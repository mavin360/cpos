<?php //extract($pageVar); // pr($this->request->data); ?>
<?php echo $this->Form->create($StoresOrderType,array('id'=>'AddBrand','class'=>'form-horizontal form-bordered','enctype' => 'multipart/form-data','onsubmit'=>'savedata();return false;')); 
echo $this->Form->control('id');
?>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
			 <div class="panel-body ">
       <div class="col-sm-6"> 
			<div class="form-group col-sm-12">
			<label class="col-sm-3 control-label">Order Type Label</label>
			<div class="col-sm-9">
			<?php echo $this->Form->input('name', array('label'=>false,'class'=>'form-control required','required'=>'required')); ?>
			</div>
			</div>
			<div class="form-group col-sm-12">
			<label class="col-sm-3 control-label">Order Type</label>
			<div class="col-sm-9">
				<?php echo $this->Form->radio('order_type',[['value'=>'in_store','text'=>'  In Store'],['value'=>'out_store','text'=>'  Out Store']],['label' => ['style' =>'padding:10px']]);?>
			</div>
			</div>
			<div class="form-group col-sm-12">
			<label class="col-sm-3 control-label">Surcharge</label>
			<div class="col-sm-9">
			 <?php echo $this->Form->input('surcharge', array('label'=>false,'class'=>'form-control','type'=>'textarea')); ?>
		   </div>
		</div>
		
	</div>
	<div class="col-sm-6">
	<div class="form-group col-sm-12">
	<h4 class="col-sm-9">Select Stores</h4>
	<?php //pr($stores);?>
	<div class="col-sm-9 pull-right">
	<div class="ckbox ckbox-primary">
			<input name="store_id[]" value="0" id="checkbox0" type="checkbox" onclick="checkAll(this);">
			<label for="checkbox0" >All Stores</label>
	</div>
	<?php 
	//pr($addedstores);
	foreach($stores as $key=>$store){ ?>
		<div class="ckbox ckbox-primary">
			<input name="store_id[]" value="<?php echo $key;?>" <?php if(in_array($key,$addedstores)){?> checked="checked" <?php }?> id="checkbox<?php echo $key;?>" type="checkbox">
			<label for="checkbox<?php echo $key;?>"><?php echo $store;?></label>
		 </div>
	<?php } ?>
     </div>
	</div>
	</div>
</div><!-- /.box-body -->

</div>
</div>
</div>
</section>
<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       <button id="save" class="btn btn-primary" type="submit" >Save</button>
</div>
<?php echo $this->Form->end();?>
<script type="text/javascript">
$(function(){
	
});
var $btn;
function savedata(){
	var form=$('#AddBrand')[0];
	var formData = new FormData(form);
	$.ajax({
				method:'POST',
				url:'<?php echo $this->request->webroot; ?>admin/stores/save-edit-type',
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
						window.location.href='<?php echo $this->request->webroot; ?>admin/stores/order-types';
					}
					if(res.status=='error'){
						$('#msg').html('<span class="error-message">'+res.msg+'</span>');
					}
				}
			});
}

function checkAll(obj){
	if($(obj).prop("checked") == true){
         $('input[name="store_id[]"]').prop('checked', true);    
	}
	else if($(obj).prop("checked") == false){
		$('input[name="store_id[]"]').prop('checked', false);
	}
}
</script>