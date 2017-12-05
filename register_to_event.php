<?php

require_once("classes/config.php");

$checkUser = new User_Valid();

if(!$checkUser->isLoggedIn()){
    if(isset($_GET["eventID"]) && $_GET["eventID"] != ""){
    	header('Location: event.php?eventID='.$eventID.'&error=userLevel');
	    exit();
    }else{
	    header('Location: /');
    	exit();
    }
}

if(isset($_SESSION["userID"]) && $_SESSION["userID"] != ""
   && isset($_GET["eventID"]) && $_GET["eventID"] != ""){
   $userID = $_SESSION["userID"];
   $eventID = $_GET["eventID"];

   $events =  new Events();
   $result = $events->register_to_event($userID, $eventID);
   if($result){
   	   header('Location: event.php?eventID='.$eventID.'&rsvp=success');
   	   exit();
   }else{
   	   header('Location: event.php?eventID='.$eventID.'&rsvp=error');
   	   exit();
   }
}
?>