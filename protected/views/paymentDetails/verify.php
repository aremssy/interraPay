<?php $this->pageTitle=Yii::app()->name;

$this->pageTitle=Yii::app()->name . ' - Interswitch';
$this->breadcrumbs=array(
	'Verify Payment',
);

	//	echo "Transaction ID: ".Yii::app()->session['transaction_id']."<br><br>";
	  //  echo "Total Amount: ".Yii::app()->session['total_amount']."<br><br>";
	//	echo CHtml::button('Proceed', array('onclick' => 'js:document.location.href="/inpay/index.php/Interswitch/Open"')); ?>
<?= $interswitch->reference_number.'<br/>';
echo hash("SHA512", Yii::app()->session['transaction_id'] . Yii::app()->params["interswitch_product_id"] . Yii::app()->params["interswitch_pay_item_id"] . Yii::app()->params["amount"] . Yii::app()->params["interswitch_redirect_url"] . Yii::app()->params["interswitch_mac_key"]);
      ?>
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
        
            <?= $form->labelEx($interswitch, 'customer_name',['class'=>'control-label col-xs-2',]); ?>
            <div class="col-xs-10">
                <?= $form->textField($interswitch, 'customer_name', array(
                    'class' => 'form-control','value'=>'Aremu Habibullahi O.',
                    'disabled' => true,
                )); ?>
            </div>
        
    </div>
    <div class="form-group">
       
            <?= $form->labelEx($interswitch, 'reference_number',['class'=>'control-label col-xs-2',]); ?>
            <div class="col-xs-10">
                <?= $form->textField($interswitch, 'reference_number', array(
                    'class' => 'form-control','value'=>Yii::app()->session['transaction_id'],
                    'disabled' => true,
                )); ?>
           
        </div>
    </div>
    <div class="form-group">
        
            <?= $form->labelEx($interswitch, 'amount_paid',['class'=>'control-label col-xs-2',]); ?>
            <?php //$amount_paid = explode(".", $interswitch->amount_paid); ?>
           <div class="col-xs-4">
            <div class="input-group">
                <span class="input-group-addon">&#8358;</span>
                <?= $form->textField($interswitch, 'amount_paid',  array(
                    'class' => 'form-control','value'=>Yii::app()->params['interswitch_convenience_fee'],
                    'disabled' => true,
                )); ?>
       
                <span class="input-group-addon">.00</span>
           
        </div>
    </div>
    </div>

    <div class="form-group">
       
            <?= CHtml::activeLabel($interswitch, 'convenience_fee',['class' => 'control-label col-xs-2',]); ?>
            <div class="col-xs-10">
                <?= $form->textField($interswitch, 'convenience_fee', array(
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
<?= CHtml::hiddenField('hash', $interswitch->getHash()); ?>
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


