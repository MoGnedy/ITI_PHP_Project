<?php
session_start();
if(!isset($_SESSION['username'])){
	header('Location: ../login.php');
}
 include ('../index.php');
?>

<div class="btn-group">
		<button type="button" class="btn btn-default">
			<a class="btn btn-primary" href="addUser.php"> Add user </a>
		</button>
		<button type="button" class="btn btn-default">
			<a class="btn btn-primary" href="usersearch.php"> Search user </a>
		</button>
</div>
<br>

 <table id="datatable" class="table" width=100%>
	 <tr>
		<th>Name</th>
		<th>User Name</th>
		<th>Group Name</th>
		<th>Expiry Date</th>
		<th>Edit</th>
		<th>Delete</th>
		<th>Block/unblock</th>
	</tr>
<?php
  include("../dbconnect.php");
  $query="select * from users";
  $result=mysqli_query($db,$query);
  if(!$result){
    echo"Unable To Select";
    exit;
  }
 $num_of_rows=mysqli_num_rows($result);

for($i=0;$i<$num_of_rows;$i++){
  $res=mysqli_fetch_assoc($result);
	$id=$res['id'];
	?>
	 <tr>
	   <td><?=$res['full_name']?></td>
	   <td><?=$res['user_name']?></td>
		 <?php
		 		$queryGroup="select * from groups where id = ".$res['group_id'];
				$resultGroup=mysqli_query($db,$queryGroup);
				$resGroup=mysqli_fetch_assoc($resultGroup);
		  ?>
		 <td><?=$resGroup['name']?></td>
		 <td><?=$res['exp_date']?></td>
	   <td><a class="btn btn-warning" href="editUser.php?userID=<?= $res['id'] ?> "> Edit </a> </td>
	   <td><a class="btn btn-danger" href="userdelete.php?id=<?= $res['id'] ?> "> delete</td>
	   <?php
		if($res['is_blocked'] == 0) { ?>
	   <td><a class="btn btn-danger" href="userblock.php?id=<?= $res['id'] ?> " >block</a></td>
	   <?php
		}
		else {?>
		 <td><a class="btn btn-success" href="userunblock.php?id=<?= $res['id'] ?> " > Unblock</a></td>
	 	<?php } ?>
	 </tr>
	 <?php
	 }
	 echo "</table>";
	 mysqli_close($db);
	 ?>

    </div>
        </div>
      </div>




<!-- /page content -->

</div>
</div>
</div>
