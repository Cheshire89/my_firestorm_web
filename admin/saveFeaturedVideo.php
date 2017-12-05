<?php

require_once("classes/config.php");

if(isset($_POST['featVidLink']) && $_POST['featVidLink'] != "" && isset($_POST['scheduleFeatVideo']) && $_POST['scheduleFeatVideo'] != "") {
    
    $db = db::instance();
    
    $featVidLink = $db->real_escape_string($_POST['featVidLink']);
    $scheduleFeatVideo = $db->real_escape_string($_POST['scheduleFeatVideo']);
    $featVideoStart = strtotime($db->real_escape_string($_POST['featVideoStart']));
    $featVideoEnd = strtotime($db->real_escape_string($_POST['featVideoEnd']));
    
    $db->query("INSERT INTO featured_video (featVidLink,scheduleFeatVideo,featVideoStart,featVideoEnd) VALUES ('$featVidLink','$scheduleFeatVideo','$featVideoStart','$featVideoEnd')");

    header("Location: ./index.php");
    exit();    
} else {
    header("Location: ./index.php?error=saving_featured_video");
    exit();
}


?>