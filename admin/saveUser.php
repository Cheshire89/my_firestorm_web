<?php

require_once("classes/config.php");

$checkUser = new User_Valid();
if(!$checkUser->isLoggedIn()){
    header('Location: /');
    exit();
}

$user =  new Users();

    if(isset($_POST["email"]) && $_POST["email"] != "" && isset($_POST["pass"]) && $_POST["pass"] != "" && isset($_POST["fName"]) && $_POST["fName"] != "" && isset($_POST["lName"]) && $_POST["lName"] != ""){
        
        $users = new Users();
        $newuser = $users->saveUser($_POST);
        if($newuser){
            header('Location: ./profile-edit.php?user='.$newuser);
            exit();
        }else{
            header('Location: ./createUser.php?save=error');
            exit();
        }
        
    }

?>