<?php
	session_start();
	if($_SESSION['username']){
		include("../logging.php");
		logging("3","User Logged Out ".$_SESSION['username']." Successfully","Logged Out User");
		session_destroy();
		header('Location: login.php');
	}
?>
