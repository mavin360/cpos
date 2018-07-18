<?php $cnt=$this->request->getParam('controller');
		$action=$this->request->getParam('action'); ?>
<div class="pageheader">
        <ol class="breadcrumb">
          <li><a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/setup">Setup</a></li>
          <li><a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/stores">Location</a></li>
          <li class="active"> Add Store</li>
        </ol>
  </div>
<section class="content">
 <ul class="nav nav-tabs" role="tablist">
	  <li><a class="btn btn-primary" href="<?php echo $this->request->getAttribute("webroot"); ?>admin/stores"><i class="fa fa-arrow-left"></i>Back</a></li>
	<li class="<?php echo (strtolower($cnt)=='stores' && $action=='add')?'active':'';?>"><a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/stores">Stores</a></li>
	  <li class="<?php echo (strtolower($cnt)=='stores' && $action=='brands')?'active':'';?>"><a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/stores/brands">Brands/Revenue Centers</a></li>
	  <li class="<?php echo (strtolower($cnt)=='stores' && $action=='orderTypes')?'active':'';?>"><a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/stores/order-types">Order Types</a></li>
</ul>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
			<div class="panel-heading">
		  <h3 class="panel-title">Add store 
		  <?php echo $this->Html->link(__('Stores List', true), array('action' => 'index'),array('class'=>'btn btn-primary pull-right')); ?>
		  </h3>
		</div>
			
			 <div class="panel-body ">
		<?php echo $this->Form->create($store,array('id'=>'AddStore','class'=>'form-horizontal form-bordered','enctype' => 'multipart/form-data','onsubmit'=>'savedata();return false;')); ?>
        
         <!-- <div class="form-group col-sm-6">
          <label class="col-sm-3 control-label required">Store ID</label>
            <div class="col-sm-9">
             <?php //echo $this->Form->input('store', array('label'=>false,'type'=>'text','class'=>'form-control required','title'=>'Please enter store id.')); ?>
           </div>
         </div> -->
       <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store Name</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('store_name', array('label'=>false,'class'=>'form-control required','title'=>'Please enter store name.')); ?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store Address</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('store_address', array('label'=>false,'class'=>'form-control required','title'=>'Please enter store address.')); ?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store Image</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('store_image', array('type'=>'file','label'=>false)); ?>
         <?php if(!empty($this->request->data['Store']['store_image'])){ ?>
          <br><img src="<?php echo WEBROOT.$this->request->data['Store']['store_image']; ?>" style="width: 50px; height: 50px;">
         <?php } ?>
       </div>
     </div>
	 
     <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store Phone</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('store_phone', array('label'=>false,'class'=>'form-control','title'=>'Please enter valid phone.')); ?>
       </div>
     </div>
	 <div class="clearfix"></div>
     <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store Email</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('store_email', array('label'=>false,'class'=>'form-control required','title'=>'Please enter valid email.')); ?>
       </div>
     </div>
      <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store City</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('city', array('label'=>false,'class'=>'form-control','title'=>'Please enter valid city.')); ?>
       </div>
     </div>
      <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store State</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('state', array('label'=>false,'class'=>'form-control','title'=>'Please enter valid state.')); ?>
       </div>
     </div>
      <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store Country</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('country', array('label'=>false,'options'=>$countryArr,'class'=>'form-control selectBox','data-placeholder'=>"Choose a Country...")); ?>
       </div>
     </div>
	 <div class="clearfix"></div>
     <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store Zipcode</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('zip', array('label'=>false,'class'=>'form-control','title'=>'Please enter valid zipcode.')); ?>
       </div>
     </div>
	
      <div class="form-group col-sm-6 ">
        <label class="col-sm-3 control-label">Store Latitude</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('latitude', array('label'=>false,'class'=>'form-control','title'=>'Please enter valid latitude.')); ?>
       </div>
     </div>
      <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store Longitude</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('longitude', array('label'=>false,'class'=>'form-control','title'=>'Please enter valid longitude.')); ?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Delivery Radius</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('delivery_radius', array('label'=>false,'class'=>'form-control')); ?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store Notification Email</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('notification_email', array('label'=>false,'class'=>'form-control')); ?>
       </div>
     </div>
    <div class="form-group col-sm-6">
          <label class="col-sm-3 control-label required">Tax ID</label>
            <div class="col-sm-9">
             <?php echo $this->Form->input('tex_id', array('label'=>false,'type'=>'text','class'=>'form-control','title'=>'Please enter store tax Id.')); ?>
           </div>
         </div>
		 <div class="clearfix"></div>
	<div class="form-group col-sm-6">
          <label class="col-sm-3 control-label required">Print Label</label>
            <div class="col-sm-9">
             <?php echo $this->Form->input('print_label', array('label'=>false,'type'=>'text','class'=>'form-control','title'=>'Please enter print label.')); ?>
           </div>
   </div>
	
  <!--  <div class="clearfix"></div><div class="form-group col-sm-6">
	<div class="col-sm-12">
      <label class="col-sm-3 control-label">Delivery Status</label>
      <div class="col-sm-9">
	   <label><input class="" type="radio" name="delivery_status" checked="checked"  value="enable" onclick="$('#delivery').addClass('hide');$('#deli_time').removeClass('hide');"> Enable</label>
	 <label> <input class="" type="radio" name="delivery_status" value="disable" onclick="$('#delivery').removeClass('hide'); $('#deli_time').addClass('hide'); "> Disable</label>
     </div>
	 </div>
	 <div id="delivery" class="hide col-sm-12">
	 <label class="col-sm-3 control-label">Delivery Disable Message</label>
      <div class="col-sm-9 md10">
	 <?php //echo $this->Form->input('delivery_message', array('label'=>false,'class'=>'form-control','type'=>'textarea','placeholder'=>'Delivery Disable Message')); ?>
	 </div>
	 </div>
	 <div id="deli_time" class="col-sm-12">
	 <label class="col-sm-3 control-label">Delivery Time (in minutes)</label>
      <div class="col-sm-9">
       <?php //echo $this->Form->input('delivery_time', array('label'=>false,'class'=>'form-control','placeholder'=>'Delivery time (in minutes)')); ?>
	   </div>
	  </div> 
   </div>
    
	<div class="form-group col-sm-6">
	<div class="col-sm-12">
      <label class="col-sm-3 control-label">Pick Up Status</label>
      <div class="col-sm-9">
	   <label><input class="" type="radio" name="pickup_status" checked="checked" value="enable" onclick="$('#pickup').addClass('hide');$('#pick_time').removeClass('hide');"> Enable</label>
	 <label> <input class="" type="radio" name="pickup_status" value="disable" onclick="$('#pickup').removeClass('hide');$('#pick_time').addClass('hide');"> Disable</label>
     </div>
	 </div>
	 <div id="pickup" class="hide col-sm-12">
	 <label class="col-sm-3 control-label">Pick Up Disable Message</label>
      <div class="col-sm-9 md10">
	 <?php //echo $this->Form->input('pickup_message', array('label'=>false,'class'=>'form-control','type'=>'textarea','placeholder'=>'Pick Up Disable Message')); ?>
	 </div>
	 </div>
	 <div id="pick_time" class="col-sm-12">
	 <label class="col-sm-3 control-label">Pick Up Time (in minutes)</label>
      <div class="col-sm-9">
       <?php //echo $this->Form->input('pickup_time', array('label'=>false,'class'=>'form-control','placeholder'=>'Pick up time (in minutes)')); ?>
	  </div> 
	  </div> 
   </div>
   -->
   
  <!-- <div class="form-group col-sm-6">
      <label class="col-sm-3 control-label">Store Status </label>
      <div class="col-sm-9">
        <?php //echo $this->Form->input('store_status', array('label'=>false,'options'=>array('Live'=>'Live','Upcoming'=>'Upcoming','Test'=>'Test'),'class'=>'form-control')); ?>
     </div>
   </div> -->
   <div class="form-group col-sm-6">
      <label class="col-sm-3 control-label">Status</label>
      <div class="col-sm-9">
       <?php echo $this->Form->input('status', array('label'=>false,'options'=>['Active'=>'Active','Inactive'=>'Inactive'],'class'=>'form-control','id'=>'sStatus')); ?>
     </div>
    </div>

   <div class="form-group col-sm-12 clear">
   <label class="col-sm-3 control-label">Add Business Hours : </label>
      <div class="col-sm-7">
       <a onclick="return new_day_time();" href="javascript:void(0)" class="btn btn-primary" id="addedBtn" ><i class="fa fa-plus"></i> Add Time Slot </a>
     </div>
    </div>
  <div id="timeSlotBlock"></div>
   <div class="col-sm-12">
  <button id="save" class="btn btn-primary" type="submit">Save</button>
