<?php

class Users EXTENDS fireSQL {
    
    function __constructor() {
        
    }
    
    /**
     *  Retrieves all users and returns admin display
     *  
     *  @return varchar; 
     **  
    */

    function get_user_info($userID){
       //$getUser = $this->select("users", array("*"), array("userID"=>$userID));
       $db = db::instance();
       $getUser = $db->query("SELECT u.*, i.industryName FROM users u LEFT JOIN industry i ON i.inID = u.companyIndustry WHERE u.userID = '$userID'");
       return $getUser->fetch_assoc();
    }

    function print_admin_edit_user_expertise_list($expertiseString){
       $resultHTML = '';
       $expListArr = explode('/', $expertiseString);
       foreach($expListArr as $key=>$val){
          $resultHTML .= '<li class="input-group" data-id="'.$key.'"><span>'.$val.'</span>
                            <div class="input-group-addon">
                              <button type="button" class="btn btn-xs edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                              <button type="button" class="btn btn-xs delete"><i class="fa fa-times" aria-hidden="true"></i></button>
                            </div>
                          </li>';
       }
       return $resultHTML;
    }

    function print_admin_user_expertise_list($expertiseString){
      $resultHTML = '';
       $expListArr = explode('/', $expertiseString);
       foreach($expListArr as $key=>$val){
          $resultHTML .= '<li>'.$val.'</li>';
       }
       return $resultHTML;
    }

    
    /**
     *  Retrieves all prospects and returns admin display
     *  
     *  @return varchar; 
     **  
    */

    function print_user_president($data){
        $resultHTML = '';
        while($row = $data->fetch_assoc()){
                $name = $row["fName"].' '.$row["lName"];
                $resultHTML .= '<tr>
                                    <td><img class="img-responsive" src=".'.$row["profPic"].'" alt="'.$name.'"></td>
                                    <td>'.$name.'</td>
                                    <td>'.$row["companyName"].'</td>
                                    <td class="controls saveChapterAdmin">
                                       <div class="form-group">
                                         <input type="radio" name="users" id="user'.$row["userID"].'" class="form-control hidden" data-id="'.$row["userID"].'">
                                         <label for="user'.$row["userID"].'"></label>
                                       </div>
                                    </td>
                                  </tr>';
            }
        return $resultHTML;
    }

    function get_admin_prospects(){
        $resultHTML = '';
        $tableData = $this->select("prospects", array("*"), array("archived" => "no"));
        
        while($row = $tableData->fetch_assoc()) {
            $prospectID = $row['prospectID'];
            $prospectName = $row["fName"].' '.$row["lName"];
            
            if($row["converted"] == 'no'){
                if(isset($row["profPic"]) && $row["profPic"] == ''){
                  $row["profPic"] = './img/placeholder_user.png';
                }
                $resultHTML .= '<tr>
                                  <td><a href="prospectInfo.php?prospectID='.$prospectID.'" title="'.$prospectName.' profile"><img class="img-responsive" src="../'.$row["profPic"].'" alt="'.$prospectName.'"></a></td>
                                  <td><a href="prospectInfo.php?prospectID='.$prospectID.'">'.$prospectName.'</a></td>
                                  <td class="text-center">'.$prospectID.'</td>
                                  <td>'.$row["industry"].'</td>
                                  <td class="controls">
                                     <div class="checkbox">
                                        <input type="checkbox" id="'.$prospectID.'" value="" name="prospects">
                                      <label for="'.$prospectID.'">
                                      </label>
                                    </div>
                                  </td>
                                </tr>';
              
            }
        }
        
        return $resultHTML;
    }

    function get_admin_users(){
       //$tableData = $this->select("users", array("*"),array('archived'=>'no','userLevel'));
       $db = db::instance();
       $tableData = $db->query("SELECT u.*, i.industryName FROM users u LEFT JOIN industry i ON i.inID = u.companyIndustry WHERE u.archived = 'no' && u.userLevel != 'admin' && u.userLevel != 'unpaid_member'");
       return $this->user_table_html($tableData);
    }
       
    function get_admin_users_archived(){
       $tableData = $this->select("users", array("*"),array('archived'=>'yes'));
       $userResult = $this->user_table_html($tableData);
       
       $tableData = $this->select("prospects", array("*"),array('archived'=>'yes'));
       $prospectResult = $this->prospects_table_html($tableData);
       
       return ($userResult.$prospectResult);
    }

