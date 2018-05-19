<?php

session_start();

if (isset($_SESSION['name'])){
function errlog($message){
	//$u =exec('whoami');
	$uName=$_SESSION['name'];
	$gName="Signal2 Team";
	$projNum=3;
	$app="PhpProject";
	$gName = preg_replace('/\s+/', '', $gName);
	$uName = preg_replace('/\s+/', '', $uName);
	$log=$projNum." ".$gName.":".$uName." **ERROR** ".$message;
//	exec("logger -i -t '$u' -p local2.err '$log'");
         //define_syslog_variables();
        openlog($app, LOG_NDELAY | LOG_PID , LOG_LOCAL2);
        syslog(LOG_CRIT, $log);
        closelog();
        
        
}

function warnlog($message){
	//$u =exec('whoami');
	$app="PhpProject";
	$uName=$_SESSION['name'];
	$gName="Signal2 Team";
	$projNum=3;
	$gName = preg_replace('/\s+/', '', $gName);
	$uName = preg_replace('/\s+/', '', $uName);
	$log=$projNum." ".$gName.":".$uName." **WARNING** ".$message;
//	exec("logger -i -t '$u' -p local3.warn '$log'");
        //define_syslog_variables();
        openlog($app, LOG_NDELAY | LOG_PID , LOG_LOCAL3);
        syslog(LOG_WARNING, $log);
        closelog();
}


function infolog($message,$infoType){
	//$u =exec('whoami');
	$app="PhpProject";
	$uName=$_SESSION['name'];
	$gName="Signal2 Team";
	$projNum=3;
	$gName = preg_replace('/\s+/', '', $gName);
	$uName = preg_replace('/\s+/', '', $uName);
	$infoType = preg_replace('/\s+/', '', $infoType);
	$log=$projNum." ".$gName.":".$uName." **".$infoType."** ".$message;
	//exec("logger -i -t '$u' -p local4.info '$log'");
         //define_syslog_variables();
        openlog($app, LOG_NDELAY | LOG_PID , LOG_LOCAL4);
        syslog(LOG_INFO, $log);
        closelog();
}
}










?>

