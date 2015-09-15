<?php
/* @var $this PaymentDetailsController */
/* @var $model PaymentDetails */

$this->breadcrumbs=array(
	'Payment Details'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PaymentDetails', 'url'=>array('index')),
	array('label'=>'Create PaymentDetails', 'url'=>array('create')),
	array('label'=>'Update PaymentDetails', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PaymentDetails', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PaymentDetails', 'url'=>array('admin')),
);
?>

<h1>View PaymentDetails #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'txn_ref',
		'product_id',
		'pay_item_id',
		'amount',
		'cust_id',
		'cust_name',
		'status_id',
	),
)); ?>
