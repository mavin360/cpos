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

$cust_phone=$this->request->session()->read('Customer.phone');
?>

<div id="customer" class="m-t-40 card-box <?php if($this->request->session()->read('Customer')){ echo 'hide';}?>">
<div class="text-center">
<h4 class="text-uppercase font-bold m-b-0">Customer Phone Number</h4>
</div>
<div class="panel-body">
<form id="customer_form" class="form-horizontal m-t-20" action="/" onsubmit="findCustomer(); return false;">
<div class="form-group ">
<div class="col-xs-12">
    <input id="cphone" class="form-control" name="phone" type="text" required="" placeholder="Phone Number" value="<?php echo $cust_phone;?>">
</div>
</div>

<div class="form-group text-center m-t-30">
    <div class="col-xs-12">
    <button class="btn btn-primary btn-bordred btn-block waves-effect waves-light" type="submit">Get Customer Details</button>
    </div>
</div>
</form>
</div>
</div>

<div class="m-b-30 hide">
<button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#add-new-customer">Add New Customer</button>
</div>
<!-- ko if: customer() -->
<div class="card-box">
    <div class="dropdown pull-right">
    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
    <i class="zmdi zmdi-more-vert"></i></a>
    <ul class="dropdown-menu" role="menu">
    <li><a href="#">Edit</a></li>
    <li><a href="#">Delete</a></li>
    <li><a href="#">Block</a></li>
    </ul>
    </div>
    <div data-bind="with:customer()">
    <h4 class="header-title m-t-0  m-b-0">Customer Details</h4>
    <h2 data-bind="text:name+' '+sur_name">Ritesh Kapoor</h2>
    <p class="text-muted font-13"><strong>Mobile :</strong><span class="m-l-15" data-bind="text:phone">(123) 123 1234</span></p>
    <p class="text-muted font-13 hide"><strong>Email :</strong> <span class="m-l-15" data-bind="text:email">ritesh@gmail.com</span></p>
    <p class="text-muted font-13"><strong>Address :</strong> <span class="m-l-15" data-bind="text:address">Belvedere Building, Dubai - United Arab Emirates</span></p>
	<p class="text-muted font-13"><strong>Country :</strong> <span class="m-l-15" data-bind="">Dubai</span></p>
    </div>

</div>
<!-- /ko -->
<!-- ko if: store() -->
<div class="card-box">
<h4 class="header-title m-t-0 m-b-0">Store Details</h4>
<address data-bind="with:store()">
<h2 data-bind="text:store_name">Marina</h2>
<span data-bind="text:store_address">
795 Folsom Ave, Suite 600
<br>
San Francisco, CA 94107
</span>
<br>
<abbr title="Phone">P:</abbr> <span data-bind="text:store_phone">(123) 456-7890</span>
</address>
<form id="order_type" class="form-horizontal m-t-20" method="post" action="<?php echo $this->request->getAttribute("webroot"); ?>pos/order-type">
<input type="hidden" name="_csrfToken" value="<?php echo $this->request->getParam('_csrfToken'); ?>">
<button name="order" value="Pickup" class="btn btn-success waves-effect waves-light btn-lg m-b-5" type="button" onclick="orderType('Pickup')">Pickup</button>
<button name="order" value="Delivery" class="btn btn-success waves-effect waves-light btn-lg m-b-5" type="button" onclick="orderType('Delivery')">Delivery</button>
</form>
</div>
<!-- /ko -->

<div id="changeCustomer" class="m-t-40 card-box <?php if(!$this->request->session()->read('Customer')){ echo 'hide';}?>">
<div class="form-group text-center m-b-30">
    <div class="col-xs-12">
    <button class="btn btn-primary btn-bordred btn-block waves-effect waves-light" type="button" onclick="changeCustomer();">Change Customer</button>
    </div>