</div><!-- /.box-footer -->
<?php echo $this->Form->end();?>
</div><!-- /.box-body -->

</div>
</div>
</div>
</section>
<link rel="stylesheet" href="<?php echo $this->request->getAttribute("webroot"); ?>pos_admin/css/bootstrap-timepicker.min.css" />
<script src="<?php echo $this->request->getAttribute("webroot"); ?>pos_admin/js/select2.min.js"></script>
<script src="<?php echo $this->request->getAttribute("webroot"); ?>pos_admin/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript">
$(function(){
	$(".selectBox").select2({
		width: '100%'
	  });
	$('.store-time').timepicker({minuteStep: 15});
});

var $btn;
function savedata(){
	var form=$('#AddStore')[0];
	var formData = new FormData(form);
	$.ajax({
				method:'POST',
				url:'<?php echo $this->request->webroot; ?>admin/stores/save',
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
					if(res.status=='success'){
						$('#save').html(res.msg);
						window.location.href='<?php echo $this->request->webroot; ?>admin/stores/';
					}
					if(res.status=='error'){
						$('#msg').html('<span class="error-message">'+res.msg+'</span>');
					}
				}
			});
}

function new_day_time(){
	var section='<div class="new-section"><div class="form-group"><label class="col-sm-2 control-label">Store Open Days</label><div class="col-sm-6" style="padding:0;"><div class="col-sm-6" style="padding:0;"><label class="col-sm-2 control-label">From</label><div class="bootstrap-timepicker col-sm-8"><select name="store_open_days_from[]" class="form-control" id="store-open-days-from"><option value="Sunday">Sunday</option><option value="Monday">Monday</option><option value="Tuseday">Tuseday</option><option value="Wednesday">Wednesday</option><option value="Thursday">Thursday</option><option value="Friday">Friday</option><option value="Saturday">Saturday</option></select></div></div><div class="col-sm-6" style="padding:0;"><label class="col-sm-2 control-label">To</label><div class="bootstrap-timepicker col-sm-8"><select name="store_open_days_to[]" class="form-control" id="store-open-days-to"><option value="Sunday">Sunday</option><option value="Monday">Monday</option><option value="Tuseday">Tuseday</option><option value="Wednesday">Wednesday</option><option value="Thursday" >Thursday</option><option value="Friday">Friday</option><option value="Saturday">Saturday</option></select></div></div></div><a href="javascript:void(0)" class="panel-close" onClick="close_section(this);">×</a></div><div class="form-group"><label class="col-sm-2 control-label">Store Open Time</label><div class="col-sm-6" style="padding:0;"><div class="col-sm-6" style="padding:0;"><label class="col-sm-2 control-label">From</label><div class="bootstrap-timepicker col-sm-8"><input name="store_open_time_from[]" class="form-control store-time" maxlength="255" id="store-open-time-from" value="11:00 AM" type="text"></div></div>	 <div class="col-sm-6" style="padding:0;"><label class="col-sm-2 control-label">To</label><div class="bootstrap-timepicker col-sm-8"><input name="store_open_time_to[]" class="form-control store-time" maxlength="20" id="store-open-time-to" value="07:00 PM" type="text"></div></div></div></div></div>';
	$('#timeSlotBlock').append(section);
	$('.store-time').timepicker({minuteStep: 15});
}
function close_section(obj){
	$(obj).parent().parent().remove();
}

</script>