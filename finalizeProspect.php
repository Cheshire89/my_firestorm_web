<?php 
	require_once('classes/config.php');
	$user = new Users();
	$info = $user->get_admin_prospect($_SESSION["prospectID"]);
   
	if(isset($info['prospectID']) && $info['archived'] == 'no' && $info['fsAplAgreement'] == '1'){
	    header('Location: payment.php');
	    exit();
	}else{
        header('Location: index.php?error=finalizing_request');
        exit();
	}
    exit();
?>
