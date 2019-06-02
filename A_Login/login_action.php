<?php
require_once("../configRT.php");
require_once($rootDirectory."/A_Model/Database.php");
require_once($rootDirectory."/A_Model/Data.php");
session_name('GiveGig');
session_start();

/***
*
* The next two conditionals check if user is responding to a notification.
* If $_GET['x'] is set, user is an org replying to text notification of vol offer to help.
* If $_GET['y'] is set, user is replying to a text message.
* If $_GET['z'] is set, user is vol replying to org call for help.
*/

if(isset($_GET['x']))
{
	$data = new Data;
	$x = $_GET['x'];
	$result = $data->verify($x);

	if($result == 'ok')
	{
		if($_SESSION['Pidnum']=='') // where would this have been set? -At Data verify
			{
				header(DEFAULTLOCATION."menu_vol.php");
			}
		else 
			{
			 	header(DEFAULTLOCATION."org_calendar.php");
			}
	}
}
// If y is set, then this a message retrival
elseif(isset($_GET['y']))
{
	$data = new Data;
	$y = $_GET['y'];
	$result = $data->verifyMess($y);

	if($result == 'ok')
	{
		$url = DEFAULTLOCATION."conversation.php?corres=".$_SESSION['send_from'];
		header($url);
	}
}
//* If $_GET['z'] is set, user is vol replying to org call for help.	
elseif(isset($_GET['z']))
{
	$data = new Data;
	$z = $_GET['z'];
	$result = $data->verifyVol($z);	
	if($result == 'ok')
	{ 
		header(DEFAULTLOCATION."vol_calendar.php");
	}
}

else 
{
	$username = $_POST['username'];
	$password = $_POST['password-1'];

	$sql_ar[':username'] = $username;
	$sql_ar[':isActive'] = 'y';

	$connection = new Connect;
	$db = $connection->db;

	$sql = $db->prepare("SELECT password FROM Credentials WHERE username =:username AND isActive = :isActive LIMIT 1");
	$sql->execute($sql_ar);

	while ($row = $sql->fetch(PDO::FETCH_ASSOC)) 
		{
	        $hashpwd = $row['password'];
		}
	if(password_verify($password, $hashpwd)) 
		{			
			$sql = $db->prepare	("SELECT person_id, level FROM Credentials WHERE username = :username LIMIT 1");
			$sql->bindParam(':username', $username);
			$sql->execute();
			$row = $sql->fetch(PDO::FETCH_ASSOC);		
			$_SESSION['username'] = $username;
			$_SESSION['person_id'] = $row['person_id'];
			$_SESSION['level'] = $row['level'];
			$person_id=$row['person_id'];
			
			// Update login history	
			$sql = $db->prepare	("SELECT qty_login FROM logins WHERE person_id = :person_id LIMIT 1");
			$sql->bindParam(':person_id', $_SESSION['person_id']);
			$sql->execute();			
			$row = $sql->fetch(PDO::FETCH_NUM);
			$qty_login=$row[0]+1;	
	
			$sql = $db->prepare("INSERT INTO logins(person_id, qty_login) VALUES (:person_id,:qty_login) 
			ON DUPLICATE KEY UPDATE qty_login = :qty_login; ");
			$sql->bindValue(':person_id', $_SESSION['person_id']);
			$sql->bindValue(':qty_login', $qty_login);	
			$sql->execute();			
			
			$sql = $db->prepare	("SELECT Pidnum FROM Org_employees WHERE person_id = :person_id LIMIT 1");
			$sql->bindValue(':person_id', $person_id);
			$sql->execute();	
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) 
				{
			    $_SESSION['Pidnum'] = $row['Pidnum'];
				}	
			if($_SESSION['Pidnum']=='')
				{
					header(DEFAULTLOCATION."menu_vol.php");
				}
			else 
				{
				 	header(DEFAULTLOCATION."menu_org.php");
				}
		}
	else
		{
			header(DEFAULTLOCATION."A_Login/main.php");
		}
} // End else


?>