    function user_table_html($data){
        $resultHTML = '';
        while($row = $data->fetch_assoc()) {
               ;
            $userID = $row['userID'];
            $prospectName = $row["fName"].' '.$row["lName"];
            if(isset($row["profPic"]) && $row["profPic"] == ''){
                  $row["profPic"] = './img/placeholder_user.png';
            }
            
                $resultHTML .= '<tr>
                                  <td><a href="profile.php?user='.$userID.'" title="'.$prospectName.' profile"><img class="img-responsive" src=".'.$row["profPic"].'" alt="'.$prospectName.'"></a></td>
                                  <td><a href="profile.php?user='.$userID.'" title="'.$prospectName.' profile">'.$prospectName.'</a></td>
                                  <td class="text-center">'.$userID.'</td>
                                  <td>'.$row["industryName"].'</td>
                                  <td class="controls">
                                     <div class="checkbox">
                                        <input type="checkbox" id="memId'.$userID.'" value="'.$userID.'" name="prospects">
                                      <label for="memId'.$userID.'">
                                      </label>
                                    </div>
                                  </td>
                        
                                </tr>';
            

        }
        
        return $resultHTML;
    }
    
    function prospects_table_html($data){
        $resultHTML = '';
        while($row = $data->fetch_assoc()) {
               ;
            $userID = $row['prospectID'];
            $prospectName = $row["fName"].' '.$row["lName"];
            if(isset($row["profPic"]) && $row["profPic"] == ''){
                  $row["profPic"] = './img/placeholder_user.png';
            }
            
                $resultHTML .= '<tr>
                                  <td><a href="prospectInfo.php?prospectID='.$userID.'" title="'.$prospectName.' profile"><img class="img-responsive" src=".'.$row["profPic"].'" alt="'.$prospectName.'"></a></td>
                                  <td><a href="prospectInfo.php?prospectID='.$userID.'" title="'.$prospectName.' profile">'.$prospectName.'</a></td>
                                  <td class="text-center">'.$userID.'</td>
                                  <td>'.$row["companyIndustry"].'</td>
                                  <td class="controls">
                                     <div class="checkbox">
                                        <input type="checkbox" id="memId'.$userID.'" value="'.$userID.'" name="prospects">
                                      <label for="memId'.$userID.'">
                                      </label>
                                    </div>
                                  </td>
                        
                                </tr>';
            

        }
        
        return $resultHTML;
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

    function print_member_groups($prospectInfo){
        $resultHTML = '';
        foreach($prospectInfo as $key=>$val){
            if($key[0] === 'g' && $key != 'groups' && $val != '' && $val != NULL){
               $resultHTML .= '<li class="list-group-item col-md-6">'.$val.'</li>';
            }
        }
        return $resultHTML;
    }

    function print_important_groups($prospectInfo){
        $resultHTML = '';
        foreach($prospectInfo as $key=>$val){
            if(substr($key, 0,2) == 'pg' && $val != '' && $val != NULL){
               $resultHTML .= '<li class="list-group-item col-md-6">'.$val.'</li>';
            }
        }
        return $resultHTML;
    } 

    function get_chapters_enrolled($userID){
      $chaptersSet = $this->select('chaptersEnrolled', array("chapterID"), array("userID"=>$userID));
      if($chapters->num_rows != 0){
        return $cahptersSet;
      }else{
        print_r("Error - The user have not signed up into any chapters");
      }
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
        
        switch($type) {
            case "text":
                $value = $db->real_escape_string($value);
                break;
            case "file":
                $upload = new upload_image($value[$field],"../usersFiles/".$userID."/");
                if($field == "covPic") {
                    $covBlur = $upload->create_blur_image($upload->uploaded_file);
                }
                $value = substr($upload->uploaded_file, 1);
                break;
        }
        //print("USER: ".$userID);
        $updateProspects = $this->update($table, array($field), array($value), array("userID" => $userID));
    }
    
    function saveUser($post, $files){
        $db = db::instance();
        foreach($post as $key => $var) {
            ${$key} = $var;
        }
        $addUser = $this->insert("users", array("email", "hash", "fName", "lName"), array($email, hash('sha512', $pass), $fName, $lName));
        return $addUser;
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
        
        if(isset($email) && $email != "" && isset($password) && $password != "") {
            $getUser = $this->select("users", array("*"), array("email"=>$email));
            $getProspects = $this->select("prospects", array("*"), array("email"=>$email));
            if($getUser->num_rows == 0 && $getProspects->num_rows == 0) {
                
                $addUser = $this->insert("prospects", array("email", "hash"), array($email, hash('sha512', $password)));
                $_SESSION['prospectID'] = $addUser->insert_id;
                
                return "Success";
            } else {
                return "Error";
            }
            
        } else {
            return "Error Adding User"; 
        }   
    }
    
    /**
     *  Converts prospect into User and returns its id
     *  
     *  @param int $prospectID for the prospect you wish to convert
     * 
     *  @return int $userID; 
     **  
    */
    
    function admin_convert_prospect($prospectID) {

        $db = db::instance();
        //$arrFields = array();
        $prospectID = $db->real_escape_string($prospectID);
        //get prospect info
        $getProspect = $this->select("prospects", array("*"), array("archived" => "no", "prospectID" => $prospectID));
        $prospect = $getProspect->fetch_assoc();


        if($prospect['converted'] == 'no'){
                $arrFields = array(
                    'applicationID',
                    'email',
                    'hash',
                    'customerID',
                    'paymentID',
                    'dateApproved',
                    'dateLastLogin',
                    'paymentStatus',
                    'fName',
                    'lName',
                    'bio',
                    'linkedIn',
                    'profPic',
                    'covPic',
                    'companyName',
                    'companyPosition',
                    'companyAddress',
                    'companyAddressCont',
                    'companyCity',
                    'companyState',
                    'companyZip',
                    'companyPhone',
                    'companyEmail',
                    'companyWeb',
                    'companyLogo',
                    'companyIndustry'
                    );
                $values = array(
                    $prospect['prospectID'],
                    $prospect['email'],
                    $prospect['hash'],
                    $prospect['customerProfileID'],
                    $prospect['paymentProfileID'],
                    date('U'),
                    date('U'),
                    0,
                    $prospect['fName'],
                    $prospect['lName'],
                    $prospect['bio'],
                    $prospect['linkedInLink'],
                    $prospect['profPic'],
                    $prospect['covPic'],
                    $prospect['compName'],
                    $prospect['compPos'],
                    $prospect['compAddOne'],
                    $prospect['compAddTwo'],
                    $prospect['compCity'],
                    $prospect['compState'],
                    $prospect['compZip'],
                    $prospect['compPhone'],
                    $prospect['compEmail'],
                    $prospect['compWeb'],
                    $prospect['compLogo'],
                    $prospect['industry'],
                    );

                $userID = $this->insert("users", $arrFields, $values);
                
                if($userID){
                    
                    $prospectUpdated = $this->update("prospects", array('converted', 'dateConverted'),array('yes',date('U')), array("prospectID" => $prospectID));

                    $this->insert('chaptersEnrolled', array("userID", "chapterID"), array($userID, $prospect["groups"]));
                }

            $name = $prospect['fName'].' '.$prospect['lName'];
            
            $sendEmail = new sendEmail();
            $sendEmail->approve_prospect($userID, $name);
            
            $sendEmail->adminNotify_ProspectApproval($userID, $name);

            return $userID;
        }else{
            print_r('User with given application exists');
        }
    }

    function admin_archive_prospect($prospectID){
            $db = db::instance();
            $prospectID = $db->real_escape_string($prospectID);
            $archived = $this->update('prospects', array('archived','converted','subscriptionSet','customerProfileID', 'paymentProfileID'), array('yes','no','0','0','0'), array('prospectID'=>$prospectID));
            
            //get prospect info
            $getProspect = $this->select("prospects", array("*"), array("archived" => "no", "prospectID" => $prospectID));
            $prospect = $getProspect->fetch_assoc();
            $name = $prospect['fName'].' '.$prospect['lName'];
                
            $sendEmail = new sendEmail();    
            $sendEmail->adminNotify_ProspectRejection($prospectID, $name);
    }

    function delete_prospect($prospectID){
            $db = db::instance();
            $prospectID = $db->real_escape_string($prospectID);
            $deleted = $this->delete('prospects', array("prospectID"=>$prospectID));
            return $deleted;
    }
    
}

?>