<head>
 
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
</head>

<html >
<head>
  <meta charset="UTF-8">
  <title>Processes</title>
      <link rel="stylesheet" href="css/style.css">
</head>

  <div id="wrap">
  <div id="regbar">
    <div id="navthing">
      <form class="" action="process.php" method="post">
        <button type="submit" name="logout" class="btn btn-danger" style="margin-top: 20;">Logout</button>
                <button type="submit" name="logs" class="btn btn-default" style="margin-top: 20;">Logs</button>
      </form>
    </div>
  </div>
</div>




<?php
ob_start();
session_start();
include_once "LogsFunctions.php";

if (! isset($_SESSION['name'])) {
  header("Location: index.php");
}
else {
  $name=$_SESSION['name'];
  $uName=$name;
  $command='ps -u'.$name;
  exec($command, $output);
  for($i=0;$i<sizeof($output);$i++) {
    $output[$i] = preg_replace('/\s/', ' ', $output[$i]);
    $line[$i]=explode(" ",$output[$i]);
    $line[$i] = array_filter($line[$i], 'strlen');  //removes null values but leaves "0"
    $line[$i] = array_filter($line[$i]);
  //   print_r($line[$i]);
  //   echo "<br>";
  }

  for ($i=0; $i < sizeof($line); $i++) {
    $j=0;
    foreach ($line[$i] as $value) {
      $lastArray[$i][$j]=$value;
      $j++;
    }
    // print_r($lastArray[$i]);
    // echo "<br>";
  }

  for ($i=0; $i < sizeof($lastArray); $i++) {
    if (isset($lastArray[$i][4])) {
      $lastArray[$i][3]=$lastArray[$i][3]." ".$lastArray[$i][4];
      unset($lastArray[$i][4]);
    }
  }
?>
<div class="container">

<table  class="table table-hover" style="color:white;margin-bottom:70px;">
  <?php
  for ($i=0; $i < sizeof($lastArray); $i++) {
    if ($i==0) {
      echo "<tr>";
      echo "<th>Check</th>";
      echo "<th> UID </th>";
      foreach ($lastArray[$i] as $value) {
        echo "<th>".$value."</th>";
      }
      echo "</tr>";
    }
    else{
      echo "<tr>";
      echo"<td><form method='post'>
<form method='post'> <input class='radio' type='checkbox' name='process[]' value=".$lastArray[$i][0]."></td>";
      echo "<td>".$name."</td>";
      foreach ($lastArray[$i] as $value) {
        echo "<td>".$value."</td>";
      }
      echo "</tr>";
    }
  }

   ?>
</table>
</div>
<?php
  if (isset($_POST['kill'])) {
    $signal=9;
    foreach($_POST['process'] as $pID) {
      $killCmd='kill -'.$signal.' '.$pID;
      echo `sudo runuser -l $name -c '$killCmd'`;
      }
      $message="Kill Process ";
      foreach($_POST['process'] as $pID) {
        $message=$message." ".$pID;
        }
      $infoType="Success";
      infolog($message,$infoType);
    header("Location: process.php");
  }

  if (isset($_POST['terminat'])) {
    $signal=15;
    foreach($_POST['process'] as $pID) {
      $killCmd='kill -'.$signal.' '.$pID;
      echo `sudo runuser -l $name -c '$killCmd'`;
      }
      $message="Terminate Process ";
      foreach($_POST['process'] as $pID) {
        $message=$message." ".$pID;
        }
      $infoType="Success";
      infolog($message,$infoType);
    header("Location: process.php");
  }

  if (isset($_POST['stop'])) {
    $signal=19;
    foreach($_POST['process'] as $pID) {
      $killCmd='kill -'.$signal.' '.$pID;
      echo `sudo runuser -l $name -c '$killCmd'`;
      }
      $message="Stop Process ";
      foreach($_POST['process'] as $pID) {
        $message=$message." ".$pID;
        }
      $infoType="Success";
      infolog($message,$infoType);
    header("Location: process.php");
  }

  if (isset($_POST['resume'])) {
    $signal=18;
    foreach($_POST['process'] as $pID) {
      $killCmd='kill -'.$signal.' '.$pID;
      echo `sudo runuser -l $name -c '$killCmd'`;
      }
      $message="Resume Process ";
      foreach($_POST['process'] as $pID) {
        $message=$message." ".$pID;
        }
      $infoType="Success";
      infolog($message,$infoType);

    header("Location: process.php");
  }

  if (isset($_POST['seg'])) {
    $signal=11;
    foreach($_POST['process'] as $pID) {
      $killCmd='kill -'.$signal.' '.$pID;
      echo `sudo runuser -l $name -c '$killCmd'`;
      }
      $message="Memory Segment Process ";
      foreach($_POST['process'] as $pID) {
        $message=$message." ".$pID;
        }
      $infoType="Success";
      infolog($message,$infoType);
    header("Location: process.php");
  }

  if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
  }
  if (isset($_POST['logs'])) {
    header("Location: logs.php");
  }
}

ob_end_flush();
?>
 <form class="" action="process.php" method="post">
   <center style="margin:20px;position: fixed;
    bottom: 0;
    right: 180px;
    width: 800px;">
     <button type="submit" name="kill" class="btn btn-danger" onclick="myFunction()" style="width:150px;">Kill</button>
     <button type="submit" name="terminat" class="btn btn-danger" onclick="myFunction()" style="width:150px;">Terminat</button>
     <button type="submit" name="stop" class="btn btn-danger" onclick="myFunction()" style="width:150px;">Stop</button>
     <button type="submit" name="resume" class="btn btn-success" onclick="myFunction()" style="width:150px;">Resume</button>
     <button type="submit" name="seg" onclick="myFunction()" class="btn btn-warning" style="width:150px;">Memory Segment</button>
     
   </center>

 </form>

 <script type="text/javascript">
 function myFunction() {
    var x = document.getElementTagName("button").checked;
    // if(!x){
    // //    alert("no selected");
    // //  }
    console.log(x);
 }
 </script>

 <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

   <script src="js/index.js"></script>
   <script type="javascript">
 function myFunction() {
   var x=document.getElementsByClassName('radio');
   var result=0,q=0;
   for (var i=0;i<x.length;i++){
      q=x[i].checked;
        if(q){
          result++;
        }
   }
   if (! result) {
     alert('no process selected');
   }

 }
 </script>
