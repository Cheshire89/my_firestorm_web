<?php
  require_once '../sdk-php-master/vendor/autoload.php';
  require_once 'config.php';
  require_once 'class.db.php';

  use net\authorize\api\contract\v1 as AnetAPI;
  use net\authorize\api\controller as AnetController;
  
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
?>
