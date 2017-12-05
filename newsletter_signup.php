<?php

require_once("classes/config.php");

if(isset($_POST['signupEmail']) && $_POST['signupEmail'] != "") {

    $data = [
        'email'     => $_POST['signupEmail'],
        'status'    => 'subscribed'
    ];
    
    $sync = syncMailchimp($data);        

    if($sync == "200") {
        header("Location: ./index.php?success=newsletter_signup");
        exit();
    } else {
        header("Location: ./index.php?error=newsletter_signup");
        exit();
    }

} else {
    header("Location: ./index.php?error=newsletter_signup");
    exit();
}

function syncMailchimp($data) {
    $apiKey = 'bbfdc562e680b9612ca1f43eda037975-us4';
    $listId = '943b31c608';

    $memberId = md5(strtolower($data['email']));
    $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
    $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $memberId;

    $json = json_encode([
        'email_address' => $data['email'],
        'status'        => $data['status'], // "subscribed","unsubscribed","cleaned","pending"
    ]);

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);                                                                                                                 

    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $httpCode;
}

?>