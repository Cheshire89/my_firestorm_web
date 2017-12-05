<?php

require_once("classes/config.php");

//doNewPassword
if(isset($_POST['email']) && $_POST['email'] && isset($_POST['resetID']) && $_POST['resetID'] && isset($_POST['password']) && $_POST['password'] && isset($_POST['confPassword']) && $_POST['confPassword']) {
    
    $db = db::instance();
    
    $email = $db->real_escape_string($_POST['email']);
    $passcode = $db->real_escape_string($_POST['resetID']);
    $password = $db->real_escape_string($_POST['password']);
    $confPassword = $db->real_escape_string($_POST['confPassword']);
    
    $hashPass = hash("sha512", $password);
    
    $checkUser = $db->query("SELECT * FROM passwordResets WHERE email = '$email' && passcode = '$passcode' && resetUsed = '' LIMIT 1");
    $numResults = $checkUser->num_rows;
    
    if($numResults == 1) {
        $now = date("U");
        $updatePassword = $db->query("UPDATE users SET hash = '$hashPass' WHERE email = '$email' LIMIT 1");
        $updateResets = $db->query("UPDATE passwordResets SET resetUsed = '$now' WHERE email = '$email' && passcode = '$passcode' LIMIT 1");

        $sendEmail = new sendEmail();
        $sendPasswordResetConfirmation = $sendEmail->password_reset_confirmed($email);
        
        header("Location: new-password.php?success=true");
        exit();
    } else {
        header("Location: new-password.php?success=expired");
        exit();
    }
    
} else {
    header("Location: new-password.php?success=false");
    exit();
}


?>