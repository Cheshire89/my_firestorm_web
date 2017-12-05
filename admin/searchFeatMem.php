<?php

require_once("classes/config.php");

if(isset($_POST['featMemName']) && isset($_POST['featMemEmail']) && ($_POST['featMemEmail'] != "" || $_POST['featMemName'] != "")) {
    
    $db = db::instance();
    
    $featMemName = $db->real_escape_string($_POST['featMemName']);
    $featMemEmail = $db->real_escape_string($_POST['featMemEmail']);
    $results = "";

    $searchMembers = $db->query("SELECT * FROM users WHERE fName like '%$featMemName%' || lName like '%$featMemName%' || email LIKE '%$featMemEmail%' && archived = 'no'");
    while($row = $searchMembers->fetch_assoc()) {
        
        $fName = $row['fName'];
        $lName = $row['lName'];
        $name = $fName . " " . $lName;
        $profPic = $row['profPic'];
        $companyIndustry = $row['companyIndustry'];
        $userID = $row['userID'];
        
        $results .= '<tr>
                    <td><img class="img-responsive" src="../'.$profPic.'" alt="Member Name"></td>
                    <td>'.$name.'</td>
                    <td>'.$companyIndustry.'</td>
                    <td class="controls">
                       <div class="form-group">
                          <!-- Set Member Id for the label.for and input.id -->
                         <input type="radio" name="setFeatMem" id="memId'.$userID.'" value="'.$userID.'" class="form-control hidden">
                         <label for="memId'.$userID.'"></label>
                       </div>
                    </td>
                  </tr>';
        
    }
    
    print($results);
    
} else {
    print("error");
}


?>