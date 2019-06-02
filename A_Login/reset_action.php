<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'].'/GiveGig';
require_once($rootDirectory."/A_Model/Database.php");
require_once($rootDirectory."/configRT.php");
session_name('GiveGig');
session_start();

$connection = new Connect;
$db = $connection->db;

$password_1 = $_POST['password_1'];
$password_2 = $_POST['password_2'];

if($password_1 !='' && $password_2!='')
{
	$changePasswordRequest = 'yes';
	if($password_1 == $password_2)
	{
		$hashedPassword = password_hash($password_1, PASSWORD_DEFAULT);	
		
		$sql = $db->prepare("UPDATE Credentials SET password = :password WHERE person_id =:person_id ;");		
		$sql->bindValue(':password', $hashedPassword);
		$sql->bindValue(':person_id', $_SESSION['person_id']);
		$sql->execute();
		
		$url = "Location:".WEB_ROOT;
		header($url);
	}
	else
	{
	 	$_SESSION['pwd_result'] = 'no match';
	 	$url = "Location:".htmlspecialchars($_SERVER['HTTP_REFERER']);
		header($url);
	 	
	}
}
else 
{
		$_SESSION['pwd_result'] = 'blank';
		$url = "Location:".htmlspecialchars($_SERVER['HTTP_REFERER']);
		header($url);
}
?>

</body>
</html>		
