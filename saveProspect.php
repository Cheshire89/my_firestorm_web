<?php 
require_once("classes/config.php");

	$fields = $_POST;
	foreach($fields as $key => $val){
		print($key.'<br>');
	}
?>