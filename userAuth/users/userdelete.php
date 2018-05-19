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
		$sql_statement="delete from users where id = $id;";
		 mysqli_query( $db, $sql_statement);
		 include("../logging.php");
 		logging("3","User ".$_SESSION['username']."Deleted a user Successfully","Deleted User");
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
