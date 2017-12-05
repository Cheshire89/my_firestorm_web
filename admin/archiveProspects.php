<?php 
	require_once("classes/config.php");

    $checkUser = new User_Valid();
    if(!$checkUser->isLoggedIn()){
        header('Location: /');
        exit();
    }
    
	if(isset($_POST["prospects"]) && $_POST["prospects"] != ''){
		$user = new Users();
		$prospects = $_POST["prospects"];
		$results = array();
		foreach($prospects as $prospect){
			$result = $user->admin_archive_prospect($prospect);
			if($result){
				array_push($results, 'success');
			}
		}
		return $results;
	}
?>