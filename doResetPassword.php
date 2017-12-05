<?php

require_once("classes/config.php");

if(isset($_POST['email']) && $_POST['email']) {
    
    $db = db::instance();
    
    $email = $db->real_escape_string($_POST['email']);
    
    $generatePasscode = hash("sha512", "resetHash".date("U")."resetHash");
    
    $checkUser = $db->query("SELECT * FROM users WHERE email = '$email' LIMIT 1");
    $numResults = $checkUser->num_rows;
    
    if($numResults == 1) {
        $addRequest = $db->query("INSERT INTO passwordResets (email,passcode) VALUES ('$email','$generatePasscode')");

        $sendEmail = new sendEmail();
        $sendPasswordReset = $sendEmail->password_reset($email,$generatePasscode);
    }
    
    header("Location: reset-password.php?success=true");
    exit();
} else {
    header("Location: reset-password.php?success=false");
    exit();
}

?>