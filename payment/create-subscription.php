<?php
  require '../sdk-php-master/vendor/autoload.php';
  require_once 'config.php';
  require_once 'class.db.php';
  require_once 'class.sendEmail.php';
  require_once 'class.PHPMailer.php';
  require_once 'class.SMTP.php';
   

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;


$userID = $_SESSION["userID"];

$db = db::instance();
$user = createUserData($_POST);
$refId = 'ref'.time();

$numOfPayments = subscriptionLength($user["subscripInterval"], $user["CCyear"], $user["CCmonth"]);
    
    $perYear = perYear($user["subscripInterval"]);
    $amount = billingAmount($user["subscripInterval"]);

    if(is_numeric($numOfPayments)){



$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
$merchantAuthentication->setName("52AhDT3mdw");
$merchantAuthentication->setTransactionKey("353YcjRx76vq8Ty6");


    // Subscription Type Info
    $subscription = new AnetAPI\ARBSubscriptionType();
    $subscription->setName("myFIrestorm Subscription");

    //set subscription lenghts
    $interval = new AnetAPI\PaymentScheduleType\IntervalAType();
    $interval->setLength($perYear);
    $interval->setUnit('months');

    //set start date
    $paymentSchedule = new AnetAPI\PaymentScheduleType();
    $paymentSchedule->setInterval($interval);
    $today = date("Y-m-d");
    $paymentSchedule->setStartDate(new DateTime($today));
    $paymentSchedule->setTotalOccurrences($numOfPayments);
    $paymentSchedule->setTrialOccurrences("0");

    //set schedule for charge

    $subscription->setPaymentSchedule($paymentSchedule);
    $subscription->setAmount($amount);
    $subscription->setTrialAmount("0.00");
    
    //add credit card - this is incomplete
    $creditCard = new AnetAPI\CreditCardType();
    $creditCard->setCardNumber($user["CCnum"]);
    $creditCard->setExpirationDate($user["CCyear"].'-'.$user["CCmonth"]);

    $payment = new AnetAPI\PaymentType();
    $payment->setCreditCard($creditCard);
    $subscription->setPayment($payment);

    //add order info, the invoice number would be a number we need to generate
    $order = new AnetAPI\OrderType();
    $order->setInvoiceNumber(date('U'));        
    $order->setDescription("Firestorm Subscription"); 
    $subscription->setOrder($order); 
    
    //set bill to information - this is incomplete
    $billTo = new AnetAPI\NameAndAddressType();
    $billTo->setFirstName($user["fName"]);
    $billTo->setLastName($user["lName"]);
    $billTo->setAddress($user["CCaddress"]);
    $billTo->setCity($user["CCcity"]);
    $billTo->setState($user["CCstate"]);
    $billTo->setZip($user["CCzip"]);

    $subscription->setBillTo($billTo);

    $request = new AnetAPI\ARBCreateSubscriptionRequest();
    $request->setmerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setSubscription($subscription);

    $controller = new AnetController\ARBCreateSubscriptionController($request);
    $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);


    
    if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") )
    {
        $subID = $response->getSubscriptionId();
        $customerID = $user["customerID"];
        $paymentID = $response->getProfile()->getCustomerPaymentProfileId();
        $lastFour = 'XXXX'.substr($user["CCnum"], -4);
        $cardType = ucwords($user["CCtype"]);
        if($cardType == 'Mastercard'){
            $cardType = 'MasterCard';
        }
        
        $freq = subscription($user["subscripInterval"]);
        $lastFour = 'XXXX'.substr($user["CCnum"], -4);
        $fName = $user["fName"];
        $lName = $user["lName"];

        $query = "UPDATE users SET paymentStatus=1, subscriptionID='$subID', userLevel='member' WHERE userID='$userID'";

        
        $db->query($query);

        $query = "INSERT INTO payment (userID, anetProfileType, anetProfileID, anetPaymentID, paymentFrequency, lastFour, price, fName, lName) VALUES('$userID','Subscription', '$customerID', '$subID', '$freq', '$lastFour','$amount', '$fName', '$lName')";


        $addPayment = $db->query($query);

        $query = "INSERT INTO paymentMethods (mainPayment, customerID, paymentProfileID, cardNum, cardType, userID) VALUES('1','$customerID', '$paymentID', '$lastFour', '$cardType','$userID')";

        $_SESSION["userLevel"] = 'member';
        $addPaymentMethod = $db->query($query);

        $email = new sendEmail();
        $email->subscription_paid($userID);

        header('Location: ../thank-you.php?subscription=paid&user='.$userID);
        exit();
     }
    else
    {   
        $customerID = $user["customerID"];
        echo "ERROR :  Subscription";
        $errorMessages = $response->getMessages()->getMessage();
        $errCode = $errorMessages[0]->getCode();
        $errMsg = $errorMessages[0]->getText();
            $query = "INSERT INTO payment (anetProfileID, anetProfileType, anetErrCode, anetErrMsg) VALUES('$customerID', 'Error', '$errCode', \" $errMsg \")";

            print($query);
        exit();

            $addTransaction =$db->query($query);
        //save the error response here
        // header('Location: ../membership-dues.php?error=payment');
        // exit();
    }
}else{
   print('Error - Num of Payments');
}

