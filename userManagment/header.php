	<?php
		echo <<<EOL
		<nav class=" navbar-inverse" style='margin-bottom: 0'>
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href='index.php'>User & Group management</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
EOL;
		if($admin == 'poweruser' || $admin == 'edit_manager') {
			echo "<li><a href='createanddelete.php'>Create a new user</a></li>";
		}
		echo <<<EOL
		<li><a href="groups.php">Manage groups</a></li>
EOL;
if (isset($_SESSION['groupname']))
{
	echo "<li ><a class='pull-right' href='log/index.php'>View Logs</a></li>";
	echo "<li ><a class='pull-right' href='../userAuth/logout.php'>Logout</a></li>";
}
else{
									echo "<li><a href='../userAuth/login.php'>Login</a></li>";
	}
	echo<<<EOL

      </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
EOL;
		?>
