<?php
/* @var $this PaymentDetailsController */
/* @var $model PaymentDetails */

$this->breadcrumbs=array(
	'Payment Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PaymentDetails', 'url'=>array('index')),
	array('label'=>'Manage PaymentDetails', 'url'=>array('admin')),
);
?>

<h1>Create PaymentDetails</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>