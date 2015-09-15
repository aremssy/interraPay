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
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
    $model=new PaymentDetails;
    $modelPay=new PaymentInterswitch;

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);
      $pymentDetails = PaymentDetails::getTransaction( Yii::app()->session['transaction_id']);
            if ($pymentDetails == null) {
    if(isset($_POST['PaymentDetails'],$_POST['PaymentInterswitch']))
    {
      $model->attributes=$_POST['PaymentDetails'];
      $modelPay->attributes=$_POST['PaymentInterswitch'];
      if($model->save())
        $modelPay->save();
        $this->redirect(array('/interswitch/verify'));
    }
        }
        else{
      $this->redirect(array('/interswitch/verify'));
    }
    $this->render('../payment/index',array(
      'model'=>$model,
      'modelPay'=>$modelPay,
    ));
         
	} 


  public function actionVerify()
        {
          //  echo  Yii::app()->session['transaction_id'].'<br>';
          //die;
        if ( Yii::app()->session['transaction_id'] == null) {
                 throw new CHttpException(403, "Bad Request 1");
                 }
         $pymentDetails = PaymentDetails::getTransaction( Yii::app()->session['transaction_id']);
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
            $interswitch    = PaymentDetails::getTransaction($transaction_id);
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
                $pymentDetails = PaymentDetails::getTransaction( Yii::app()->session['transaction_id']);
                $result              = CJSON::decode($data);
                //$interswitch->response_code        = $result["ResponseCode"];
                $paymentInterswitch->response_code        = $result["ResponseCode"];
                $paymentInterswitch->response_description = $result["ResponseDescription"];
                $pymentDetails->status_id                   = '1';
                echo  $paymentInterswitch->response_description;
                 if ($paymentInterswitch->save()) {
                  $pymentDetails->save();
                    $this->redirect(array('/interswitch/complete'));
            
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
  public function actionComplete()
        {
            if (Yii::app()->session['transaction_id'] == null) {
                throw new CHttpException(403, "Bad Request");
            }
            
            $paymentInterswitch = PaymentInterswitch::getTransaction( Yii::app()->session['transaction_id']);
            $paymentDetails = PaymentDetails::getTransaction( Yii::app()->session['transaction_id']);
            $to          = $paymentDetails->email;
            //$sent        = YumMailer::transactionNotificationMessage($interswitch->payment, $to);
            
            unset(Yii::app()->session['transaction_id']);
            
         //   $returnUri = $this->createUrl('/payment/default/detail', array('id' => $interswitch->payment->class_student_id));
         //   Yii::app()->clientScript->registerMetaTag("10;url={$returnUri}", null, 'refresh');
            $this->render("../payment/complete", array(
                'paymentInterswitch' => $paymentInterswitch,
               'to'          => $to
            ));
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