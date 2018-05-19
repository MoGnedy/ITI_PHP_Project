<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header('Location: ../login.php');
	}
	include_once ("../index.php");
   	include_once("../dbconnect.php");
	if (isset($_GET['id']) ) {
		$id = $_GET['id'];
		$sql_statement="select * from groups where id = $id;";
		$result = mysqli_query( $db, $sql_statement);
		if ($result){
			$r = mysqli_fetch_assoc($result);
			if (! isset($_POST['group_name'])) {
			?>


			<form id="form" method = 'post'>
				<div class="form-group">
					<label>
						Group Name
					</label>
					<input class="form-control" id="group-name" name= 'group_name' type = "text" value = "<?= $r['name'] ?>" >
				</div>
				<div class="form-group">
					<label>
						Group Description
					</label>
					<input class="form-control" name= 'group_desc' type = 'text' value = "<?= $r['group_desc'] ?>" >
				<div class="form-group">
					<label>
						Callback Function
					</label>
					<input class="form-control" id="callback" name= 'callBack' type = 'text' value = "<?= $r['callBack'] ?>" >
				</div>
				<div class="form-group">
					<label>
						Project Number
					</label>
					<select class="form-control" type="number" name="group_proj_num" id="group-proj-num" placeholder="add project number">
            <option value="1" <?php if($r['proj_num'] == 1) echo "selected" ; ?> >1</option>
            <option value="2" <?php if($r['proj_num'] == 2) echo "selected" ; ?> >2</option>
            <option value="3" <?php if($r['proj_num'] == 3) echo "selected" ; ?> >3</option>
            <option value="4" <?php if($r['proj_num'] == 4) echo "selected" ; ?> >4</option>
            <option value="5" <?php if($r['proj_num'] == 5) echo "selected" ; ?> >5</option>
          </select>

				<input id="submit-btn" class="btn btn-primary" type="button" value ="submit">
			</form>
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
		             else {
		             	alert("One or more fields are empty !!")
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
		<?php
	} else {
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
			$sql_statement="update groups set name= '$group_name', group_desc='$group_desc' , callBack='$callBack' , proj_num = $group_proj_num where id = $id;";
			//echo $sql_statement;
		     mysqli_query($db, $sql_statement);
				 include("../logging.php");
	       logging("3","Group Edited ".$group_name." Successfully","Editing Group");
		     ?>
		     <script>
		     	location.href="allgroups.php";
		     </script>


<?php
		}
	}
	else {
		http_response_code(404);
		include("../logging.php");
		logging("3","Group Added ".$group_name." Un-Successfully","Editing Group");
		exit();
	}
}
	else {
		http_response_code(404);
		exit();
	}
			?>
