<?php
	if($_SERVER['REQUEST_METHOD'] == "POST")
	if($_POST['password'] && $_POST['username'])
	{
		$password = $_POST['password'];
		$username = $_POST['username'];
		$DBName = "authdb";
		$DBHost = "localhost";
		$DBuserName = "root";
		$DBPassword = "root";

		@ $db = mysqli_connect($DBHost,$DBuserName, $DBPassword,$DBName);
		if (mysqli_connect_error())
		{
			echo "error in connection";
		}
		else
		{
			$sql = "select * from users where user_name= '$username'";
			$result = mysqli_query($db,$sql);
			//echo $sql;
			include("./users/password.php");
			$userData=mysqli_fetch_assoc($result);
			//var_dump($userData);
			$flag = password_verify($password, $userData['password']);
			//echo $flag;
			$numOfRows = mysqli_num_rows($result);
			if($numOfRows>0 && $flag)
			{
				//var_dump($result);
				$groupIdx = $userData['group_id'];
				$groupQuery = "select * from groups where id =$groupIdx";
				//echo $groupQuery;

				$group_result = mysqli_query($db,$groupQuery);
				$groupData = mysqli_fetch_assoc($group_result);
				//var_dump($groupData);
				if($userData['is_blocked'] == 1){
					header('Location: login.php?msg=you are blocked contact the adminstrator ');
				}
				if(strtotime($userData['exp_date']) <= strtotime(date('Y-m-n'))){
					//echo $userData['exp_date'];
					header('Location: login.php?msg=your account is expired contact the adminstrator ');
				}

				session_start();
				$_SESSION['username'] = $userData['user_name'];
				$_SESSION['groupname'] = $groupData['name'];
				$_SESSION['callBack'] = $groupData['callBack'];
				$_SESSION['projectNum'] = $groupData['proj_num'];
				include("callBack.php");
				$callBack = goCallBack();
				//echo "<br>".$_SESSION['username'] ."<br>". $_SESSION['groupname']."<br>".$_SESSION['projectNum'];
				//echo "<a href='logout.php'>logout </a>";
				include("logging.php");
				logging("3","successfull ".$_SESSION['username']." login","login");
			}
			elseif($numOfRows==0){
				header('Location: login.php?msg=User Name doesn\'t Exist ');
			}
			else{
				header('Location: login.php?msg=Incorrect Password! ');
			}
		}
	}
	else
	{
		header('Location: login.php?msg=enter username and password');
	}
?>
