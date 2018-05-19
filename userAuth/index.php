<?php
  session_start();
  if(!isset($_SESSION['username'])){
  	header('Location: login.php');
  }
  include "fixed_sidebar.php";
?>
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a  class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src='/userAuth/images/user.png'>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="/userAuth/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
          </ul>
        </li>

        <li role="presentation" class="dropdown">
          <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
            <li>
              <a>
                <span class="image"><img src= '/userAuth/images/user.png' alt="Profile Image" /></span>
              </a>
            </li>
            <li>
              <a>
                <span class="image"><img src= '/userAuth/images/user.png' alt="Profile Image" /></span>
              </a>
            </li>

          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

          <div class="x_content"> 