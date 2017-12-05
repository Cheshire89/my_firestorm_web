<?php

class Users EXTENDS fireSQL {
    
    function Users() {
        
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

    function set_user_search($userEmail, $userID){
        $db = db::instance();
        $userEmail = $db->real_escape_string($userEmail);
        $userID = $db->real_escape_string($userID);

        if($userEmail != "") {
            $searchArray = array("email" => $userEmail);
        }

        if($userID != "") {
            if($searchArray != "") {
                $searchArray = array_push($searchArray, array("userID" => $userID));
            } else {
                $searchArray = array("userID" => $userID);
            }
        }

        $data = $this->select("users", array("*"), $searchArray);

        $resultHTML = '';
        while($row = $data->fetch_assoc()){
                $name = $row["fName"].' '.$row["lName"];
                $resultHTML .= '<tr>
                                    <td><img class="img-responsive" src=".'.$row["profPic"].'" alt="'.$name.'"></td>
                                    <td>'.$name.'</td>
                                    <td class="text-center">'.$row["userID"].'</td>
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

    function get_admin_prospects($chaptersData){
                //Get List Of Users From Associated Chapters
          $users = array();
          
          foreach($chaptersData as $chunk){
               
            $val = $chunk["chapterID"];
            
            $mysqlObj = $this->select("prospects", array("*"), array("groups" => $val));
            while($inner =  $mysqlObj->fetch_assoc()){
                array_push($users, $inner["prospectID"]);
            }
          }

           $userData = array();
           $resultHTML = '';
        

           foreach($users as $user){
              $dataResult = $this->select("prospects", array("prospectID","converted", "fName","lName","profPic", "industry", "applicationFee"), array("prospectID"=>$user));

                while($row = $dataResult->fetch_assoc()) {
                    $prospectID = $row['prospectID'];
                    $prospectName = $row["fName"].' '.$row["lName"];
                    // print('<pre>'); 
                    //   print_r($row);
                    // print('</pre>');
                    if($row["applicationFee"] == 1 && $row["converted"] == 'no'){
                        $resultHTML .= '<tr>
                                          <td><a href="prospectInfo.php?prospectID='.$prospectID.'" title="'.$prospectName.' profile"><img class="img-responsive" src=".'.$row["profPic"].'" alt="'.$prospectName.'"></a></td>
                                          <td>'.$prospectName.'</td>
                                          <td class="text-center">'.$prospectID.'</td>
                                          <td>'.$row["industry"].'</td>
                                          <td class="controls">
                                             <div class="checkbox">
                                                <input type="checkbox" id="memId'.$prospectID.'" value="" name="prospects">
                                              <label for="memId'.$prospectID.'">
                                              </label>
                                            </div>
                                          </td>
                                        </tr>';
                      
                    }
                }

           }

          return $resultHTML;
        

        
        // return $resultHTML;
    }

    function getChapterUsers($chaptersData){
        //Get List Of Users From Associated Chapters
          $users = array();
          
          foreach($chaptersData as $chunk){
              
               $val = $chunk["chapterID"];
               $mysqlObj = $this->select("chaptersEnrolled", array("userID"), array("chapterID" => $val));
               while($inner =  $mysqlObj->fetch_assoc()){
                  array_push($users, $inner["userID"]);
               }
           }

           //Remove Dublicate Entries
           $users = array_unique($users);
           $userData = array();
           $resultHTML = '';

           foreach($users as $user){
              $dataResult = $this->select("users", array("userID", "fName", "lName", "companyIndustry", "profPic"), array("userID"=>$user));

               while($row = $dataResult->fetch_assoc()) {
               
                    $userID = $row['userID'];
                    $prospectName = $row["fName"].' '.$row["lName"];
                    
                    $resultHTML .= '<tr>
                                      <td><a href="profile.php?user='.$userID.'" title="'.$prospectName.' profile"><img class="img-responsive" src=".'.$row["profPic"].'" alt="'.$prospectName.'"></a></td>
                                      <td>'.$prospectName.'</td>
                                      <td class="text-center">'.$userID.'</td>
                                      <td>'.$row["companyIndustry"].'</td>
                                      <td class="controls">
                                         <div class="checkbox">
                                            <input type="checkbox" id="memId'.$userID.'" value="" name="user">
                                          <label for="memId'.$userID.'">
                                          </label>
                                        </div>
                                      </td>
                            
                                    </tr>';
                }
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
            print_r($value[$field]);
                $upload = new upload_image($value[$field],"../usersFiles/".$userID."/");
                $value = substr($upload->uploaded_file, 1);
                break;
        }
        $updateProspects = $this->update($table, array($field), array($value), array("userID" => $userID));
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
            if($getUser->num_rows == 0 && $getProspects->num_rows ) {
                
                $addUser = $this->insert("prospects", array("email", "hash"), array($email, hash('sha512', $password)));
                $_SESSION['prospectID'] = $addUser;
            }
            return $addUser;
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

                    if($prospectUpdated){
                      $addProspectToChapter = $this->insert('chaptersEnrolled', array('userID', 'chapterID'), array($userID, $prospect["groups"]));
                    }
                }
            
            $sendEmail = new sendEmail();
            $sendEmail->approve_prospect($userID);
            return $userID;
        }else{
            print_r('User with given application exists');
        }
    }

    function delete_prospect($prospectID){
            $db = db::instance();
            $prospectID = $db->real_escape_string($prospectID);
            $deleted = $this->delete('prospects', array("prospectID"=>$prospectID));
            return $deleted;
    }
    
}

?>