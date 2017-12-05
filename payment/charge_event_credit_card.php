<?php
  require '../sdk-php-master/vendor/autoload.php';
  require_once 'config.php';
  require_once 'class.db.php';
  require_once 'class.sendEmail.php';
  require_once 'class.PHPMailer.php';
  require_once 'class.SMTP.php';

  $db = db::instance();
  $user = createUserData($_POST);

  use net\authorize\api\contract\v1 as AnetAPI;
  use net\authorize\api\controller as AnetController;

    // Common setup for API credentials
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
	$merchantAuthentication->setName("52AhDT3mdw");
	$merchantAuthentication->setTransactionKey("353YcjRx76vq8Ty6");

    $refId = 'ref' . time();

    // Create the payment data for a credit card
    $creditCard = new AnetAPI\CreditCardType();
    $creditCard->setCardNumber($user["payCCNum"]);
    $creditCard->setExpirationDate($user["payCardYear"].'-'.$user["payCardMonth"]);
    $creditCard->setCardCode($user["payCSC"]);
    $paymentOne = new AnetAPI\PaymentType();
    $paymentOne->setCreditCard($creditCard);

    $order = new AnetAPI\OrderType();
    $order->setDescription("Payment For ".$user["eventTitle"]);

    // Set the customer's Bill To address
    $customerAddress = new AnetAPI\CustomerAddressType();
    $customerAddress->setFirstName($user["fName"]);
    $customerAddress->setLastName($user["lName"]);
    //$customerAddress->setCompany("Souveniropolis");
    $customerAddress->setAddress($user["payAddress"]);
    $customerAddress->setCity($user["payCity"]);
    $customerAddress->setState($user["payState"]);
    $customerAddress->setZip($user["payState"]);
    //$customerAddress->setCountry("USA");

    // Set the customer's identifying information
    $customerData = new AnetAPI\CustomerDataType();
    $customerData->setType("individual");
    $customerData->setId($refID);
    $customerData->setEmail($user["payEmail"]);

    //Add values for transaction settings
    $duplicateWindowSetting = new AnetAPI\SettingType();
    $duplicateWindowSetting->setSettingName("duplicateWindow");
    $duplicateWindowSetting->setSettingValue("600");

    // Create a TransactionRequestType object
    $transactionRequestType = new AnetAPI\TransactionRequestType();
    $transactionRequestType->setTransactionType( "authCaptureTransaction"); 
    $transactionRequestType->setAmount($user["eventPrice"]);
    $transactionRequestType->setOrder($order);
    $transactionRequestType->setPayment($paymentOne);
    $transactionRequestType->setBillTo($customerAddress);
    $transactionRequestType->setCustomer($customerData);
    $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);

    $request = new AnetAPI\CreateTransactionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId( $refId);
    $request->setTransactionRequest( $transactionRequestType);

    $controller = new AnetController\CreateTransactionController($request);
    $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
    
    $cardNum = 'XXXX'.substr($user["payCCNum"], -4);

    if ($response != null)
    {
      if($response->getMessages()->getResultCode() == "Ok")
      {
        $tresponse = $response->getTransactionResponse();
        
        if ($tresponse != null && $tresponse->getMessages() != null)   
        {  
        	 $fName = $user["fName"];
        	 $lName = $user["lName"];
        	 $eventID = $user["eventID"];
        	 $email = $user["payEmail"];
        	 $price = $user["eventPrice"];
           $title = $user["eventTitle"];

          	 $paymentResponse = $db->real_escape_string($tresponse->getResponseCode());
        	 
             $transAuthCode = $db->real_escape_string($tresponse->getAuthCode());
        	 
             $transRes = $db->real_escape_string($tresponse->getTransId());
        	 
             $transCode = $db->real_escape_string($tresponse->getMessages()[0]->getCode());
        	 
             $transDesc = $db->real_escape_string($tresponse->getMessages()[0]->getDescription());
        	 
             $query = "INSERT INTO payment (lastFour, anetAuthCode, anetTransactionID, anetErrMsg, fName, lName, eventID, email, price, anetProfileType, transDesc) VALUES('$cardNum','$transCode', '$transRes', '$transDesc', '$fName', '$lName', '$eventID', '$email', '$price','Event', '$title')";

             //print($query);
        	
        	 $addTransaction = $db->query($query);
            if($addTransaction){
               //print('sending email');
            	 $sendEmail = new sendEmail();
            	 $sendEmail->nonuser_paid_event($user, $transRes);
            }

           header('Location: ../event.php?eventID='.$eventID.'event=paid');
           exit();

        }
        else
        {
          echo "Transaction Failed \n";
          if($tresponse->getErrors() != null)
          {
          	$errCode = $tresponse->getErrors()[0]->getErrorCode();
        	$errMsg = $tresponse->getErrors()[0]->getErrorText();
        	$query = "INSERT INTO payment (anetProfileID, anetProfileType, anetErrCode, anetErrMsg) VALUES('$cardNum', 'Error', '$errCode', '$errMsg')";
        	$addTransaction =$db->query($query);             
          }
        }
      }
      else
      {
    	
        echo "Transaction Failed \n";
        $tresponse = $response->getTransactionResponse();
        
        if($tresponse != null && $tresponse->getErrors() != null)
        {
	  	    $errCode = $tresponse->getErrors()[0]->getErrorCode();
        	$errMsg = $tresponse->getErrors()[0]->getErrorText();
        	$query = "INSERT INTO payment (anetProfileID, anetProfileType, anetErrCode, anetErrMsg) VALUES('$cardNum', 'Error', '$errCode', '$errMsg')";
        	print($query);
        	$addTransaction =$db->query($query);                      
        }
        else
        {
        	$errCode = $response->getMessages()->getMessage()[0]->getCode();
        	$errMsg = $response->getMessages()->getMessage()[0]->getText();
        	$query = "INSERT INTO payment (anetProfileID, anetProfileType, anetErrCode, anetErrMsg) VALUES('$cardNum', 'Error', '$errCode', '$errMsg')";
        	print($query);
        	$addTransaction =$db->query($query);   
        }
      }      
    }
    else
    {
      echo  "No response returned \n";
    }


