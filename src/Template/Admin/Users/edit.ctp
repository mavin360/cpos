<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?= $this->Form->create($user,['id'=>'AddUser','class'=>'form-horizontal form-bordered','onsubmit'=>'savedata();return false;','enctype' => 'multipart/form-data']);
		$this->Form->templates([
					'inputContainer' => '<div class="col-sm-6">{{content}}</div>',
					'label'=>false
				]);
	echo $this->Form->control('id');			
	?>
<div class="panel panel-default">
<div class="panel-body panel-body-nopadding">

		<div class="form-group"><label class="col-sm-2 control-label">Name</label>
		<?php echo $this->Form->control('name',['class'=>'form-control','required'=>'required']);?>
		</div>
		<div class="form-group"><label class="col-sm-2 control-label">Email</label>
        <?php echo $this->Form->control('email',['class'=>'form-control','required'=>'required']); ?>
		</div>
		 <div class="form-group"><label class="col-sm-2 control-label">Phone</label>
         <?php echo $this->Form->control('phone',['class'=>'form-control']);?>
		 </div>
		<div class="form-group"><label class="col-sm-2 control-label">Password</label>
         <?php echo $this->Form->control('password',['class'=>'form-control','required'=>'required','value'=>'']);?>
         </div>
		<div class="form-group"><label class="col-sm-2 control-label">Assign To</label>
			<?php echo $this->Form->control('store_id',['options' => $stores,'class'=>'form-control','empty'=>'All Locations']);?>
		</div>
		<div class="form-group"><label class="col-sm-2 control-label">User Role</label>
			<?php echo $this->Form->control('role_id',['options' => $allRoles,'class'=>'form-control','empty'=>'Select Role']);?>
		</div>
		
		<div class="form-group"><label class="col-sm-2 control-label">User Image</label>
			<?php echo $this->Form->control('profile_image',['type' =>'file','class'=>'form-control']);?>
		</div>
</div>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       <button id="save" class="btn btn-primary" type="submit" >Save</button>
</div>
 <?= $this->Form->end() ?>
 
<script>
var $btn;
function savedata(){
	var form=$('#AddUser')[0];
	var formData = new FormData(form);
	$.ajax({
				method:'POST',
				url:'<?php echo $this->request->webroot; ?>admin/users/saveEdit',
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
					if(res.status=='emailerror'){
						$('#email').after('<span class="error-message">'+res.msg+'</span>');
					}
				}
			});
}

</script>