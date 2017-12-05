<?php

require_once("classes/config.php");

if(isset($_GET['id']) && $_GET['id'] != "") {
    
    $db = db::instance();
    
    $id = $db->real_escape_string($_GET['id']);
    
    if($_SESSION['userLevel'] == "admin") {
        $db->query("DELETE FROM videos WHERE vID = '$id' LIMIT 1");
    }

    header("Location: ./videos.php");
    exit();    
} else {
    header("Location: ./videos.php?error=deleting_video");
    exit();
}


?>