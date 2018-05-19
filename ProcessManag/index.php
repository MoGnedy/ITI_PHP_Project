<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
    <script type="text/javascript" src="node_modules/tether/dist/js/tether.js"></script>
    <script type="text/javascript" src="node_modules/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.css">
      <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div id="wrap">
  <div id="regbar">
    <div id="navthing">
      <h2><a href="#" id="loginform">Login</a> </h2>
    <div class="login">
      <div class="arrow-up"></div>
      <div class="formholder">
        <div class="randompad">
           <fieldset>
             <form method="post" >
             <label >Username</label>
             <input type="text" name="name" required/>
             <label >Password</label>
             <input type="password" name="password" required/>
             <input type="submit" value="Login" name="button" />
             </form>
           </fieldset>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</html>
<?php
include_once "LogsFunctions.php";
if (isset($_POST['button'])) {
  $myUsername=$_POST['name'];
  $myPassword=$_POST['password'];
  $gName="Signal2 Team";
  $uName=$_POST['name'];

  function authenticate($user, $pass){
    // run shell command to output shadow file, and extract line for $user
    // then spit the shadow line by $ or : to get component parts
    // store in $shad as array
    $shad =  preg_split("/[$:]/",`sudo cat /etc/shadow | grep "^$user\:"`);
    // use mkpasswd command to generate shadow line passing $pass and $shad[3] (salt)
    // split the result into component parts
    $mkps = preg_split("/[$:]/",trim(`mkpasswd -m sha-512 $pass $shad[3]`));
    // compare the shadow file hashed password with generated hashed password and return
    return ($shad[4] == $mkps[3]);
  }

  // usage...
  if(authenticate($myUsername,$myPassword)){
    session_start();
    $_SESSION['name']=$myUsername;
    $message="Logged in Successfully";
    $infoType="Success";
    infolog($message,$infoType);
    header("Location: process.php");
  } else {
    $message="fail to login";
    errlog($message);
    echo"<div class='alert alert-danger'>
  <strong>ERROR!</strong> not valid user.
</div>";
  }

}
?>