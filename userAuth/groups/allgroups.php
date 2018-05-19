<?php
session_start();
if(!isset($_SESSION['username'])){
	header('Location: ../login.php');
}
	include_once('../index.php');
	include_once('../dbconnect.php');
	$query= "select * from groups";
	$result = mysqli_query($db, $query);
	if(! $result) {
			 		echo "can't query";
			 		exit;
	}
	$ro = mysqli_num_rows($result);
	?>
	<div class="btn-group">
			<button type="button" class="btn btn-default">
				<a class="btn btn-primary" href="addgroup.php"> Add Group </a>
			</button>
			<button type="button" class="btn btn-default">
				<a class="btn btn-primary" href="groupsearch.php"> Search group </a>
			</button>
	</div>

	<table id="datatable" class="table table-striped table-bordered"style="width: 100%" >
	<tr>
		<th>Name</th>
		<th>Group Description</th>
		<th>Project Number</th>
		<th> Call back </th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php
	for ( $i=0; $i < $ro; $i++){
		$r = mysqli_fetch_assoc($result);
	?>
	<tr>
		<td> <?= $r['name']; ?> </td>
		<td> <?= $r['group_desc']; ?> </td>
		<td> <?= $r['proj_num']; ?> </td>
		<td> <?= $r['callBack']; ?> </td>
		<td> <a class="btn btn-primary" href="editgroup.php?id=<?= $r['id']; ?>" > Edit </a></td>
		<td> <a class="btn btn-danger" href="deletegroup.php?id=<?= $r['id']; ?>"> Delete </a></td>
	</tr>
	<?php
		}
		echo "</table>";
?>
