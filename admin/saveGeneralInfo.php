<?php

require_once("classes/config.php");

if(!isset($_SESSION['userID']) || $_SESSION['userID'] == "") {
    header("Location: ../");
    exit();
}

if(isset($_POST["aogaFacebookLink"]) && $_POST["aogaFacebookLink"] != '' &&
isset($_POST["aogaBtnTxt"]) && $_POST["aogaBtnTxt"] != '' &&
isset($_POST["aogaBtnLink"]) && $_POST["aogaBtnLink"] != ''){
    
    $referer = $_SERVER['HTTP_REFERER'];
    
    $db = db::instance();
    
    $facbookLink = $db->real_escape_string($_POST["aogaFacebookLink"]);
    $aogaBtnTxt = $db->real_escape_string($_POST["aogaBtnTxt"]);
    $aogaBtnLink = $db->real_escape_string($_POST["aogaBtnLink"]);
    
    $result = $db->query("UPDATE general SET facebookLink = '$facbookLink', aogaBtnText = '$aogaBtnTxt', aogaBtnLink = '$aogaBtnLink' WHERE gnID = '1'");
    
    if(isset($_FILES['aogaLogo']) && $_FILES['aogaLogo']['name'] != "" && $result) {
        
        $image = uploadImage($_FILES['aogaLogo']);
        
        $updateLogo = $db->query("UPDATE general SET logo = '$image' WHERE gnID = '1'");
        
        
        header("Location: ".$referer."?logo=saved&info=saved"); 
        exit();
    }
    
    header("Location: ".$referer."?logo=saved&info=saved"); 
    exit();
    
}


function uploadImage($file) {
    
    $target_dir = "../uploads/";
    
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0755, true);
    }
    
    $filename = date("U") . "_" . basename($file["name"]);
    $target_file = $target_dir . $filename;
    $target_filepath = "uploads/" . $filename;
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    $name = $file["name"];
    $ext = strtolower(end((explode(".", $name))));
    
    if($ext != "jpg" && $ext != "jpeg" && $ext != "gif" && $ext != "png") {
        $uploadOk = 0;
    }
    
    if($uploadOk == 1) {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            //echo "The file ". basename( $_FILES["main_image"]["name"]). " has been uploaded.";
        } else {
            $target_filepath = "Moving File";
        }
    } else {
        $target_filepath = "Bad File";
    }
    
    return ($target_filepath);
}

?>