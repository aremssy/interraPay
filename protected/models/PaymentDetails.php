<?php

/**
 * This is the model class for table "payment_details".
 *
 * The followings are the available columns in table 'payment_details':
 * @property integer $id
 * @property string $transaction_id
 * @property string $product_id
 * @property string $pay_item_id
 * @property string $amount
 * @property string $cust_id
 * @property string $cust_name
 * @property integer $status_id
 */
class PaymentDetails extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'payment_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status_id', 'numerical', 'integerOnly'=>true),
			array('transaction_id, product_id, pay_item_id, amount, cust_id, cust_name','length', 'max'=>50),
			array('email', 'email'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, transaction_id, product_id, pay_item_id, amount, cust_id, cust_name, status_id',  'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'transaction_id' => 'Transaction Reference',
			'product_id' => 'Product',
			'pay_item_id' => 'Pay Item',
			'amount' => 'Amount',
			'cust_id' => 'Cust',
			'cust_name' => 'Customer Name',
			'status_id' => 'Status',
			 'email'	 => 'Email',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('transaction_id',$this->transaction_id,true);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('pay_item_id',$this->pay_item_id,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('cust_id',$this->cust_id,true);
		$criteria->compare('cust_name',$this->cust_name,true);
		$criteria->compare('status_id',$this->status_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PaymentDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	     /* @param $transaction_id
         * @return PaymentDetails
         */
        public static function getTransaction($transaction_id)
        {
            $paymentDetails = PaymentDetails::model()->findByAttributes(array(
                'transaction_id' => $transaction_id
            ));
            return $paymentDetails;
        }
}
