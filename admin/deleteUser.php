<?php

require_once("classes/config.php");

$checkUser = new User_Valid();
if(!$checkUser->isLoggedIn()){
    header('Location: /');
    exit();
}

if(isset($_GET['id']) && $_GET['id'] != "") {
    
    $db = db::instance();
    
    $id = $db->real_escape_string($_GET['id']);
    
    $update = $db->query("UPDATE users SET archived = 'yes' WHERE userID = '$id' LIMIT 1");
    
    $updateChaptersEnrolled = $db->query("DELETE FROM chaptersEnrolled WHERE userID = '$id'");
    $updateEventsEnrolled = $db->query("DELETE FROM eventsEnrolled WHERE userID = '$id'");
    
    header("Location: users-authenticated.php?success=true");
    exit();
    
} else {
    
    header("Location: users-authenticated.php?success=false");
    exit();
    
}

//

?>