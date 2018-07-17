<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" >
    <title>Cloud Pos Kitchan</title>
    <link type="text/css" rel="stylesheet" href="<?php echo $this->request->getAttribute("webroot"); ?>css/kitchen-style-master.css">
	
    <link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
  <?php //pr($Auth->user('brand_id'));?>
    <div class="main-container">
	  <ul class="grid-list" id="Current-list" data-bind="foreach:orders">
        <li>
          <div class="head-sec">
            <div class="right-sec" data-bind="text:'Order:00'+$data.id">#149441</div>
          </div>
          <div class="body-sec">
		  <span class="order-no" data-bind="text:$index()+1">0</span>
		  <div class="all-brand" data-bind="foreach:$data.order_items">
			<div class="brand" data-bind="attr:{class:'brand'+$data.brand+' '+$data.status.toLowerCase()}">
				 <div class="head-sec">
					 <div class="left-sec" data-bind="text:$data.brand_name">NKD</div>
					 <!--ko if: $data.status=='Completed' -->
					 <div class="right-sec"><i class="fa  fa-check-square-o"></i></div>
					 <!-- /ko -->
				 </div>
				<div class="item-list" data-bind="foreach:$data.items">
				<div class="item">
				<h3><span class="num" data-bind="text:$index()+1">1</span><span class="title" data-bind="text:$data.item.name">superbiotic</span></h3>
				<!--ko if:$data.size -->
				<ul class="menu-list">
				  <li><span data-bind="text:'Size:'+$data.size">Crust: Gluten Free</span></li>
				</ul> 
				<!--/ko-->
				<!--ko if:$data.order_item_toppings -->
				<ul class="menu-list" data-bind="foreach:$data.order_item_toppings">
				  <li><span data-bind="text:'+'+$data.topping_name"></span></li> 
				</ul>
				<!--/ko-->
				</div>
				</div>
				</div>
				</div>
			
          </div>
		  
          <div class="footer-sec">
            <div class="right-sec"><a href="javascript:void(0)" data-bind="click:$parent.order_send">Delivered</a></div>
          </div>
        </li>
        
	
	 </ul>
    </div>
    <footer>
      <!-- <span class="hide">Dispatch Screen</span>-->
      <!--<span class="order-no">Order1</span>-->
      <ul>
        <li><a href="javascript:void();" onclick="fullscreen()"><i class="fa fa fa-arrows-alt"></i></a></li>
       <!-- <li><a href="javascript:void();" class="tab" id="Completed">Completed Order</a></li>-->
        <li><a href="javascript:void();" class="tab active" id="Current">Current Order</a></li>
        <li><a href="javascript:void();"><i class="fa fa fa-chevron-left"></i> Prev</a></li>
        <li><a href="javascript:void();">next <i class="fa fa fa-chevron-right"></i></a></li>
      </ul>
    </footer>
<script src="<?php echo $this->request->getAttribute("webroot"); ?>js/knockout.js"></script>	
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#Completed").on('click',function(){
	   $("#Completed-list").fadeIn();
	   $("#Current-list").fadeOut();
	   $("#Current").removeClass('active');
	   $("#Completed").addClass('active');
	});
	$("#Current").on('click',function(){
	   $("#Current-list").fadeIn();
	   $("#Completed-list").fadeOut();
	   $("#Completed").removeClass('active');
	   $("#Current").addClass('active');
	});
});

function fullscreen() {
    if ((document.fullScreenElement && document.fullScreenElement !== null) ||
        (!document.mozFullScreen && !document.webkitIsFullScreen)) {
        if (document.documentElement.requestFullScreen) {
            document.documentElement.requestFullScreen();
        } else if (document.documentElement.mozRequestFullScreen) {
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullScreen) {
            document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        }
    }
  }
  
  function PosModel(){
        var self = this;
        self.orders=ko.observable();
		self.order_send=function(order){
			console.log(order);
		}
    }
var pm=new PosModel();
$.get('<?php echo $this->request->getAttribute("webroot"); ?>master-kitchen/orders',function(data){
		pm.orders(JSON.parse(data));
	});
setInterval(function(){
	$.get('<?php echo $this->request->getAttribute("webroot"); ?>master-kitchen/orders',function(data){
		pm.orders(JSON.parse(data));		
	});	
 },3000);
ko.options.useOnlyNativeEvents = true;
ko.options.deferUpdates = true;
ko.applyBindings(pm);
</script>
</body>
</html>