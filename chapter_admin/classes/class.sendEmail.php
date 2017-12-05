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

    }

    function fee_paid($prospectID){
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$this->email.'>' . "\r\n";

        $emlMsg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

        $emlMsg .= '<html xmlns="http://www.w3.org/1999/xhtml"><head>';

        $emlMsg .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="initial-scale=1.0">';

        $emlMsg .= '</head><body>';
        $emlMsg .= '<h2/>Prospect '.$prospectID.' Paid Fee</h2>';
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

}

?>