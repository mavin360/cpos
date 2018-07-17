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
        <?php // $this->fetch('title') ?>
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
<body>
  
		
        <?= $this->fetch('content') ?>
    
</body>
</html>
