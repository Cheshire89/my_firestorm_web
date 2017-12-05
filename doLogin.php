<?php 
	require_once('classes/config.php');
	if(isset($_POST['login']) && $_POST['login'] != '' && isset($_POST['password']) && $_POST['password'] != ''){
		$user = new User_Valid();
		$redirect = $user->doLogin($_POST['login'], $_POST['password']);
		
		header("Location: $redirect");
		exit();
		
	}else{
		header('Location: sign-login.php?error=login');
		exit();
	}
?>