function createUserData($post){
    $db = db::instance();

    $user = array();


		$user["payEmail"] = $db->real_escape_string($post["payEmail"]);
		$user["payName"] = $db->real_escape_string($post["payName"]);
			$sep = strrpos($user["payName"], ' ');
        	$user["fName"] = trim(substr($user["payName"], 0, $sep+1));
        	$user["lName"] = trim(substr($user["payName"], $sep));
		$user["payCCNum"] = $db->real_escape_string($post["payCCNum"]);
		$user["payCardMonth"] = $db->real_escape_string($post["payCardMonth"]);
		$user["payCardYear"] = $db->real_escape_string($post["payCardYear"]);
		$user["payCSC"] = $db->real_escape_string($post["payCSC"]);
		$user["payAdd1"] = $db->real_escape_string($post["payAdd1"]);
		$user["payAdd2"] = $db->real_escape_string($post["payAdd2"]);
		$user["payState"] = $db->real_escape_string($post["payState"]);
		$user["payCity"] = $db->real_escape_string($post["payCity"]);
		$user["payZip"] = $db->real_escape_string($post["payZip"]);
		$user["eventID"] = $db->real_escape_string($post["eventID"]);
		// Event Id
		$user["eventDate"] = $db->real_escape_string($post["eventDate"]);
		$user["eventTitle"] = $db->real_escape_string($post["eventTitle"]);
		$user["eventBy"] = $db->real_escape_string($post["eventBy"]);
		$user["eventAddress"] = $db->real_escape_string($post["eventAddress"]);
		$user["eventPrice"] = $db->real_escape_string($post["eventPrice"]);

	if(isset($post["payAdd2"]) && $post["payAdd2"] != ''){
        $user["payAddress"] = $user["payAdd1"].' '.$user["payAdd2"];
    }else{
        $user["payAddress"] = $user["payAdd1"];
    }

    return $user;
}




?>
