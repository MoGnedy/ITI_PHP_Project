<?php
	session_start();
	if($_SESSION['username']){
		include("logging.php");
		logging("3","logged out","logged out");
		session_destroy();
		header('Location: login.php');
	}
?>
