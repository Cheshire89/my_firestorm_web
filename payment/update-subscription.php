<?php
require_once '../sdk-php-master/vendor/autoload.php';
require_once 'config.php';
require_once 'class.db.php';

$db = db::instance();

  use net\authorize\api\contract\v1 as AnetAPI;
  use net\authorize\api\controller as AnetController;
  
  define("AUTHORIZENET_LOG_FILE", "phplog");

    $subscriptionId = $db->real_escape_string($_POST['subscriptionID']);
    $customerProfileId= $db->real_escape_string($_POST['profileID']);
    $customerpaymentprofileid = $db->real_escape_string($_POST['paymentID']); //deletes this

  //function updateSubscription($subscriptionId) {

    // Common Set Up for API Credentials
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName("52AhDT3mdw");
    $merchantAuthentication->setTransactionKey("353YcjRx76vq8Ty6");
    
    $refId = 'ref' . time();

    $subscription = new AnetAPI\ARBSubscriptionType();

    //$creditCard = new AnetAPI\CreditCardType();
    //$creditCard->setCardNumber("4111111111111111");
    //$creditCard->setExpirationDate("2020-12");

    //$payment = new AnetAPI\PaymentType();
    //$payment->setCreditCard($creditCard);

    //set profile information
    $profile = new AnetAPI\CustomerProfileIdType();
    $profile->setCustomerProfileId($customerProfileId);
    $profile->setCustomerPaymentProfileId($customerpaymentprofileid);
    //$profile->setCustomerAddressId("141414");

    //$subscription->setPayment($payment);

    //set customer profile information
    $subscription->setProfile($profile);
    
    $request = new AnetAPI\ARBUpdateSubscriptionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setSubscriptionId($subscriptionId);
    $request->setSubscription($subscription);

    $controller = new AnetController\ARBUpdateSubscriptionController($request);

    $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
    
    if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") )
    {
        $errorMessages = $response->getMessages()->getMessage();
        //echo "SUCCESS Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
        print("success");
     }
    else
    {
        //echo "ERROR :  Invalid response\n";
        $errorMessages = $response->getMessages()->getMessage();
        //echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
        print($errorMessages[0]->getText());
    }
    exit();
    //return $response;
  //}

  //if(!defined('DONT_RUN_SAMPLES'))
      //updateSubscription("3056948");
?>
