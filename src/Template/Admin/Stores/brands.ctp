<?php ?>


<section class="content">
		<div class="panel panel-default">
		<div class="panel-heading">
		  <h3 class="panel-title">List of Brands/Revenue Centers
		  <?php echo $this->Html->link(__('Add New Brand', true), array('action' => 'add-brand'),array('class'=>'btn btn-primary pull-right','onclick'=>'addBrand();return false;')); ?>
		  </h3>
		</div>
	<div class="panel-body table-responsive">
			<?php if(!empty($Brands)){?>
			<table class="table table-danger">
			<thead>
				<tr>
				<th>#</th>
				<th><?php echo $this->Paginator->sort('logo');?></th>
				<th><?php echo $this->Paginator->sort('name');?></th>
				
				<th><?php echo $this->Paginator->sort('','Stores');?></th>
				<th><?php echo __('Actions');?></th></tr>
			</thead>
			<tbody>			
				<?php
				$i=0;
				foreach ($Brands as $brand): $i++;
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td>
					<?php if($brand['logo']){ ?>
					<img src="<?php echo $this->request->getAttribute("webroot").'img/brand-images/original/'.$brand['logo']; ?>" style="width: 50px; height: 50px;">
					<?php	} ?>
					</td>
					<td><?php echo $brand['name']; ?></td>
					<td><?php //echo wordwrap($brand['description'],20,"</br>"); 
					if($brand){
						foreach($brand['stores'] as $bd){
							echo '<span class="badge">'.$bd->store_name.'</span>&nbsp;&nbsp;';
						}
					}
					?></td>
					<td>
					<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit-brand', $brand['id']),array('class'=>'btn btn-sm btn-primary','onclick'=>"editBrand(".$brand['id']."); return false;")); ?>
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

<div class="modal fade" id="add_popup" tabindex="-1" role="dialog">
  <div class="modal-dialog  modal-lg" role="document">
    <div  class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		 <h4 class="modal-title"></h4>
	</div>
	<div id="cont" class="modal-body"></div>
     </div>
  </div>
</div>
<script>
function addBrand()
{
	$.get('<?php echo $this->request->webroot;?>admin/stores/add-brand',function(data){
			  $('#add_popup').find('#cont').html(data);
			   $('#add_popup').find('.modal-title').html('Add Brand');
			 $('#add_popup').modal('show');
			 // $('#comment_popup').modal('handleUpdate');
	});
}

function editBrand(id)
{
	$.get('<?php echo $this->request->webroot;?>admin/stores/edit-brand/'+id,function(data){
			  $('#add_popup').find('#cont').html(data);
			  $('#add_popup').find('.modal-title').html('Edit Brand');
			 $('#add_popup').modal('show');
			 // $('#comment_popup').modal('handleUpdate');
	});
}
</script>
