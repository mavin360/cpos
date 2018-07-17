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
 * @license    https://opensource.org/licenses/mit-license.php MIT License
 */

$customer=$this->request->getSession()->read('Customer');
//pr($customer);
?>
<div class="content-page" style="margin-left:0px; background-color:#373a36;">
<div class="content" style="margin-top:60px;">
<div class="container">
<div class="row">
<div class="col-lg-6">
<div class="panel panel-custom panel-border">
<div class="panel-body" style="height:780px;">
<h3 class="m-t-0">Order for <?php echo $customer['name']?> (<?php echo $customer['phone']?>) <a class="btn btn-default btn-bordred waves-effect btn-sm m-b-5 m-r-10" style="float:left;" href="javascript:void(0)" onclick="changeOrder();"><i class="fa fa-edit"></i></a></h3>
<div class="cart" >
<table class="tablesaw table m-b-0">
	<thead>
	<tr>
		<th scope="col" >Items</th>
		<th scope="col" class="text-right">Unit Price</th>
		<th scope="col" class="text-right">Quantity</th>
		<th scope="col" class="text-right">Total Price</th>
	</tr>
	</thead>
	<tbody data-bind="foreach:cartItems">
		<tr>
			<td>
				<p style="width:45px; margin:0px; float:left;"><a class="btn btn-sm btn-default" href="javascript:void(0)" data-bind="click:$parent.delete.bind($data,$index());"><i class="fa fa-trash error"></i></a></p>
				<p style="width:45px; margin:0px; float:left;"><a class="btn btn-sm btn-default" href="javascript:void(0)"><i class="fa fa-edit"></i></a></p>
				<h5 style="margin-top:5px;" data-bind="text:$data.name">Chicken Teriyaki</h5>
				<!-- ko if: $data.size -->
				<span class="label label-default" data-bind="text:'+ Size : '+$data.size.name">Large</span> — <span data-bind="text:'AED '+parseFloat($data.size.price).toFixed(2)">$ 3.00</span><br>
				<!-- /ko -->
				<!-- ko if: $data.toppings -->
				<div data-bind="foreach:$data.toppings">
				<span class="label label-default" data-bind="text:'+ Topping : '+$data.name"> Onions</span> — <span data-bind="text:'AED '+parseFloat($data.price).toFixed(2)">$ 0.75</span><br>
				</div>
				<!-- /ko -->
			</td>
			<td class="text-right" data-bind="text:'AED '+parseFloat($data.unit_price).toFixed(2)">$ 17.41</td>
			<td>
				<div class="input-group input-group-sm text-right">
					<span class="input-group-btn item-control-btns-wrapper ">
						<button class="btn btn-default item-reduce" data-bind="click:$parent.countAction.bind($data,$index(),'minus');">-</button>
						<button name="" value="1" class="btn btn-default" data-bind="text:$data.count">1</button>
						<button class="btn btn-default item-add" data-bind="click:$parent.countAction.bind($data,$index(),'plus');">+</button>
					</span>
				</div>
			</td>
			<td class="text-right" data-bind="text:'AED '+parseFloat($data.total_price).toFixed(2)">$ 17.41 </td>
		   
		</tr>

	</tbody>
</table>
</div>
<table class="table" id="cart-details">
<tfoot class="hidden-xs hidden-sm hidden-md">
<tr class="active">
	<td width="200" class="text-left">Products count (
		<span class="items-number" data-bind="text:cartItems().length">0</span> )</td>
	<td width="150" class="text-right hidden-xs"></td>
	<td width="150" class="text-right">Sub Total</td>
	<td width="90" class="text-right">
		<span class="cart-value" data-bind="text:'AED '+parseFloat(cartSubTotal()).toFixed(2);">$ 0.00 </span>
	</td>
</tr>
<tr class="active">
	<td></td>
	<td></td>
	<td class="text-right cart-discount-notice-area">Discount on Cart</td>
	<td class="text-right cart-discount-remove-wrapper">
		<span class="cart-discount pull-right" data-bind="text:'AED '+parseFloat(cartDiscount()).toFixed(2);">AED 0.00 </span>
	</td>
</tr>
<tr class="active">
	<td></td>
	<td></td>
	<td class="">
		<span class="pull-right">Shipping </span>
	</td>
	<td class="text-right">
		<span class="pull-right cart-shipping-amount">AED 0.00 </span>
	</td>
