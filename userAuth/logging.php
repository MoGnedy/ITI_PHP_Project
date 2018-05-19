<?php
session_start();
function logging($logType="", $message="", $infoType="Info"){
	//echo $_SERVER['DOCUMENT_ROOT']. 'Logging/LogsFunctions.php';
	require_once($_SERVER['DOCUMENT_ROOT'] . 'Logging/LogsFunctions.php');
	switch($logType){
		case 1:
			warnlog($message);
			break;
		case 2:
			errlog($message);
			break;
		case 3:
			infolog($message,$infoType);
			break;
		default:
			infolog($message,$infoType);
			break;
	}
}
?>
