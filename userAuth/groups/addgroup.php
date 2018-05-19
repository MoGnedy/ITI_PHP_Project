<?php
session_start();
if(!isset($_SESSION['username'])){
  header('Location: ../login.php');
}
include_once('../index.php');

if (!isset($_POST['group_name']) ) {
 ?>
 <html>
   <head>
      <title> Add Group </title>
      <script>
      </script>
   </head>
   <body>
     <form id="form" method='post' action="addgroup.php">
     	<div class="form-group">
        	<label> Group Name </label>
        	<input class="form-control" type="text" name="group_name" id="group-name" placeholder="add group name">
        </div>
        <div class="form-group">
        	<label> Group Description </label>
        	<textarea class="form-control" name="group_desc" id="group_desc" placeholder="add group description"></textarea>
        </div>
        <div class="form-group">
        	<label> Call Back </label>
        	<input class="form-control" type="text" name="callBack" id="callback" placeholder="add callBack function url">
        </div>
        <div class="form-group">
        	<label> Project Number </label>
          <select class="form-control" type="number" name="group_proj_num" id="group-proj-num" placeholder="add project number">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </div>
        <input id="submit-btn" class="btn btn-primary" type="button" value ="submit">

     </form>
   </body>
   <script>
     document.getElementById('submit-btn').addEventListener("click", function() {
         var groupName= document.getElementById('group-name');
         var callBack= document.getElementById('callback');
         var projNum= document.getElementById('group-proj-num');
         if ( groupName.value ) {
           if( callBack.value) {
             if (projNum.value) {

                   document.getElementById('form').submit();
                }
         }
         else {
              alert("One or more fields are empty !! " );
         }
       }
         else {
               alert("One or more fields are empty !! " );
         }



     });

   </script>
 </html>
 <?php
}
 else {
   function secure_input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
   }
   $_POST['group_name'] = secure_input($_POST['group_name']);
   $_POST['group_desc'] = secure_input($_POST['group_desc']);
   $_POST['callBack'] = secure_input($_POST['callBack']);
   $_POST['group_proj_num'] = secure_input($_POST['group_proj_num']);

   extract($_POST);
   include("../dbconnect.php");
   $sql_statement="insert into groups(name,group_desc,callBack, proj_num) values (\" $group_name \",
    \"$group_desc\", \"$callBack\", \"$group_proj_num\");";
    //echo $sql_statement;
    $result = mysqli_query( $db, $sql_statement);
    if (! $result ) {
      echo "can't insert";
      exit;
    }
    else {
      ?>
      <script>
      alert("Done");
      location.href="allgroups.php"
      </script>
      <?php
      include("../logging.php");
      logging("3","Group Added ".$group_name." Successfully","Adding Group");
    }
    mysqli_close($db);
 }
 ?>
