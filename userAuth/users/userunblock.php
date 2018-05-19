<?php
session_start();
if(!isset($_SESSION['username'])){
	header('Location: ../login.php');
}
include("../dbconnect.php");
if (isset($_GET['id']) ) {
	$id = $_GET['id'];
	echo $id;
	$sql_statement="select * from users where id = $id;";
	$result = mysqli_query( $db, $sql_statement);
	if ($result){
		$sql_statement="update users set is_blocked= 0 where id= $id;";
		 mysqli_query( $db, $sql_statement);
		 include("../logging.php");
 		infolog("User ".$_SESSION['username']."Un-Blocked a user Successfully","Un-Blocked User");
		 header('Location: allUsers.php');
	}
	else {
		http_response_code(404);
		exit();
	}
}
else {
	http_response_code(404);
	exit();
}
?>
