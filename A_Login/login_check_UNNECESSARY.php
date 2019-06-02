<?php

$location = 'Location: /develop/GiveGig';
	if(!isset($_SESSION['username']))
	{
		header($location);
		exit();
	}	
/*###################################################################*/	
?>