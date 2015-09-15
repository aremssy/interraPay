<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public $interswitch_webpay_url = '';
	public $interswitch_redirect_url = '';
	public $interswitch_currency_code = '';
	public $interswitch_product_id = '';
	public $interswitch_pay_item_id = '';
	public $interswitch_mac_key = '';
	public $interswitch_convenience_fee = '';
	public $interswitch_transaction_response_url = '';
	public $amount_paid = '';
	public $amount_total = '';
	public $amount_paid_session = '';
    		public function init(){
              
            $this->interswitch_webpay_url = Yii::app()->params['interswitch_webpay_url'];
            $this->interswitch_redirect_url =Yii::app()->params['interswitch_redirect_url'] ;
            $this->interswitch_currency_code =Yii::app()->params['interswitch_currency_code'];
            $this->interswitch_product_id = Yii::app()->params['interswitch_product_id'];
            $this->interswitch_pay_item_id = Yii::app()->params['interswitch_pay_item_id'];
            $this->interswitch_mac_key = Yii::app()->params['interswitch_mac_key'];
            $this->interswitch_convenience_fee = Yii::app()->params['interswitch_convenience_fee'];
            $this->interswitch_transaction_response_url = Yii::app()->params['interswitch_transaction_response_url'];
            $this->amount_paid = Yii::app()->params["amount_paid"]=2000;
           	$this->amount_total =  Yii::app()->params["amount"];
          	$this->amount_paid_session =    Yii::app()->session['amount_paid'];
            }


}