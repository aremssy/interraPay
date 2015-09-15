<?php
    /**
     *
     * @var DefaultController $this
     * @var Interswitch $paymentInterswitch
     */
    $try_again = false;
    if ($paymentInterswitch->response_code == "00") {
        $css_class = "alert-info";
        $message   = "Your transaction was successful!";

    } else {
        $css_class = "alert-danger";
        $message   = "Your transaction was not successful!";
        $try_again = true;
        
     //   $payment = $paymentInterswitch->payment;
     //   $payment->approval_status = PaymentStatus::UNAPPROVED;
      //  $payment->save();
    }
?>
<br/>
<br/>
<br/>
<div class="alert <?php echo $css_class; ?>">
    <h1 style="margin-left: 0;"><?php echo $message; ?></h1>

    <p>An email has also being sent to <b><?php echo $to; ?></b></p>

    <p>Transaction Reference: <?php echo $paymentInterswitch->transaction_id; ?></p>
    <?php if ($try_again): ?>
        <p>Reason: <?php echo $paymentInterswitch->response_description; ?></p>
        <p>Please initiate this payment again.</p>
    <?php endif; ?>
</div>
<p><strong>You will now being redirected to your payment details.</strong></p>