</tr>

<tr class="success">
	<td></td>
	<td></td>
	<td class="text-right">
		<strong>Net Payable</strong>
	</td>
	<td class="text-right">
		<span class="cart-topay pull-right" data-bind="text:'AED '+parseFloat(cartTotal()).toFixed(2)">AED 0.00 </span>
	</td>
</tr>
</tfoot>
<tfoot class="hidden-lg">
<tr class="active">
	<!--<td>Products count ( <span class="items-number">0</span> )</td>-->
	<td>
		<span class="hidden-xs">Sub Total
		</span>

		<span class="hidden-lg hidden-md">
			S.Total
		</span>

		<span class="cart-value pull-right" data-bind="text:'AED '+parseFloat(cartSubTotal()).toFixed(2);">$ 0.00 </span>
	</td>
	<td>Discount
		<span class="cart-discount pull-right" data-bind="text:'AED '+parseFloat(cartDiscount()).toFixed(2);">AED 0.00 </span>
	</td>
</tr>
<tr class="active">
	<td></td>
	<td>Net Payable
		<span class="cart-topay pull-right" data-bind="text:'AED '+parseFloat(cartTotal()).toFixed();">$ 0.00 </span>
	</td>
</tr>
</tfoot>
</table>

<div class="box-footer" id="cart-panel">
<div class="btn-group btn-group-justified" role="group" aria-label="...">
<div class="btn-group ng-scope" role="group" ng-controller="payBox">
<button type="button" class="btn btn-lg btn-success" onclick="payment();" style="margin-bottom:0px;">
	<i class="fa fa-money"></i>
	<span class="hidden-xs">Pay</span>
</button>
</div>
<div class="btn-group sendToKitchenButtonWrapper hide" role="group">
<button type="button" class="btn btn-success btn-lg" onclick="sendToKitchen()" style="margin-bottom:0px;">
	<i class="fa fa-cutlery"></i>
	<span class="hidden-xs">To Kitchen</span>
</button>
</div>
<div class="btn-group ng-scope hide" role="group" ng-controller="saveBox">
<button type="button" class="hold_btn btn btn-default btn-lg" style="margin-bottom:0px;">
	<i class="fa fa-hand-stop-o"></i>
	<span class="hidden-xs">Hold</span>
</button>
</div>
<div class="btn-group" role="group">
<button type="button" class="btn  btn-warning btn-lg" id="cart-discount-button" style="margin-bottom:0px;" onclick="discount();">
	<i class="fa fa-gift"></i>
	<span class="hidden-xs">Discount</span>
</button>
</div>
<div class="btn-group" role="group">
<button type="button" class="btn btn-danger btn-lg" id="cart-return-to-order" style="margin-bottom:0px;" onclick="cancelOrder();">
	<!-- btn-app  -->
	<i class="fa fa-refresh"></i>
	<span class="hidden-xs">Cancel</span>
</button>
</div>
</div>
</div>

</div>
</div>

</div>

<div class="col-lg-6">
<div class="panel panel-custom panel-border">

<div class="panel-body">

<div class="row">
	<ul id="brands" class="brands" data-bind="foreach:brands">
	<li data-bind="attr:{class:$index()==$parent.selectedBrand()?'selected':''}">
	<figure><a href="javascript:void(0)" data-bind="click:$parent.changeBrand.bind($data,$index())"><img data-bind="attr:{src:'<?php echo $this->request->getAttribute("webroot"); ?>img/brand-images/'+$data.logo}" class="brand-img" ></a></figure>
	<span data-bind=""></span>
	</li>
	</ul>		
</div>

<div>
	<form action="#" method="post" id="" class="">
	<div class="input-group">
	<div class="input-group-btn">
		<button type="submit" class="btn btn-large btn-default">
			<i class="fa fa-search"></i>
		</button>
		<button type="button" class="enable_barcode_search btn btn-large btn-default">
			<i class="fa fa-barcode"></i>
		</button>
	</div>

	<input autocomplete="off" type="text" name="item_sku_barcode" placeholder="Barcode, SKU, product name or category ..." class="form-control"> </div>
	</form>
	</div>

	<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 ">
			<div class="card-box" style="margin:10px 0px 10px 0px; 0px;padding:5px;">
				<div class="portfolioFilter">
					<a href="javascript:void(0)" data-bind="click:allItems" class="btn btn-danger  current btn-default waves-effect waves-custom" >All</a>
					<div class="cat_f" data-bind="foreach:categories">
					<a href="javascript:void(0)" class="btn btn-default waves-effect waves-custom" data-bind="attr:{'data-filter':$data.slug},text:$data.name,click:$parent.ItemsByCategory.bind($data,$index())">Pizza-Farm</a>
					</div>
				</div>
			</div>
		</div>
	</div>


