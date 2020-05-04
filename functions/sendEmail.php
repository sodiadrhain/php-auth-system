<?php 

require_once('alert.php');
require_once('redirect.php');

function send_mail(
    $subject = "", 
    $message = "",
    $email = ""
    ){
    
    $headers = "From: no-reply@sodiadrhainhos.org" . "\r\n" .
    "CC: soji@sodiadrhainhos.org";

    $send = mail($email,$subject,$message,$headers);

    if($send){
        
        set_alert('message',"Password reset has been sent to your email: " . $email);        
        redirect_to("login.php");

    } else{
        
        set_alert('error', "Sorry something went wrong, we could not send password reset to :" . $email);             
        redirect_to("forgotPassword.php");
    }

}


function send_success_trans_mail(
    $subject = "", 
    $message = "",
    $email = ""
){
    $headers = "From: no-reply@sodiadrhainhos.org" . "\r\n" .
    "CC: soji@sodiadrhainhos.org";

    $send = mail($email,$subject,$message,$headers);

    if($send){

    } else{

    }


}