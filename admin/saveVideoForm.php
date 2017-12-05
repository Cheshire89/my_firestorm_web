<?php

require_once("classes/config.php");

if(isset($_POST['videoTitle']) && $_POST['videoTitle'] != "" && isset($_POST['videoLink']) && $_POST['videoLink'] != "" && isset($_POST['videoCategory']) && $_POST['videoCategory'] != "") {
    
    $db = db::instance();
    
    $videoTitle = $db->real_escape_string($_POST['videoTitle']);
    $videoLink = $db->real_escape_string($_POST['videoLink']);
    $videoCategory = $db->real_escape_string($_POST['videoCategory']);
    $videoId = $db->real_escape_string($_POST['videoId']);
    
    if($videoId != "") {
        $update = $db->query("UPDATE videos SET videoTitle = '$videoTitle', videoLink = '$videoLink', videoCategory = '$videoCategory' WHERE vID = '$videoId'");
    } else {
        $insert = $db->query("INSERT INTO videos (videoTitle,videoLink,videoCategory) VALUES ('$videoTitle','$videoLink','$videoCategory')");
    }
    
    header("Location: videos.php");
    exit();
} else {
    header("Location: videos.php?error=saving_video");
    exit();
}



?>