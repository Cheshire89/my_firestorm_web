<?php

class sendEmail {
    
    private $host;
    private $email;

    function sendEmail() {
        $this->host = 'myfirestorm.com';
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

    }

    function approve_prospect($userID, $name){
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$this->email.'>' . "\r\n";

        $emlMsg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

        $emlMsg .= '<html xmlns="http://www.w3.org/1999/xhtml"><head>';

        $emlMsg .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="initial-scale=1.0">';

        $emlMsg .= '</head><body>';
        $emlMsg .= '<a href="'.$this->host.'/sign-login.php?membership=subscription" />Dear '.$name.' You were approved. <br> Please follow this link to pay subscription and complete your initiation</a>';
        $emlMsg .= '</body></html>';

        mail($this->email, 'Dear '.$name.' Your Application was Approved',$emlMsg, $headers);
    }

    function fee_paid($prospectID){
        mail($this->email,'fee paid','test test');
    }

    function notify_chapter_admin($prospectID){
        mail($this->email,'notify admin','test test');
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
    
    function adminNotify_ProspectApproval($userID, $name) {
        //to is phil@myfirestorm.com
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$this->email.'>' . "\r\n";

        $emlMsg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

        $emlMsg .= '<html xmlns="http://www.w3.org/1999/xhtml"><head>';

        $emlMsg .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="initial-scale=1.0">';

        $emlMsg .= '</head><body>';
        $emlMsg .= 'Member '.$userID.', '.$name.' has been Converted into a User.';
        $emlMsg .= '</body></html>';

        mail($this->email, 'myFirestorm - Prospect Approved',$emlMsg, $headers);
    }
    
    function adminNotify_ProspectRejection($userID, $name) {
        //to is phil@myfirestorm.com
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$this->email.'>' . "\r\n";

        $emlMsg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

        $emlMsg .= '<html xmlns="http://www.w3.org/1999/xhtml"><head>';

        $emlMsg .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="initial-scale=1.0">';

        $emlMsg .= '</head><body>';
        $emlMsg .= 'Member '.$userID.', '.$name.' has been Rejected and is now an archived Prospect.';
        $emlMsg .= '</body></html>';

        mail($this->email, 'myFirestorm - Prospect Rejected',$emlMsg, $headers);
    }

}

?>