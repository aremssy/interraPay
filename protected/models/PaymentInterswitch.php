<?php

/**
 * This is the model class for table "ins_account_payment_interswitch".
 *
 * The followings are the available columns in table 'ins_account_payment_interswitch':
 * @property integer $payment_id
 * @property string $transaction_id
 * @property string $response_code
 * @property string $response_description
 * @property string $transaction_date
 */
class PaymentInterswitch extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ins_account_payment_interswitch';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('transaction_id', 'required'),
			array('transaction_id', 'length', 'max'=>100),
			array('response_code', 'length', 'max'=>3),
			array('response_description', 'length', 'max'=>200),
			array('transaction_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('payment_id, transaction_id, response_code, response_description, transaction_date', 'safe', 'on'=>'search'),
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
			'payment_id' => 'Payment',
			'transaction_id' => 'Transaction',
			'response_code' => 'Response Code',
			'response_description' => 'Response Description',
			'transaction_date' => 'Transaction Date',
			'cust_name'=>'Customer Name',
			'amount'=>'Amount',
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

		$criteria->compare('payment_id',$this->payment_id);
		$criteria->compare('transaction_id',$this->transaction_id,true);
		$criteria->compare('response_code',$this->response_code,true);
		$criteria->compare('response_description',$this->response_description,true);
		$criteria->compare('transaction_date',$this->transaction_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PaymentInterswitch the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

/**
         * @param $transaction_id
         * @return PaymentInterswitch
         */
        public static function getTransaction($transaction_id)
        {
            $paymentInterswitch = PaymentInterswitch::model()->findByAttributes(array(
                'transaction_id' => $transaction_id
            ));
            return $paymentInterswitch;
        }

        }