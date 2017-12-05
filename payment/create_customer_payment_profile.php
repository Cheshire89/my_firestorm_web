<?php
  require '../sdk-php-master/vendor/autoload.php';
  require_once 'config.php';
  require_once 'class.db.php';
  require_once 'class.sendEmail.php';
  require_once 'class.PHPMailer.php';
  require_once 'class.SMTP.php';

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

 
$db = db::instance();
$user = createUserData($_POST);

$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
$merchantAuthentication->setName("52AhDT3mdw");
$merchantAuthentication->setTransactionKey("353YcjRx76vq8Ty6");

$existingcustomerprofileid= $user["customerID"];
//$customerPaymentProfileId= "33211899"; this page creates this

$refId = 'ref' . time();
	  $creditCard = new AnetAPI\CreditCardType();
	  $creditCard->setCardNumber($user["CCnum"]);
	  $creditCard->setExpirationDate($user["CCyear"].'-'.$user["CCmonth"]);
	  $creditCard->setCardCode($user["CCcode"]);

	  $paymentCreditCard = new AnetAPI\PaymentType();
	  $paymentCreditCard->setCreditCard($creditCard);
	  // Create the Bill To info for new payment type

	  $billto = new AnetAPI\CustomerAddressType();
	  $billto->setFirstName($user["fName"]);
	  $billto->setLastName($user["lName"]);
	  // $billto->setCompany("My company");
	  $billto->setAddress($user["CCaddress"]);
	  $billto->setCity($user["CCcity"]);
	  $billto->setState($user["CCstate"]);
	  $billto->setZip($user["CCzip"]);
	  // $billto->setPhoneNumber($phoneNumber);
	  // $billto->setfaxNumber("999-999-9999");
	  // $billto->setCountry("USA");
	  // Create a new Customer Payment Profile
	  $paymentprofile = new AnetAPI\CustomerPaymentProfileType();
	  $paymentprofile->setCustomerType('individual');
	  $paymentprofile->setBillTo($billto);
	  $paymentprofile->setPayment($paymentCreditCard);
	  $paymentprofile->setDefaultPaymentProfile(true);
	  $paymentprofiles[] = $paymentprofile;
	  // Submit a CreateCustomerPaymentProfileRequest to create a new Customer Payment Profile
	  $paymentprofilerequest = new AnetAPI\CreateCustomerPaymentProfileRequest();
	  $paymentprofilerequest->setMerchantAuthentication($merchantAuthentication);
	  //Use an existing profile id
	  $paymentprofilerequest->setCustomerProfileId($user["customerID"]);
	  $paymentprofilerequest->setPaymentProfile( $paymentprofile );
	  $paymentprofilerequest->setValidationMode("liveMode");
	  $controller = new AnetController\CreateCustomerPaymentProfileController($paymentprofilerequest);
	  $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
	  $customerID= $user["customerID"];
	  if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") )
	  {		

	  		$paymentProfileID = $response->getCustomerPaymentProfileId();

	  		if($paymentProfileID){
	  	
	  			$customerProfile = getCustomerProfile($user["customerID"]);
		  		$paymentProfilesSelected = $customerProfile->getPaymentProfiles();
		  	
					foreach($paymentProfilesSelected as $card){
			
					    $payProfId = $card->getCustomerPaymentProfileId();
					    $creditCardInfo = $card->getPayment()->getCreditCard();
					    
					    $cardNum = $creditCardInfo->getCardNumber();
					    $cardType = $creditCardInfo->getCardType();
						
					    $paymentExists = $db->query("SELECT pmID FROM paymentMethods WHERE paymentProfileID = '$payProfId'");



					    if($paymentExists->num_rows == 0){
						    $addPaymentMethod = $db->query("INSERT INTO paymentMethods (customerID, paymentProfileID, cardNum, cardType) VALUES('$customerID', '$payProfId', '$cardNum', '$cardType')");    
					    }
					}
				
				
				if($_SESSION["userLevel"] == 'admin'){
					header('Location: ../admin/profile-billing.php?user='.$user["userID"]);
					exit();
				}
	  		}
	   }
	  else
	  {
	  	    $errorMessages = $response->getMessages()->getMessage();

	  	    $errCode = $errorMessages[0]->getCode();
        	$errMsg = $errorMessages[0]->getText();
        	
        	$addTransaction =$db->query("INSERT INTO payments (anetProfileID, anetProfileType, anetErrCode, anetErrMsg) VALUES($customerID, 'Error', '$errCode', '$errMsg')");

		 if($_SESSION["userLevel"] == 'admin'){
				header('Location: ../admin/profile-billing.php?user='.$user["userID"].'&error='.$errMsg);
				exit();
		 }
		 
	  }


function getCustomerProfile($customerID){
	  // Common setup for API credentials
	  $refId = 'ref' . time();
    
	    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
		$merchantAuthentication->setName("52AhDT3mdw");
		$merchantAuthentication->setTransactionKey("353YcjRx76vq8Ty6");

	  // Retrieve an existing customer profile along with all the associated payment profiles and shipping addresses

	  $request = new AnetAPI\GetCustomerProfileRequest();
	  $request->setMerchantAuthentication($merchantAuthentication);
	  $request->setCustomerProfileId($customerID);
	  $controller = new AnetController\GetCustomerProfileController($request);
	  $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);

	  if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") )
	  {
		
			$profileSelected = $response->getProfile();
			//$paymentProfilesSelected = $profileSelected->getPaymentProfiles();
		    return $profileSelected;
		

		if($response->getSubscriptionIds() != null) 
		{
			if($response->getSubscriptionIds() != null)
			{

				echo "List of subscriptions:";
				foreach($response->getSubscriptionIds() as $subscriptionid)
					echo $subscriptionid . "\n";
			}
		}
	  }
	  else
	  {
		echo "ERROR :  GetCustomerProfile: Invalid response\n";
		$errorMessages = $response->getMessages()->getMessage();
		echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
	  }
	  //return $response;
 }

function createUserData($post){
    $db = db::instance();

    $user = array();
    	$user["userID"] = $db->real_escape_string($post["userID"]);
        $user["CCName"] = $db->real_escape_string($post["payName"]);
        	$sep = strrpos($user["CCName"], ' ');
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

        $user["customerID"] = $db->real_escape_string($post["customerID"]);
        $user["subscripInterval"] = $db->real_escape_string($post["subscripInterval"]);
    
    if(isset($post["payAdd2"]) && $post["payAdd2"] != ''){
        $user["CCaddress"] = $user["CCadd1"].' '.$user["CCadd2"];
    }else{
        $user["CCaddress"] = $user["CCadd1"];
    }
    return $user;
}

?>