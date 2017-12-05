<?php

require_once("classes/config.php");

if(isset($_POST['membershipAgreementHeader']) && $_POST['membershipAgreementHeader'] != "" && isset($_POST['membershipAgreementText']) && $_POST['membershipAgreementText'] != "") {
    
    $db = db::instance();
    
    $membershipAgreementHeader = $db->real_escape_string($_POST['membershipAgreementHeader']);
    $membershipAgreementText = $db->real_escape_string($_POST['membershipAgreementText']);
    
    $update = $db->query("UPDATE membership_agreement SET header = '$membershipAgreementHeader', content = '$membershipAgreementText' WHERE maID = '1'");
    
    header("Location: membership-agreement.php?saved=true");
    exit();
} else {
    header("Location: membership-agreement.php?saved=error");
    exit();
}



?>