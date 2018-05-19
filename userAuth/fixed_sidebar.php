<?php
session_start();
if(!isset($_SESSION['username'])){
  header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title> Dashboard </title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <script src=  "/userAuth/js/jquery-1.11.1.min.js" ></script>
    <script src=  "/userAuth/js/bootstrap.js "></script>
    <script src=  "/userAuth/js/fastclick.js" ></script>
    <!-- NProgress -->
    <script src= "/userAuth/js/nprogress.js"  ></script>
    <!-- jQuery custom content scroller -->
    <script src=  "/userAuth/js/jquery.mCustomScrollbar.concat.min.js" ></script>

    <!-- Custom Theme Scripts -->
    <script src=  "/userAuth/js/custom.min.js" ></script>

    <!-- Bootstrap -->
    <link href=  "/userAuth/css/bootstrap.css"  rel="stylesheet">
    <!-- Font Awesome -->
    <link href=  "/userAuth/fonts/font-awesome/css/font-awesome.min.css"  rel="stylesheet">
    <!-- NProgress -->
    <link href=  "/userAuth/css/nprogress.css"  rel="stylesheet">
    <link href= "/userAuth/css/fixedHeader.bootstrap.min.css"  rel="stylesheet" >
    <link href=  "/userAuth/css/scroller.bootstrap.min"  rel="stylesheet" >
    <link href=  "/userAuth/css/buttons.bootstrap.min"  rel="stylesheet" >
    <link href=  "/userAuth/css/dataTables.bootstrap.min.css"  rel="stylesheet" >


    <!-- Custom Theme Style -->
    <link href= "/userAuth/css/adminpanel.css"  rel="stylesheet">
      <link href=  "/userAuth/css/custom_style.css"  rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/userAuth/index.php" class="site_title"><i class="fa fa-paw"></i> <span>Admin Panel</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src=  "/userAuth/images/user.png"  class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2> </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a  href="/userAuth/users/allUsers.php"><i class="fa fa-user"></i> Users</a>
                  <li><a href= "/userAuth/groups/allgroups.php" ><i class="fa fa-thumb-tack"></i> Groups </a></li>
                  <li><a href= "/Logging/index.php" ><i class="fa fa-thumb-tack"></i> History </a></li>
                </ul>
              </div>

            </div>
          </div>
        </div>

    <!-- jQuery -->

    <!-- FastClick -->
