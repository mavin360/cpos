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


?>
<div class="container">
<div class="row">
<div class="col-md-3">
	<div class="card">
	  <div class="card-body">
		<a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/stores" class="card-link">
		<h5 class="card-title"><i class="fa fa-globe"></i><br/>
					  <span>Location</span></h5></a>
	  </div>
	</div>
</div>
<div class="col-md-3">
	<div class="card">
	  <div class="card-body">
		<a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/users" class="card-link"><h5 class="card-title"><i class="fa fa-users"></i><br/>
					  <span>Staff</span></h5></a>
	  </div>
	</div>
</div>
<div class="col-md-3">
	<div class="card">
	  <div class="card-body">
		<a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/stores" class="card-link"><h5 class="card-title"><i class="fa fa-cutlery"></i><br/>
					  <span>Menu Setup</span></h5></a>
	  </div>
	</div>
</div>
<div class="col-md-3">
	<div class="card">
	  <div class="card-body">
		<a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/stores" class="card-link">
		<h5 class="card-title"><i class="fa fa-briefcase"></i><br/>
			<span>Inventory</span>
			</h5>
		</a>
	  </div>
	</div>
</div>
</div>
</div>
