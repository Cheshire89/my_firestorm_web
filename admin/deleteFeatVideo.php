<?php

require_once("classes/config.php");

if(isset($_GET['id']) && $_GET['id'] != "") {
    
    $db = db::instance();
    
    $id = $db->real_escape_string($_GET['id']);
    
    if($_SESSION['userLevel'] == "admin") {
        $db->query("DELETE FROM featured_video WHERE fvID = '$id' LIMIT 1");
    }

    header("Location: ./index.php");
    exit();    
} else {
    header("Location: ./index.php?error=deleting_video");
    exit();
}


?>