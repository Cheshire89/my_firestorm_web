<?php 
	require '../sdk-php-master/vendor/autoload.php';
	require_once 'config.php';
	require_once 'class.db.php';
	require_once 'class.sendEmail.php';
	require_once 'class.PHPMailer.php';
	require_once 'class.SMTP.php';
	require_once 'get-customer-profile.php';

	use net\authorize\api\contract\v1 as AnetAPI;
	use net\authorize\api\controller as AnetController;
	if(isset($_POST["payProf"]) && $_POST["payProf"]!='' &&
	   isset($_POST["payRepeat"]) && $_POST["payRepeat"]!='' &&
	   isset($_POST["payRepeat"]) && $_POST["payRepeat"]!=''
		){

	    $db = db::instance();

		$paymentID =  $db->real_escape_string($_POST["payProf"]);
		$repeating =  $db->real_escape_string($_POST["payRepeat"]);
		$customerID = $db->real_escape_string($_POST["custProf"]);

		$userID = $_SESSION["userID"];

		$customerProfile = getCustomerProfile($customerID);
		$paymentProfiles = $customerProfile->getPaymentProfiles();
			foreach ($paymentProfiles as $payProfile){
				if($payProfile->getCustomerPaymentProfileId() == $paymentID){
					$lastFour = $payProfile->getPayment()->getCreditCard()->getCardNumber();
				}
			}
		$name = $customerProfile->getDescription();
		$lName = substr($name, strpos($name, ' ')+1);
		$fName = substr($name, 0, strpos($name, ' '));
		$email = $customerProfile->getEmail();

		$perYear = perYear($repeating);
		$amount = billingAmount($repeating);
		$freq = subscription($repeating);


		$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
		$merchantAuthentication->setName("52AhDT3mdw");
		$merchantAuthentication->setTransactionKey("353YcjRx76vq8Ty6");

		$refId = 'ref' . time();

		// Subscription Type Info
		$subscription = new AnetAPI\ARBSubscriptionType();
		$subscription->setName("myFIrestorm Subscription");

		$interval = new AnetAPI\PaymentScheduleType\IntervalAType();
		$interval->setLength($perYear);
		$interval->setUnit('months');

		$paymentSchedule = new AnetAPI\PaymentScheduleType();
		$paymentSchedule->setInterval($interval);
		$today = date("Y-m-d");
		$paymentSchedule->setStartDate(new DateTime($today));
		$paymentSchedule->setTotalOccurrences(99);
		$paymentSchedule->setTrialOccurrences("0");

		$subscription->setPaymentSchedule($paymentSchedule);
		$subscription->setAmount($amount);
		$subscription->setTrialAmount("0.00");

		$profile = new AnetAPI\CustomerProfileIdType();
		$profile->setCustomerProfileId($customerID);
		$profile->setCustomerPaymentProfileId($paymentID);
		//$profile->setCustomerAddressId($customerAddressId);

		$subscription->setProfile($profile);

		$request = new AnetAPI\ARBCreateSubscriptionRequest();
		$request->setmerchantAuthentication($merchantAuthentication);
		$request->setRefId($refId);
		$request->setSubscription($subscription);
		$controller = new AnetController\ARBCreateSubscriptionController($request);

		$response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);

		if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") )
		{
			$subID = $response->getSubscriptionId();
		    
		    	$updatePayment = "INSERT INTO payment (userID, anetProfileType, anetProfileID, anetPaymentID, paymentFrequency, lastFour, price, fName, lName) VALUES('$userID','Subscription', '$customerID', '$subID', '$freq', '$lastFour','$amount', '$fName', '$lName')";
                $addPayment = $db->query($updatePayment);
                
                $updatePaymentMethods = "UPDATE paymentMethods SET mainPayment='1', userID='$userID' WHERE paymentProfileID = '$paymentID'";
                $addPaymentMethod = $db->query($updatePaymentMethods);


		    	$query = "UPDATE users SET subscriptionID = '$subID', userLevel = 'member', paymentStatus = '1' WHERE userID = '$userID'";
                

		    	$_SESSION["userLevel"] = 'member';

		    $addUser = $db->query($query);
		   	
		   	header('Location: ../member_admin/');
			exit();
		 }
		else
		{	
		    $errorMessages = $response->getMessages()->getMessage();
			$errCode = $errorMessages[0]->getCode();
			$errMsg = $errorMessages[0]->getText();
			

			$query = "INSERT INTO payment (lastFour, email, fName, lName, price, anetPaymentID, paymentFrequency, userID, anetProfileID, anetProfileType, anetErrCode, anetErrMsg) VALUES('$lastFour','$email','$fName','$lName','$amount','$paymentID','$freq','$userID','$customerID', 'Error', '$errCode', \" $errMsg \")";

			header('Location: ../membership-dues.php?subscription=error');
			exit();
		}

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