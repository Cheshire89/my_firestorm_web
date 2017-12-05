<?php 
	require_once('classes/config.php');
	if(isset($_POST["name"]) &&  $_POST["name"] != '' &&
	isset($_POST["email"]) &&  $_POST["email"] != '' &&
	isset($_POST["phone"]) &&  $_POST["phone"] != '' &&
	isset($_POST["evID"]) &&  $_POST["evID"] != ''){

		print('Got Here');

		$ev = new Events();
		$register = $ev->register_to_event_non_user($_POST);
		if($register){
			$em = new sendEmail();
			$send = $em->non_user_registered($_POST);

			if($send){
				print('Success');
			}else{
				print('Error');
			}
		}	
	}



?>