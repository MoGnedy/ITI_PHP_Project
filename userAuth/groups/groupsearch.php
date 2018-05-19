<?php
session_start();
if(!isset($_SESSION['username'])){
	header('Location: ../login.php');
}
  include_once('../index.php');
?>
<div class="row">
    <div class="col-md-8">
      <?php
        echo "No of records : " . $ro . " <br>";
        ?>
    </div>
    <div class="col-md-4" style="text-align: center">
      <div>
        <a href="addgroup.php" class="btn btn-primary"> Add Group </a>
      </div>
      <div>
      <a href="groupsearch.php" class="btn btn-primary"> Search group </a>
      </div>
    </div>
  </div>

<form class="" action="groupsearch.php" method="post">
	<div class="form-group">
	  	<label for="Group Name">Group Name</label>
	  	<input class="form-control" type="text" name="groupname" value="">
  	</div>
  <button class="btn btn-primary" type="submit" name="button">Search</button>
</form>
<?php
if($_POST['groupname']){
  $groupname = $_POST['groupname'];
  //echo $groupname;
  include("../dbconnect.php");
   $query = "SELECT * FROM groups WHERE name LIKE '%$groupname%'";
   $result = mysqli_query($db,$query);
   $numOfGroups = mysqli_num_rows($result);
    if($numOfGroups>0){
      echo "Total Number Of Groups Is : ".$numOfGroups;
      echo "<table id='datatable' class='table table-striped table-bordered' style='width: 100%'>
            <thead>
              <tr>
                <th>Group Name</th>
                <th>Project No</th>
              </tr>
            </thead>
            <tbody>";
      for($i = 0 ; $i < $numOfGroups ; $i++){
        $groupData = mysqli_fetch_assoc($result);
        echo "<tr>
                <td>".$groupData['name']."</td>
                <td>".$groupData['proj_num']."</td>
              </tr>";
      }
      echo "</tbody>
          </table>";
    }else{
      echo "No Data";
    }
  
}

?>
