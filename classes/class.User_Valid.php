<?php 
	
	class User_Valid EXTENDS fireSQL{

			function __constructor(){

			}

			function doLogin($username, $password){  
                $db = db::instance();
				$username = $db->real_escape_string($username);
				$password = hash("sha512", $db->real_escape_string($password)); 

				
				$isUser = $this->select('users',array('userID','userLevel','email','companyPhone','fName', 'lName'), array('email'=>$username, 'hash'=>$password, 'archived'=>'no'));
                $return = $isUser->fetch_assoc();
                $numRows = $isUser->num_rows;

	             if($numRows > 0) {
	             	//print('here0');
					$_SESSION['userID'] = $return['userID'];
					$_SESSION['userLevel'] = $return['userLevel'];
					$_SESSION['email'] = $return['email'];
	                $_SESSION['phone'] = $return['companyPhone'];
	                $_SESSION['fName'] = $return['fName'];
	                $_SESSION['lName'] = $return['lName'];

					switch ($return['userLevel']) {
						case 'admin':
								$pageName = './admin';
							break;
						case 'chapter_admin':
								$pageName = './member_admin';
							break;
						case 'member':
								$pageName = './member_admin';
							break;
						case 'unpaid_member':
								$pageName = './membership-dues.php';
							break;
						case 'guest':
								$pageName = './new-account.php';
							break;
						default:
							$pageName = $this->checkProspects($username, $password);
							break;
					}
					return $pageName;
				} else {
					//print('here');
					$pageName = $this->checkProspects($username, $password);
					return $pageName;
				}
					
				
			}

			function checkProspects($username, $password){
					$db = db::instance();
					$isUser = $this->select('prospects',array('prospectID', 'email', 'fName', 'lName', 'applicationFee', 'prospectFormPage'), array('email'=>$username, 'hash'=>$password, 'archived'=>'no'));
					
					$return = $isUser->fetch_assoc();
					$_SESSION["prospectID"] = $return["prospectID"];
        			$_SESSION["email"] = $return["email"];
        			$_SESSION['fName'] = $return['fName'];
        			$_SESSION['lName'] = $return['lName'];
        			$_SESSION['phone'] = $return['companyPhone'];
        			$_SESSION['applicationFee'] = $return['applicationFee'];
        			$_SESSION['prospectFormPage'] = $return['prospectFormPage'];

        			//print_r($_SESSION);
					

    				if($return["applicationFee"] == 1){
    					$pageName = './thank-you.php?waiting=approval';
    				}else if($return["prospectFormPage"]){
    					$pageName = './new-account.php';
    				}else{
    					$pageName = 'sign-login.php?error=level';
    				}

    			 return $pageName;
			}

			function isLoggedIn(){
				if(isset($_SESSION['userID']) && $_SESSION['userID'] != ''){
					return true;
				}else{
					return false;
				}
			}

			function logOut(){
				$_SESSION['userID']='';
				unset($_SESSION);
				session_unset();
				session_destroy();
			}
	}

?>