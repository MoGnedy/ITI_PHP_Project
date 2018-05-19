<?php
 	$DBuser = 'root';
 	$DBpass = 'root';
 	$DBname = "authdb";
	$DBhost = "localhost";
	$db= mysqli_connect($DBhost, $DBuser, $DBpass, $DBname );
			 	if(mysqli_connect_errno() ) {
			 		echo "Error connect";
			 		exit;
			 	}
?>
