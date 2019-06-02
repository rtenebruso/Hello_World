<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'].'/GiveGig';
require_once($rootDirectory."/configRT.php");
session_name('GiveGig');
session_start();

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) 
	{
		$params = session_get_cookie_params();
		setcookie(session_name('GiveGig'), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}

session_destroy();

echo "<h4>You have been logged out.</h4>";

echo "<a href=\"".WEB_ROOT."\" >Click here to log back in.</a>";


 
?>