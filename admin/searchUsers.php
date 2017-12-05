<?php
	require_once("classes/config.php");
	if(isset($_POST["userName"]) && $_POST["userName"] != '' ||
	   isset($_POST["userID"]) && $_POST["userID"] != ''){

	   $db = db::instance();
	   $users = new Users();
	   
   		if($_POST["userName"] != ''){
		   $fullName = $db->real_escape_string($_POST["userName"]);
           $exName = explode(" ", $fullName);
           $fName = $exName[0];
           $lName = $exName[1];
		   //$fName = substr($fullName, 0, strpos($fullName, ' '));
		   //$lName = substr($fullName, strpos($fullName, ' ')+1);
   		}

   		if($_POST["userID"] != ''){
		   $memID = $db->real_escape_string($_POST["userID"]);
   		}

	   if($fullName != '' && $memID !=''){ 
	       if($lName != "") {
                $query = "SELECT * FROM users WHERE (fName LIKE '%$fName%' || lName LIKE '%$lName%' || userID = '$memID') && archived = 'no' ORDER BY userLevel ASC";
           } else {
                $query = "SELECT * FROM users WHERE (fName LIKE '%$fName%' || userID = '$memID') && archived = 'no' ORDER BY userLevel ASC";
           }
	   }else if($fullName != ''){
            if($lName != "") {
                $query = "SELECT * FROM users WHERE (fName LIKE '%$fName%' || lName LIKE '%$lName%') && archived = 'no' ORDER BY userLevel ASC";
            } else {
                $query = "SELECT * FROM users WHERE (fName LIKE '%$fName%') && archived = 'no' ORDER BY userLevel ASC";
            }
	   }else if($memID != ''){
	   		$query = "SELECT * FROM users WHERE userID = '$memID' && archived = 'no' ORDER BY userLevel ASC";
	   }
       
		$srchResult = $db->query($query);

		$html = $users->print_user_president($srchResult);
		print($html);
	} else{
		print('error');
	}
?>