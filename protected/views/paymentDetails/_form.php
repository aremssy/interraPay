<?php
/* @var $this PaymentDetailsController */
/* @var $model PaymentDetails */
/* @var $form CActiveForm */
?>

<div class="form">

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

	<div class="row">
		<?php echo $form->labelEx($model,'txn_ref'); ?>
		<?php echo $form->textField($model,'txn_ref',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'txn_ref'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_id'); ?>
		<?php echo $form->textField($model,'product_id',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'product_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pay_item_id'); ?>
		<?php echo $form->textField($model,'pay_item_id',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'pay_item_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cust_id'); ?>
		<?php echo $form->textField($model,'cust_id',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cust_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cust_name'); ?>
		<?php echo $form->textField($model,'cust_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cust_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_id'); ?>
		<?php echo $form->textField($model,'status_id'); ?>
		<?php echo $form->error($model,'status_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


    <h4><strong>Please Verify Your Details</strong></h4>
    <p>Please verify your payment details, once you have confirmed that every information shown is correct, click on the
        "Proceed" button.</p>
    <p>If you don't want to continue with this transaction please click the "back" button to go back to the previous
        page</p>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id'          => 'interswitch-form',
    'action'      => Yii::app()->params["interswitch_webpay_url"],
    'htmlOptions' => array(
        'class' => 'form-horizontal',
    ),
)); ?>
    <div class="form-group">
        
            <?= $form->labelEx($model, 'customer_name',['class'=>'control-label col-xs-2',]); ?>
            <div class="col-xs-10">
                <?= $form->textField($model, 'customer_name', array(
                    'class' => 'form-control','value'=>'Aremu Habibullahi O.',
                    'disabled' => true,
                )); ?>
            </div>
        
    </div>
    <div class="form-group">
       
            <?= $form->labelEx($model, 'reference_number',['class'=>'control-label col-xs-2',]); ?>
            <div class="col-xs-10">
                <?= $form->textField($model, 'reference_number', array(
                    'class' => 'form-control','value'=>Yii::app()->session['transaction_id'],
                    'disabled' => true,
                )); ?>
           
        </div>
    </div>
    <div class="form-group">
        
            <?= $form->labelEx($model, 'amount_paid',['class'=>'control-label col-xs-2',]); ?>
            <?php //$amount_paid = explode(".", $interswitch->amount_paid); ?>
           <div class="col-xs-4">
            <div class="input-group">
                <span class="input-group-addon">&#8358;</span>
                <?= $form->textField($model, 'amount_paid',  array(
                    'class' => 'form-control','value'=>Yii::app()->params['interswitch_convenience_fee'],
                    'disabled' => true,
                )); ?>
       
                <span class="input-group-addon">.00</span>
           
        </div>
    </div>
    </div>

    <div class="form-group">
       
            <?= CHtml::activeLabel($model, 'convenience_fee',['class' => 'control-label col-xs-2',]); ?>
            <div class="col-xs-10">
                <?= $form->textField($model, 'convenience_fee', array(
                    'class' => 'form-control','value'=>Yii::app()->params['interswitch_convenience_fee'],
                    'disabled' => true,
                )); ?>
           
        </div>
    </div>
<?php $this->endWidget(); ?>

<?= CHtml::beginForm(Yii::app()->params["interswitch_webpay_url"], "POST", array(
    'class' => 'form-horizontal'
)) ?>
<?= CHtml::hiddenField('txn_ref', Yii::app()->session['transaction_id']); ?>
<?= CHtml::hiddenField('product_id', Yii::app()->params['interswitch_product_id']); ?>
<?= CHtml::hiddenField('pay_item_id', Yii::app()->params['interswitch_pay_item_id']); ?>
<?= CHtml::hiddenField('amount', Yii::app()->params['amount']); ?>
<?= CHtml::hiddenField('site_redirect_url', Yii::app()->params['interswitch_redirect_url']); ?>
<?= CHtml::hiddenField('currency', Yii::app()->params['interswitch_currency_code'] ); ?>
<?= CHtml::hiddenField('hash', $model->getHash()); ?>
<?= CHtml::hiddenField('cust_id', '148'); ?>
<?= CHtml::hiddenField('cust_name', 'Aremu Habibullahi O.'); ?>
    <div class="form-actions buttons">
        <div class="controls">
            <?= CHtml::link('Back', Yii::app()->request->urlReferrer, array(
                'class' => 'btn btn-info',
                'style' => 'margin-left: 130px;',
            )) ?>
            <?= CHtml::submitButton('Proceed', array(
                'class' => 'btn btn-warning',
                'style' => 'margin-left: 10px;',
                'id' => 'proceed',
            )) ?>
        </div>
    </div>
<?= CHtml::endForm(); ?>


