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
 <?= $this->Form->create($userRole,['id'=>'AddRole','class'=>'form-horizontal form-bordered','onsubmit'=>'savedata();return false;']);
		$this->Form->templates([
					'inputContainer' => '<div class="col-sm-9">{{content}}</div>',
					'label'=>false
				]);
	?>
<div class="panel panel-default">
<div class="panel-body panel-body-nopadding">
	<div class="col-sm-6">
		<div class="form-group"><label class="col-sm-3 control-label">Role Name</label><?php echo $this->Form->control('role_name',['class'=>'form-control','required'=>'required']);?></div>
		<div class="form-group"><label class="col-sm-3 control-label">Role Description</label><?php echo $this->Form->control('role_description',['class'=>'form-control','type'=>'textarea']);?></div>
		
	</div>


</div>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       <button id="save" class="btn btn-primary" type="submit" >Save</button>
</div>
	<?= $this->Form->end() ?>
<script>
$(function(){
	$('.module-list li h5').on('click',function(){
			if($(this).next('.module-child').is(':visible')){
				$('.module-child').slideUp();
			}else{
				$('.module-child').slideUp();
				$(this).next('.module-child').slideDown();
			}
	});
});

var $btn;
function savedata(){
	var form=$('#AddRole')[0];
	var formData = new FormData(form);
	$.ajax({
				method:'POST',
				url:'<?php echo $this->request->webroot; ?>admin/users/save-role',
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
						window.location.href='<?php echo $this->request->webroot; ?>admin/users';
					}
					if(res.status=='error'){
						$('#msg').html('<span class="error-message">'+res.msg+'</span>');
					}
				}
			});
}

</script>