<?php
require_once("../configRT.php");
require_once ($_SERVER['DOCUMENT_ROOT'].'/twilio/Twilio/autoload.php');
$rootDirectory = $_SERVER['DOCUMENT_ROOT'].'/GiveGig';

use Twilio\Rest\Client;
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/phpmailer/class.phpmailer.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/phpmailer/class.smtp.php');
require_once($rootDirectory."/A_Model/Database.php");
session_start();

$connection = new Connect;
$db = $connection->db;

// Does this user_name exist?
$sql = $db->prepare("SELECT person_id FROM Credentials WHERE username LIKE :username ");		
$sql->bindValue(':username', $_POST['user_name']);
$sql->execute();
$row = $sql->fetch(PDO::FETCH_NUM);

if($row[0] != '')
	{
	// generate tag and put in table
		$uniqueId = uniqid();
		$microtime = microtime();
		$microtime = substr($microtime, -5);
		$tag = $uniqueId.$microtime;
		
		$reset_link = WEB_ROOT."A_Login/reset.php?tag=".$tag;
		
		
		$sql = $db->prepare("INSERT INTO Click_in_pwd_reset (person_id, tag) VALUES (:person_id, :tag)
		ON DUPLICATE KEY UPDATE tag = :tag ");		
		$sql->bindValue(':person_id', $row[0]);
		$sql->bindValue(':tag', $tag);
		$sql->execute();
		
		$body_email = "Please <a href=\"".$reset_link."\">click here</a> to reset your password for GiveGig.";
		
		$body_text = "Follow link to reset you password for GiveGig."
			.PHP_EOL.$reset_link;	
	
		if($_POST['send_as'] == 'email')
			{
				
				$sql = $db->prepare("SELECT email_address FROM Person_email WHERE person_id = :person_id ");		
				$sql->bindValue(':person_id', $row[0]);
				$sql->execute();
				$row = $sql->fetch(PDO::FETCH_NUM);
				
				$email = $row[0];
				
				$mail = new PHPMailer;
				$mail->isHTML(true);
				
				$mail->setFrom('technician@mnrt.net', 'GiveGig');
				$mail->addReplyTo('technician@mnrt.net', 'GiveGig');

				$mail->addAddress($email);
				$mail->Subject = 'Password reset';
				$mail->Body = $body_email;
				$mail->send();			
			}
		elseif($_POST['send_as'] == 'text')
			{				
				$sql = $db->prepare("SELECT area_code, phone_number FROM Person_phone WHERE person_id = :person_id ");		
				$sql->bindValue(':person_id', $row[0]);
				$sql->execute();
				$row = $sql->fetch(PDO::FETCH_NUM);
				
				$area = preg_replace( "/[^0-9]/", "", $row[0] );
				$phone = preg_replace( "/[^0-9]/", "", $row[1] );
				$fullAddress = '+1'.$area.$phone;

					$client = new Client(TWILIO_ACCOUNT_SID, TWILIO_TOKEN);
					$client->messages->create
					(
					$fullAddress,
					array(
					'from' => "+16087193767",
					'body' => $body_text,
					)
					);
			} 
		$_SESSION['sent']='yes';
	}
else 
	{
	 	$_SESSION['found']='no';
	}
	
$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
$location = 'Location:'.$url;
header($location);


	


	
	
	
	
	
	
	
	
	?>