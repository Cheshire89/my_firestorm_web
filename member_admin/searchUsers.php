<?php

	require_once('classes/config.php');

	$users = new Users();

	$userEmail = $_POST["userEmail"];
	$userID = $_POST["userID"];

	$searchUser = $users->set_user_search($userEmail, $userID);
	print_r($searchUser);



	// if(isset($_POST["userEmail"]) && $_POST["userEmail"] != ''){
	// 	$searchUser = $users->set_user_search($userEmail, $userID='');
	// }else if(isset($_POST["userID"]) && $_POST["userID"] != ''){
	// 	$searchUser = $users->set_user_search($userEmail='', $userID);
	// }else if(
	// 	isset($_POST["userEmail"]) && 
	// 	$_POST["userID"] != '' && 
	// 	isset($_POST["userID"]) && 
	// 	$_POST["userID"] != ''
	// 	){
	// 	$searchUser = $users->set_user_search($userEmail, $userID);
	// }

	// print_r($searchUser);
?>