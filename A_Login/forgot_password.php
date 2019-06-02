<?php

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
if($_SESSION['found']=='no')
{
	unset($_SESSION['found']);
	echo "The user name entered cannot be found. Please try again.<br/>";
}

if($_SESSION['sent']=='yes')
{
	unset($_SESSION['sent']);
	echo "A link to reset your password has been sent to you!<br/>";
}
else 
{
?>
<form name="myform" action = "forgot_password_action.php" method = "post">	

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="user_name" placeholder="user name"></p>
  
We will send a link to reset your password.
<br><br>	
	
  <input type="radio" name="send_as" value="email" checked> Send Email<br><br>
  <input type="radio" name="send_as" value="text"> Send Text<br>

<br/><br/>
<input type="submit" value="Send reset link">
<?php } ?> <!--ends else-->

</div> <!--content-->
</div> <!-- bigcontainer -->
</body>
</html>