<?php
session_start();
require_once("functions/redirect.php");
require_once("functions/email.php");

$email = $_SESSION["email"];
$chargeAmount = $_SESSION["chargeAmount"];


$subject = "Payment Successful";
$message = "Your transaction was successfully, you paid " . $chargeAmount . " naira only, 
if you did not initiate the booking, please visi smh.org and reset the password now.";

 send_mail_payment($subject,$message,$email);

?>