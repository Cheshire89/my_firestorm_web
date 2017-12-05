<?php 
require_once("classes/config.php");

$checkUser = new User_Valid();
if(!$checkUser->isLoggedIn()){
     header('Location: /');
     exit();
}

$general = new General();
$success = $general->updateGeneral($_POST);

if($success) {
	header('Location: ./general-settings.php?success=yes');
}else{
	header('Location: ./general-settings.php?success=failed');
}

exit();

?>