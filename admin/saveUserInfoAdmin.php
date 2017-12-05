<?php 
require_once("classes/config.php");

if(isset($_POST['userID']) && $_POST['userID'] != "") {
    $db = db::instance();
    $userID = $db->real_escape_string($_POST['userID']);
    if(isset($_POST['type']) && $_POST['type'] == "text"){
    	if(isset($_POST['fieldName']) && $_POST['fieldName'] != "" && isset($_POST['fieldVal']) && $_POST['fieldVal'] != "") {
    
    	    $users = new Users();
    	    $fieldName = $db->real_escape_string($_POST['fieldName']);
    	    $fieldVal = $_POST['fieldVal'];
    	    $saveField = $users->saveField($fieldName, $fieldVal, "text", "users", $userID);
    	}
    }elseif (isset($_POST['type']) && $_POST['type'] == "file") {
    	if(isset($_POST['fieldName']) && $_POST['fieldName'] != "" && isset($_POST['fieldVal']) && $_POST['fieldVal'] != "") {
    		print('file');
    	    $users = new Users();
    	    $fieldName = $db->real_escape_string($_POST['fieldName']);
    	    $fieldVal = $db->real_escape_string($_POST['fieldVal']);
    	    $saveField = $users->saveField($fieldName, $fieldVal, "file", "users", $userID);
    	}
    }
} else {
    print("Error");
}
?>