<div class="row">
<div class="portfolioContainer" data-bind="foreach:items">
	<div class="col-sm-6 col-lg-3 col-md-4 sides-salads pizza-farm">
		<div class="gal-detail thumb">
			<a href="javascript:void(0)" class="image-popup" data-bind="click:$parent.addTo.bind($data,$index())">
				<img data-bind="attr:{src:'<?php echo $this->request->getAttribute("webroot"); ?>img/item-images/'+$data.image}" src="" class="thumb-img" alt="work-thumbnail">
			<h4 data-bind="text:$data.name">Nature Image</h4>
			<p class="" data-bind="text:'AED '+parseFloat($data.price).toFixed(2)">10.5</p></a>
		</div>
		
		
	</div>

</div><!-- end portfoliocontainer-->
<!-- ko ifnot: items -->
<h4>No menu item(s) founded.</h4>
<!-- /ko -->
</div> <!-- End row -->
</div>
</div>
</div>
</div>
</div>
</div>
</div>
  <div id="modifiers" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Customize your order</h4>
                </div>
                <div class="modal-body">
                    <h5 class="m-b-15 m-t-20">Select your size</h5>
					<div id="size" class="row" data-bind="foreach:itemSizes">
						<button class="btn btn-default waves-effect waves-light btn-lg m-b-5 btn-size" data-bind="text:$data.size_name,click:$parent.selectSize.bind($data,$index());">Small</button>
					</div>
                    
                    <h5 class="m-b-15 m-t-20">Choose your crust</h5>
					<div id="crust" class="row">
                    <button class="curstbtn btn btn-default waves-effect waves-light btn-lg m-b-5" onclick="selectCrust('Original Crust','2',this);">Original Crust</button>
                    <button class="curstbtn btn btn-default waves-effect waves-light btn-lg m-b-5" onclick="selectCrust('Gluten Free','2.5',this);">Gluten Free</button>
                    <button class="curstbtn btn btn-default waves-effect waves-light btn-lg m-b-5" onclick="selectCrust('Skinny Crust','3',this);">Skinny Crust</button>
					</div>
                    <div class="m-t-30 m-b-30"></div>
					<form id="toppings_form" action="/" method="post">
                    <div class="panel-group panel-group-joined" id="accordion-test">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                        Pick a sauce
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse">
                                <div class="panel-body">

                                    <div class="radio radio-info">
                                        <input type="radio" id="sauce1" value="Tomato Sauce" name="sauce">
                                        <label for="sauce1"> Tomato Sauce </label>
                                    </div>
                                    <div class="radio radio-info">
                                        <input type="radio" id="sauce2" value="BBQ Sauce" name="sauce">
                                        <label for="sauce2"> BBQ Sauce</label>
                                    </div>
                                    <div class="radio radio-info">
                                        <input type="radio" id="sauce3" value="Tandori Sauce" name="sauce">
                                        <label for="sauce3"> Tandori Sauce</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseTwo" class="collapsed">
                                        Choose your cheese
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="radio radio-info">
                                        <input type="radio" id="cheese1" value="Mozzarella" name="cheese">
                                        <label for="cheese1"> Mozzarella </label>
                                    </div>
                                    <div class="radio radio-info">
                                        <input type="radio" id="chees2" value="Feta" name="cheese">
                                        <label for="cheese2"> Feta</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseThree" class="collapsed">
                                        Topping from the farm
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="checkbox checkbox-success">
                                        <input id="tf-farm1" type="checkbox" name="tf-farm[]" value="Beef Hamburger">
                                        <label for="tf-farm1">
                                            Beef Hamburger
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="tf-farm2" type="checkbox" name="tf-farm[]" value="Beef Keema">
                                        <label for="tf-farm2">
                                            Beef Keema
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="tf-farm3" type="checkbox" name="tf-farm[]" value="Beef Sausage">
                                        <label for="tf-farm3">
                                            Beef Sausage
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseFour" class="collapsed">
                                        Topping from the field
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="checkbox checkbox-success">
                                        <input id="tf-field1" type="checkbox" name="tf-field[]" value="Red Onions">
                                        <label for="tf-field1">
                                            Red Onions
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="tf-field2" type="checkbox" name="tf-field[]" value="Mushrooms">
                                        <label for="tf-field2">
                                            Mushrooms
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input id="tf-field3" type="checkbox" name="tf-field[]" value="Cherry Tomotoes">
                                        <label for="tf-field3">
                                            Cherry Tomotoes
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					</form>
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="button" onclick="confirmForCart();" class="btn btn-danger waves-effect waves-light">Confirm</button>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

	<div id="alert" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Order Alert</h4>
                </div>
                <div id="msg" class="modal-body">
					
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-default btn-info waves-effect" data-dismiss="modal">OK</button>
                </div>
			</div>
			</div>	
	</div>
