<?php
  session_start();
  if(!isset($_SESSION['username'])){
    header('Location: ../login.php');
  }
  include('../index.php');
?>
<form class="" action="usersearch.php" method="post">
	<div class="form-group">
  		<label for="username">User Name</label>
  		<input class="form-control" type="text" name="username" value="">
	</div>
  <button class="btn btn-primary" type="submit" name="button">Search</button>
</form>
<?php
if($_POST['username']){
  $userName = $_POST['username'];
  //echo $userName;
  $db = mysqli_connect( "localhost" , "root" , "root" , "authdb" );
  if(mysqli_connect_errno($db)){
    echo "error while connecting to db";
    exit;
  }else{
    $query = "SELECT * FROM users WHERE user_name LIKE '%$userName%'";
    $result = mysqli_query($db,$query);
    $numOfUsers = mysqli_num_rows($result);
    if($numOfUsers>0){      
      echo "Total Number Of Users Is : ".$numOfUsers;
      echo "<table id='datatable' class='table table-striped table-bordered'>
            <thead>
              <tr>
                <th>User Name</th>
                <th>Group Id</th>
              </tr>
            </thead>
            <tbody>";
      for($i = 0 ; $i < $numOfUsers ; $i++){
        $userData = mysqli_fetch_assoc($result);
        echo "<tr>
                <td>".$userData['user_name']."</td>
                <td>".$userData['group_id']."</td>
              </tr>";
      }
      echo "</tbody>
          </table>";
    }else{
      echo "No Data";
    }
  }
}

?>
