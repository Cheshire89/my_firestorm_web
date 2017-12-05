<?php
require_once("classes/config.php");

$db = db::instance();
$users = new Users();
$reply = $users->createNewUser($_POST);

if($reply != "Error") {
    print("Success: ".$reply);
} else {
    print("Error");
}
?>