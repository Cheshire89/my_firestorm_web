<?php

class Users EXTENDS fireSQL {
    
    function Users() {
        
    }

    function get_user_info($userID){
       //$getUser = $this->select("users", array("*"), array("userID"=>$userID));
       $db = db::instance();
       $getUser = $db->query("SELECT u.*, i.industryName FROM users u LEFT JOIN industry i ON i.inID = u.companyIndustry WHERE u.userID = '$userID'");
       return $getUser->fetch_assoc();
    }

    function get_all_users(){
        //$getUsers = $this->select('users', array("*"), array("archived"=>"no"));.
        $db = db::instance();
        $getUsers = $db->query("SELECT u.*, i.industryName FROM users u LEFT JOIN industry i ON u.companyIndustry = i.inID WHERE u.archived = 'no' && u.userLevel != 'admin' && u.userLevel != 'unpaid_member'");
        return $getUsers;
    }

    function print_members($data = null){
        $usersData = $this->get_all_users();
        $resultHTML = '';

        if($data){
            $usersData = $data;
        }else{
            $usersData = $this->get_all_users();
        }
        
        while($row = $usersData->fetch_assoc()){
        if($row["profPic"] == ''){
            $row["profPic"] = 'img/placeholder_user.png';
        }
        $resultHTML .= '<div class="col-xs-6 col-sm-4 col-md-3  text-center featured-member">
              <a href="profile.php?user='.$row["userID"].'" title="'.$row["fName"].' '.$row["lName"].'">
                  <img class="img-responsive img-circle center-block" src="'.$row["profPic"].'" alt="'.$row["fName"].' '.$row["lName"].' Avatar">
              </a>
              <h4 class="fs-header" style="min-height: 19px;">'.$row["fName"].' <span class="fs-strong">'.$row["lName"].'</span></h4>
              <p class="fs-header-black h5" style="min-height: 15px;">'.$row["industryName"].'</p>
          </div>';
        }
        return $resultHTML;
    }
    
    function print_user_expertise_list($expertiseString){
       $resultHTML = '';
       $expListArr = explode('/', $expertiseString);

       foreach($expListArr as $key=>$val){
          $resultHTML .= '<li class="input-group""><span>'.$val.'</span>
                          </li>';
       }
       return $resultHTML;
    }


    
    function get_admin_users() {
        $db = db::instance();
        
        $getUsers = $this->select("users", array("*"), array("archived" => "no"));
        while($row = $getUsers->fetch_assoc()) {
            $userID = $row['userID'];
        }
        return $results;
    }
    
    /**
     *  Retrieves all prospects and returns admin display
     *  
     *  @return varchar; 
     **  
    */
    function get_admin_prospects() {
        $db = db::instance();
        
        $getProspects = $this->select("prospects", array("*"), array("archived" => "no"));
        while($row = $getProspects->fetch_assoc()) {
            $prospectID = $row['prospectID'];   
        }
        return $results;
    }
    
    /**
     *  Retrieves all prospect info and returns admin display
     *  
     *  @param int $prospectID for the prospect you wish to retrieve
     * 
     *  @return prospect array; 
     **  
    */
    function get_admin_prospect($prospectID) {
        $db = db::instance();
        $prospectID = $db->real_escape_string($prospectID);
        $getProspect = $this->select("prospects", array("*"), array("archived" => "no", "prospectID" => $prospectID));
        $row = $getProspect->fetch_assoc();
        return $row;
    }
    
/**
     *  Inserts data into the prospects table.
     *  
     *  Function will handle both text and file type inputs for saving in the prospects table. Returns true / false if save succeeds
     *  
     *  @param string $field for the field you wish to save
     *  @param string $value for the value of the field
     *  @param string $type for the type of variable we're saving
     * 
     *  @return boolean; 
     **  
    */
    function saveField($field, $value, $type, $table, $userID) {
        $db = db::instance();
        //error_log("saveField");
        switch($type) {
            case "text":
                $value = $db->real_escape_string($value);
                break;
            case "file":
                //error_log("file: ".$field);
                $upload = new upload_image($value[$field],"usersFiles/".$userID."/",array("jpeg","jpg","gif","png"));
                //error_log("upload".$upload->uploaded_file);
                if($field == "covPic" && $upload != "false") {
                    //error_log("covPic".$upload->uploaded_file);
                    $covBlur = $upload->create_blur_image($upload->uploaded_file);
                    //error_log("covBlur".$covBlur);
                }
                $value = $upload->uploaded_file;
                break;
        }
        
        if($value != "false") {
            $updateProspects = $this->update($table, array($field), array($value), array("prospectID" => $userID));
            if($updateProspects == 1) {
                print("Success");
            }
        } else {
            print("Error");
        }
    }
    /**
     *  Inserts data into the specified table.
     *  
     *  The form data to create an intial prospect user. The password will be SHA512 hashed. 
     *  
     *  @param array of $post variables
     * 
     *  @return int $insert_id or varchar error message; 
     **  
    */
    function createNewUser($post) {
        foreach($post as $key => $var) {
            ${$key} = $var;
        }
        //print("email: ".$email);
        //print("pass: ".$password);
        
        if(isset($email) && $email != "" && isset($password) && $password != "") {
            $getUser = $this->select("users", array("*"), array("email"=>$email));
            $getProspects = $this->select("prospects", array("*"), array("email"=>$email));
            //print("un: ".count($getUser->fetch_assoc()));
            //print("pn: ".$getProspects->num_rows);
            if($getUser->num_rows == 0 && $getProspects->num_rows == 0) {
                
                $addUser = $this->insert("prospects", array("email", "hash"), array($email, hash('sha512', $password)));
                $_SESSION['prospectID'] = $addUser;
                $_SESSION['email'] = $email;

                    if($addUser){
                        $updatProgress = $this->update('prospects', array('prospectFormPage'), array('1'), array('prospectID' => $addUser));
                        
                    }

                
                return "Success: '".$addUser."'";
            } else {
                return "Error";
            }
            
        } else {
            return "Error Adding User"; 
        }   
    }
}

?>