<div id="discount" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Order discount</h4>
                </div>
                <div class="modal-body">
					<div id="disc" class="row" >
						<button class="btn btn-default waves-effect waves-light btn-lg m-b-5 btn-size" onclick="setDiscount(10,this)">10% Discount</button>
					
						<button class="btn btn-default waves-effect waves-light btn-lg m-b-5 btn-size" onclick="setDiscount(20,this)">20% Discount</button>
					
						<button class="btn btn-default waves-effect waves-light btn-lg m-b-5 btn-size" onclick="setDiscount(30,this)">30% Discount</button>
					</div>
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-info waves-effect" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-danger btn-info waves-effect" onclick="applyDiscount();">OK</button>
                </div>
			</div>
			</div>	
	</div>

	<div id="pay_order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Order Payment</h4>
                </div>
                <div class="modal-body">
					<div id="pay_sec" class="row" >
						<button class="btn btn-default waves-effect waves-light btn-lg m-b-5 btn-size" style="width:200px; height:150px;" onclick="order()">Cash</button>
					
						<button class="btn btn-default waves-effect waves-light btn-lg m-b-5 btn-size" style="width:200px; height:150px;" onclick="order()">Card</button>
		
					</div>
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-info waves-effect" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-danger btn-info waves-effect hide" onclick="order();">OK</button>
                </div>
			</div>
			</div>	
	</div>
	
