<?php
session_start();
require_once("functions/redirect.php");
$curl = curl_init();


$currency = $_POST['currency'];
$txref = $_POST['txref'];


$customer_email = $_POST['email'];;
$amount = $_POST['amount'];  
$currency = $_POST['currency'];
$txref = $_POST['txref']; // ensure you generate unique references per transaction.
$PBFPubKey = "FLWPUBK_TEST-ca1bae79045ee105ab06ca5a6f808f7b-X"; // get your public key from the dashboard.
$redirect_url = "http://localhost:81/startnghospital/verify.php";
$payment_plan = "pass the plan id"; // this is only required for recurring payments.

$_SESSION["amount"] = $amount;
$_SESSION["currency"] = $currency;


curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'amount'=>$amount,
    'customer_email'=>$customer_email,
    'currency'=>$currency,
    'txref'=>$txref,
    'PBFPubKey'=>$PBFPubKey,
    'redirect_url'=>$redirect_url,
    'payment_plan'=>$payment_plan
  ]),
  CURLOPT_HTTPHEADER => [
    "content-type: application/json",
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
  // there was an error contacting the rave API
  die('Curl returned error: ' . $err);
}

$transaction = json_decode($response);

if(!$transaction->data && !$transaction->data->link){
  // there was an error from the API
  print_r('API returned error: ' . $transaction->message);
}

// uncomment out this line if you want to redirect the user to the payment page
//print_r($transaction->data->message);


// redirect to page so User can pay
// uncomment this line to allow the user redirect to the payment page
header('Location: ' . $transaction->data->link);