<?php 
    require_once('classes/config.php');
    if(isset($_POST["userID"]) && $_POST["userID"] != ''){
        $userID = $_POST["userID"];
        $payment = new Payment($userID);
        $remainingPayment = $payment->calculate_remaining_payment();
    }
    
?>