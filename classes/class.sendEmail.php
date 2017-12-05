<?php

class sendEmail {
    
    private $host;
    private $email;

    function sendEmail() {
        $this->host = 'http://coloradoweb.design/dev/mfs/';
        $this->email = 'aleksandr@lasyte.com';
    }

    function send_prospect_approved() {

    


    //returns email address
    //send email

    //$email = $_SESSION['email'];
    //send confirmation email - thank you

    }

    function send_user_paid_subscription($userID) {

        //send tahnk you email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$this->email.'>' . "\r\n";

        $emlMsg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

        $emlMsg .= '<html xmlns="http://www.w3.org/1999/xhtml"><head>';

        $emlMsg .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="initial-scale=1.0">';

        $emlMsg .= '</head><body>';
        $emlMsg .= '<h2/>Thank you '.$userID.' Your Subscription Fee has been Paid.</h2>';
        $emlMsg .= '</body></html>';

        mail($this->email, 'You Have A New Prospect',$emlMsg, $headers);

    }

    function fee_paid($prospectID){
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$this->email.'>' . "\r\n";

        $emlMsg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

        $emlMsg .= '<html xmlns="http://www.w3.org/1999/xhtml"><head>';

        $emlMsg .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="initial-scale=1.0">';

        $emlMsg .= '</head><body>';
        $emlMsg .= '<h2/>Prospect '.$prospectID.' Paid $100 Fee</h2>';
        $emlMsg .= '</body></html>';

        mail($this->email, 'You Have A New Prospect',$emlMsg, $headers);
    }

    function notify_chapter_admin($prospectID){
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$this->email.'>' . "\r\n";

        $emlMsg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

        $emlMsg .= '<html xmlns="http://www.w3.org/1999/xhtml"><head>';

        $emlMsg .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="initial-scale=1.0">';

        $emlMsg .= '</head><body>';
        $emlMsg .= '<h2/>Prospect '.$prospectID.' Paid Subscription</h2>';
        $emlMsg .= '</body></html>';

        mail($this->email, 'You Have A New Prospect',$emlMsg, $headers);
    }

    function subscription_paid($userID){
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$this->email.'>' . "\r\n";

        $emlMsg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

        $emlMsg .= '<html xmlns="http://www.w3.org/1999/xhtml"><head>';

        $emlMsg .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="initial-scale=1.0">';

        $emlMsg .= '</head><body>';
        $emlMsg .= '<a href="'.$this->host.'profile.php?userID='.$userID.'" />Member '.$userID.' Paid Subscription</a>';
        $emlMsg .= '</body></html>';

        mail($this->email, 'Subscription Paid',$emlMsg, $headers);
    }
    
    function referralEmail($refer_page,$refer_name,$refer_email,$refer_phone,$their_name,$their_email,$their_phone,$refMessage){
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$refer_email.'>' . "\r\n";

        $emlMsg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

        $emlMsg .= '<html xmlns="http://www.w3.org/1999/xhtml"><head>';

        $emlMsg .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="initial-scale=1.0">';

        $emlMsg .= '</head><body>';
        $emlMsg .= 'Dear '.$their_name.',
'.$refer_name.' would you like you to know more about myFirestorm! He\'s sent you the following link, so you can find out more. <a href="'.$this->host.$refer_page.'" />Referral Link</a>.<br /><br />The following message was also included: '.$refMessage;
        $emlMsg .= '</body></html>';

        mail($their_email, 'myFirestorm Referral',$emlMsg, $headers);
    }
    
    function password_reset($email,$passcode) {
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$this->email.'>' . "\r\n";

        $emlMsg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

        $emlMsg .= '<html xmlns="http://www.w3.org/1999/xhtml"><head>';

        $emlMsg .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="initial-scale=1.0">';

        $emlMsg .= '</head><body>';
        $emlMsg .= '<a href="'.$this->host.'new-password.php?email='.$email.'&passcode='.$passcode.'" />Click Here to Reset Your Password</a>';
        $emlMsg .= '</body></html>';

        mail($this->email, 'myFirestorm Password Reset Request',$emlMsg, $headers);
    }
    
    function password_reset_confirmed($email) {
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$this->email.'>' . "\r\n";

        $emlMsg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

        $emlMsg .= '<html xmlns="http://www.w3.org/1999/xhtml"><head>';

        $emlMsg .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="initial-scale=1.0">';

        $emlMsg .= '</head><body>';
        $emlMsg .= 'Your password has been reset. If this was not you, please contact support immediately.';
        $emlMsg .= '</body></html>';

        mail($this->email, 'myFirestorm Password Reset Request',$emlMsg, $headers);
    }

    function non_user_registered($post){
        $db = db::instance();
        foreach($post as $key => $var) {
            ${$key} = $db->real_escape_string($var);
        }

        $ev = new Events();
        $event = $ev->getEvent($evID);

        $subj = $event["eventTitle"].' @ myfirestorm.com';

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: MyFirestorm <no-reply@myfirestorm.com>' . "\r\n";

        $emlMsg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

        $emlMsg .= '<html xmlns="http://www.w3.org/1999/xhtml"><head>';

        $emlMsg .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="initial-scale=1.0">';

        $emlMsg .= '</head><body>';
        $emlMsg .= '<h1>Thank You for Registering for | '.$event["eventTitle"].'</h1>';
        $emlMsg .= '<h3>Event Details</h3>';
        $emlMsg .= '<p><strong>'.$event["eventTitle"].'</strong></p>';
        $emlMsg .= '<p><strong>Time: </strong>'. date('m-d-Y',$event["eventDateStart"]).' '.$event["eventTimeStart"].' to '.$event["eventTimeEnd"].'</p>';
        $emlMsg .= '<p><strong>Address: </strong>'.$event["addressFull"].'</p>';
        $emlMsg .= '<p><strong>Sign Up Date: </strong>'.date('l jS \of F Y h:i:s A').'</p>';
        $emlMsg .= '<p><a href="http://myfirestorm.com/event.php?eventID='.$evID.'">View Event</a></p>';
        $emlMsg .= '</body></html>';

        if(mail($email, $subj, $emlMsg, $headers)){
            return 'Success';
        }else{
            return 'Failed';
        }
    }

}

?>