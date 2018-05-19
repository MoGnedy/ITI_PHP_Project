
<?php
session_start();
if(!isset($_SESSION['username'])){
	header('Location: ../login.php');
}
 include ('../index.php');

error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);
 ?>
<!DOCTYPE HTML>
  <html>
    <head>
      <title>Edit User</title>
      <style>
        .error {color: #FF0000;}
      </style>
    </head>
  <body>
  	<div class="row">
		<div class="col-md-8">
		</div>
		<div class="col-md-4" style="text-align: center">
			<div>
				<a class="btn btn-primary" href="addUser.php"> Add user </a>
			</div>
			<div>
				<a class="btn btn-primary" href="usersearch.php"> Search user </a>
			</div>
		</div>
	</div>
  <?php
    // define variables and set to empty values
    $fullNameErr = $userNameErr = $passWDErr = $rePassWDErr = $expDateErr = $groupsErr = "";
    $userID = $fullName = $userName = $passWD = $rePassWD = $expDate = $groups = $insertGroup = $encryptedPassWD = $currentPassWD = "";
    if(isset($_GET["userID"])){
      $userID = $_GET["userID"];
      //echo "$userID";
      getUserData($userID);
    }
    $groups = getGroupsList();
    if(!count($groups)>0){
      $groups = "";
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $errorFlag = true;
      if (empty($_POST["fullName"])) {
        $fullNameErr = "Name is required";
        $errorFlag = false;
      } else {
        $fullName = test_input($_POST["fullName"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$fullName)) {
          $fullNameErr = "Only letters and white space allowed";
          $errorFlag = false;
        }
      }
      if (empty($_POST["userName"])) {
        $userNameErr = "User Name is required";
        $errorFlag = false;
      } else {
        $userName = test_input($_POST["userName"]);
        // check if username only contains letters numbers or . or _ or -
        if (!preg_match("/^[a-zA-Z0-9._-]*$/",$userName)) {
          $userNameErr = "Only letters, numbers and . or _ or - allowed";
          $errorFlag = false;
        }
        //Must Check if UserName exists!?
        /*if(!checkUserNameUnique($userName)){
          $userNameErr = "User Name Already Exists!";
          $errorFlag = false;
        }*/
      }
      if (empty($_POST["passWD"])) {
        $encryptedPassWD = getPassword($userID);
      } else {
        $passWD = $_POST["passWD"];
        checkWeakPassword($passWD);
        //password encryption...
        $encryptedPassWD = encryptPassword($passWD);
      }
      if (!empty($_POST["passWD"]) && empty($_POST["rePassWD"])) {
        $rePassWDErr = "Password Confirmation is required";
        $errorFlag = false;
      } else {
        $rePassWD = $_POST["rePassWD"];
        if(!($passWD == $rePassWD))
        {
          //echo "PW".$passWD, "rePW".$rePassWD;
          $rePassWDErr = "Password and Confirmation didn't match";
          $errorFlag = false;
        }
      }
      if (!empty($_POST["group"])){
        $insertGroup = $_POST["group"];
      }
      if (!empty($_POST["expDate"])){
        $expDate = $_POST["expDate"];
      }
      //Insert Data into database
      if($errorFlag){
        extract($_POST);
         include("../dbconnect.php");

        //password encryption...
        //$passWD = "";
        $expDate1 = $expDate;
        if($expDate == ""){
          $expDate1 = "3000-01-01";
        }
        $encryptedPassWD = mysqli_real_escape_string($db, $encryptedPassWD);
        $sql = "UPDATE `users` SET `full_name`='$fullName',`user_name`='$userName',`password`='$encryptedPassWD',`exp_date`='$expDate1',`group_id`='$insertGroup' WHERE id = $userID;";
        //$sql = "insert into users (full_name, user_name, password, exp_date, group_id) values (\"$\", \"$\", \"$\", \"$\")";
        //$sql_statement="insert into  users (full_name, user_name, password, exp_date, group_id) values(\"$\",\"$\", \"$\", \" $ \");"
        //echo $sql;
        mysqli_query($db, $sql);
        //echo "<br>";
        $result = mysqli_affected_rows($db);
        //echo $result;
        if($result<1){
          echo "Couldn't update";
          //$newURL = "http://php.com/Project/ITI_PHP_Project/gp4/editUser.php?userID=$userID";
          //header('Location: '.$newURL);
        }
        else{
          //redirect to main page
					include("../logging.php");
          logging("3","User Edited ".$userName." Successfully","Editing User");
 ?>
          <script>
            alert("Done!");
            location.href="allUsers.php";
          </script>
<?php
        }
          mysqli_close($db);
      }
    }
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    function checkUserNameUnique($userName){
      include("../dbconnect.php");
      $sql = "select * from users where user_name like '$userName'";
      //echo $sql;
      //echo $userName;
      $result = mysqli_query($db, $sql);
      if(mysqli_num_rows($result)>0){
        $isUnique = false;
        //var_dump($result);
        //echo $isUnique;
      }
      mysqli_close($db);
      return $isUnique;
    }
    function getGroupsList(){
      include("../dbconnect.php");

      $sql = "SELECT * FROM `groups`;";
      $result = mysqli_query($db, $sql);
      $rows = [];
      while($row = mysqli_fetch_array($result))
      {
          $rows[] = $row;
      }
      //var_dump($rows);
      mysqli_close($db);
      return $rows;
    }
    function checkWeakPassword($passWD){
      global $passWDErr, $errorFlag;
      // check if password contains mixed chars and strong
      if (strlen($passWD) < 8) {
        $passWDErr = "Password too short!";
        $errorFlag = false;
      }
      if (strlen($passWD) > 25) {
        $passWDErr = "Password too long!";
        $errorFlag = false;
      }
      if (!preg_match("#[0-9]+#", $passWD)) {
          $passWDErr .= "<br>Password must include at least one number!";
          $errorFlag = false;
      }
      if (!preg_match("#[a-z]+#", $passWD)) {
          $passWDErr .= "<br>Password must include at least one letter!";
          $errorFlag = false;
      }
      if (!preg_match("#[A-Z]+#", $passWD)) {
          $passWDErr .= "<br>Password must include at least one upper letter!";
          $errorFlag = false;
      }
      if (!preg_match("#\W+#", $passWD)) {
          $passWDErr .= "<br>Password must include at least one special character!";
          $errorFlag = false;
      }
    }
    function encryptPassword($passWD){
      include("password.php");
      $hash = password_hash($passWD, PASSWORD_BCRYPT);
      return $hash;
    }
    function getUserData($userID){
      global $fullName, $userName, $expDate, $groups, $insertGroup, $currentPassWD ;
      include ('../dbconnect.php');
      $sql = "SELECT * FROM `users` where id = '$userID';";
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_assoc($result);
      //var_dump($row);
      //var_dump($result);
      //echo $sql;
      $fullName = $row["full_name"];
      $userName = $row["user_name"];
      $expDate = $row["exp_date"];
      if($expDate == "3000-01-01"){
        $expDate = "";
      }
      $groups = $row["group_id"];
      $insertGroup = $row["group_id"];
      $currentPassWD = $row["password"];
      mysqli_close($db);
    }
    function getPassword($userID){
      include("../dbconnect.php");
      $sql = "SELECT `password` FROM `users` where id = '$userID';";
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_assoc($result);
      $currentPassWD = $row["password"];
      mysqli_close($db);
      return $currentPassWD;
    }
  ?>

  <h2>Edit User Form</h2>
  <p><span class="error">* required field.</span></p>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?userID=".$userID);?>">
  	<div class="from-group">
	    <p><label for="fullName">Full Name: </label></p>
	    <input class="form-control" type="text" name="fullName" value="<?php echo $fullName;?>"/>
	    <span class="error">* <?php echo $fullNameErr;?></span>
    </div>
    <div class="from-group">
	    <p><label for="userName">UserName: </label></p>
	    <input class="form-control" type="text" name="userName" value="<?php echo $userName;?>"/>
	    <span class="error">* <?php echo $userNameErr;?></span>
    </div>
    <div class="form-group">
	    <p><label for="passWD">Password: </label></p>
	    <input type="password" name="passWD" value="<?php echo $passWD;?>"/>
	    <span class="error">* <?php echo $passWDErr;?></span>
    </div>
    <div class="form-group">
	    <p><label for="rePassWD">Retype Password: </label></p>
	    <input class="form-control" type="password" name="rePassWD" value="<?php echo $rePassWD;?>"/>
	    <span class="error">* <?php echo $rePassWDErr;?></span>
    </div>
    <div class="form-group">
	    <p><label for="expDate">Expiry Date (you may leave it blank): </label></p>
	    <input class="form-control" type="date" name="expDate" value="<?php echo $expDate;?>">
	    <br>
	    <p><label for="group">Group: </label></p>
	</div>
	<div class="form-group">
	    <select name="group">
	      <?php
	        if ($groups == "" )
	          echo '<option "selected" value="0">No Groups Found!</option>';
	        else{
	          //echo '<option "selected" value="0"></option>';
	          foreach($groups as $group){
	            echo '<option ';
	            if($group["id"] == $insertGroup)
	              echo 'selected ';
	            echo 'value="'.htmlspecialchars((isset($group["id"]))?$group["id"]:0).'">'.$group["name"].'</option>';
	          }
	        }
	        echo $insertGroup;
	       ?>
	    </select>
	  </div>
    <span class="error">* <?php echo $groupsErr;?></span>
    <br>
    <input type="hidden" name="userID" value="<?php echo htmlspecialchars((isset($userID))?$userID:0); ?>" />
    <br>
    <button class="btn btn-primary" id="reset" type="reset" value="cancel">Cancel</button>
    <input class="btn btn-primary" type="submit" name="submit" value="Update User">
  </form>

  </body>
</html>
