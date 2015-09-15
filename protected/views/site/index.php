<?php
/* @var $this SiteController */

//$this->pageTitle=Yii::app()->name;
?>

<div class="form-horizontal">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'payment-details-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'txn_ref'); ?>
		<?php echo $form->textField($model,'txn_ref',array('size'=>50,'maxlength'=>50,'class' => 'form-control','Value'=>Yii::app()->session['transaction_id'])); ?>
		<?php echo $form->error($model,'txn_ref'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($modelPay,'transaction_id'); ?>
		<?php echo $form->textField($modelPay,'transaction_id',array('size'=>50,'maxlength'=>50,'class' => 'form-control','Value'=>Yii::app()->session['transaction_id'])); ?>
		<?php echo $form->error($modelPay,'transaction_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'product_id'); ?>
		<?php echo $form->textField($model,'product_id',array('size'=>50,'maxlength'=>50,'class' => 'form-control','Value'=>'6205')); ?>
		<?php echo $form->error($model,'product_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'pay_item_id'); ?>
		<?php echo $form->textField($model,'pay_item_id',array('size'=>50,'maxlength'=>50,'class' => 'form-control','Value'=>'101')); ?>
		<?php echo $form->error($model,'pay_item_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount',array('size'=>50,'maxlength'=>50,'class' => 'form-control','Value'=>'2000')); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'cust_id'); ?>
		<?php echo $form->textField($model,'cust_id',array('size'=>50,'maxlength'=>50,'class' => 'form-control','Value'=>'123')); ?>
		<?php echo $form->error($model,'cust_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'cust_name'); ?>
		<?php echo $form->textField($model,'cust_name',array('size'=>50,'maxlength'=>50,'class' => 'form-control','Value'=>'Aremu Habibullahi')); ?>
		<?php echo $form->error($model,'cust_name'); ?>
	</div>

	<div class="form-group">
		<?php //echo $form->labelEx($model,'status_id'); ?>
		<?php //echo $form->textField($model,'status_id',array('size'=>50,'maxlength'=>50,'class' => 'form-control','Value'=>'1')); ?>
		<?= CHtml::hiddenField('status_id', '0'); ?>
		<?php //echo $form->error($model,'status_id'); ?>
	</div>

	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-success')); ?>
		<?php echo CHtml::button('Pay with Interswitch', array('onclick' => 'js:document.location.href="/inpay/index.php/Interswitch/Open"','class'=>'btn btn-success')); ?>

	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