function createUserData($post){
    $db = db::instance();

    $user = array();
        $user["CCName"] = $db->real_escape_string($post["payName"]);
            $user["fName"] = trim(substr($user["CCName"], 0, $sep+1));
            $user["lName"] = trim(substr($user["CCName"], $sep));
        $user["CCnum"] = $db->real_escape_string($post["payCCNum"]);
        $user["CCtype"] = $db->real_escape_string($post["payCardType"]);
        

        $user["CCmonth"] = $db->real_escape_string($post["payCardMonth"]);
        $user["CCyear"] = $db->real_escape_string($post["payCardYear"]);
        $user["CCcode"] = $db->real_escape_string($post["payCSC"]);

        $user["CCadd1"] = $db->real_escape_string($post["payAdd1"]);
        $user["CCadd2"] = $db->real_escape_string($post["payAdd2"]);
        $user["CCstate"] = $db->real_escape_string($post["payState"]);
        $user["CCcity"] = $db->real_escape_string($post["payCity"]);
        $user["CCzip"] = $db->real_escape_string($post["payZip"]);

        $user["userID"] = $db->real_escape_string($post["userID"]);
        $user["customerID"] = $db->real_escape_string($post["customerID"]);
        $user["subscripInterval"] = $db->real_escape_string($post["subscripInterval"]);
    
    if(isset($post["payAdd2"]) && $post["payAdd2"] != ''){
        $user["CCaddress"] = $user["CCadd1"].' '.$user["CCadd2"];
    }else{
        $user["CCaddress"] = $user["CCadd1"];
    }
    return $user;
}

function subscriptionLength($subInt, $expYear, $expMonth){
    $curMonth = date('m');
    $curYear = date('Y');
    switch ($subInt) {
        case 'month':
            $perYear = 12;
            if($expMonth > $curMonth){
                $extraMonths = $expMonth - $curMonth;
            }
            $numOfPayments = (($expYear - $curYear) * $perYear) + $extraMonths;
            break;
        case 'quater':
            $perYear = 3;
            if($expMonth > $curMonth){
                $extraMonths = floor(($expMonth - $curMonth) / $perYear);
            }
            $numOfPayments = (($expYear - $curYear) * $perYear) + $extraMonths;
            break;
        case 'annual':
            $perYear = 1;
            $numOfPayments = ($expYear - $curYear) * 12;
            break;
        default:
            $numOfPayments = 'Error';
            break;
    }
    return $numOfPayments;
}

function perYear($setInt){
    switch ($setInt) {
        case 'month':
            return 12;
            break;
        case 'quater':
            return 3;
            break;
        case 'annual':
            return 1;
            break;
    }
}

function billingAmount($setInt){
    switch ($setInt) {
        case 'month':
            return 65;
            break;
        case 'quater':
            return 180;
            break;
        case 'annual':
            return 650;
            break;
    }
}

function subscription($subscript){
    switch ($subscript) {
        case 'month':
            $freq = 'Monthly';
            break;
        case 'quater':
            $freq = 'Quaterly';
            break;
        case 'annual':
            $freq = 'Annually';
            break;
    }
    return $freq;
}
  

?>
