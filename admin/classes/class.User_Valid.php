<?php 
	
	class User_Valid EXTENDS fireSQL{

			function __constructor() {
        
            }

			function doLogin($username, $password){
				$username = $this->db->real_escape_string($username);
				$password = $this->db->real_escape_string($password); 
				$isUser = $this->select('users',array('userID','userLevel'), array('email'=>$username, 'hash'=>$password, 'archived'=>'no'));
				$_SESSION['userID'] = $isUser['userID'];
				$_SESSION['userLevel'] = $isUser['userLevel'];

				switch ($_SESSION['userLevel']) {
					case 'admin':
							$pageName = '/admin';
						break;
					case 'eventAdmin':
							$pageName = '/chapter';
						break;
					case 'member':
							$pageName = '/member';
						break;
					case 'incompleteMember':
							$pageName = 'new-account.php';
						break;
					case 'guest':
							$pageName = 'new-account.php';
						break;
					default:
							$pageName = 'login.php?error=level-t';
						break;
				}
					
				return $pageName;
			}

			function isLoggedIn(){
				if(isset($_SESSION['userID']) && $_SESSION['userID'] != ''){
				    if(isset($_SESSION['userLevel']) && $_SESSION['userLevel'] == "admin") {
					   return true;
                    } else {
                        return false;
                    }
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