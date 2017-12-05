<?php 
	
	class User_Valid EXTENDS fireSQL{

			function User_Valid(){

			}

			function doLogin($username, $password){
				$username = $this->db->real_escape_string($username);
				$password = $this->db->real_escape_string($password); 
				$isUser = $this->select('users',array('userID','userLevel'), array('email'=>$username, 'hash'=>$password, 'archived'=>'no'));
				$_SESSION['userID'] = $isUser['userID'];
				$_SESSION['userLevel'] = $isUser['userLevel'];

				switch ($_SESSION['userLevel']) {
					case 'admin':
							$redirectPage = './admin';
						break;
					case 'chapter_admin':
							$redirectPage = './chapter_admin';
						break;
					case 'member':
							$redirectPage = './member_admin';
						break;
					case 'unpaid_member':
							$redirectPage = './new-account.php';
						break;
					case 'guest':
							$redirectPage = './new-account.php';
						break;
					default:
							$redirectPage = './sign-login.php?error=level';
						break;
				}
					
				return $pageName;
			}

			function isLoggedIn(){
				if(isset($_SESSION['userID']) && $_SESSION['userID'] != ''){
				    if(isset($_SESSION['userLevel']) && $_SESSION['userLevel'] == "chapter_admin") {
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