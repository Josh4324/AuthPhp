<?php
session_start();
require_once("functions/alert.php");
require_once("functions/email.php");
require_once("functions/redirect.php");
require_once("functions/token.php");
require_once("functions/users.php");

// collecting data
$email = $_POST['email'];

$errorCount = 0;

// verifying data
$email == "" ? $errorCount++ : $email;
$_SESSION['email'] = $email;

if ($errorCount == 1) {
    //Give feedback to user
    set_alert("error", "You have " . $errorCount . " error in your form submission");
    redirect("login.php");
}else if($errorCount > 1){
    set_alert("error", "You have " . $errorCount . " errors in your form submission");
    redirect("login.php");
}else{
        //check if the user already exists.
    $userExists = find_user($email);
    
        if($userExists){
            
            $token = generate_token();
            
            $subject = "Password Reset Link";
            $message = "A password reset has been inittiated from your account, 
            if you did not initiate this reset, please ignore this message, otherwise, 
            visit localhost:81/startnghospital/reset.php?token=".$token;
            file_put_contents( "db/tokens/" . $email . ".json", json_encode(['token'=> $token]));
            
            send_mail($subject,$message,$email,"forgot");
            die();
        }
         
    set_alert("error", "Email not registered with us");
    redirect("forgot.php");
    die();
}