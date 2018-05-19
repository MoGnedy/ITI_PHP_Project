<?php
session_start();
if(isset($_SESSION['username'])){
	include("callBack.php");
	$callBack = goCallBack();
}
?>
<html>
<head>
	<style>
		body {
			background: #ccc !important;
		}
		h2 {
			text-align: center;
		}

	</style>
    <link href=  "/userAuth/css/bootstrap.css"  rel="stylesheet">
</head>
	<body>
		<div class="container">
			<h2> Login Form </h2>
			<form method="POST" action="auth.php">
				<div class="form-group">
					<label> Username </label>
					<input class="form-control" type="text" name="username">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input class="form-control" type="password" name="password">
					<div style="text-align: center">
					<button style="margin-top: 40px;" class="btn btn-primary" type="submit">Login</button>
					</div>
				</div>
			<p>
				<?php
					if($_GET["msg"]!=""){
						echo $_GET['msg'];
					}
				?>
			</p>
		</form>
	</body>
</html>
