<?php

require_once("classes/config.php");

if(isset($_POST['refer_page']) && $_POST['refer_page'] != "" && isset($_POST['refer_name']) && $_POST['refer_name'] != "" && isset($_POST['refer_email']) && $_POST['refer_email'] != "" && isset($_POST['refer_phone']) && $_POST['refer_phone'] != "" && isset($_POST['their_name']) && $_POST['their_name'] != "" && isset($_POST['their_email']) && $_POST['their_email'] != "" && isset($_POST['their_phone']) && $_POST['their_phone'] != "" && isset($_POST['refMessage']) && $_POST['refMessage'] != "") {
    
    $db = db::instance();
    
    $refer_page = $db->real_escape_string($_POST['refer_page']);
    $refer_name = $db->real_escape_string($_POST['refer_name']);
    $refer_email = $db->real_escape_string($_POST['refer_email']);
    $refer_phone = $db->real_escape_string($_POST['refer_phone']);
    $their_name = $db->real_escape_string($_POST['their_name']);
    $their_email = $db->real_escape_string($_POST['their_email']);
    $their_phone = $db->real_escape_string($_POST['their_phone']);
    $refMessage = $db->real_escape_string($_POST['refMessage']);
    
    $userID = $_SESSION['userID'];
    
    $addReferral = $db->query("INSERT INTO referrals (userID,refer_page,refer_name,refer_email,refer_phone,their_name,their_email,their_phone,refMessage) VALUES ('$userID','$refer_page','$refer_name','$refer_email','$refer_phone','$their_name','$their_email','$their_phone','$refMessage')");
    
    $sendEmail = new sendEmail();
    $sendReferralEmail = $sendEmail->referralEmail($refer_page,$refer_name,$refer_email,$refer_phone,$their_name,$their_email,$their_phone,$refMessage);
    
    print("Success");
} else {
    print("Error");
}

?>