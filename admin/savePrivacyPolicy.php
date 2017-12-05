<?php

require_once("classes/config.php");

if(isset($_POST['privacyPolicyHeader']) && $_POST['privacyPolicyHeader'] != "" && isset($_POST['privacyPolicyText']) && $_POST['privacyPolicyText'] != "") {
    
    $db = db::instance();
    
    $privacyPolicyHeader = $db->real_escape_string($_POST['privacyPolicyHeader']);
    $privacyPolicyText = $db->real_escape_string($_POST['privacyPolicyText']);
    
    $update = $db->query("UPDATE privacy SET header = '$privacyPolicyHeader', content = '$privacyPolicyText' WHERE privacyID = '1'");
    
    header("Location: privacy-policy.php?saved=true");
    exit();
} else {
    header("Location: privacy-policy.php?saved=error");
    exit();
}



?>