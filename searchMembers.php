<?php 
	require_once("classes/config.php");
	if((isset($_POST["firstName"]) && $_POST["firstName"] != '') || (isset($_POST["lastName"]) && $_POST["lastName"] != '') || (isset($_POST["industry"]) && $_POST["industry"] != '')){

	   $db = db::instance();
	   $users = new Users();
	   $fields = array();
	   
	   $firstName = $db->real_escape_string($_POST["firstName"]);
	   $lastName = $db->real_escape_string($_POST["lastName"]);
       $industry = $db->real_escape_string($_POST['industry']);

	   $fieldsLen = count($fields);
       
	   $query = "SELECT * FROM users WHERE ";
       if($firstName != "") {
            $search .= " fName LIKE '%$firstName%' ";
       }
       
       if($lastName != "") {
            if($search != "") {
                $search .= "|| lName LIKE '%$lastName%' ";
            } else {
                $search = " lName LIKE '%$lastName%' ";
            }
       }
       
       if($industry != "") {
            if($search != "") {
                $search .= " || companyIndustry = '$industry' ";
            } else {
                 $search = " companyIndustry = '$industry' ";
            }
       }
       
       $query .= $search . " ORDER BY userLevel ASC";
    
		$srchResult = $db->query($query);
		$html = $users->print_members($srchResult);

		print($html);
	} else{
		print('error');
	}
?>