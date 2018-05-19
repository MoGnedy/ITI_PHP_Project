<?php
session_start();
if(!isset($_SESSION['username'])){
	header('Location: ../login.php');
}
include("../dbconnect.php");
if (isset($_GET['id']) ) {
	$id = $_GET['id'];
	$sql_statement="select * from users where id = $id;";
	$result = mysqli_query( $db, $sql_statement);
	if ($result){
		$sql_statement="update users set is_blocked= 1 where id= $id;";
		 mysqli_query( $db, $sql_statement);
		 include("../logging.php");
 			logging("3","User ".$_SESSION['username']."Blocked a user Successfully","Blocked User");
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
