<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" >
    <title>Cloud Pos Kitchan</title>
    <link id="css_file" type="text/css" rel="stylesheet" href="<?php echo $this->request->getAttribute("webroot"); ?>css/<?php echo $Auth->user('brand_id')?'kitchen-style-'.$Auth->user('brand_id'):'kitchen-style-master'?>.css">
	
    <link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
  <?php //pr($Auth->user('brand_id'));?>
    <div class="main-container">
      <ul class="grid-list" id="Completed-list"  style="display: none;">
        <li>
          <div class="head-sec">
            <div class="left-sec">Walkin <span>4</span></div>
            <div class="right-sec">#149441</div>
          </div>
          <div class="body-sec">
            <span class="order-no">1</span>
            <h3><span class="num">1</span><span class="title">superbiotic</span></h3>
            <ul class="menu-list">
              <li><span>Crust: Gluten Free</span></li>
              <li><span>Size: Medium</span></li>
              <li><span>- Tomato Sauce (Full)</span></li>
              <li><span>+ BBQ Sauce (Full)</span></li>
              <li><span>+ Feta (Full)</span></li>
            </ul>
          </div>
          <div class="footer-sec">
            <div class="item-progress">--#149441 continued--</div>
          </div>
        </li>
        <li>
          <div class="head-sec">
            <div class="left-sec">continuation</div>
            <div class="right-sec">#149441</div>
          </div>
          <div class="body-sec">
            <span class="order-no">1</span>
            <ul class="menu-list">
              <li><span>+ Beef Sausage (Add Extra) (Full)</span></li>
              <li><span>+ Chicken (Add Extra) (Full)</span></li>
            </ul>
            <h3><span class="num">2</span><span class="title">green apple &amp; feta salad</span></h3>
            <ul class="menu-list">
              <li><span>+ Balsamic &amp; Basil Sauce</span></li>
              <li><span>+ Rocket Leaves (Add Extra)</span></li>
              <li><span>+ Cucumber (Add Extra)</span></li>
            </ul>
          </div>
          <div class="footer-sec">
            <div class="item-progress">--#149441 continued--</div>
          </div>
        </li>
        <li>
          <div class="head-sec">
            <div class="left-sec">continuation</div>
            <div class="right-sec">#149441</div>
          </div>
          <div class="body-sec">
            <span class="order-no">1</span>
            <h3><span class="num">2</span><span class="title">diet pepsi</span></h3>
            <h3><span class="num">3</span><span class="title">sun blast orange</span></h3>
          </div>
          <div class="footer-sec">
            <div class="left-sec">07:17:52</div>
            <!--<div class="right-sec"><a href="javascript:void(0)">Ready</a> <a href="javascript:void(0)">Collected?</a></div>-->
          </div>
        </li>
      </ul>
      
	  <ul class="grid-list" id="Current-list" data-bind="foreach:orders,timer">
        <li>
          <div class="head-sec">
          <div class="left-sec" data-bind="with:$parent.brand"><h4 data-bind="text:name" style="font-weight:bold; font-size:12px;">Brand Name</h4>
        </div>
		  <!--  <div class="left-sec" data-bind="with:$parent.brand" style="display: inline;">
			  <span  data-bind="text:name"></span>
			</div>-->
           <!-- <div class="left-sec" data-bind="text:$data.order_status"></div>-->
         <!--<div class="left-sec" data-bind="text:'Order No:'+$data.id">#149441</div> -->
		 <div class="right-sec" data-bind="text:'Order:'+$data.id"></div>
		 <div class="right-sec" data-bind="text:$data.cart_count">1/2</div>
          </div>
          <div class="body-sec">
            <!--<span class="order-no" data-bind="text:$index()+1">0</span> -->
			<div class="item-list" data-bind="foreach:$data.order_items">
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
		  
          <!--<div class="footer-sec">
            <div class="item-progress">--<span data-bind="text:$data.order_id">#149441</span> continued--</div>
          </div> -->
		  <div class="footer-sec">
            <div class="left-sec timer" data-bind="attr: {'data-time':$data.order_date}">00:00</div>
            <div class="right-sec"><a href="javascript:void(0)" data-bind="click:$parent.order_complete">Complete</a></div>
          </div>
        </li>
	 </ul>
    </div>
    <footer>
	<div data-bind="with:brand" style="display: inline;">
      <span  data-bind="text:name"></span>
	</div>
      <ul>
		<li>
		<i class="fa  fa-desktop"></i>
		<?php $brnd_id=$Auth->user('brand_id');
			
		?>
		<select name="screen" class="screen" onchange="changeScreen(this)">
		<option value="master" <?php echo $brnd_id==0?'selected="selected"':'';?>>Expo</option>
		<option value="1" <?php echo $brnd_id==1?'selected="selected"':'';?>>Right Bite Express</option>
		<option value="4" <?php echo $brnd_id==4?'selected="selected"':'';?>>NKD Pizza</option>
		
		</select>
		</li>
        <li><a href="javascript:void();" onclick="fullscreen()"><i class="fa fa fa-arrows-alt"></i></a></li>
       <!-- <li><a href="javascript:void();" class="tab" id="Completed">Completed Order</a></li> -->
        <li><a href="javascript:void();" class="tab active" id="Current">Current Order</a></li>
        <li><a href="javascript:void();"><i class="fa fa fa-chevron-left"></i> Prev</a></li>
        <li><a href="javascript:void();">next <i class="fa fa fa-chevron-right"></i></a></li>
      </ul>
    </footer>

