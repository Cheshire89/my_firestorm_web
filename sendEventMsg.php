<?php 
	require_once('classes/config.php');

	if(isset($_POST["from"]) && $_POST["from"] != '' &&
	       isset($_POST["to"]) && $_POST["to"] != '' &&
	       isset($_POST["msg"]) && $_POST["msg"] != ''){

		$db = db::instance();
                $from = $db->real_escape_string($_POST["from"]);
                $to = $db->real_escape_string($_POST["to"]);
                $msg = $db->real_escape_string($_POST["msg"]);
                $subj = $db->real_escape_string($_POST["subj"]);
                $time = $db->real_escape_string($_POST["time"]);
                $loc = $db->real_escape_string($_POST["loc"]);
                $evID = $db->real_escape_string($_POST["evID"]);

                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: MyFirestorm <no-reply@myfirestorm.com>' . "\r\n";

                $emlMsg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

                $emlMsg .= '<html xmlns="http://www.w3.org/1999/xhtml"><head>';

                $emlMsg .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="initial-scale=1.0">';

                $emlMsg .= '</head><body>';
                $emlMsg .= '<h1>From '.$from.'</h1>';
                $emlMsg .= '<h2/>'.$subj.'<br/> @ Sent From <a href="http://myfirestrom.com">myfirestorm.com</a></h2>';
                $emlMsg .= '<p>'.$msg.'</p>';
                $emlMsg .= '<h3>Event Details</h3>';
                $emlMsg .= '<p>'.$time.'</p>';
                $emlMsg .= '<p>'.$loc.'</p>';
                $emlMsg .= '<p><a href="http://myfirestorm.com/event.php?eventID='.$evID.'">View Event</a></p>';
                $emlMsg .= '</body></html>';

                if(mail($to, $subj, $emlMsg, $headers)){
                        print('Success');
                }else{
                        print('Failed');
                }

	}else{
                header('Location: events.php');
                exit();
        }
?>