<script>
$(function(){
	$('#loader').removeClass('hide');
});
var crsf='<?php echo $this->request->getParam('_csrfToken'); ?>';
function PosModel() {
	var self = this;
	self.brands=ko.observableArray();  
	self.selectedBrand=ko.observable();
	self.selectedBrandId=ko.observable();
	self.categories=ko.observableArray();
	self.items=ko.observableArray();
	self.cartItems=ko.observableArray();
	self.cartSubTotal=ko.observable();
	self.cartTotal=ko.observable();
	self.itemSizes=ko.observableArray();
	self.selectedItemSize=ko.observable();
	self.selectedCrust=ko.observable();
	self.selectedItem=ko.observable();
	self.discount=ko.observable();
	self.cartDiscount=ko.observable();
	self.changeBrand=function(index,brand){
		$('#loader').removeClass('hide');
			self.selectedBrand(index);
			$.get('<?php echo $this->request->getAttribute("webroot"); ?>api/categories',{id:brand.id},function(data){
				pm.categories(JSON.parse(data));
				$('.portfolioFilter a').removeClass('current');
				$('.portfolioFilter a').eq(0).addClass('current');
				$.get('<?php echo $this->request->getAttribute("webroot"); ?>api/items',{brand_id:brand.id},function(data){
					pm.items(JSON.parse(data));
					$('#loader').addClass('hide');
				});
			});
	}
	self.ItemsByCategory=function(index,category){
		$('#loader').removeClass('hide');
		$.get('<?php echo $this->request->getAttribute("webroot"); ?>api/items',{id:category.id},function(data){
			pm.items(JSON.parse(data));
			$('.portfolioFilter a').removeClass('btn-danger  current');
			$('.portfolioFilter a').eq(index+1).addClass('btn-danger  current');
			$('#loader').addClass('hide');
		});
	}
	self.allItems=function(){
		$('#loader').removeClass('hide');
		$.get('<?php echo $this->request->getAttribute("webroot"); ?>api/items',{brand_id:pm.brands()[pm.selectedBrand()].id},function(data){
			pm.items(JSON.parse(data));
			$('.portfolioFilter a').removeClass('btn-success  current');
			$('.portfolioFilter a').eq(0).addClass('btn-success  current');
			$('#loader').addClass('hide');
		});
	}
	self.addTo=function(index,item){
		if(item.item_sizes.length>0){
			self.selectedItemSize(0);
			self.selectedCrust(0);
			$('.btn-size').removeClass('btn-success');
			$('.curstbtn').removeClass('btn-success');
			$('.error').remove();
			self.itemSizes(item.item_sizes);
			self.selectedItem(item);
			$('#modifiers').modal('show');
		}else{
			addToCart(item);
		}
	}
	self.selectSize=function(index,item){
		$('.btn-size').removeClass('btn-success');
		$('.btn-size').eq(index).addClass('btn-success');
		self.selectedItemSize(item);
	}
	
	self.countAction=function(index,action,data){
		$.ajax({
				method:'POST',
				url:'<?php echo $this->request->getAttribute("webroot"); ?>api/count-action',
				data:{'_csrfToken':crsf,'index':index,'action':action},
				dataType: "JSON",
				beforeSend:function(){
					$('#loader').removeClass('hide');
				},
				success:function(res){
					$('#loader').addClass('hide');
					if(res.type==='success'){
						pm.cartItems(res.items);
						pm.cartSubTotal(res.sub_total);
						pm.cartTotal(res.cart_total);
						pm.cartDiscount(0);
					}
				},
				statusCode: {
					403: function() {
					  window.location.reload();
					}
				  }
			});
	}
	self.delete=function(index,action,data){
			$.ajax({
				method:'POST',
				url:'<?php echo $this->request->getAttribute("webroot"); ?>api/delete-action',
				data:{'_csrfToken':crsf,'index':index},
				dataType: "JSON",
				beforeSend:function(){
					$('#loader').removeClass('hide');
				},
				success:function(res){
					$('#loader').addClass('hide');
					if(res.type==='success'){
						pm.cartItems(res.items);
						pm.cartSubTotal(res.sub_total);
						pm.cartTotal(res.cart_total);
					}
				},
				statusCode: {
					403: function() {
					  window.location.reload();
					}
				  }
			});
	}
}
var pm=new PosModel();
	$.get('<?php echo $this->request->getAttribute("webroot"); ?>api/brands',function(data){
			pm.brands(JSON.parse(data));
			pm.selectedBrand(0);
		$.get('<?php echo $this->request->getAttribute("webroot"); ?>api/categories',{id:pm.brands()[0].id},function(data){
				pm.categories(JSON.parse(data));
			$.get('<?php echo $this->request->getAttribute("webroot"); ?>api/items',{brand_id:pm.brands()[0].id},function(data){
					pm.items(JSON.parse(data));
					$('#loader').addClass('hide');
			});
		});
});

$.get('<?php echo $this->request->getAttribute("webroot"); ?>api/allCartItems',function(data){
	var data=JSON.parse(data);
	pm.cartItems(data.items);
	pm.cartSubTotal(data.sub_total);
	pm.cartTotal(data.cart_total);
	pm.cartDiscount(data.discount_amount);
});

function addToCart(data){
	if(data){
		$.ajax({
				method:'POST',
				url:'<?php echo $this->request->getAttribute("webroot"); ?>api/addToCart',
				data:{'_csrfToken':crsf,'item':data},
				dataType: "JSON",
				beforeSend:function(){
					$('#loader').removeClass('hide');
				},
				success:function(res){
					$('#loader').addClass('hide');
					if(res.type==='success'){
						pm.cartItems(res.items);
						pm.cartSubTotal(res.sub_total);
						pm.cartTotal(res.cart_total);
						pm.cartDiscount(0);
					}
				},
				statusCode: {
					403: function() {
					  window.location.reload();
					}
				  }
			});
	}
}

function selectCrust(crust,price,obj){
	$('.curstbtn').removeClass('btn-success');
	$(obj).addClass('btn-success');
	pm.selectedCrust({crust:crust,price:price});
}

