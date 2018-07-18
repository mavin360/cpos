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

<?php //pr($users); ?>

<div class="panel panel-default">
<div class="col-sm-12">
<div class="panel-heading col-sm-12">
<div class="panel-btns" >
   <?= $this->Html->link(__('Add User <i class="fa fa-plus"></i>'), ['action' => 'add'],['escape' => false,'class'=>'btn btn-primary','onclick'=>'addUser();return false;']) ?>
</div>		  
</div>
</div>

<?php echo $this->Flash->render(); ?>
<div class="table-responsive col-sm-9">
    <table class="table mb30 table-danger">
        <thead>
            <tr>
                 <th scope="col">#</th>
				<th scope="col"><?= $this->Paginator->sort('name','Name') ?></th>
				<th scope="col"><?= $this->Paginator->sort('email') ?></th>
				<th scope="col"><?= $this->Paginator->sort('role_id','User Role'); ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; foreach ($users as $user): ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= h($user->name) ?></td>
				<td><?= h($user->email) ?></td>
				<td><?php echo h($user->user_role->role_name); //pr($user); ?></td>
                <td>
				<?php if($user->status=='Active') {?>
				<div class="toggles toggle-success" data-toggle-on="true" data-toggle-height="20" data-toggle-width="60" data-id="<?= $user->id ?>"></div>
				<?php }else{?>
				<div class="toggles toggle-success" data-toggle-on="false" data-toggle-height="20" data-toggle-width="60" data-id="<?= $user->id ?>"></div>
				<?php }?>
				</td>
               
                <td class="actions">
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id],['escape' => false,'class'=>'btn btn-primary','onclick'=>'editUser('.$user->id.');return false;']) ?>
                    <?php //$this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
	<?php if($this->Paginator->counter('{{pages}}')>1){?>
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
	<?php }?>	
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>

<div class="col-sm-3">
<div class="panel-body panel-body-nopadding">
<div class="roles">
<?php if($allRoles){ ?>
<?= $this->Html->link(__('All'), ['action' => 'index'],['escape' => false,'class'=>'role-name']) ?>
<?php foreach($allRoles as $role){?>
<?= $this->Html->link(__($role->role_name), ['action' => 'index',$role->id],['escape' => false,'class'=>$role->id==$this->request->getParam('pass.0')?'role-name active':'role-name']) ?>
<?php }}?>
</div>
<div class="add-btn">
 <?= $this->Html->link(__('Add Role <i class="fa fa-plus"></i>'), ['action' => 'add-role'],['escape' => false,'class'=>'btn btn-primary','onclick'=>'addRole();return false;']) ?>
</div> 

</div>
</div>
</div>


<div class="modal fade" id="add_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog  modal-lg" role="document">
    <div  class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h4 class="modal-title"></h4>
	</div>
	<div id="cont" class="modal-body">
	
	</div>
     </div>
  </div>
</div>

<script>
function addRole(){
	$('#loader').removeClass('hide');
	$.get('<?php echo $this->request->getAttribute("webroot"); ?>admin/users/add-role',function(data){
			$('#loader').addClass('hide');
			 $('#add_popup #cont').html(data);
			 $('#add_popup').modal('show');
			 $('#add_popup').find('.modal-title').html('Add Role');
	});
}

function addUser(){
	$('#loader').removeClass('hide');
	$.get('<?php echo $this->request->getAttribute("webroot"); ?>admin/users/add',function(data){
			$('#loader').addClass('hide');
			 $('#add_popup #cont').html(data);
			 $('#add_popup').modal('show');
			 $('#add_popup').find('.modal-title').html('Add User');
	});
}
function editUser(id){
	$('#loader').removeClass('hide');
	$.get('<?php echo $this->request->getAttribute("webroot"); ?>admin/users/edit/'+id,function(data){
			 $('#loader').addClass('hide');
			 $('#add_popup #cont').html(data);
			 $('#add_popup').modal('show');
			 $('#add_popup').find('.modal-title').html('Edit Role');
	});
}
var crsf='<?php echo $this->request->getParam('_csrfToken'); ?>';
$('.toggles').each(function(ele){
	$(this).toggles({on:$(this).data('toggle-on')});
});
$('.toggles').on('toggle', function(e, active) {
	var elmId=$(this).data('id');
  if (active) {
    var status='Active';
  } else {
    var status='Inactive';
  }
  $.ajax({
	method:'POST',
	url:'<?php echo $this->request->getAttribute("webroot"); ?>admin/users/change-status',
	dataType: "JSON",
	data: {id:elmId,status:status,'_csrfToken':crsf},
	beforeSend:function(){
		$('#loader').removeClass('hide');
	},
	success:function(res){
		$('#loader').addClass('hide');
	}
  });
});
</script>