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

$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();

$merchantAuthentication->setName("52AhDT3mdw");
$merchantAuthentication->setTransactionKey("353YcjRx76vq8Ty6");

//customerprofileid="36731856"; this page creates this

$user = array();

$user["prospectID"] = $_SESSION["prospectID"];
$user["fullName"] = $_POST["payName"];
$user["fName"] = substr($user["fullName"], 0, strpos($user["fullName"], ' '));
$user["lName"] = substr($user["fullName"], strpos($user["fullName"], ' ')+1);
$user["email"] = $_POST["payEmail"];
//$user["email"] = 'new'.rand(100,200).'@test.com';
$user["cardType"] = $_POST["payCardType"];

$user["cardNum"] = $_POST["payCCNum"];

$user["cardExp"] = $_POST["payCardYear"].'-'.$_POST["payCardMonth"];
$user["cardCSC"] = $_POST["payCSC"];

$user["billAddress"] = $_POST["payAdd1"];
	if(isset($_POST["payAdd2"]) && $_POST["payAdd2"] != ''){
		$user["billAddress"] .= ' '.$_POST["payAdd2"];
	}
$user["billState"] = $_POST["payState"]; 
$user["billCity"] = $_POST["payCity"];
$user["billZip"] = $_POST["payZip"];

	  
	 $refId = 'ref' . time();
		// Create the payment data for a credit card
	  $creditCard = new AnetAPI\CreditCardType();
	  $creditCard->setCardNumber($user["cardNum"]);
	  $creditCard->setExpirationDate($user["cardExp"]);
	  $creditCard->setCardCode($user["cardCSC"]);

	  $paymentCreditCard = new AnetAPI\PaymentType();
	  $paymentCreditCard->setCreditCard($creditCard);
	  // Create the Bill To info
	  $billto = new AnetAPI\CustomerAddressType();
	  $billto->setFirstName($user["fName"]);
	  $billto->setLastName($user["lName"]);
	 // $billto->setCompany();
	  $billto->setAddress($user["billAddress"]);
	  $billto->setCity($user["billCity"]);
	  $billto->setState($user["billState"]);
	  $billto->setZip($user["billZip"]);
	  //$billto->setCountry();

	 // Create a Customer Profile Request
	 //  1. create a Payment Profile
	 //  2. create a Customer Profile   
	 //  3. Submit a CreateCustomerProfile Request
	 //  4. Validate Profiiel ID returned
	  
	  $paymentprofile = new AnetAPI\CustomerPaymentProfileType();
	  $paymentprofile->setCustomerType('individual');
	  $paymentprofile->setBillTo($billto);
	  $paymentprofile->setPayment($paymentCreditCard);
	  $paymentprofiles[] = $paymentprofile;

	  $customerprofile = new AnetAPI\CustomerProfileType();
	  $customerprofile->setDescription($user['fName'] ." ".$user['lName']);
	  $customerprofile->setMerchantCustomerId("M_".$user["prospectID"]);
	  $customerprofile->setEmail($user["email"]);
	  $customerprofile->setPaymentProfiles($paymentprofiles);

	  $request = new AnetAPI\CreateCustomerProfileRequest();
	  $request->setMerchantAuthentication($merchantAuthentication);
	  $request->setRefId($refId);
	  $request->setProfile($customerprofile);

	  $controller = new AnetController\CreateCustomerProfileController($request);
	  $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);


	  if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") )
	  {
	  		
		  // echo "Succesfully create customer profile : " . $response->getCustomerProfileId() . "\n";
		  $paymentProfiles = $response->getCustomerPaymentProfileIdList();
		  // echo "SUCCESS: PAYMENT PROFILE ID : " . $paymentProfiles[0] . "\n";
	  	  
	  	  $customerID = $response->getCustomerProfileId();
	  	  $paymentID = $paymentProfiles[0];
	  	  $prospectID = $user["prospectID"];

	  	 $AddIdsQuery = "INSERT INTO payments (prospectID,anetProfileType, anetProfileID, anetPaymentID) VALUES('$prospectID','individual', '$customerID', '$paymentID')";

		  $addIds = $db->query($AddIdsQuery);

		  $updateProspectQuery = "UPDATE prospects SET  customerProfileID ='$customerID', paymentProfileID = '$paymentID', applicationFee='1' WHERE prospectID='$prospectID'";

		  $updateProspect = $db->query($updateProspectQuery);


			$order = new AnetAPI\OrderType();
			$order->setDescription("Firestorm Application Fee");
		  
			// Set the customer's identifying information
			$customerData = new AnetAPI\CustomerDataType();
			$customerData->setType("individual");
			$customerData->setId($refId);
			$customerData->setEmail($user['email']);

			// Create a TransactionRequestType object
			$amount = 100;
			$transactionRequestType = new AnetAPI\TransactionRequestType();
			$transactionRequestType->setTransactionType("authCaptureTransaction"); 
			$transactionRequestType->setAmount($amount);
			$transactionRequestType->setOrder($order);
			$transactionRequestType->setPayment($paymentCreditCard);
			$transactionRequestType->setBillTo($billto);
			$transactionRequestType->setCustomer($customerData);

			//$transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
			$request = new AnetAPI\CreateTransactionRequest();
			$request->setMerchantAuthentication($merchantAuthentication);
			$request->setRefId($refId);
			$request->setTransactionRequest( $transactionRequestType);

			$controller = new AnetController\CreateTransactionController($request);
    		$paymentResponse = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);

