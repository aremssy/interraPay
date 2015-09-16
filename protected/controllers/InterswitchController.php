<?php

class InterswitchController extends Controller
{
	/**
	 * Declares class-based actions.
	 */				

  public function actionIndex()
  {
    // renders the view file 'protected/views/site/index.php'
    // using the default layout 'protected/views/layouts/main.php'
    unset(Yii::app()->session['transaction_id']);
     $interswitch = 'inpay'.'-' . strtotime("now");     
         if(Yii::app()->session['transaction_id'] == null ){
          Yii::app()->session['transaction_id']=$interswitch;
         }
    $this->redirect(array('/interswitch/open'));
  
  }

	public function actionOpen()
	{
    
      $model = $_POST['FormModel'];
  //print_r($model);die;
  
    $interswitch = $model['transaction_id'];
    $amount=  $model['amount'];
    $customer=  $model['cust_name'];
    Yii::app()->session["interswitch_redirect_url_complete"]  = 'http://localhost/website/index.php/site/complete';
    
         if(!empty(Yii::app()->session['transaction_id'])){
          unset(Yii::app()->session['transaction_id']);
          Yii::app()->session['transaction_id']=$interswitch;
        }else{
          Yii::app()->session['transaction_id']=$interswitch;
         }
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
    $modelPay=new PaymentInterswitch;

    if(isset(Yii::app()->session['transaction_id']))
    {
      $modelPay->amount=$amount;
       $modelPay->transaction_id=$interswitch;
        $modelPay->cust_name=$customer;
      if($modelPay->save())
        $this->redirect(array('/interswitch/verify'));
    }
	} 


  public function actionVerify()
        {
        if ( Yii::app()->session['transaction_id'] == null) {
                 throw new CHttpException(403, "Bad Request 1");
                 }
         $pymentDetails = PaymentInterswitch::getTransaction( Yii::app()->session['transaction_id']);
            if ($pymentDetails == null) {
                throw new CHttpException(403, "Bad Request 2");
        }
          $interswitch = Interswitch::getViewModel(Yii::app()->session['transaction_id'], $pymentDetails);
          $this->render("../payment/verify", array(
                'interswitch' => $interswitch
            ));
        }

  public function actionResponse()
        {
         // echo Yii::app()->session['transaction_id'];
         // die;
          if (Yii::app()->session['transaction_id'] == null ) {
                throw new CHttpException(403, "Bad Request 1");
            }
          $transaction_id = Yii::app()->session['transaction_id'];
            $interswitch    = PaymentInterswitch::getTransaction($transaction_id);
         if ($interswitch == null) {
                throw new CHttpException(403, "Bad Request 2");
            }
            
            $interswitchModel = Interswitch::getViewModel(Yii::app()->session['transaction_id'], $interswitch);

            if ($transaction_id == null) {
                throw new CHttpException(403, "Bad Request");
            }
		       $thash =  $interswitchModel->getSecurityHash();
  // $credentials = "mithun:mithun";
		 $parami = array(
        'productid'              => $interswitchModel->product_id,
         'transactionreference'  => $transaction_id,
         'amount'                 => $interswitchModel->amount
		); 

	   $client = http_build_query($parami) . "\n";
		
		//$url = "https://stageserv.interswitchng.com/test_paydirect/api/v1/gettransaction.xml?$client";// xml
		$url = "https://stageserv.interswitchng.com/test_paydirect/api/v1/gettransaction.json?$client"; // json
	  
    		//note the variables appended to the url as get values for these parameters
		$headers = array(
		"GET /HTTP/1.1",
		"User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1",
		//"Content-type:  multipart/form-data",
		//"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8", 
		"Accept-Language: en-us,en;q=0.5",
		//"Accept-Encoding: gzip,deflate",
		//"Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
		"Keep-Alive: 300",      
		"Connection: keep-alive",
		//"Hash:$thash",
		"Hash: $thash " );
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //curl_setopt($ch,CURLOPT_POSTFIELDS,$client);
     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
    curl_setopt( $ch, CURLOPT_POST, false );
    // dont use this on production enviroment
    //curl_setopt($ch, CURLOPT_USERAGENT, $defined_vars['HTTP_USER_AGENT']); 
  	
    $data = curl_exec($ch); 
    //var_dump($data);
            if (!empty($data)) {
                $paymentInterswitch  = PaymentInterswitch::getTransaction( Yii::app()->session['transaction_id']);
                $result              = CJSON::decode($data);
                //$interswitch->response_code        = $result["ResponseCode"];
                $paymentInterswitch->response_code        = $result["ResponseCode"];
                $paymentInterswitch->response_description = $result["ResponseDescription"];
                Yii::app()->session['session_ResponseDescription'] = $result["ResponseDescription"];
                Yii::app()->session['session_ResponseCode']  = $result["ResponseCode"];
                Yii::app()->session['session_customer']  = $paymentInterswitch->cust_name;

                 if ($paymentInterswitch->save()) {
                  echo 'URL'.  Yii::app()->session["interswitch_redirect_url_complete"];
                  $this->redirect(Yii::app()->session["interswitch_redirect_url_complete"]);
            
                  }
                }
                 else
              if (curl_errno($ch)) { 
               //print "Error: " . curl_error($ch);
                         throw new CHttpException(403, curl_error($ch));
              }
                           else {  
                       curl_close($ch);
                   throw new CHttpException(403, "Bad Request ");
                  }
          		}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}
	                    ?>