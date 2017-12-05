<?php

require_once("classes/config.php");

if(isset($_POST['termsOfUseHeader']) && $_POST['termsOfUseHeader'] != "" && isset($_POST['termsOfUseText']) && $_POST['termsOfUseText'] != "") {
    
    $db = db::instance();
    
    $termsOfUseHeader = $db->real_escape_string($_POST['termsOfUseHeader']);
    $termsOfUseText = $db->real_escape_string($_POST['termsOfUseText']);
    
    $update = $db->query("UPDATE terms SET header = '$termsOfUseHeader', content = '$termsOfUseText' WHERE tID = '1'");
    
    header("Location: terms-of-use.php?saved=true");
    exit();
} else {
    header("Location: terms-of-use.php?saved=error");
    exit();
}

?>