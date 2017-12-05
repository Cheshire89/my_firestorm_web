<?php 
	class Chapters extends fireSQL{
		
		public $action;
		public $placeholder;
		
		function Chapters(){
			$this->action ="Create";
			$this->placeholder = 'http://placehold.it/880x320?text=Chapter+Image';
		}
	
		function getChapter($chapterID = null){
			if($chapterID != null){
				$this->action = 'Edit';
				$returnArr = array();
				$db = db::instance();

				

				$chapterID = $db->real_escape_string($chapterID);

				$result = $this->select('chapters', array("chapterName", "chapterAddress", "chapterCity", "chapterState", "chapterZip", "chapterDesc", "chapterImg","chapterID"), array('chapterID' => $chapterID));
				 
				$row = $result->fetch_assoc();


				if($row["chapterImg"] != ''){
                    $this->placeholder = $row["chapterImg"];
                }

				return $row;
			}
		}

	    function getListChapters(){
	    	$db = db::instance();
	    	$resultArr = array();
	    	$result = $this->select('chapters', array("*"), array('chapterAdminID'=> $_SESSION["userID"]));
	    	while($row = $result->fetch_assoc()){
	    		array_push($resultArr, $row);
	    	}
	    	return $resultArr;
	    }

	    function printChaptersOption($active){
	    	$resultHTML = '';
	    	$list = $this->getListChapters();
	    	foreach($list as $item){
	    		if(isset($active) && $active == $item["chapterID"]){
	    			$resultHTML .= '<option value="'. $item["chapterID"] .'" selected="selected">'.$item["chapterName"].'</option>';
	    		}else{
		    		$resultHTML .= '<option value="'. $item["chapterID"] .'">'.$item["chapterName"].'</option>';
	    		}
	    	}
	    	return $resultHTML;
	    }

	   	function getChapterUsers($chapterID){
	   	}

	   	function getMembers($chapterID){
			$users = $this->select('chaptersEnrolled',array("userID"),array("chapterID"=>$chapterID));

			if($users->num_rows == 1){
				$dataUsers = $users->fetch_assoc();
				$allUsers = $this->select('users',array("*"),$dataUsers,"OR");
				return $allUsers;
			}else if($users->num_rows == 0){
				return false;
			}else{
				$usersData = array();
				while($row = $users->fetch_assoc()){
					$userMysqlObj = $this->select("users", array("*"),array("userID"=>$row["userID"]));
					array_push($usersData, $userMysqlObj);
				}
				return $usersData;
				// print('<pre>');
				// 	print_r($usersData);
				// print('</pre>');
			}
		}

		function printAdminChapterMembers($chapterID){
			
			$data = $this->getMembers($chapterID);
			// print('<pre>');
			// print_r($data);
			// print('</pre>');

			if($data){
				$resultHTML = '';
				if(count($data) == 1){
					while($row = $data->fetch_assoc()){
						$name = $row["fName"].' '.$row["lName"];
						$resultHTML .= '<div class="col-xs-6 col-sm-4 col-md-3 member">
					                        <a href="profile.php?user='.$row["userID"].'" title="'.$name.'" class="text-center">
					                        <img class="img-responsive img-circle center-block" src=".'.$row["profPic"].'" alt="'.$name.' Profile Picture"/>
					                        
					                        <h4 class="fs-header">'.$row["fName"].' <strong>'.$row["lName"].'</strong></h4>
					                        <p class="fs-header-black h5">'.$row["companyIndustry"].'</p>
					                        </a>
					                      </div>';
					}
					return $resultHTML;
				}else if(count($data) > 1){
					foreach($data as $chunk){
						while($row = $chunk->fetch_assoc()){
								$name = $row["fName"].' '.$row["lName"];
								$resultHTML .= '<div class="col-xs-6 col-sm-4 col-md-3 member">
					                        <a href="profile.php?user='.$row["userID"].'" title="'.$name.'" class="text-center">
					                        <img class="img-responsive img-circle center-block" src=".'.$row["profPic"].'" alt="'.$name.' Profile Picture"/>
					                        
					                        <h4 class="fs-header">'.$row["fName"].' <strong>'.$row["lName"].'</strong></h4>
					                        <p class="fs-header-black h5">'.$row["companyIndustry"].'</p>
					                        </a>
					                      </div>';
							}
					}
					return $resultHTML;
				}
			}
		}

		function getAdminChapters(){
			$adminID = $_SESSION["userID"];
			$data = $this->select('chapters',array("chapterName", "chapterAddress", "chapterCity", "chapterState", "chapterZip", "chapterDesc", "chapterImg","chapterID"), array('chapterAdminID'=>$adminID));
			if($data->num_rows != 0){
				return $data;
			}else{
				print("Error - The user does not have associated chapters as admin");
			}
		}

		function printAdminChapters(){
			$resultHTML = '';
			$data = $this->getAdminChapters();
			while($row = $data->fetch_assoc()){
				$resultHTML .= '<tr>
		                            <td><a href="createChapter.php?chapterID='.$row["chapterID"].'" title="'.$row["chapterName"].'"><img class="img-responsive center-block" src="'.$row["chapterImg"].'" alt="'.$row["chapterName"].' Cover Image"></a></td>
		                            <td class="title">'.$row["chapterName"].'</td>
		                            <td class="city">'.$row["chapterCity"].'</td>
		                            <td class="state">'.$row["chapterState"].'</td>
		                            <td class="zip">'.$row["chapterZip"].'</td>
		                            <td>
		                              <div class="checkbox">
		                                  <input type="checkbox" id="chapter'.$row["chapterID"].'" value="'.$row["chapterID"].'" name="articles">
		                                   <label for="chapter'.$row["chapterID"].'">
		                                </label>
		                              </div>
		                            </td>
		                          </tr>';
			}
			return $resultHTML;
		}
		
		function saveChapter($post, $files){
			$db = db::instance();
			foreach($post as $key => $var) {
				${$key} = $db->real_escape_string($var);
			}

			if($files['chapterImg']["tmp_name"] != ""){
				$image = new upload_image($files['chapterImg'], '../chapters/', array('jpg', 'png', 'gif', 'jpeg'));
			}

			// articleDate - (The date article was created) - Printed Format mm/dd/yy
			$chapterCreationDate = date('U');

		    $insertID = $this->insert('chapters', array("chapterName", "chapterAddress", "chapterCity", "chapterState", "chapterZip", "chapterDesc","chapterCreationDate","chapterImg"), array($chapterName, $chapterAddress, $chapterCity, $chapterState, $chapterZip, $chapterDesc, $chapterCreationDate, $image->uploaded_file));

		    return $insertID;
		}
		
		function updateChapter($post, $files){
			$db = db::instance();

			foreach($post as $key => $var) {
				${$key} = $db->real_escape_string($var);
			}

			if($files['chapterImg']["tmp_name"] != ""){
				$image = new upload_image($files['chapterImg'], '../chapters/', array('jpg', 'png', 'gif', 'jpeg'));
			}

			if($image != ""){
			    $this->update('chapters', array("chapterName", "chapterAddress", "chapterCity", "chapterState", "chapterZip", "chapterDesc", "chapterImg"), array($chapterName, $chapterAddress, $chapterCity, $chapterState, $chapterZip, $chapterDesc, $image->uploaded_file), array('chapterID'=>$chapterID));
			}else{
				$this->update('chapters', array("chapterName", "chapterAddress", "chapterCity", "chapterState", "chapterZip", "chapterDesc"), array($chapterName, $chapterAddress, $chapterCity, $chapterState, $chapterZip, $chapterDesc), array('chapterID'=>$chapterID));
			}
			return true;
		}
		
		function deleteChapter($chapterId){
			$db = db::instance();
			$chapterId = $db->real_escape_string($chapterId);
			$this->delete('chapters',array("chapterID" => $chapterId));
		}
		
        function setChapterAdmin($userID,$chapterID) {
            $update = $this->update('chapters', array("chapterAdminID"), array($userID), array('chapterID'=>$chapterID));
            if($update->affected_rows != 0) {
                return "Good";
            } else {
                return "Bad";
            }
        }

        function assignChapter($userId, $chapterId){
        	$matchingResult = $this->select("chaptersEnrolled", array("ceID"), array("userID"=>$userId, "chapterID" => $chapterId));

        	if($matchingResult->num_rows == 0){
	        	$insertID = $this->insert("chaptersEnrolled", array("userID","chapterID"), array($userId, $chapterId));
	        	
	        	print_r('Success - The user was added');
	        	return $insertID;
        	}else{
        		print_r('Error - The user has already signed up for this chapter');
        	}
        }

        function removeUserFromChapter($userId, $chapterId){
        	$matchingResult = $this->select("chaptersEnrolled", array("ceID"), array("userID"=>$userId, "chapterID" => $chapterId));
        	
        	$search = $matchingResult->fetch_assoc();
			$result = $this->delete('chaptersEnrolled', array("ceID"=>$search["ceID"]));	
        }

        function getChaptersEnrolled($userID){
	      $chaptersSet = $this->select('chaptersEnrolled', array("chapterID"), array("userID"=>$userID));

	      if($chaptersSet->num_rows != 0){
	        return $chaptersSet;
	      }else{
	      	return false;
	        print_r("Error - The user have not signed up into any chapters");
	      }
	    }

	    function getUserChapters($userID){
	    	$db = db::instance();
	    	$data = $this->getChaptersEnrolled($userID);
	    	$where = ' WHERE ';
	    	
	    	if($data){
	    		$i=1;
	    		$len = $data->num_rows;

	    		while($row = $data->fetch_assoc()){
	    			if($i < $len){
		    			$where .= ' '.key($row).'='.$row[key($row)].' ||';
	    			}else{
	    				$where .= ' '.key($row).'='.$row[key($row)];
	    			}
	    			$i++;
	    		}
		    	
		    	$query = 'SELECT * FROM chapters'. $where;
		    	$call = $db->query($query);
		    	return $call;
		    }

	    }

	    function printUserChapters($userID, $editable = null){
	    	$data = $this->getUserChapters($userID);
	    	$resultHTML = '';
	    	
	    	if($data){
	    		
		        while($row = $data->fetch_assoc()){

		    		switch ($editable) {
		    		case 'editable':
		    		    $btn = '<span class="badge badge-danger" data-id="'.$row["chapterID"].'" ><i class="fa fa-times" aria-hidden="true"></i></span>';

		    			break;
		    		
		    		default:
		    			$btn = '';
		    			;
		    			break;
		    	}
		    		$resultHTML .='<li><a href="createChapter.php?chapterID='.$row["chapterID"].'" title="'.$row["chapterName"].'" >'.$row["chapterName"].'</a>'.$btn.'</li>';
		    	}
	    	}
	    	return $resultHTML;
		}
}
?>