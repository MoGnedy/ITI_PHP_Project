<?php
session_start();

    include('check_request.php');
    include_once "log/LogsFunctions.php";

    $user_name= $_POST['delete_user'];
    //echo " $user_name";
    $remote_group = $_POST['remote_group'];
  	$remote_user = $_POST['remote_user'];

    exec("sudo userdel '$user_name'", $out, $code);
  	if($code == 0) {
  		infolog("Successfully deleted user '".$user_name."'", "Success");
  	}
  	else {
  		errlog( "Error ".$code.": unable to delete user '".$user_name."'");
  	}

    exec("sudo rm -rf /home/'$user_name'",$out, $code1);
    if($code1 == 0) {
      infolog("Successfully deleted home directory for user '".$user_name."'", "Success");
    }
    else {
      errlog( "Error ".$code1.": unable to delete home directory for user '".$user_name."'");
    }
    header('Location: index.php');
 ?>
