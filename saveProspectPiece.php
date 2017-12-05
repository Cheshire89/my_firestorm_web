<?php

require_once("classes/config.php");

if(isset($_POST['type']) && $_POST['type'] == "text"){
	if(isset($_POST['fieldName']) && $_POST['fieldName'] != "" && isset($_POST['fieldVal']) && $_POST['fieldVal'] != "") {
	    $db = db::instance();
	    $users = new Users();
	    $fieldName = $db->real_escape_string($_POST['fieldName']);
	    $fieldVal = $db->real_escape_string($_POST['fieldVal']);
	    $saveField = $users->saveField($fieldName, $fieldVal, "text", 'prospects',$_SESSION['prospectID']);
	    // print($saveField);
	}
}elseif (isset($_POST['type']) && $_POST['type'] == "file") {
	if(isset($_POST['fieldName']) && $_POST['fieldName'] != "" && isset($_POST['fieldVal']) && $_POST['fieldVal'] != "") {
		//print('file');
	    $db = db::instance();
	    $users = new Users();
	    $fieldName = $db->real_escape_string($_POST['fieldName']);
	    $fieldVal = $db->real_escape_string($_POST['fieldVal']);
	    $saveField = $users->saveField($fieldName, $fieldVal, "file", 'prospects',$_SESSION['prospectID']);
	    print($saveField);
	}
}

?>