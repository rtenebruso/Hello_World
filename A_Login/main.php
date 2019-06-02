<?php
$_SESSION = array();
if (ini_get("session.use_cookies")) 
	{
		$params = session_get_cookie_params();
		setcookie(session_name('GiveGig'), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}

$rootDirectory = $_SERVER['DOCUMENT_ROOT'].'/GiveGig';
//require_once($rootDirectory."/A_Model/sessionname.php");
require_once($rootDirectory."/A_Model/Database.php");
require_once($rootDirectory."/A_Model/Data.php");
//require_once($rootDirectory."/configRT.php");
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
	
<?php
	echo "<form name=\"myform\" action = \"login_action.php\" method = \"post\">";
	
	echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<input type=\"text\" name=\"username\" placeholder=\"user name\"></p>";
		
	echo "<p>&#128274;&nbsp;";
		echo "<input type=\"password\" name=\"password-1\" placeholder=\"password\" ></p>";
?>

<p id="forgot">
 <a href="forgot_password.php">Forgot Password</a> 
</p>

<br/><br/>
<input type="submit" value="Log In">


</div> <!--content-->
</div> <!-- bigcontainer -->
</body>
</html>