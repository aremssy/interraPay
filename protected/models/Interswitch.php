 <?php
 class Interswitch extends CFormModel
    {
        public $customer_name;
        public $reference_number;
        public $amount_paid;
        public $convenience_fee;
        //public $txn_ref;
        public $product_id;
        public $pay_item_id;
        public $amount;
        public $site_redirect_url;
        public $currency;
        public $macKey;
        public $cust_id;

        public function attributeLabels()
        {
            return array(
               'customer_name'    => 'Customer Name',
                'reference_number' => 'Reference Number',
               'convenience_fee'  => 'Convenience Fee',
               'amount_paid'      => 'Amount Paid',
            );
        }

        public function getHash()
        {
        // return $this->product_id;
           return hash("SHA512", $this->reference_number.$this->product_id.$this->pay_item_id.$this->amount.$this->site_redirect_url.$this->macKey);
        }

        public function getSecurityHash()
        {
            return hash("SHA512", $this->product_id.$this->reference_number.$this->macKey);
        }

        /**
         * @param $transaction_id int
         * @param $interswitch Interswitch
         * @return InterswitchViewModel
         */
       /* public static function getViewModel($transaction_id)
        {
            $interswitch                   = new Interswitch;
 			$interswitch->reference_number = Yii::app()->session['transaction_id'];
            $interswitch->product_id = Yii::app()->params["interswitch_product_id"];
            $interswitch->pay_item_id = Yii::app()->params["interswitch_pay_item_id"];
            $interswitch->convenience_fee    = Yii::app()->params["interswitch_convenience_fee"];
            $interswitch->amount           = (2000 + Yii::app()->params["interswitch_convenience_fee"]) * 100;
            $interswitch->site_redirect_url = Yii::app()->params["interswitch_redirect_url"];
            $interswitch->currency = Yii::app()->params["interswitch_currency_code"];
           // $interswitch->cust_id = $interswitch->payment->class_student->id;
          //  $interswitch->customer_name    = Student::getFullName($interswitch->payment->class_student->student->id, true);
            $interswitch->macKey    = Yii::app()->params["interswitch_mac_key"];
            $interswitch->amount_paid      = Yii::app()->params["total_amount"];
            
            return $interswitch;
        }*/

         /**
         * @param $transaction_id int
         * @return Interswitch
         */
        public static function getViewModel($transaction_id, $interswitch)
        {
            $interswitchModel                   = new Interswitch;

            $interswitchModel->reference_number = $transaction_id;
            $interswitchModel->product_id = Yii::app()->params["interswitch_product_id"];
            $interswitchModel->pay_item_id = Yii::app()->params["interswitch_pay_item_id"];
            $interswitchModel->convenience_fee    = Yii::app()->params["interswitch_convenience_fee"];
            $interswitchModel->amount           = ($interswitch->amount + $interswitchModel->convenience_fee) * 100;
            $interswitchModel->site_redirect_url = Yii::app()->params["interswitch_redirect_url"];
            $interswitchModel->currency = Yii::app()->params["interswitch_currency_code"];
           // $interswitchModel->cust_id = $interswitch->payment->class_student->id;
          //  $interswitchModel->customer_name    = Student::getFullName($interswitch->payment->class_student->student->id, true);
            
            $interswitchModel->macKey    = Yii::app()->params["interswitch_mac_key"];
            $interswitchModel->amount_paid      = $interswitch->amount;
            $interswitchModel->customer_name      = $interswitch->cust_name;
           // $interswitchModel->customer_id      = $interswitch->cust_id;
            
            return $interswitchModel;
        }
      

	  
    }