<!-- Latest compiled and minified JavaScript -->

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
		self.brand=ko.observable();
        self.orders=ko.observable();
		self.kitchenId=ko.observable(<?php echo $Auth->user('brand_id');?>);
		
		self.order_complete=function(data){
			$.ajax({
				method:'POST',
				url:'<?php echo $this->request->getAttribute("webroot"); ?>kitchen/complete-order',
				data:{'_csrfToken':crsf,'id':data.id,'kitchen':self.kitchenId()},
				dataType: "JSON",
				beforeSend:function(){
					//$('#loader').removeClass('hide');
				},
				success:function(res){
					//$('#loader').addClass('hide');
					if(res.type==='success'){
						$.get('<?php echo $this->request->getAttribute("webroot"); ?>kitchen/orders',function(data){
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
var pm=new PosModel();	
function changeScreen(obj){
	var val=$(obj).val();
	$.get('<?php echo $this->request->getAttribute("webroot"); ?>kitchen/change-screen/'+val,function(data){
		if(data =='master'){
			window.location.href="<?php echo $this->request->getAttribute("webroot"); ?>master-kitchen"
		}else {
			$('#css_file').attr('href','<?php echo $this->request->getAttribute("webroot"); ?>css/kitchen-style-'+data+'.css');
			pm.kitchenId(data);
			$.get('<?php echo $this->request->getAttribute("webroot"); ?>kitchen/brand/'+data,function(data){
				pm.brand(JSON.parse(data));
				$.get('<?php echo $this->request->getAttribute("webroot"); ?>kitchen/orders',function(data){
					pm.orders(JSON.parse(data));
				});
			});
		}
	});
}	

$.get('<?php echo $this->request->getAttribute("webroot"); ?>kitchen/orders',function(data){
		pm.orders(JSON.parse(data));
	});
$.get('<?php echo $this->request->getAttribute("webroot"); ?>kitchen/brand/'+pm.kitchenId(),function(data){
		pm.brand(JSON.parse(data));
	});
	
setInterval(function(){
	$.get('<?php echo $this->request->getAttribute("webroot"); ?>kitchen/orders',function(data){
		pm.orders(JSON.parse(data));		
	});	
 },100000);
 
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
ko.options.useOnlyNativeEvents = true;
ko.options.deferUpdates = true;
ko.applyBindings(pm);
</script>
</body>
</html>