<?php $cnt=$this->request->getParam('controller');
		$action=$this->request->getParam('action');
?>

<section class="content">
 <ul class="nav nav-tabs" role="tablist">
 <li><a class="btn btn-primary" href="<?php echo $this->request->getAttribute("webroot"); ?>admin/setup"><i class="fa fa-arrow-left"></i>Back</a></li>
					<li class="<?php echo (strtolower($cnt)=='stores' && $action=='index')?'active':'';?>"><a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/stores">Stores</a></li>
					  <li class="<?php echo (strtolower($cnt)=='stores' && $action=='brands')?'active':'';?>"><a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/stores/brands">Brands/Revenue Centers</a></li>
					  <li class="<?php echo (strtolower($cnt)=='stores' && $action=='orderTypes')?'active':'';?>"><a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/stores/order-types">Order Types</a></li>
	  </ul>
		<div class="panel panel-default">
			<div class="panel-heading">
		  <h3 class="panel-title">Order Types
		  <?php echo $this->Html->link(__('Add Order Type', true), array('action' => 'add-brand'),array('class'=>'btn btn-primary pull-right','onclick'=>'addOrdTyp();return false;')); ?>
		  </h3>
		</div>
	<div class="panel-body table-responsive">
			<?php if(!empty($StoresOrderTypes)){ ?>
			<table class="table table-danger">
			<thead>
				<tr>
				<th>#</th>
				<th><?php echo $this->Paginator->sort('name');?></th>
				<th><?php echo $this->Paginator->sort('Type');?></th>
				<th><?php echo $this->Paginator->sort('Stores');?></th>
				<th><?php echo $this->Paginator->sort('Status');?></th>
				<th><?php echo __('Actions');?></th></tr>
			</thead>
			<tbody>			
				<?php
				$i=0;
				foreach ($StoresOrderTypes as $strOrdTyp): $i++;
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $strOrdTyp['name']; ?></td>
					<td>
					<?php echo ucfirst(str_replace('_',' ',$strOrdTyp['order_type'])); ?>
					</td>
					
					<td><?php //echo wordwrap($brand['description'],20,"</br>"); 
					if($strOrdTyp['stores']){
						foreach($strOrdTyp['stores'] as $bd){
							echo '<span class="badge">'.$bd->store_name.'</span>&nbsp;&nbsp;';
						}
					}
					?></td>
					
					<td><?php $strOrdTyp['status']; ?>
						<?php if($strOrdTyp['status']=='Active') {?>
				<div class="toggles toggle-success" data-toggle-on="true" data-toggle-height="20" data-toggle-width="60" data-id="<?= $strOrdTyp['id']; ?>"></div>
				<?php }else{?>
				<div class="toggles toggle-success" data-toggle-on="false" data-toggle-height="20" data-toggle-width="60" data-id="<?= $strOrdTyp['id']; ?>"></div>
				<?php }?></td>
					<td>
					<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit-order-type', $strOrdTyp['id']),array('class'=>'btn btn-sm btn-primary','onclick'=>"editOrdTyp(".$strOrdTyp['id']."); return false;")); ?>
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
function addOrdTyp()
{
	$('#loader').removeClass('hide');
	$.get('<?php echo $this->request->getAttribute("webroot"); ?>admin/stores/add-order-type',function(data){
			$('#loader').addClass('hide');
			$('#add_popup').find('#cont').html(data);
			 $('#add_popup').modal('show');
			 $('#add_popup').find('.modal-title').html('Add Order Type');
	});
}

function editOrdTyp(id)
{
	$('#loader').removeClass('hide');
	$.get('<?php echo $this->request->getAttribute("webroot"); ?>admin/stores/edit-order-type/'+id,function(data){
		$('#loader').addClass('hide');
			  $('#add_popup').find('#cont').html(data);
			 $('#add_popup').modal('show');
			 $('#add_popup').find('.modal-title').html('Edit Order Type');
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
	url:'<?php echo $this->request->getAttribute("webroot"); ?>admin/stores/change-type-status',
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
