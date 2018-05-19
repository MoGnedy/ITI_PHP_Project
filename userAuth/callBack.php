<?php
  function goCallBack(){
    session_start();
    $callBack = $_SESSION['callBack'];
    header('Location: '.$callBack);
  }

 ?>
