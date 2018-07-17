<?php ?>

<section class="content">
		<div class="panel panel-default">
			<div class="panel-heading">
		  <h3 class="panel-title">List of stores 
		  <?php echo $this->Html->link(__('Add New Store', true), array('action' => 'add'),array('class'=>'btn btn-primary pull-right')); ?>
		  </h3>
		</div>
	<div class="panel-body table-responsive">
			<?php if(!empty($Stores)){?>
			<table class="table table-danger">
			<thead>
				<tr><th><?php echo $this->Paginator->sort('store_id', 'Store ID');?></th><th><?php echo $this->Paginator->sort('store_name');?></th><th><?php echo $this->Paginator->sort('store_address');?></th><th><?php echo $this->Paginator->sort('store_phone');?></th><th><?php echo $this->Paginator->sort('store_email');?></th><th><?php echo $this->Paginator->sort('status');?></th><th><?php echo __('Actions');?></th></tr>
			</thead>
			<tbody>			
				<?php
				$i=0;
				foreach ($Stores as $Store): $i++;
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $Store['store_name']; ?></td>
					<td><?php echo wordwrap($Store['store_address'],20,"</br>"); ?></td>
					<td><?php echo $Store['store_phone']; ?></td>
					<td><?php echo $Store['store_email']; ?></td>
					<td><?php $Store['status']; ?>
						<?php if($Store['status']=='Active') {?>
				<div class="toggles toggle-success" data-toggle-on="true" data-toggle-height="20" data-toggle-width="60" data-id="<?= $Store['id']; ?>"></div>
				<?php }else{?>
				<div class="toggles toggle-success" data-toggle-on="false" data-toggle-height="20" data-toggle-width="60" data-id="<?= $Store['id']; ?>"></div>
				<?php }?>
					</td>
				
					<td >
						<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $Store['id']),array('class'=>'btn btn-sm btn-primary')); ?>
						<?php echo $this->Html->link(__('View', true), array('action' => 'view', $Store['id']),array('class'=>'btn btn-primary btn-sm')); ?>
					</td>
				</tr>
				<?php endforeach; ?>
				<tbody>
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
			<?php }else{ ?>
				<div class="alert alert-danger">Records not found.</div>
			<?php	} ?>
			</div>
		</div>
	
</section>
<script>
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
	url:'<?php echo $this->request->getAttribute("webroot"); ?>admin/stores/change-status',
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