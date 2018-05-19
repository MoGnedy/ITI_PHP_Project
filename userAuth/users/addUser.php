<?php
session_start();
if(!isset($_SESSION['username'])){
  header('Location: ../login.php');
}
//error_reporting(E_ALL);
//ini_set('display_errors', true);
//ini_set('html_errors', true);
include_once('../index.php');

 ?>
<!DOCTYPE HTML>
  <html>
    <head>
      <title>Add User</title>
      <style>
        .error {color: #FF0000;}
      </style>
    </head>
  <body>

  <?php
    // define variables and set to empty values
    $fullNameErr = $userNameErr = $passWDErr = $rePassWDErr = $expDateErr = $groupsErr = "";
    $fullName = $userName = $passWD = $rePassWD = $expDate = $groups = $insertGroup = $encryptedPassWD = "";

    $groups = getGroupsList();
    if(!count($groups)>0)
      $groups = "";

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
        if(!checkUserNameUnique($userName)){
          $userNameErr = "User Name Already Exists!";
          $errorFlag = false;
        }
      }

      if (empty($_POST["passWD"])) {
        $passWDErr = "Password is required";
        $errorFlag = false;
      } else {
        $passWD = $_POST["passWD"];
        checkWeakPassword($passWD);
        //password encryption...
        $encryptedPassWD = encryptPassword($passWD);
      }

      if (empty($_POST["rePassWD"])) {
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
        include ('../dbconnect.php');
        //password encryption...
        //$passWD = "";
        if($expDate == ""){
          $expDate = "3000-01-01";
        }
        $encryptedPassWD = mysqli_real_escape_string($db, $encryptedPassWD);
        //echo $encryptedPassWD;
        $sql = "insert into users (full_name, user_name, password, exp_date, group_id) values ('$fullName', '$userName', '$encryptedPassWD', '$expDate', '$insertGroup')";
        //$sql = "insert into users (full_name, user_name, password, exp_date, group_id) values (\"$\", \"$\", \"$\", \"$\")";
        //$sql_statement="insert into  users (full_name, user_name, password, exp_date, group_id) values(\"$\",\"$\", \"$\", \" $ \");"
        //echo $sql;
        $result = mysqli_query($db, $sql);

        if(! $result){
          echo "Couldn't insert";
          exit;
        }
        else{
          //redirect to main page
          include("../logging.php");
          logging("3","User Added ".$userName." Successfully","Adding User");
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
      include ('../dbconnect.php');
      $isUnique = true;
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
      include ('../dbconnect.php');
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
  ?>

  <h2>Add User Form</h2>
  <p><span class="error">* required field.</span></p>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
      <p><label for="fullName">Full Name: </label></p>
      <input class="form-control" type="text" name="fullName" value="<?php echo $fullName;?>"/>
     <span class="error">* <?php echo $fullNameErr;?></span>
    </div>
    <div class="form-group">
      <p><label for="userName">UserName: </label></p>
      <input class="form-control" type="text" name="userName" value="<?php echo $userName;?>"/>
      <span class="error">* <?php echo $userNameErr;?></span>
    </div>
    <div class="form-group">
      <p><label for="passWD">Password: </label></p>
      <input class="form-control" type="password" name="passWD" value="<?php echo $passWD;?>"/>
      <span class="error">* <?php echo $passWDErr;?></span>
    </div>
    <div class="form-group">
      <p><label for="rePassWD">Retype Password: </label></p>
      <input class="form-control" type="password" name="rePassWD" value="<?php echo $rePassWD;?>"/>
      <span class="error">* <?php echo $rePassWDErr;?></span>
    </div>
    <div class="form-group">
      <p><label for="expDate">Expiry Date (you may leave it blank): </label></p>
      <input class="form-control" type="date" name="expDate" value="<?php echo $expDate;?>"/>
    </div>
    <div class="form-group">
      <p><label for="group">Group: </label></p>
      <select class="form-control" name="group">
        <?php
          if ($groups == "" )
            echo '<option "selected" value="0">No Groups Found!</option>';
          else{
            //echo '<option "selected" value="0"></option>';
            foreach($groups as $group){
              echo '<option ';
              if($group["id"] == $insertGroup)
                echo 'selected ';
              echo 'value="'.$group["id"].'">'.$group["name"].'</option>';
            }
          }
          //echo $insertGroup;
         ?>
      </select>
      <span class="error">* <?php echo $groupsErr;?></span>
    </div>
    <button class="btn btn-primary" id="reset" type="reset" value="cancel">Cancel</button>
    <input  class="btn btn-primary" type="submit" name="submit" value="Add User">
  </form>

  </body>
</html>
