<?php 
	class Chapters extends fireSQL{
		
		public $action;
		public $img;
        
        function __construct() {
            $this->Chapters();
        }
		
		function Chapters(){
			$this->action ="Create";
			$this->img = 'http://placehold.it/880x320?text=Chapter+Image';
		}
	
		function getChapter($chapterID = null){
			if($chapterID != null){
				$db = db::instance();

				$chapterID = $db->real_escape_string($chapterID);

				$result = $this->select('chapters', array("*"), array('chapterID' => $chapterID));
				 
				$row = $result->fetch_assoc();

				if($row["chapterImg"] != ''){
                    $row["chapterImg"] = substr($row["chapterImg"], 1);
                }
                

				return $row;
			}
		}
        
        function getChapterAdmins($chapterID) {
            $db = db::instance();
            $chapterID = $db->real_escape_string($chapterID);
            $getAdmins = $db->query("SELECT ca.userID, CONCAT(u.fName, ' ', u.lName) as fullName, u.profPic FROM chapterAdmins ca LEFT JOIN users u ON u.userID = ca.userID WHERE chID = '$chapterID'");
            $numRows = $getAdmins->num_rows;
            
            if($numRows > 1) {
                $result = '<h4 class="fs-header text-left"><span class="fs-strong">Chapter Presidents</span></h4>';
            } else {
                $result = '<h4 class="fs-header text-left"><span class="fs-strong">Chapter President</span></h4>';
            }
            
            while($row = $getAdmins->fetch_assoc()) {
                $userID = $row['userID'];
                $fullName = $row['fullName'];
                $profPic = $row['profPic'];
                
                $result .= '<div class="row featured-member chapter">
                      <div class="col-xs-2 col-sm-5 col-md-4 center-block">
                        <a href="profile.php?user='.$userID.'" class="fs-header-brown h4" style="float:left;"><img class="img-responsive img-circle" src="'.$profPic.'" alt="'.$fullName.'"></a>
                      </div>
                      <div class="col-xs-8 col-sm-7" style="vertical-align:middle;">
                       <a href="profile.php?user='.$userID.'" class="fs-header-brown h4" style="float:left;">'.$fullName.'</a>
                      </div>
                    </div>';
            }
            
            return $result;
        }

	    function getListChapters(){
	    	$db = db::instance();
	    	$resultArr = array();
	    	$result = $this->select('chapters', array("*"),null,null,' ORDER BY chapterName ASC');
	    	while($row = $result->fetch_assoc()){
	    		array_push($resultArr, $row);
	    	}
	    	return $resultArr;
	    }

	   	function print_chapters_site_front($data = null){
	   		$chapters = $this->getListChapters();
	   		foreach($chapters as $chapter){
	   			$resultHtml .= '<tr>
		                        <td><a href="chapter.php?chapterID='.$chapter["chapterID"].'" title="chapter name">'.$chapter["chapterName"].'</a></td>
		                        <td><a href="chapter.php?chapterID='.$chapter["chapterID"].'" title="chapter name">'.$chapter["chapterCity"].'</a></td>
		                        <td><a href="chapter.php?chapterID='.$chapter["chapterID"].'" title="chapter name">'.$chapter["chapterState"].'</a></td>
		                        <td>'.$chapter["meetingDay"].'</td>
		                        <td>'.$chapter["meetingTime"].'</td> 
		                      </tr>';
	   		}
	   		return $resultHtml;
	   	}

	   	function print_chapters_search_front($data){
	   		while($chapter = $data->fetch_assoc()){
	   			 $resultHtml .= '<tr>
		                        <td><a href="chapter.php?chapterID='.$chapter["chapterID"].'" title="chapter name">'.$chapter["chapterName"].'</a></td>
		                        <td><a href="chapter.php?chapterID='.$chapter["chapterID"].'" title="chapter name">'.$chapter["chapterCity"].'</a></td>
		                        <td><a href="chapter.php?chapterID='.$chapter["chapterID"].'" title="chapter name">'.$chapter["chapterState"].'</a></td>
		                        <td>'.$chapter["meetingDay"].'</td>
		                        <td>'.$chapter["meetingTime"].'</td>  
		                      </tr>';
	   		}
	   		return $resultHtml;
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
			}
		}

		function print_members($chapterID){
		    $db = db::instance();		  
			$getChapterAdmins = $db->query("SELECT u.*, i.industryName FROM users u LEFT JOIN chapterAdmins ca ON ca.userID = u.userID LEFT JOIN industry i ON i.inID = u.companyIndustry WHERE ca.chID = '$chapterID' && u.archived = 'no' && u.userLevel = 'chapter_admin'");
			while($row = $getChapterAdmins->fetch_assoc()){
				$name = $row["fName"].' '.$row["lName"];
                if($row["profPic"] == ''){
					$row["profPic"] = 'img/placeholder_user.png';
				} 
				$resultHTML .= '<div class="col-xs-6 col-sm-4 col-md-3 member admin">
			                        <a href="profile.php?user='.$row["userID"].'" title="'.$name.'" class="text-center">
                                        <i class="fa fa-star adminStar" aria-hidden="true"></i>
			                            <img class="img-responsive img-circle center-block" style="height: 200px; width: 200px;" src="'.$row["profPic"].'" alt="'.$name.' Profile Picture"/>
			                            <h4 class="fs-header">'.$row["fName"].' <strong>'.$row["lName"].'</strong></h4>
			                            <p class="fs-header-black h5">'.$row["industryName"].' &nbsp;</p>
			                        </a>
			                      </div>';
			}
            
            $getChapterMembers = $db->query("SELECT u.*, i.industryName FROM users u LEFT JOIN chaptersEnrolled ce ON ce.userID = u.userID LEFT JOIN industry i ON i.inID = u.companyIndustry WHERE ce.chapterID = '$chapterID' && u.archived = 'no' && u.userLevel = 'member'");
			while($row = $getChapterMembers->fetch_assoc()){
				$name = $row["fName"].' '.$row["lName"];
                if($row["profPic"] == ''){
					$row["profPic"] = 'img/placeholder_user.png';
				} 
				$resultHTML .= '<div class="col-xs-6 col-sm-4 col-md-3 member">
			                        <a href="profile.php?user='.$row["userID"].'" title="'.$name.'" class="text-center">
			                        <img class="img-responsive img-circle center-block" style="height: 200px; width: 200px;" src="'.$row["profPic"].'" alt="'.$name.' Profile Picture"/>
			                        
			                        <h4 class="fs-header">'.$row["fName"].' <strong>'.$row["lName"].'</strong></h4>
			                        <p class="fs-header-black h5">'.$row["industryName"].' &nbsp;</p>
			                        </a>
			                      </div>';
			}
            return $resultHTML;            
		}



		function getChaptersEnrolled($userID){
	      $chaptersSet = $this->select('chaptersEnrolled', array("chapterID"), array("userID"=>$userID));

	      if($chaptersSet->num_rows != 0){
	        return $chaptersSet;
	      }else{
	      	return false;
	        //print_r("Error - The user have not signed up into any chapters");
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
		    } else {
		      return false;
		    }
	    }

	    function printChaptersOption($active = null){
	    	$resultHTML = '';
	    	$list = $this->getListChapters();
	    	foreach($list as $item){
	    		if(isset($active) && $active == $item["chapterName"]){
	    			$resultHTML .= '<option value="'. $item["chapterID"] .'" selected="selected">'.$item["chapterName"].'</option>';
	    		}else{
		    		$resultHTML .= '<option value="'. $item["chapterID"] .'">'.$item["chapterName"].'</option>';
	    		}
	    	}
	    	return $resultHTML;
	    }

		function printAdminChapterMembers($chapterID){
			
			$data = $this->getMembers($chapterID);

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

	    function printUserChapters($userID, $editable = null){
	    	$data = $this->getUserChapters($userID);
	    	$resultHTML = '';

            if($data) {
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
    	    		$resultHTML .='<li><a href="chapter.php?chapterID='.$row["chapterID"].'" title="'.$row["chapterName"].'" >'.$row["chapterName"].'</a>'.$btn.'</li>';
    	    	}
    	    	return print($resultHTML);
            } else {
                return false;
            }
		}
        
        function getChaptersLngLat($data = null) {
            $db = db::instance();
            $string = "";
            if($data){
            	$getChapters = $db->query("SELECT lng, lat, chapterName FROM chapters ORDER BY chapterName ASC");
            }else{
	            $getChapters = $db->query("SELECT lng, lat, chapterName FROM chapters ORDER BY chapterName ASC");
            }
            $count=0;
            while($row = $getChapters->fetch_assoc()) {
                //['Maroubra Beach', -33.950198, 151.259302, 1]
                $lat = $row['lat'];
                $lng = $row['lng'];
                $chapterName = $row['chapterName'];
                
                $count++;

                if($lat != "" && $lng != "") {
                    if($string == "") {
                        $string = "['$chapterName', $lat, $lng, $count]";
                    } else {
                        $string .= ",['$chapterName', $lat, $lng, $count]";
                    }
                }

            }
            
            return "[$string]";
        }
}
?>