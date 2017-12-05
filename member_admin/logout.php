<?php

require_once("classes/config.php");

if(isset($_SESSION['userID'])) {
    $_SESSION['userID'] = '';
    $_SESSION['userLevel'] = '';
}

unset($_SESSION['userID']);
unset($_SESSION['userLevel']);
session_unset();
session_destroy();

header("Location: ../");
exit();

?>