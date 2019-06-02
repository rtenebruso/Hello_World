<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'].'/GiveGig';
require_once($rootDirectory."/A_Model/Database.php");
require_once($rootDirectory."/configRT.php");
session_name('GiveGig');
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>GiveGig</title>
<meta name="viewport" content="width=500">
<link rel="icon" href="../images/favicon.png">
<link href="../givegig_2.css" rel="stylesheet" type="text/css">
<link href="login.css" rel="stylesheet" type="text/css">

<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,800" rel="stylesheet">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<style type="text/css">
</style>
</head>

<body>
<div id="container_dark">
<div id="content">
	
<img id="logo" src="..\images\GiveGig_light_background.png" alt="GiveGig Logo">

<!--Check for tag-->
<?php
$connection = new Connect;
$db = $connection->db;

// Don't do tag stuff is person sent back for bad password


if(!isset($_SESSION['person_id']))
	{
		$sql = $db->prepare("SELECT person_id FROM Click_in_pwd_reset WHERE tag = :tag ");		
		$sql->bindValue(':tag', $tag = $_GET['tag']);
		$sql->execute();
		$row = $sql->fetch(PDO::FETCH_NUM);
		if(!isset($row))
			{
				// Did not find tag in table
			}
		else 
			{ 	
				$_SESSION['person_id'] = $row[0];
				$sql = $db->prepare("DELETE FROM Click_in_pwd_reset WHERE person_id = :person_id ");		
				$sql->bindValue(':person_id', $_SESSION['person_id'] );
				$sql->execute();
				$_SESSION['error']=$sql->errorinfo();
				
			}
	}
if($_SESSION['pwd_result'] == 'no match')
{
	echo "The passwords did not match. Please try again.";
	unset($_SESSION['pwd_result']);
}
elseif($_SESSION['pwd_result'] == 'blank')
{
	echo "Password cannot be left blank. Please try again.";
	unset($_SESSION['pwd_result']);
}

?>
		<form name="myform" action = "reset_action.php" method = "post">	

		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="password_1" placeholder="password"></p>

		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="password_2" placeholder="confirm"></p>

		<br/><br/>
		<input type="submit" value="Change my password">
		
</div> <!--content-->
</div> <!-- bigcontainer -->
</body>
</html>