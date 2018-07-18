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

$cakeDescription = 'CPOS';
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $cakeDescription; ?>:
        <?php echo $this->fetch('title'); ?>
    </title>
    <?php //$this->Html->meta('icon'); ?>
  <link href="<?php echo $this->request->getAttribute("webroot"); ?>pos_admin/css/style.default.css" rel="stylesheet" type="text/css" />
   <link href="<?php echo $this->request->getAttribute("webroot"); ?>pos_admin/css/custom.css" rel="stylesheet" type="text/css" />
   <link href="<?php echo $this->request->getAttribute("webroot"); ?>pos_admin/css/bootstrap-editable.css" rel="stylesheet" type="text/css" />
   
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="<?php echo $this->request->getAttribute("webroot"); ?>pos_admin/js/jquery-1.11.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<script src="<?php echo $this->request->getAttribute("webroot"); ?>pos_admin/js/knockout.js"></script>
<script src="<?php echo $this->request->getAttribute("webroot"); ?>pos_admin/js/moment.min.js"></script>
<script src="<?php echo $this->request->getAttribute("webroot"); ?>pos_admin/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo $this->request->getAttribute("webroot"); ?>pos_admin/js/bootstrap.min.js"></script>
<script src="<?php echo $this->request->getAttribute("webroot"); ?>pos_admin/js/modernizr.min.js"></script>
<script src="<?php echo $this->request->getAttribute("webroot"); ?>pos_admin/js/toggles.min.js"></script>
<script src="<?php echo $this->request->getAttribute("webroot"); ?>pos_admin/js/jquery.cookies.js"></script>
<script src="<?php echo $this->request->getAttribute("webroot"); ?>pos_admin/js/bootstrap-editable.min.js"></script>
<script src="<?php echo $this->request->getAttribute("webroot"); ?>pos_admin/js/custom.js"></script>
<?php echo $this->fetch('meta'); ?>
<?php echo $this->fetch('css'); ?>
<?php echo $this->fetch('script'); ?>
</head>
<body class="horizontal-menu"> 
<section>
  <div class="leftpanel">
      <?php 
		$cnt=$this->request->getParam('controller');
		$action=$this->request->getParam('action');
		$iconTmpl=[''=>'fa fa-home','Users'=>'fa fa-users','Settings'=>'fa fa-cog','Sliders'=>'fa fa-picture-o','Dashboard'=>'','Categories'=>'','Items'=>'','Pages'=>'fa fa-file-text','Galleries'=>'fa fa-camera','StoreLocations'=>'fa fa-map-marker','Jobs'=>'fa fa-suitcase','Experts'=>'fa fa-suitcase','TopPicks'=>'fa fa-file-text','Banners'=>'fa fa-file-code-o','Products'=>'fa fa-shopping-cart','Orders'=>'fa fa-align-justify','Videos'=>'fa fa-video-camera','Coupons'=>'fa fa-money','Stores'=>'fa fa-globe'];
	  ?>  
    
  </div><!-- leftpanel -->
  
	 <div class="mainpanel">
	 
	   <div class="headerbar">
      
      <div class="header-left">
         <div class="logopanel">
		<?php if($Auth->user('profile_image')){?>
			<h1><a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/dashboard" class="logo"><img src="<?php echo $this->request->getAttribute("webroot"); ?>img/company-logo/original/<?php echo $Auth->user('profile_image');?>" alt="logo" style="width: 220px;height: 50px;"></a></h1>
		<?php }else{?>
			<h1><a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/dashboard" class="logo"><img src="<?php echo $this->request->getAttribute("webroot"); ?>images/logo-cpos.png" alt="logo" style="height: 25px;"></a></h1>
		<?php }?>
    </div><!-- logopanel -->
	
        <div class="topnav">
            <a class="menutoggle"><i class="fa fa-bars"></i></a>
			  <ul class="nav nav-horizontal">
				<li class="<?php if($cnt=='Dashboard' && $action=='index'){echo 'active';}?>"><a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/dashboard"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
				
				<li class="nav-parent <?php echo (strtolower($cnt)=='stores' || (strtolower($cnt)=='users' && $action=='companyProfile'))?'active nav-active':'';?>">
					<a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/setup" class="dropdown-toggle" >
					  <i class="fa fa-gears"></i>
					  <span>Setup</span>
					</a>
		  </li>
		  <li class="<?php if($cnt=='Pos' && $action=='index'){echo 'active';}?>"><a href="<?php echo $this->request->getAttribute("webroot"); ?>pos">POS</span></a></li>
		</ul>
		</div><!-- topnav -->   
      </div><!-- header-left -->
	  
      <div class="header-right">
		  <ul class="headermenu"> 
		 <li>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <?php echo h($Auth->user('name')); ?>
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                <li><a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/users/profile"><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
               <!-- <li><a href="<?php //echo $this->request->getAttribute("webroot"); ?>admin/settings"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-question-sign"></i> Help</a></li>-->
                <li><a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/logout"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
              </ul>
            </div>
          </li>
		  <li> 
			<button class="btn btn-default tp-icon chat-icon">
                &nbsp;&nbsp;&nbsp;
            </button>
		</li>
        </ul>
      
	  </div>
      
    </div><!-- headerbar -->
	 
	 
	
    
    <div class="pageheader hide">
	<?php if($action=='offers' || $action =='reports'){?>
	 <h2><i class="<?php echo $iconTmpl[$cnt]?$iconTmpl[$cnt]:'fa fa-home'?>"></i><?php echo ucfirst(implode(" ",preg_split('/(?=[A-Z])/',$action)));?></h2>
	<?php }else{?>
      <h2><i class="<?php echo $iconTmpl[$cnt]?$iconTmpl[$cnt]:'fa fa-home'?>"></i> <?php echo $cnt;?> </h2>
	<?php }?>
    </div>
	<div class="contentpanel"> 
	<?php echo $this->fetch('content'); ?>
	</div>
	</div>
</section>

<div id="loader" class="loading hide"><div class="loader"><i class="fa fa-spinner fa-spin"></i></div></div>
</body>
</html>
