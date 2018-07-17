<?php //extract($pageVar); 
$storeData=$store->toArray();
?>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
		  <div class="panel-btns">
			<a href="" class="panel-close">×</a>
			<a href="" class="minimize">−</a>
		  </div><!-- panel-btns -->
		  <h3 class="panel-title">View store details</h3>
		</div>
			 <div class="panel-body ">
         <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store ID : </label>
        <div class="col-sm-6">
          <?=$storeData['store_id']?>
       </div>
     </div>
       <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store Name : </label>
        <div class="col-sm-6">
          <?=$storeData['store_name']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store Address : </label>
        <div class="col-sm-6">
          <?=$storeData['store_address']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store Phone : </label>
        <div class="col-sm-6">
          <?=$storeData['store_phone']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store Email : </label>
        <div class="col-sm-6">
          <?=$storeData['store_email']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store City : </label>
        <div class="col-sm-6">
          <?=$storeData['city']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store State : </label>
        <div class="col-sm-6">
          <?=$storeData['state']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store Country : </label>
        <div class="col-sm-6">
          <?=$storeData['country']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store Latitude : </label>
        <div class="col-sm-6">
          <?=$storeData['latitude']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store Logitude : </label>
        <div class="col-sm-6">
          <?=$storeData['longitude']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Delivery Radius : </label>
        <div class="col-sm-6">
          <?=$storeData['delivery_radius']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store Notification Email : </label>
        <div class="col-sm-6">
          <?=$storeData['notification_email']?>
       </div>
     </div>
   <div class="form-group col-sm-6">
      <label class="col-sm-6 control-label">Status : </label>
      <div class="col-sm-6">
        <?= $storeData['status']?>
     </div>
    </div>
<?php if($storeData['store_times']){ ?>
 <div class="form-group col-sm-12">
<h3 >Store Open Time</h3>
</div>
<?php  foreach($storeData['store_times'] as $st){?>
<div class="form-group col-sm-12">
	<div class="form-group col-sm-4">
      <label class="col-sm-6 control-label"><?= $st['from_open_day']?></label>
      <div class="col-sm-6">
        <?= $st['from_open_time']?>
     </div>
	</div>
	<label class="col-sm-2 control-label">To</label>
	<div class="form-group col-sm-4">
      <label class="col-sm-6 control-label"><?= $st['to_open_day']?></label>
      <div class="col-sm-6">
        <?= $st['to_open_time']?>
     </div>
	</div>
</div>
<?php }} ?>
</div><!-- /.box-body -->
</div>
</div>
</div>
</section>