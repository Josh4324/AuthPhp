<?php require_once('alert.php');
    require_once('redirect.php');

function send_mail(
    $subject = "",
    $message = "",
    $email = "",
    $type = "reset"
){

    $headers = "From: no-reply@smh.org" . "\r\n" . "CC: josh@smh.org";
    
    $try = mail($email,$subject,$message,$headers);
    if ($try){
        //success message
        $type == "reset" ? set_alert("message","Password Reset Successfull") : set_alert("message", "Password Reset Mail Sent Successfully");
        redirect("login.php");
    }else{
        //display error message
        $type == "reset" ? set_alert("error","Poor Network, Unable to Send Email") : set_alert("error","Something went wrong, Unable to Send Password Reset Email");
        redirect("forgot.php");
    }

}