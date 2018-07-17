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
<div class="row">
<div class="col-sm-12">
<?php //pr($Auth->user());?>
	<div class="profile-header">
		<div class="tab-content">
		<div class="tab-pane active" id="activities">
		 <?= $this->Form->create($user,['id'=>'user_form','class'=>'form-horizontal form-bordered','enctype' => 'multipart/form-data','onsubmit'=>'savedata();return false;']);
			$this->Form->setTemplates([
					'inputContainer' => '<div class="col-sm-6">{{content}}</div>',
					'label'=>false
				]);
			?>
			<div class="form-group" style="border-top:none;"><label class="col-sm-2 control-label">Company Name </label>
			<?php echo $this->Form->control('name',['class'=>'form-control','placeholder'=>'Company Name']);?>
			</div>
			<div class="form-group"><label class="col-sm-2 control-label">Company Email </label>
			<?php echo $this->Form->control('email',['class'=>'form-control','placeholder'=>'Company Email','readonly'=>true]);?>
			</div>
			<div class="form-group"><label class="col-sm-2 control-label">Company Phone </label>
			<?php echo $this->Form->control('phone',['class'=>'form-control','placeholder'=>'Company Phone']);?>
			</div>
			<div class="form-group"><label class="col-sm-2 control-label">Company Address </label>
			<?php echo $this->Form->control('address',['class'=>'form-control','placeholder'=>'Company address']);?>
			</div>
			<div class="form-group"><label class="col-sm-2 control-label">Company Logo </label>
			<?php echo $this->Form->control('profile_image',['class'=>'form-control','type'=>'file','accept'=>"image/gif, image/jpeg, image/jpg, image/png"]);?>
			<?php if($Auth->user('profile_image')){?>
					<div class="col-sm-3">
					<img src="<?php echo $this->request->getAttribute("webroot"); ?>img/company-logo/small/<?php echo $Auth->user('profile_image');?>" alt="user" class="">
					<button type="button" class="btn btn-danger" onclick="delete_img();"><i class="fa  fa-trash-o"></i></button>
					</div>
			<?php }?>
			</div>
			<div class="form-group">
			<div class="col-sm-3 col-sm-offset-2">
			<?= $this->Form->button(__('Submit'),array('id'=>'submitBtn','class'=>'btn btn-success btn-block','type'=>'submit')) ?>
			</div>
			
			</div>
			<div id="msg"></div>
		 </div>
		</div>
		
	</div><!-- profile-header -->
</div>
</div>
<link href="<?php echo $this->request->getAttribute("webroot"); ?>css/bootstrap-editable.css" rel="stylesheet">
<script src="<?php echo $this->request->getAttribute("webroot"); ?>js/bootstrap-editable.min.js"></script>
<script>
var $btn;
function savedata(){
	var form=$('#user_form')[0];
	var formData = new FormData(form);
	$.ajax({
				method:'POST',
				url:'<?php echo $this->request->webroot; ?>admin/users/update',
				dataType: "JSON",
				data: formData,
				processData: false,
				contentType: false,
				cache: false,
				beforeSend:function(){
					$btn = $('#submitBtn').button('loading');
					$('.error-message').remove();
				},
				success:function(res){
					$btn.button('reset');
					if(res.status=='success'){
						$('#msg').html(res.msg);
						window.location.reload();
					}
					if(res.status=='error'){
						$('#msg').html('<span class="error">'+res.msg+'</span>');
					}
				}
			});
}

function delete_img(){
	var formData='';
	$.ajax({
				method:'POST',
				url:'<?php echo $this->request->webroot; ?>admin/users/delete-image',
				dataType: "JSON",
				data: {'_csrfToken':'<?php echo $this->request->getParam('_csrfToken');?>'},
				beforeSend:function(){
					//$btn = $('#submitBtn').button('loading');
					$('.error-message').remove();
				},
				success:function(res){
					///$btn.button('reset');
					if(res.status=='success'){
						window.location.reload();
					}
					if(res.status=='error'){
						$('#msg').html('<span class="error">'+res.msg+'</span>');
					}
				}
			});
}
</script>