<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'cPOS - Cloud POS';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured POS.">
        <meta name="author" content="Mavin360">
        <!-- App Favicon -->
        <link rel="shortcut icon" href="images/favicon.ico">
    <title>
        <?= $cakeDescription ?>
        <?php //$this->fetch('title') ?>
    </title>
    

    <link href="<?php echo $this->request->getAttribute("webroot"); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $this->request->getAttribute("webroot"); ?>css/core.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $this->request->getAttribute("webroot"); ?>css/components.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $this->request->getAttribute("webroot"); ?>css/icons.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $this->request->getAttribute("webroot"); ?>css/pages.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $this->request->getAttribute("webroot"); ?>css/menu.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $this->request->getAttribute("webroot"); ?>css/responsive.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>js/modernizr.min.js"></script>
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>js/jquery.min.js"></script>
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>js/bootstrap.min.js"></script>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

</head>
<body class="fixed-left">
    <div id="wrapper">
         <!-- Top Bar Start -->
  <div class="topbar"> 
    
    <!-- LOGO -->
    <div class="topbar-left"> <a href="index.html" class="logo"><span>CPOS</span>
      <i class="zmdi zmdi-layers"></i></a> </div>
    
    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
      <div class="container"> 
        
        <!-- Page title -->
        <ul class="nav navbar-nav navbar-left">
          <li>
            <button class="button-menu-mobile open-left"> <i class="zmdi zmdi-menu"></i> </button>
          </li>
          <li>
            <h4 class="page-title">Dashboard</h4>
          </li>
        </ul>
        
        <!-- Right(Notification and Searchbox -->
        <ul class="nav navbar-nav navbar-right">
          <li> 
            <!-- Notification -->
            <div class="notification-box">
              <ul class="list-inline m-b-0">
                <li> <a href="javascript:void(0);" class="right-bar-toggle"> <i class="zmdi zmdi-notifications-none"></i> </a>
                  <div class="noti-dot"> <span class="dot"></span> <span class="pulse"></span> </div>
                </li>
              </ul>
            </div>
            <!-- End Notification bar --> 
          </li>
          <li class="hidden-xs">
            <form role="search" class="app-search">
              <input type="text" placeholder="Search..." class="form-control">
              <a href=""><i class="fa fa-search"></i></a>
            </form>
          </li>
        </ul>
      </div>
      <!-- end container --> 
    </div>
    <!-- end navbar --> 
  </div>
  <!-- Top Bar End --> 
  
  <!-- ========== Left Sidebar Start ========== -->
  <div class="left side-menu">
    <div class="sidebar-inner slimscrollleft"> 

      <!--- Sidemenu -->
      <div id="sidebar-menu">
        <ul>
          <li class="text-muted menu-title">Navigation</li>
          <li> <a href="<?php echo $this->request->getAttribute("webroot"); ?>dashboard" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard </span> </a> </li>
          <li> <a href="<?php echo $this->request->getAttribute("webroot"); ?>pos" class="waves-effect"><i class="zmdi zmdi-calendar"></i><span> Open POS </span></a> </li>
          <li> <a href="<?php echo $this->request->getAttribute("webroot"); ?>dashboard" class="waves-effect"><i class="zmdi zmdi-calendar"></i><span> Sales </span></a> </li>
          <li> <a href="<?php echo $this->request->getAttribute("webroot"); ?>dashboard" class="waves-effect"><i class="zmdi zmdi-calendar"></i><span> Coupons</span></a> </li>
          <li> <a href="<?php echo $this->request->getAttribute("webroot"); ?>dashboard" class="waves-effect"><i class="zmdi zmdi-calendar"></i><span> Inventory</span></a> </li>
          <li> <a href="<?php echo $this->request->getAttribute("webroot"); ?>dashboard" class="waves-effect"><i class="zmdi zmdi-calendar"></i><span> Suppliers</span></a> </li>
          <li> <a href="<?php echo $this->request->getAttribute("webroot"); ?>dashboard" class="waves-effect"><i class="zmdi zmdi-calendar"></i><span> Customers</span></a> </li>
          <li> <a href="<?php echo $this->request->getAttribute("webroot"); ?>dashboard" class="waves-effect"><i class="zmdi zmdi-calendar"></i><span> Reports </span></a> </li>
          <li> <a href="<?php echo $this->request->getAttribute("webroot"); ?>dashboard" class="waves-effect"><i class="zmdi zmdi-calendar"></i><span> Expenses </span></a> </li>
          <li> <a href="<?php echo $this->request->getAttribute("webroot"); ?>dashboard" class="waves-effect"><i class="zmdi zmdi-calendar"></i><span> POS Settings </span></a> </li>
          

        </ul>
        <div class="clearfix"></div>
      </div>
      <!-- Sidebar -->
      <div class="clearfix"></div>
    </div>
  </div>
  <!-- Left Sidebar End --> 
  <!-- ============================================================== --> 
  <!-- Start right Content here --> 
  <!-- ============================================================== -->
  <div class="content-page"> 
     <?= $this->fetch('content'); ?>
     <footer class="footer text-right"> 2016 - 2017 © cPOS-Mavin360 | SIT </footer>
  </div>
  
  <!-- ============================================================== --> 
  <!-- End Right content here --> 
  <!-- ============================================================== --> 
    <!-- Right Sidebar -->
  <div class="side-bar right-bar"> <a href="javascript:void(0);" class="right-bar-toggle"> <i class="zmdi zmdi-close-circle-o"></i> </a>
    <h4 class="">Notifications</h4>
    <div class="notification-list nicescroll">
      <ul class="list-group list-no-border user-list">
        <li class="list-group-item"> <a href="#" class="user-list-item">
          <div class="avatar"> <img src="assets/images/users/avatar-2.jpg" alt=""> </div>
          <div class="user-desc"> <span class="name">Michael Zenaty</span> <span class="desc">There are new settings available</span> <span class="time">2 hours ago</span> </div>
          </a> </li>
        <li class="list-group-item"> <a href="#" class="user-list-item">
          <div class="icon bg-info"> <i class="zmdi zmdi-account"></i> </div>
          <div class="user-desc"> <span class="name">New Signup</span> <span class="desc">There are new settings available</span> <span class="time">5 hours ago</span> </div>
          </a> </li>
        <li class="list-group-item"> <a href="#" class="user-list-item">
          <div class="icon bg-pink"> <i class="zmdi zmdi-comment"></i> </div>
          <div class="user-desc"> <span class="name">New Message received</span> <span class="desc">There are new settings available</span> <span class="time">1 day ago</span> </div>
          </a> </li>
        <li class="list-group-item active"> <a href="#" class="user-list-item">
          <div class="avatar"> <img src="assets/images/users/avatar-3.jpg" alt=""> </div>
          <div class="user-desc"> <span class="name">James Anderson</span> <span class="desc">There are new settings available</span> <span class="time">2 days ago</span> </div>
          </a> </li>
        <li class="list-group-item active"> <a href="#" class="user-list-item">
          <div class="icon bg-warning"> <i class="zmdi zmdi-settings"></i> </div>
          <div class="user-desc"> <span class="name">Settings</span> <span class="desc">There are new settings available</span> <span class="time">1 day ago</span> </div>
          </a> </li>
      </ul>
    </div>
  </div>
  <!-- /Right-bar -->     
    </div>
    <script>
        var resizefunc = [];
    </script> 
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>js/detect.js"></script> 
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>js/fastclick.js"></script> 
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>js/jquery.blockUI.js"></script> 
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>js/waves.js"></script> 
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>js/jquery.nicescroll.js"></script> 
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>js/jquery.slimscroll.js"></script> 
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>js/jquery.scrollTo.min.js"></script> 

    <!-- KNOB JS --> 
    <!--[if IE]>
            <script type="text/javascript" src="<?php echo $this->request->getAttribute("webroot"); ?>plugins/jquery-knob/excanvas.js"></script>
            <![endif]--> 
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>plugins/jquery-knob/jquery.knob.js"></script> 

    <!--Morris Chart--> 
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>plugins/morris/morris.min.js"></script> 
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>plugins/raphael/raphael-min.js"></script> 

    <!-- Dashboard init --> 
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>pages/jquery.dashboard.js"></script> 

    <!-- App js --> 
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>js/jquery.core.js"></script> 
    <script src="<?php echo $this->request->getAttribute("webroot"); ?>js/jquery.app.js"></script>
</body>
</html>