</div>
</div>
<!-- modal -->
<div id="add-new-customer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<h4 class="modal-title">Add New Customer</h4>
	</div>
	<form id="new_customer" action="/" method="post" onsubmit="saveCustomer(); return false;">
	<div class="modal-body">
	<div class="row">
	<div class="col-md-6">
	<div class="form-group">
	<label for="name" class="control-label">Name</label>
	<input type="text" class="form-control" name="name" id="name" required="" placeholder="Name">
	</div>
	</div>
	<div class="col-md-6">
	<div class="form-group">
	<label for="phone" class="control-label" >Phone Number</label>
	<input type="text" class="form-control" name="phone" id="phone" required="" placeholder="Phone Number" data-bind="value:phone();">
	</div>
	</div>
	</div>
	
	<div class="row hide">
	<div class="col-md-6 hide">
	<div class="form-group">
	<label for="sname" class="control-label">Surname</label>
	<input type="text" class="form-control" name="sur_name" id="sname" placeholder="Doe">
	</div>
	</div>
	
	<div class="col-md-6 hide">
	<div class="form-group">
	<label for="email" class="control-label" >Email</label>
	<input type="email" class="form-control" name="email" id="email"  placeholder="Email">
	</div>
	</div>
	
	</div>
	<div class="row hide">
	<h5>Customer Address</h5>
	</div>
	
	<div class="row">
	<div class="col-md-6">
	<div class="form-group">
	<label for="city" class="control-label">City/Postal Code</label>
	<input type="text" class="form-control" name="city" id="city" required="" placeholder="City/Postal Code">
	</div>
	</div>
	<div class="col-md-6">
	<div class="form-group">
	<label for="apartment_no" class="control-label">Apartment Number</label>
	<input type="text" class="form-control" name="apartment_no" id="apartment_no" placeholder="Apartment Number">
	</div>
	</div>
	</div>
	
	<div class="row">
	<div class="col-md-6">
	<div class="form-group">
	<label for="street_no" class="control-label">Street Number</label>
	<input type="text" class="form-control" name="street_no" id="street_no" placeholder="Street Number">
	</div>
	</div>
	<div class="col-md-6">
	<div class="form-group">
	<label for="street_no" class="control-label">Street/Building Name</label>
	<input type="text" class="form-control" name="street_name" id="street_name" placeholder="Street/Building Name">
	</div>
	</div>
	</div>
	</div>
	<div class="modal-footer">
	<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
	<button id="save" type="submit" data-loading-text='Saving...' class="btn btn-info waves-effect waves-light">Add Customer</button>
	</div>
	</form>
	</div>
	</div>
</div><!-- /.modals -->

<script>
$(function (){
	<?php if($cust_phone){?>
		findCustomer();
	<?php }?>
});
    var crsf='<?php echo $this->request->getParam('_csrfToken'); ?>';
    function PosModel() {
        var self = this;
        self.customer=ko.observable();
        self.store=ko.observable();
        self.actionMsg=ko.observable();
		self.phone=ko.observable(false);
    }
 var pm=new PosModel(); 

    function findCustomer(){
        var phone=$('#cphone').val();
        $.ajax({
				method:'POST',
				url:'<?php echo $this->request->getAttribute("webroot"); ?>api/customer',
				data:{'_csrfToken':crsf,'phone':phone},
				dataType: "JSON",
				beforeSend:function(){
					$('#loader').removeClass('hide');

				},
				success:function(res){
					$('#loader').addClass('hide');
					if(res.status==='new'){
						$('#new_customer')[0].reset();
                        $('#add-new-customer').modal('show');
						pm.phone(res.phone);
						pm.customer(false);
						pm.store(false);
                    }
					if(res.status==='success'){
						$('#add-new-customer').modal('hide');
						pm.customer(res.customer);
						pm.store(res.customer.store);
						$('#customer').addClass('hide');
						$('#changeCustomer').removeClass('hide');
					}
				},
				statusCode: {
					403: function() {
					  window.location.reload();
					}
				  }
			});
    }
	var $btn;
function saveCustomer(){
	var form=$('#new_customer')[0];
	var formData = new FormData(form);
	formData.append('_csrfToken',crsf);
	$.ajax({
			method:'POST',
			url:'<?php echo $this->request->getAttribute("webroot"); ?>api/save-customer',
			dataType: "JSON",
			data: formData,
			processData: false,
			contentType: false,
			cache: false,
			beforeSend:function(){
				$btn = $('#save').button('loading');
				$('.error-message').remove();
			},
			success:function(res){
				$btn.button('reset');
				if(res.status==='success'){
					$('#new_customer')[0].reset();
					$('#add-new-customer').modal('hide');
					pm.customer(res.customer);
					pm.store(res.customer.store);
				}
			},
			statusCode: {
				403: function() {
				  window.location.reload();
				}
			  }
	});
}
function orderType(type){
        $.ajax({
				method:'POST',
				url:'<?php echo $this->request->getAttribute("webroot"); ?>api/order-type',
				data:{'_csrfToken':crsf,'ordertype':type},
				dataType: "JSON",
				beforeSend:function(){
					$('#loader').removeClass('hide');
					
				},
				success:function(res){
					$('#loader').addClass('hide');
					if(res.status==='success'){
						window.location.href=res.action;
					}
				},
				statusCode: {
					403: function() {
					  window.location.reload();
					}
				  }
			});
}

function changeCustomer(){
	$.get('<?php echo $this->request->getAttribute("webroot"); ?>api/change',function(data){
			window.location.href='<?php echo $this->request->getAttribute("webroot"); ?>pos';
		});
}
ko.options.useOnlyNativeEvents = true;
ko.options.deferUpdates = true;
ko.applyBindings(pm);
</script>