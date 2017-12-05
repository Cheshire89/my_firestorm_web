<?php

require_once("classes/config.php");

if(isset($_POST['featMem']) && $_POST['featMem'] != "") {
    
    $db = db::instance();
    
    $setFeatMem = $db->real_escape_string($_POST['featMem']);
    
    $updateMembers = $db->query("UPDATE users SET featured = 'no'");
    $updateMember = $db->query("UPDATE users SET featured = 'yes' WHERE userID = '$setFeatMem'");
    
    print("success");
} else {
    print("error");
}

?>