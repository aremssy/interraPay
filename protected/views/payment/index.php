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
<?php //echo Yii::app()->session['transaction_id'];?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'transaction_id'); ?>
		<?php echo $form->textField($model,'transaction_id',array('size'=>50,'maxlength'=>50,'class' => 'form-control','Value'=>Yii::app()->session['transaction_id'])); ?>
		<?php echo $form->error($model,'transaction_id'); ?>
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
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50,'class' => 'form-control','Value'=>'oaremu@interranetworks.com')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
		<?= CHtml::hiddenField('status_id', '1'); ?>
		<?php echo $form->hiddenField($modelPay,'transaction_id',array('size'=>50,'maxlength'=>50,'class' => 'form-control','Value'=>Yii::app()->session['transaction_id'])); ?>
		<?php echo $form->hiddenField($model,'product_id',array('size'=>50,'maxlength'=>50,'class' => 'form-control','Value'=>'6205')); ?>
		<?php echo $form->hiddenField($model,'pay_item_id',array('size'=>50,'maxlength'=>50,'class' => 'form-control','Value'=>'101')); ?>
	
	
	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Pay with Interswitch' : 'Save',array('class'=>'btn btn-success')); ?>
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


