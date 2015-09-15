<?php
/* @var $this PaymentDetailsController */
/* @var $data PaymentDetails */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('txn_ref')); ?>:</b>
	<?php echo CHtml::encode($data->txn_ref); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_id')); ?>:</b>
	<?php echo CHtml::encode($data->product_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pay_item_id')); ?>:</b>
	<?php echo CHtml::encode($data->pay_item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cust_id')); ?>:</b>
	<?php echo CHtml::encode($data->cust_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cust_name')); ?>:</b>
	<?php echo CHtml::encode($data->cust_name); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
	<?php echo CHtml::encode($data->status_id); ?>
	<br />

	*/ ?>

</div>