function confirmForCart(){
	$('.error').remove();
	var toppings=$('#toppings_form').serialize();
	if(pm.selectedItemSize()==0){
		$('#size').append('<span class="error">Please select size.</span>');
		return false;
	}
	if(pm.selectedCrust()==0){
		$('#crust').append('<span class="error">Please select crust.</span>');
		return false;
	}
	$.ajax({
			method:'POST',
			url:'<?php echo $this->request->getAttribute("webroot"); ?>api/add-to-cart-with-toppings',
			data:{'_csrfToken':crsf,'size':pm.selectedItemSize(),'crust':pm.selectedCrust(),'toppings':toppings,'item':pm.selectedItem()},
			dataType: "JSON",
			beforeSend:function(){
				$('#loader').removeClass('hide');
			},
			success:function(res){
				$('#loader').addClass('hide');
				$('#modifiers').modal('hide');
				$('#toppings_form')[0].reset();
				if(res.type==='success'){
					pm.cartItems(res.items);
					pm.cartSubTotal(res.sub_total);
					pm.cartTotal(res.cart_total);
					pm.cartDiscount(0);
				}
			},
			statusCode: {
				403: function() {
				  window.location.reload();
				}
			  }
		});
}

function changeOrder(){
	var r = confirm("Are sure you want to cancel this order");
	if (r == true) {
		$.get('<?php echo $this->request->getAttribute("webroot"); ?>api/change',function(data){
			window.location.href='<?php echo $this->request->getAttribute("webroot"); ?>pos';
		});
	}
}

function order(){
	$.ajax({
			method:'POST',
			url:'<?php echo $this->request->getAttribute("webroot"); ?>api/add-order',
			data:{'_csrfToken':crsf},
			dataType: "JSON",
			beforeSend:function(){
				$('#loader').removeClass('hide');
			},
			success:function(res){
				$('#loader').addClass('hide');
				if(res.type==='success'){
					window.location.href=res.action;
				}
				if(res.type==='error'){
					$('#msg').html(res.msg);
					$('#alert').modal('show');
				}
				
			},
			statusCode: {
				403: function() {
				  window.location.reload();
				}
			  }
		});
}

function sendToKitchen(){
	window.location.href='<?php echo $this->request->getAttribute("webroot"); ?>pos/kitchen';
}
function cancelOrder(){
	var r = confirm("Are sure you want to cancel this order");
	if (r == true) {
		$.ajax({
			method:'POST',
			url:'<?php echo $this->request->getAttribute("webroot"); ?>api/cancel-order',
			data:{'_csrfToken':crsf},
			dataType: "JSON",
			beforeSend:function(){
				$('#loader').removeClass('hide');
			},
			success:function(res){
				$('#loader').addClass('hide');
				if(res.type==='success'){
					pm.cartItems(res.items);
					pm.cartSubTotal(res.sub_total);
					pm.cartTotal(res.cart_total);
					pm.cartDiscount(0);
				}
			},
			statusCode: {
				403: function() {
				  window.location.reload();
				}
			  }
		});
	}
}
function discount(){
	 $('#discount').modal('show');
 }
 function setDiscount(dis,obj){
	 pm.discount(dis);
	 $('#disc button').removeClass('btn-success');
	 $(obj).addClass('btn-success');
 }
 function applyDiscount(){
	 $('.error').remove();
	 if(pm.discount()){
		 $.ajax({
				method:'POST',
				url:'<?php echo $this->request->getAttribute("webroot"); ?>api/apply-discount',
				data:{'_csrfToken':crsf,'discount':pm.discount()},
				dataType: "JSON",
				beforeSend:function(){
					 $('#discount').modal('hide');
					$('#loader').removeClass('hide');
				},
				success:function(res){
					$('#loader').addClass('hide');
					$.get('<?php echo $this->request->getAttribute("webroot"); ?>api/allCartItems',function(data){
						var data=JSON.parse(data);
						pm.cartItems(data.items);
						pm.cartSubTotal(data.sub_total);
						pm.cartTotal(data.cart_total);
						pm.cartDiscount(data.discount_amount);
						
					});
				},
				statusCode: {
					403: function() {
					  window.location.reload();
					}
				  }
			});
	 }else{
		$('#disc').append('<span class="error">Please select Discount.</span>');
	 }
 }
 function setPay(pay,obj){
	 $('#pay_sec button').removeClass('btn-success');
	 $(obj).addClass('btn-success');
 }
 
 function payment(){
	 if(pm.cartItems().length==0){
		 $('#alert').modal('show');
		 $('#msg').html('NO item in cart for payment.');
	 }else{
		 $('#pay_order').modal('show');
		 
	 } 
 }
ko.options.useOnlyNativeEvents = true;
ko.options.deferUpdates = true;
ko.applyBindings(pm);
</script>