if ($paymentResponse != null)
    {
      if($paymentResponse->getMessages()->getResultCode() == 'Ok')
      {
        $tPaymentResponse = $paymentResponse->getTransactionResponse();
        
        if ($tPaymentResponse != null && $tPaymentResponse->getMessages() != null)   
        {
        	 $paymentResponse = $tPaymentResponse->getResponseCode();
        	 $transAuthCode = $tPaymentResponse->getAuthCode();
        	 $transRes = $tPaymentResponse->getTransId();
        	 $transCode = $tPaymentResponse->getMessages()[0]->getCode();
        	 $transDesc = $tPaymentResponse->getMessages()[0]->getDescription();

        	 $lastFour = 'XXXX'.substr($user["cardNum"], -4);
        	 $fName = $user["fName"];
        	 $lName = $user["lName"];
        	 $email = $user["email"];

        	 $desc = 'Create User Profile and Paymet Profile';

        	 $addTransaction = $db->query("INSERT INTO payment (prospectID, anetProfileType, anetProfileID, anetPaymentID, anetAuthCode, anetTransactionID, anetErrMsg ,price, paymentFrequency, lastFour, fName, lName, email , transDesc) VALUES('$prospectID', 'Payment','$customerID', '$paymentID','$transCode', '$transRes', '$transDesc', '$amount', 'Single', '$lastFour', '$fName', '$lName', '$email', '$desc')");

        	  //Get Payment Profile Info
			  $customerProfileReq = new AnetAPI\GetCustomerProfileRequest();
			  $customerProfileReq->setMerchantAuthentication($merchantAuthentication);
			  $customerProfileReq->setCustomerProfileId($customerID);

			  $controller = new AnetController\GetCustomerProfileController($customerProfileReq);
			  
			  $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);

		  	   if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")){
			
					$profileSelected = $response->getProfile();
					$paymentProfilesSelected = $profileSelected->getPaymentProfiles();
					//print('<pre>');
					//print_r($paymentProfilesSelected);
					//print('</pre>');
					//exit();
                    
                    
					foreach($paymentProfilesSelected as $card){
					    $payProfId = $card->getCustomerPaymentProfileId();
					    $creditCardInfo = $card->getPayment()->getCreditCard();
					    
					    $cardNum = $creditCardInfo->getCardNumber();
					    $cardType = $creditCardInfo->getCardType();

					    $query="INSERT INTO paymentMethods (customerID, paymentProfileID, cardNum, cardType,mainPayment, prospectID) VALUES('$customerID', '$payProfId', '$cardNum', '$cardType', '1', '$prospectID')";
									
					    $addPaymentMethod = $db->query($query);  
					}

			   }else{
			   		print("Error - No customer data returned");
			   }

			 $name = $fName.' '.$lName;

        	 // Send Email To Chapter Leader
        	 $sendEmail = new sendEmail();
        	 $sendEmail->fee_paid_user($prospectID, "Firestorm Application Fee" ,$amount,$transRes);
        	 $sendEmail->fee_paid_admin($prospectID, $name, $email);

        	 header('Location: ../thank-you.php?fee=paid');
        	 exit();
        }
        else
        {	

          echo "Transaction Failed \n";
          if($tPaymentResponse->getErrors() != null)
          {

        	$errCode = $tPaymentResponse->getErrors()[0]->getErrorCode();
        	$errMsg = $tPaymentResponse->getErrors()[0]->getErrorText();

        	$addTransaction =$db->query("INSERT INTO payments (anetProfileID, anetPaymentID, anetProfileType, anetErrCode, anetErrMsg) VALUES($customerID, $paymentID, 'Error', '$errCode', '$errMsg')");

        	header('Location: ../payment-fail.php?customerID='.$customerID); 
        	exit(); 
          }
        }
      }
      else
      {
        echo "Transaction Failed \n";
        $tPaymentResponse = $paymentResponse->getTransactionResponse();
        
        if($tPaymentResponse != null && $tPaymentResponse->getErrors() != null)
        {
        	$errCode = $tPaymentResponse->getErrors()[0]->getErrorCode();
        	$errMsg = $tPaymentResponse->getErrors()[0]->getErrorText();
        	$addTransaction =$db->query("INSERT INTO payments (anetProfileID, anetPaymentID, anetProfileType, anetErrCode, anetErrMsg) VALUES($customerID, $paymentID, 'Error', '$errCode', '$errMsg')");                

        }
        else
        {
        	$errCode = $paymentResponse->getMessages()->getMessage()[0]->getCode();
        	$errMsg = $paymentResponse->getMessages()->getMessage()[0]->getText();
        	$addTransaction =$db->query("INSERT INTO payments (anetProfileID, anetPaymentID, anetProfileType, anetErrCode, anetErrMsg) VALUES($customerID, $paymentID, 'Error', '$errCode', '$errMsg')");
          
          // echo " Error code  : " . $paymentResponse->getMessages()->getMessage()[0]->getCode() . "\n";
          // echo " Error message : " . $paymentResponse->getMessages()->getMessage()[0]->getText() . "\n";
        }
    	header('Location: ../payment-fail.php?customerID='.$customerID); 
    	exit(); 
      }      
    }
    else
    {

      header('Location: ../payment-fail.php?customerID='.$customerID.'&status=no_auth'); 
      exit(); 
      //echo  "No paymentResponse returned \n";
    }
	   }
	  else
	  {
	  	 $paymentProfiles = $response->getCustomerPaymentProfileIdList();
	  	 $customerID = $response->getCustomerProfileId();
		 $prospectID = $user["prospectID"];


	  	 	if($customerID != ''){
	  	 		$updateProspect = $db->query("UPDATE prospects SET  customerProfileID='$customerID' WHERE prospectID='$prospectID'");
	  	 	}

		  
		  //echo "ERROR :  Invalid response\n";
		  $errorMessages = $response->getMessages()->getMessage();
          //echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
          $errCode = $errorMessages[0]->getCode();
          $errMsg = $db->real_escape_string($errorMessages[0]->getText());
          $addIds = $db->query("INSERT INTO payment (prospectID, anetErrCode, anetErrMsg, anetProfileType) VALUES('$prospectID', '$errCode', '$errMsg', 'Error')");
          header('Location: ../thank-you.php?fee=paid');
          exit();
	  }
	  return $response;

?>