<?php

require_once '../sdk-php-master/vendor/autoload.php';
require_once 'config.php';
require_once 'class.db.php';

$db = db::instance();

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
$merchantAuthentication->setName("52AhDT3mdw");
$merchantAuthentication->setTransactionKey("353YcjRx76vq8Ty6");

$customerProfileId= $db->real_escape_string($_POST['profileID']);
$customerpaymentprofileid = $db->real_escape_string($_POST['paymentID']); //deletes this

// Use an existing payment profile ID for this Merchant name and Transaction key
	  
	  $request = new AnetAPI\DeleteCustomerPaymentProfileRequest();
	  $request->setMerchantAuthentication($merchantAuthentication);
	  $request->setCustomerProfileId($customerProfileId);
	  $request->setCustomerPaymentProfileId($customerpaymentprofileid);
	  $controller = new AnetController\DeleteCustomerPaymentProfileController($request);
	  $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
	  if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") )
	  {
	   
          $deleteMethod = $db->query("DELETE FROM paymentMethods WHERE customerID = '$customerProfileId' && paymentProfileID = '$customerpaymentprofileid' LIMIT 1");
            
		  print("success");
          exit();
	   }
	  else
	  {
		  //echo "ERROR :  Delete Customer Payment Profile: Invalid response\n";
		  $errorMessages = $response->getMessages()->getMessage();
          
          if($errorMessages[0]->getText() == "The record cannot be found.") {
            $deleteMethod = $db->query("DELETE FROM paymentMethods WHERE customerID = '$customerProfileId' && paymentProfileID = '$customerpaymentprofileid' LIMIT 1");
            print("success");
          } else {
            print($errorMessages[0]->getText());
            exit();
          }
          
          
		  //echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
	  }
	  //return $response;
      
?>