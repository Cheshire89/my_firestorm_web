<?php
require_once('classes/config.php');
$about = new About();
$success = $about->updateAbout($_POST,$_FILES);

if($success) {
	header('Location: ./about.php?success=yes');
}else{
	header('Location: ./about.php?success=failed');
}

exit();

?>