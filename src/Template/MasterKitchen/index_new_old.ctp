<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" >
    <title>Cloud Pos Kitchan</title>
    <link type="text/css" rel="stylesheet" href="<?php echo $this->request->getAttribute("webroot"); ?>css/kitchen-style-master.css">
	
    <link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <style>
  .hide{display:none;}
  </style>
  <body>
  <?php //pr($Auth->user('brand_id'));?>
    <div class="main-container">
	  <ul class="grid-list" id="Current-list" data-bind="foreach:orders,timer">
        <li data-bind="attr:{class:$index()>15?'hide':''}">
          <div class="head-sec">
            <div class="right-sec" data-bind="text:'Order:'+$data.id">#149441</div>
          </div>
          <div class="body-sec">
		  <!--<span class="order-no" data-bind="text:$index()+1">0</span>-->
		  <div class="all-brand" data-bind="foreach:$data.order_items">
			<div class="brand" >
				 <div class="head-sec" data-bind="attr:{class:'brand'+$data.brand+' '+$data.status.toLowerCase()}">
					 <div class="left-sec" data-bind="text:$data.brand_name">NKD</div>
					 <!--ko if: $data.status=='Completed' -->
					 <div class="right-sec">Ready</div>
					 <!-- /ko -->
					 <!--ko ifnot: $data.status=='Completed' -->
					 <div class="right-sec">In Kitchen</div>
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
		  <div class="left-sec timer" data-bind="attr: {'data-time':$data.order_date}">00:00</div>
            <div class="right-sec"><button type="button" class="dispach_btn" data-bind="click:$parent.order_send.bind($data,$index()),attr:{'disabled':$data.order_delevery=='Pending'?true:false}">Dispatch</button></div>
          </div>
        </li>
        
	
	 </ul>
    </div>
    <footer>
      <span style="color: #000;">Dispatch Screen</span>
      <!--<span class="order-no">Order1</span>-->
      <ul>
	  <li>
		<i class="fa fa-desktop"></i>
		<?php $brnd_id=$Auth->user('brand_id');	?>
		<select name="screen" class="screen" onchange="changeScreen(this)">
		<option value="master" <?php echo $brnd_id==0?'selected="selected"':'';?>>Expo</option>
		<option value="1" <?php echo $brnd_id==1?'selected="selected"':'';?>>Right Bite Express</option>
		<option value="4" <?php echo $brnd_id==4?'selected="selected"':'';?>>NKD Pizza</option>
		</select>
		</li>
        <li><a href="javascript:void();" onclick="fullscreen()"><i class="fa fa fa-arrows-alt"></i></a></li>
       <!-- <li><a href="javascript:void();" class="tab" id="Completed">Completed Order</a></li>-->
        <li><a href="javascript:void();" class="tab active" id="Current">Current Order</a></li>
        <li><a href="javascript:void();" onclick="prev();"><i class="fa fa fa-chevron-left"></i> Prev</a></li>
        <li><a href="javascript:void();" onclick="next();">next <i class="fa fa fa-chevron-right"></i></a></li>
      </ul>
    </footer>
<script src="<?php echo $this->request->getAttribute("webroot"); ?>js/knockout.js"></script>	
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
 <script src="<?php echo $this->request->getAttribute("webroot"); ?>js/vendor.js"></script>
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
   var crsf='<?php echo $this->request->getParam('_csrfToken'); ?>';
  function PosModel(){
        var self = this;
        self.orders=ko.observable();
		self.order_send=function(index,order){
			if(order){
				$.ajax({
				method:'POST',
				url:'<?php echo $this->request->getAttribute("webroot"); ?>master-kitchen/dispatch-order',
				data:{'_csrfToken':crsf,'data':order},
				dataType: "JSON",
				beforeSend:function(){
					//$('#loader').removeClass('hide');
				},
				success:function(res){
					//$('#loader').addClass('hide');
					if(res.type==='success'){
						$.get('<?php echo $this->request->getAttribute("webroot"); ?>master-kitchen/orders',function(data){
							pm.orders(JSON.parse(data));
						});
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
		self.prev=ko.observable(0);
		self.next=ko.observable(0);
    }
var pm=new PosModel();
function changeScreen(obj){
	var val=$(obj).val();
	$.get('<?php echo $this->request->getAttribute("webroot"); ?>master-kitchen/change-screen/'+val,function(data){
		if(data !='master'){
			window.location.href="<?php echo $this->request->getAttribute("webroot"); ?>kitchen"
		}
	});
}
$.get('<?php echo $this->request->getAttribute("webroot"); ?>master-kitchen/orders',function(data){
		pm.orders(JSON.parse(data));
	});
setInterval(function(){
	$.get('<?php echo $this->request->getAttribute("webroot"); ?>master-kitchen/orders',function(data){
		pm.orders(JSON.parse(data));		
	});	
 },300000);
 
 
 ko.bindingHandlers.timer={
    init: function() {
		 setInterval(function () {
            var timers = $('.timer');
            timers.each(function (timer) {
                var elm = $(this);
                var time = elm.data('time');
                var seconds = moment().diff(time, 'seconds');
                var durationStr = moment.duration(seconds, "seconds").format("h[h], m[m], s[s]");
                elm.text(durationStr+' ago');
            });
        }, 1000);
    },
    update:function(){
        
    }
};
function next(){
	//var gc=16;
	if(pm.orders().length>gc){
		//pm.next(1);
		
	}
}
function prev(){
	
}
ko.options.useOnlyNativeEvents = true;
ko.options.deferUpdates = true;
ko.applyBindings(pm);
</script>
</body>
</html>