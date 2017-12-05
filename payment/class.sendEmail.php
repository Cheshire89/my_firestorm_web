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
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$this->email.'>' . "\r\n";

        $emlMsg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

        $emlMsg .= '<html xmlns="http://www.w3.org/1999/xhtml"><head>';

        $emlMsg .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="initial-scale=1.0">';

        $emlMsg .= '</head><body>';
        $emlMsg .= '<h2/>User '.$user.' Paid Subscription</h2>';
        $emlMsg .= '</body></html>';

        mail($this->email, 'You Have A New Prospect',$emlMsg, $headers);
    }

    function fee_paid_user($prospectID, $desc, $amount, $transID){
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$this->email.'>' . "\r\n";

        $emlMsg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

        $emlMsg .= '<html xmlns="http://www.w3.org/1999/xhtml"><head>';

        $emlMsg .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="initial-scale=1.0">';

        $emlMsg .= '</head><body>';
        $emlMsg .= '<h2/>Prospect '.$prospectID.' Paid Fee</h2>';
        $emlMsg .= '<p>Transaction Date: <span>'.date('m/d/Y h:i:s A').'</span></p>';
        $emlMsg .= '<p>Transaction ID: <span>'.$transID.'</span></p>';
        $emlMsg .= '<p>Description: <span>'.$desc.'</span></p>';
        $emlMsg .= '<p>Transaction Amount: <span>'.$amount.'</span></p>';
        $emlMsg .= '</body></html>';

        mail($this->email, 'Thank you for completing application process',$emlMsg, $headers);
    }

    function fee_paid_admin($prospectID, $name, $email){
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$this->email.'>' . "\r\n";

        $emlMsg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

        $emlMsg .= '<html xmlns="http://www.w3.org/1999/xhtml"><head>';

        $emlMsg .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="initial-scale=1.0">';

        $emlMsg .= '</head><body>';
        $emlMsg .= '<h2/>Prospect '.$prospectID.' Paid Fee</h2>';
        $emlMsg .= '<p>Date: <span>'.date('m/d/Y h:i:s A').'</span></p>';
        $emlMsg .= '<p>Prospect Name: <span>'.$name.'</span></p>';
        $emlMsg .= '<p>Prospect Email: <span>'.$email.'</span></p>';

        $emlMsg .= '</body></html>';

        mail($this->email, 'New prospect paid fee',$emlMsg, $headers);
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

    function nonuser_paid_event($userInfo, $transID){
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$this->email.'>' . "\r\n";

        $emlMsg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

        $emlMsg .= '<html xmlns="http://www.w3.org/1999/xhtml"><head>';

        $emlHeadInner = '<meta name="viewport" content="initial-scale=1.0">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="initial-scale=1.0">
            <meta name="format-detection" content="telephone=no">
            <title>Firestorm Receipt</title>
            <style type="text/css">
                .socialLinks {
                    font-size: 6px;
                }
                
                .socialLinks a {
                    display: inline-block;
                }
                
                .socialIcon {
                    display: inline-block;
                    vertical-align: top;
                    padding-bottom: 0px;
                    border-radius: 100%;
                }
                
                table.vb-row,
                table.vb-content {
                    border-collapse: separate;
                }
                
                table.vb-row {
                    border-spacing: 9px;
                }
                
                table.vb-row.halfpad {
                    border-spacing: 0;
                    padding-left: 9px;
                    padding-right: 9px;
                }
                
                table.vb-row.fullwidth {
                    border-spacing: 0;
                    padding: 0;
                }
                
                table.vb-container.fullwidth {
                    padding-left: 0;
                    padding-right: 0;
                }
            </style>
            <style type="text/css">
                /* yahoo, hotmail */
                
                .ExternalClass,
                .ExternalClass p,
                .ExternalClass span,
                .ExternalClass font,
                .ExternalClass td,
                .ExternalClass div {
                    line-height: 100%;
                }
                
                .yshortcuts a {
                    border-bottom: none !important;
                }
                
                .vb-outer {
                    min-width: 0 !important;
                }
                
                .RMsgBdy,
                .ExternalClass {
                    width: 100%;
                    background-color: #3f3f3f;
                    background-color: #3f3f3f
                }
                /* outlook */
                
                table {
                    mso-table-rspace: 0pt;
                    mso-table-lspace: 0pt;
                }
                
                #outlook a {
                    padding: 0;
                }
                
                img {
                    outline: none;
                    text-decoration: none;
                    border: none;
                    -ms-interpolation-mode: bicubic;
                }
                
                a img {
                    border: none;
                }
                
                @media screen and (max-device-width: 600px),
                screen and (max-width: 600px) {
                    table.vb-container,
                    table.vb-row {
                        width: 95% !important;
                    }
                    .mobile-hide {
                        display: none !important;
                    }
                    .mobile-textcenter {
                        text-align: center !important;
                    }
                    .mobile-full {
                        float: none !important;
                        width: 100% !important;
                        max-width: none !important;
                        padding-right: 0 !important;
                        padding-left: 0 !important;
                    }
                    img.mobile-full {
                        width: 100% !important;
                        max-width: none !important;
                        height: auto !important;
                    }
                }
            </style>
            <style type="text/css">
                #ko_textBlock_16 .links-color a,
                #ko_textBlock_16 .links-color a:link,
                #ko_textBlock_16 .links-color a:visited,
                #ko_textBlock_16 .links-color a:hover {
                    color: #3f3f3f;
                    color: #3f3f3f;
                    text-decoration: underline;
                }
                
                #ko_textBlock_7 .links-color a,
                #ko_textBlock_7 .links-color a:link,
                #ko_textBlock_7 .links-color a:visited,
                #ko_textBlock_7 .links-color a:hover {
                    color: #3f3f3f;
                    color: #3f3f3f;
                    text-decoration: underline;
                }
                
                #ko_textBlock_9 .links-color a,
                #ko_textBlock_9 .links-color a:link,
                #ko_textBlock_9 .links-color a:visited,
                #ko_textBlock_9 .links-color a:hover {
                    color: #3f3f3f;
                    color: #3f3f3f;
                    text-decoration: underline;
                }
                
                #ko_textBlock_14 .links-color a,
                #ko_textBlock_14 .links-color a:link,
                #ko_textBlock_14 .links-color a:visited,
                #ko_textBlock_14 .links-color a:hover {
                    color: #3f3f3f;
                    color: #3f3f3f;
                    text-decoration: underline;
                }
                
                #ko_footerBlock_2 .links-color a:visited,
                #ko_footerBlock_2 .links-color a:hover {
                    color: #ccc;
                    color: #ccc;
                    text-decoration: underline;
                }
            </style>';
        $emlMsg .= $emlHeadInner;
        $emlMsg .= '</head>';
        $emlMsg .= '<body bgcolor="#ffffff" text="#919191" alink="#cccccc" vlink="#cccccc" style="margin: 0;padding: 0;background-color: #ffffff;color: #919191;">
                    <center>
                        <table class="vb-outer" width="100%" cellpadding="0" border="0" cellspacing="0" bgcolor="#ffffff" style="background-color: #ffffff;" id="ko_logoBlock_3">
                            <tbody>
                                <tr>
                                    <td class="vb-outer" align="center" valign="top" bgcolor="#d36a1d" style="padding-left: 9px;padding-right: 9px;background-color: #d36a1d;">

                                        <!--[if (gte mso 9)|(lte ie 8)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="910"><tr><td align="center" valign="top"><![endif]-->
                                        <div class="oldwebkit" style="max-width: 910px;">
                                            <table width="910" style="border-collapse: separate;border-spacing: 18px;padding-left: 0;padding-right: 0;width: 100%;max-width: 910px;" border="0" cellpadding="0" cellspacing="18" class="vb-container fullpad">
                                                <tbody>
                                                    <tr>
                                                        <td valign="top" align="left">

                                                            <!--[if (gte mso 9)|(lte ie 8)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="258"><tr><td align="center" valign="top"><![endif]-->
                                                            <div class="mobile-full" style="display: inline-block; max-width: 258px; vertical-align: top; width: 100%;">
                                                                <a target="_new" href="link" style="font-size: 18px; font-family: Arial, Helvetica, sans-serif; color: #e36c09; text-decoration: none;"><img width="258" vspace="0" hspace="0" border="0" alt="Firestorm Logo" style="border: 0px;display: block;width: 100%;max-width: 258px;" src="https://mosaico.io/srv/f-o4itlqs/img?src=https%3A%2F%2Fmosaico.io%2Ffiles%2Fo4itlqs%2Ffs-logo-header.png&amp;method=resize&amp;params=258%2Cnull"></a>
                                                            </div>
                                                            <!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="vb-outer" width="100%" cellpadding="0" border="0" cellspacing="0" bgcolor="#ffffff" style="background-color: #ffffff;" id="ko_titleBloc910">
                            <tbody>
                                <tr>
                                    <td class="vb-outer" align="center" valign="top" bgcolor="#ffffff" style="padding-left: 9px;padding-right: 9px;background-color: #ffffff;">

                                        <!--[if (gte mso 9)|(lte ie 8)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="910"><tr><td align="center" valign="top"><![endif]-->
                                        <div class="oldwebkit" style="max-width: 910px;">
                                            <table width="910" border="0" cellpadding="0" cellspacing="9" class="vb-container halfpad" bgcolor="#ffffff" style="border-collapse: separate;border-spacing: 9px;padding-left: 9px;padding-right: 9px;width: 100%;max-width: 910px;background-color: #fff;">
                                                <tbody>
                                                    <tr>
                                                        <td bgcolor="#ffffff" align="left" style="">
                                                            <span><strong>&nbsp;</strong></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#ffffff" align="left" style="background-color: #ffffff; font-size: 22px; font-family: Arial, Helvetica, sans-serif; color: #e36c09; text-align: left;">
                                                            <span><strong>Transaction Summary</strong></span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="vb-outer" width="100%" cellpadding="0" border="0" cellspacing="0" bgcolor="#ffffff" style="background-color: #ffffff;" id="ko_textBlock910">
                            <tbody>
                                <tr>
                                    <td class="vb-outer" align="center" valign="top" bgcolor="#ffffff" style="padding-left: 9px;padding-right: 9px;background-color: #ffffff;">

                                        <!--[if (gte mso 9)|(lte ie 8)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="910"><tr><td align="center" valign="top"><![endif]-->
                                        <div class="oldwebkit" style="max-width: 910px;">
                                            <table width="910" border="0" cellpadding="0" cellspacing="18" class="vb-container fullpad" bgcolor="#ffffff" style="border-collapse: separate;border-spacing: 18px;padding-left: 0;padding-right: 0;width: 100%;max-width: 910px;background-color: #fff;">
                                                <tbody>
                                                    <tr>
                                                        <td align="left" class="long-text links-color" style="text-align: left; font-size: 16px; font-family: Arial, Helvetica, sans-serif; color: #000000;">
                                                            <p style="margin: 1em 0px; margin-bottom: 0px;margin-top: 0px;">'.date('m/d/Y').'</p>
                                                        </td>
                                                    </tr>
                                                     <tr>
                                                        <td align="left" class="long-text links-color" style="text-align: left; font-size: 16px; font-family: Arial, Helvetica, sans-serif; color: #000000;">
                                                            <p style="margin: 1em 0px; margin-bottom: 0px;margin-top: 0px;">Transaction #: '.$transID.'</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="vb-outer" width="100%" cellpadding="0" border="0" cellspacing="0" bgcolor="#ffffff" style="background-color: #ffffff;" id="ko_hrBlock910">
                            <tbody>
                                <tr>
                                    <td class="vb-outer" align="center" valign="top" bgcolor="#ffffff" style="padding-left: 9px;padding-right: 9px;background-color: #ffffff;">

                                        <!--[if (gte mso 9)|(lte ie 8)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="910"><tr><td align="center" valign="top"><![endif]-->
                                        <div class="oldwebkit" style="max-width: 910px;">
                                            <table width="910" border="0" cellpadding="0" cellspacing="9" class="vb-container halfpad" bgcolor="#ffffff" style="border-collapse: separate;border-spacing: 9px;padding-left: 9px;padding-right: 9px;width: 100%;max-width: 910px;background-color: #fff;">
                                                <tbody>
                                                    <tr>
                                                        <td valign="top" bgcolor="#ffffff" align="center" style="background-color: #ffffff;">
                                                            <table width="80%" cellspacing="0" cellpadding="0" border="0" style="width: 80%;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td width="100%" height="1" style="font-size: 1px; line-height: 1px; width: 100%; background-color: #e36c09;"> </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="vb-outer" width="100%" cellpadding="0" border="0" cellspacing="0" bgcolor="#ffffff" style="background-color: #ffffff;" id="ko_titleBlock910">
                            <tbody>
                                <tr>
                                    <td class="vb-outer" align="center" valign="top" bgcolor="#ffffff" style="padding-left: 9px;padding-right: 9px;background-color: #ffffff;">

                                        <!--[if (gte mso 9)|(lte ie 8)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="910"><tr><td align="center" valign="top"><![endif]-->
                                        <div class="oldwebkit" style="max-width: 910px;">
                                            <table width="910" border="0" cellpadding="0" cellspacing="9" class="vb-container halfpad" bgcolor="#ffffff" style="border-collapse: separate;border-spacing: 9px;padding-left: 9px;padding-right: 9px;width: 100%;max-width: 910px;background-color: #fff;">
                                                <tbody>
                                                    <tr>
                                                        <td bgcolor="#ffffff" align="left" style="background-color: #ffffff; font-size: 22px; font-family: Arial, Helvetica, sans-serif; color: #e36c09; text-align: left;">
                                                            <span><strong>Billing Address</strong><br></span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="vb-outer" width="100%" cellpadding="0" border="0" cellspacing="0" bgcolor="#ffffff" style="background-color: #ffffff;" id="ko_textBloc910">
                            <tbody>
                                <tr>
                                    <td class="vb-outer" align="center" valign="top" bgcolor="#ffffff" style="padding-left: 9px;padding-right: 9px;background-color: #ffffff;">

                                        <!--[if (gte mso 9)|(lte ie 8)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="910"><tr><td align="center" valign="top"><![endif]-->
                                        <div class="oldwebkit" style="max-width: 910px;">
                                            <table width="910" border="0" cellpadding="0" cellspacing="18" class="vb-container fullpad" bgcolor="#ffffff" style="border-collapse: separate;border-spacing: 18px;padding-left: 0;padding-right: 0;width: 100%;max-width: 910px;background-color: #fff;">
                                                <tbody>
                                                    <tr>
                                                        <td align="left" class="long-text links-color" style="text-align: left; font-size: 16px; font-family: Arial, Helvetica, sans-serif; color: #000000;">
                                                            <p style="margin: 1em 0px;margin-top: 0px;">'.$user["payAddress"].'</p>
                                                            <p style="margin: 1em 0px;margin-bottom: 0px;">'.$user["payCity"].' '.$user["payState"].', '.$user["payZip"].'</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="vb-outer" width="100%" cellpadding="0" border="0" cellspacing="0" bgcolor="#ffffff" style="background-color: #ffffff;" id="ko_hrBlock910">
                            <tbody>
                                <tr>
                                    <td class="vb-outer" align="center" valign="top" bgcolor="#ffffff" style="padding-left: 9px;padding-right: 9px;background-color: #ffffff;">

                                        <!--[if (gte mso 9)|(lte ie 8)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="910"><tr><td align="center" valign="top"><![endif]-->
                                        <div class="oldwebkit" style="max-width: 910px;">
                                            <table width="910" border="0" cellpadding="0" cellspacing="9" class="vb-container halfpad" bgcolor="#ffffff" style="border-collapse: separate;border-spacing: 9px;padding-left: 9px;padding-right: 9px;width: 100%;max-width: 910px;background-color: #fff;">
                                                <tbody>
                                                    <tr>
                                                        <td valign="top" bgcolor="#ffffff" align="center" style="background-color: #ffffff;">
                                                            <table width="80%" cellspacing="0" cellpadding="0" border="0" style="width: 80%;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td width="100%" height="1" style="font-size: 1px; line-height: 1px; width: 100%; background-color: #e36c09;"> </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="vb-outer" width="100%" cellpadding="0" border="0" cellspacing="0" bgcolor="#ffffff" style="background-color: #ffffff;" id="ko_titleBlock910">
                            <tbody>
                                <tr>
                                    <td class="vb-outer" align="center" valign="top" bgcolor="#ffffff" style="padding-left: 9px;padding-right: 9px;background-color: #ffffff;">

                                        <!--[if (gte mso 9)|(lte ie 8)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="910"><tr><td align="center" valign="top"><![endif]-->
                                        <div class="oldwebkit" style="max-width: 910px;">
                                            <table width="910" border="0" cellpadding="0" cellspacing="9" class="vb-container halfpad" bgcolor="#ffffff" style="border-collapse: separate;border-spacing: 9px;padding-left: 9px;padding-right: 9px;width: 100%;max-width: 910px;background-color: #fff;">
                                                <tbody>
                                                    <tr>
                                                        <td bgcolor="#ffffff" align="left" style="background-color: #ffffff; font-size: 22px; font-family: Arial, Helvetica, sans-serif; color: #e36c09; text-align: left;">
                                                            <span><strong>Billing Method</strong><br></span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="vb-outer" width="100%" cellpadding="0" border="0" cellspacing="0" bgcolor="#ffffff" style="background-color: #ffffff;" id="ko_textBloc910">
                            <tbody>
                                <tr>
                                    <td class="vb-outer" align="center" valign="top" bgcolor="#ffffff" style="padding-left: 9px;padding-right: 9px;background-color: #ffffff;">

                                        <!--[if (gte mso 9)|(lte ie 8)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="910"><tr><td align="center" valign="top"><![endif]-->
                                        <div class="oldwebkit" style="max-width: 910px;">
                                            <table width="910" border="0" cellpadding="0" cellspacing="18" class="vb-container fullpad" bgcolor="#ffffff" style="border-collapse: separate;border-spacing: 18px;padding-left: 0;padding-right: 0;width: 100%;max-width: 910px;background-color: #fff;">
                                                <tbody>
                                                    <tr>
                                                        <td align="left" class="long-text links-color" style="text-align: left; font-size: 16px; font-family: Arial, Helvetica, sans-serif; color: #000000;">
                                                            <p style="margin: 1em 0px;">Credit Card Number: ...'.substr($user["payCCNum"], -4).'</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="vb-outer" width="100%" cellpadding="0" border="0" cellspacing="0" bgcolor="#ffffff" style="background-color: #ffffff;" id="ko_hrBlock910">
                            <tbody>
                                <tr>
                                    <td class="vb-outer" align="center" valign="top" bgcolor="#ffffff" style="padding-left: 9px;padding-right: 9px;background-color: #ffffff;">

                                        <!--[if (gte mso 9)|(lte ie 8)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="910"><tr><td align="center" valign="top"><![endif]-->
                                        <div class="oldwebkit" style="max-width: 910px;">
                                            <table width="910" border="0" cellpadding="0" cellspacing="9" class="vb-container halfpad" bgcolor="#ffffff" style="border-collapse: separate;border-spacing: 9px;padding-left: 9px;padding-right: 9px;width: 100%;max-width: 910px;background-color: #fff;">
                                                <tbody>
                                                    <tr>
                                                        <td valign="top" bgcolor="#ffffff" align="center" style="background-color: #ffffff;">
                                                            <table width="80%" cellspacing="0" cellpadding="0" border="0" style="width: 80%;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td width="100%" height="1" style="font-size: 1px; line-height: 1px; width: 100%; background-color: #e36c09;"> </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="vb-outer" width="100%" cellpadding="0" border="0" cellspacing="0" bgcolor="#ffffff" style="background-color: #ffffff;" id="ko_titleBlock_12">
                            <tbody>
                                <tr>
                                    <td class="vb-outer" align="center" valign="top" bgcolor="#ffffff" style="padding-left: 9px;padding-right: 9px;background-color: #ffffff;">

                                        <!--[if (gte mso 9)|(lte ie 8)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="910"><tr><td align="center" valign="top"><![endif]-->
                                        <div class="oldwebkit" style="max-width: 910px;">
                                            <table width="910" border="0" cellpadding="0" cellspacing="9" class="vb-container halfpad" bgcolor="#ffffff" style="border-collapse: separate;border-spacing: 9px;padding-left: 9px;padding-right: 9px;width: 100%;max-width: 910px;background-color: #fff;">
                                                <tbody>
                                                    <tr>
                                                        <td bgcolor="#ffffff" align="left" style="background-color: #ffffff; font-size: 22px; font-family: Arial, Helvetica, sans-serif; color: #e36c09; text-align: left;">
                                                            <span><strong>Order Summary</strong></span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="vb-outer" width="100%" cellpadding="0" border="0" cellspacing="0" bgcolor="#ffffff" style="background-color: #ffffff;" id="ko_textBlock_14">
                            <tbody>
                                <tr>
                                    <td class="vb-outer" align="center" valign="top" bgcolor="#ffffff" style="padding-left: 9px;padding-right: 9px;background-color: #ffffff;">

                                        <!--[if (gte mso 9)|(lte ie 8)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="910"><tr><td align="center" valign="top"><![endif]-->
                                        <div class="oldwebkit" style="max-width: 910px;">
                                            <table width="910" border="0" cellpadding="0" cellspacing="18" class="vb-container fullpad" bgcolor="#ffffff" style="border-collapse: separate;border-spacing: 18px;padding-left: 0;padding-right: 0;width: 100%;max-width: 910px;background-color: #fff;">
                                                <tbody>
                                                    <tr>
                                                        <td align="left" class="long-text links-color" style="text-align: left; font-size: 16px; font-family: Arial, Helvetica, sans-serif; color: #000000;">
                                                            <p style="margin: 1em 0px;margin-top: 0px;">'.$user["eventTitle"].' '.$user["eventDate"].'
                                                                <br>
                                                            </p>
                                                            <p style="margin: 1em 0px;margin-bottom: 0px;">Total: $'.$user["eventPrice"].'</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- footerBlock -->
                        <table width="100%" cellpadding="0" border="0" cellspacing="0" bgcolor="#3f3f3f" style="background-color: #3f3f3f;" id="ko_footerBlock_2">
                            <tbody>
                                <tr>
                                    <td align="center" valign="top" bgcolor="#3f3f3f" style="background-color: #3f3f3f;">

                                        <!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- /footerBlock -->
                    </center>

                </body>';
        $emlMsg .= '</html>';

        mail($this->email, 'Subscription Paid',$emlMsg, $headers);
    }

}

?>