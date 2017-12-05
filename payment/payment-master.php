<?php 
	require_once '../sdk-php-master/vendor/autoload.php';
  	require_once 'config.php';
  	require_once '../classes/class.db.php';
  	require_once '../classes/class.fireSQL.php';
  	require_once '../classes/class.Users.php';
  	
  	use net\authorize\api\contract\v1 as AnetAPI;
  	use net\authorize\api\controller as AnetController;

  	Class Payment_Master EXTENDS fireSQL{
  		public $refID;
  		public $merchantAuth;

  		function Payment_Master(){
  			$this->merchantAuth = $this->merchantAuthenticate();
  			$this->refID = 'ref' . time();
  		}

  		private function merchantAuthenticate(){
  			$merchant = new AnetAPI\MerchantAuthenticationType();
			$merchant->setName("52AhDT3mdw");
			$merchant->setTransactionKey("353YcjRx76vq8Ty6");
			return $merchant;
  		}

  		function createCreditCardPaymentData($cardNum, $cardExp, $cardCSC = null){
  			$creditCard = new AnetAPI\CreditCardType();
			$creditCard->setCardNumber($cardNum);
			$creditCard->setExpirationDate($cardExp);
				
				if(isset($cardCSC) && $cardCSC != ''){
					$creditCard->setCardCode($cardCSC);
				}

			$paymentCreditCard = new AnetAPI\PaymentType();
			$paymentCreditCard->setCreditCard($creditCard);
			return $paymentCreditCard;
  		}

  		function createBillToData($fName, $lName, $compName = null, $billAddress, $billCity, $billState, $billZip, $billCountry = 'USA'){

	  		  $billto = new AnetAPI\CustomerAddressType();
			  $billto->setFirstName($fName);
			  $billto->setLastName($lName);

			  	 if(isset($compName) && $compName!=''){
					 $billto->setCompany($compName);
			  	 }

			  $billto->setAddress($billAddress);
			  $billto->setCity($billCity);
			  $billto->setState($billState);
			  $billto->setZip($billZip);

			  	if(isset($billCountry) && $billCountry!=''){
					  $billto->setCountry($billCountry);
			  	}
			  return $billto;
  		}

  		function createPaymentProfile($billto, $paymentCreditCard){
  			$paymentprofile = new AnetAPI\CustomerPaymentProfileType();
	  		$paymentprofile->setCustomerType('individual');
	  		$paymentprofile->setBillTo($billto);
	  		$paymentprofile->setPayment($paymentCreditCard);
	  		$paymentprofiles[] = $paymentprofile;
	  		return $paymentprofiles;
  		}

  		function createCutomerProfile($email, $paymentprofiles){
  			$customerprofile = new AnetAPI\CustomerProfileType();
	  		$customerprofile->setDescription("Create New Customer");
	  		$customerprofile->setMerchantCustomerId("M_".$email);
	  		$customerprofile->setEmail($email);
	  		$customerprofile->setPaymentProfiles($paymentprofiles);
	  		return $customerprofile;
  		}

  		function processCutomerProfile($customerprofile){
	  		  $request = new AnetAPI\CreateCustomerProfileRequest();
			  $request->setMerchantAuthentication($this->merchantAuth);
			  $request->setRefId($this->refID);
			  $request->setProfile($customerprofile);
			  return $request;
  		}

  		function createOrder($orderDescription){
  			 $order = new AnetAPI\OrderType();
    		 $order->setDescription("New Item");
    		 return $order;
  		}

  		function setCutomerInfo($id, $email){
  			$customerData = new AnetAPI\CustomerDataType();
    		$customerData->setType("individual");
    		$customerData->setId($id);
    		$customerData->setEmail($email);
    		return $customerData;
  		}

  		function setTransactionSettings(){
  			$duplicateWindowSetting = new AnetAPI\SettingType();
    		$duplicateWindowSetting->setSettingName("duplicateWindow");
    		$duplicateWindowSetting->setSettingValue("600");
    		return $duplicateWindowSetting;
  		}

  		function createTransactionRequest($amount, $order, $paymentCard, $billTo, $customerData, $transactionSettings){
  			$transactionRequestType = new AnetAPI\TransactionRequestType();
		    $transactionRequestType->setTransactionType("authCaptureTransaction"); 
		    $transactionRequestType->setAmount($amount);
		    $transactionRequestType->setOrder($order);
		    $transactionRequestType->setPayment($paymentCard);
		    $transactionRequestType->setBillTo($billTo);
		    $transactionRequestType->setCustomer($customerData);
		    $transactionRequestType->addToTransactionSettings($transactionSettings);
		    return $transactionRequestType;
  		}

  		function runTransaction($transactionRequestType){
  			$request = new AnetAPI\CreateTransactionRequest();
    		$request->setMerchantAuthentication($this->merchantAuth);
    		$request->setRefId($this->refID);
    		$request->setTransactionRequest($transactionRequestType);
    		return $request;
  		}

  		function transactionHandler($transaction){

  		  $controller = new AnetController\CreateTransactionController($transaction);
	      $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);

	        // print($response->getMessages()->getResultCode());
		    
		    if ($response != null)
		    {
		      if($response->getMessages()->getResultCode())
		      {
		        $tresponse = $response->getTransactionResponse();
		       
		        if ($tresponse != null && $tresponse->getMessages() != null)   
		        {
		        	 $transactionObj = array();
		             $transactionObj["transResponse"] = $tresponse->getResponseCode();
		             $transactionObj["transAuthCode"] = $tresponse->getResponseCode();
		             $transactionObj["transID"] = $tresponse->getTransId();
		             $transactionObj["transCode"] = $tresponse->getMessages()[0]->getCode();
		             $transactionObj["transDesc"] = $tresponse->getMessages()[0]->getDescription();

		                return $transactionObj;

		        }
		        else
		        {
		          echo "Transaction Failed \n";
		          if($tresponse->getErrors() != null)
		          {
		          	    $err = array();
		          	    $err["errCode"] = $tresponse->getErrors()[0]->getErrorCode();
		          	    $err["errMsg"] = $tresponse->getErrors()[0]->getErrorText();
		                
		                return $err;

		          }
		        }
		      }
		      else
		      {
		        echo "Transaction Failed \n";
		        $tresponse = $response->getTransactionResponse();
		        
		        if($tresponse != null && $tresponse->getErrors() != null)
		        {
		                $err = array();
						$err["errCode"] = $tresponse->getErrors()[0]->getErrorCode();
						$err["errMsg"] =  $tresponse->getErrors()[0]->getErrorText();
						return $err; 
		        }
		        else
		        {
		             
		                $err = array();
						$err["errCode"] = $response->getMessages()->getMessage()[0]->getCode();
						$err["errMsg"] =  $response->getMessages()->getMessage()[0]->getText();
						return $err; 
		        }
		      }      
		    }
		    else
		    {
		      echo  "No response returned \n";
		    } 
		}

		function getCustomerProfile($profileID){
		  $request = new AnetAPI\GetCustomerProfileRequest();
		  $request->setMerchantAuthentication($this->merchantAuth);
		  $request->setCustomerProfileId($profileID);
		  $controller = new AnetController\GetCustomerProfileController($request);
		  $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
		  if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") )
		  {
			echo "GetCustomerProfile SUCCESS : " .  "\n";
			$profileSelected = $response->getProfile();
			return $profileSelected;

			$paymentProfilesSelected = $profileSelected->getPaymentProfiles();
			echo "Profile Has " . count($paymentProfilesSelected). " Payment Profiles" . "\n";
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
		}



		function chargeCustomerProfile($profileid, $paymentprofileid, $amount){
			$profileToCharge = new AnetAPI\CustomerProfilePaymentType();
		    $profileToCharge->setCustomerProfileId($profileid);
		    
		    $paymentProfile = new AnetAPI\PaymentProfileType();
		    $paymentProfile->setPaymentProfileId($paymentprofileid);
		    $profileToCharge->setPaymentProfile($paymentProfile);

		    $transactionRequestType = new AnetAPI\TransactionRequestType();
		    $transactionRequestType->setTransactionType("authCaptureTransaction"); 
		    $transactionRequestType->setAmount($amount);
		    $transactionRequestType->setProfile($profileToCharge);

		    $request = $this->runTransaction($transactionRequestType); 
		    $response = $this->transactionHandler($request);
		    return $response;
		}

		function transactionResponseHandler($response, $text, $user, $customerProfileID, $paymentProfileID){
			
			// print('Action : '.$text);
			
			// print('<pre>');
			// 	print_r($response);
			// print('</pre>');

			if(isset($response["transResponse"]) && $response["transResponse"] == 1){

			  	 $this->insert('payment',array('prospectID','anetProfileType','anetProfileID', 'anetPaymentID', 'anetTransactionDate', 'anetAuthCode', 'anetTransactionID'),array($user["prospectID"], 'Payment', $customerProfileID, $paymentProfileID, date('U'), $response["transAuthCode"], $response["transID"]));

			  	 $this->update('prospects',array('applicationFee','anetProfileID'), array(1, $customerProfileID), array('prospectID'=>$user["prospectID"]));



			  	 print('<h1>Payment Successful</h1> <br>');

			  	 //header('Location: ../profile.php?user='.$user["prospectID"]);

			  }else if($response["errCode"] && $response["errCode"] != ''){

			  	  $logError = $this->insert('payment',
			  	  	array('prospectID', 'anetProfileType', 'anetProfileID','anetPaymentID', 'anetErrCode', 'anetErrMsg'), 
			  	  	array($user["prospectID"], 'Error', $customerProfileID, $paymentProfileID, $response["errCode"], $response["errMsg"]));

			  	  print('<h1>Payment Not Successful</h1> <br>');

			  	  //header('Location: ../payment.php?errCode='.$response["errCode"]);
			  }

		}

		function deleteCustomerPaymentProfile($customerProfileId, 
      $customerpaymentprofileid){
		      $request = new AnetAPI\DeleteCustomerPaymentProfileRequest();
			  $request->setMerchantAuthentication($this->merchantAuth);
			  $request->setCustomerProfileId($customerProfileId);
			  $request->setCustomerPaymentProfileId($customerpaymentprofileid);
			  $controller = new AnetController\DeleteCustomerPaymentProfileController($request);
			  $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
			  if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") )
			  {
				  echo "SUCCESS: Delete Customer Payment Profile  SUCCESS  :" . "\n";
			   }
			  else
			  {	
			  		$errorMessages = $response->getMessages()->getMessage();
			  		$err = array();
						$err["errCode"] = $errorMessages[0]->getCode();
						$err["errMsg"] =  $errorMessages[0]->getText();
					    $this->transactionResponseHandler($err, 'delete payment profile', $customerProfileId, $customerpaymentprofileid);
			  }
			  return $response;
		}


	
  
  		
}
 
?>