<?php
/* @var $this PaymentDetailsController */
/* @var $model PaymentDetails */

$this->breadcrumbs=array(
	'Payment Details'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PaymentDetails', 'url'=>array('index')),
	array('label'=>'Create PaymentDetails', 'url'=>array('create')),
	array('label'=>'View PaymentDetails', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PaymentDetails', 'url'=>array('admin')),
);
?>

<h1>Update PaymentDetails <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>