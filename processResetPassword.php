<?php session_start();
    require_once('functions/user.php');
    require_once('functions/token.php');
    require_once('functions/alert.php');
    require_once('functions/sendEmail.php');
    require_once('functions/redirect.php');

    //Collecting details entered

$errorCount = 0;

if(!is_user_loggedIn()){

    $token = $_POST['token'] != "" ? $_POST['token'] :  $errorCount++;
    $_SESSION['token'] = $token;
}

$email = $_POST['email'] != "" ? $_POST['email'] :  $errorCount++;

$password = $_POST['password'] != "" ? $_POST['password'] :  $errorCount++;


$_SESSION['email'] = $email;

if($errorCount > 0){

    $session_error = "You have " . $errorCount . " error";
   
   if($errorCount > 1) {        
       $session_error .= "s";
   }

   $session_error .=   " in your form submission";
   
   set_alert('error',$session_error);

   redirect_to("resetPassword.php");

} else{
            $check_token = find_token($email);
            $check_token = $check_token->token;

           if(is_user_loggedIn() || $check_token == $token){
           
                $userExists = find_user($email);

                if($userExists){
                        
                    $currentUser = $email.".json";
                    $userString = file_get_contents("db/users/".$currentUser);
                    $userObject = json_decode($userString);
                    $userObject->password = password_hash($password, PASSWORD_DEFAULT);
                    
                    file_put_contents("db/users/". $email . ".json", json_encode($userObject));

                    if(is_token_set()){
                    //deleting token data
                    unlink("db/tokens/".$currentUser);
                    }

                    if(is_user_loggedIn()){
                        unset($_SESSION['loggedIn']);
                    }

                    $subject = "Password Reset Successful";
                    $message = "Your account password on sodiadrhain hospital has changed. if you did not initiate the password change, please visit sodiadrhainhos.org and reset your password immediately";

                    send_mail($subject,$message,$email);
                    
                    set_alert('message',"Password Reset Successful, you can now login");

                    redirect_to("login.php");

                    }

        
    } else {

    set_alert('error',"Password Reset Failed, token/email invalid or expired");

    if(is_user_loggedIn()){
        redirect_to("resetPassword.php");
    } else {
        redirect_to("login.php");
    }

    }
}
