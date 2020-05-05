<?php
    session_start();
    require_once("functions/redirect.php");
    require_once("functions/users.php");
    require_once("functions/email.php");

    if (isset($_GET['txref'])) {
        $ref = $_GET['txref'];
        $email = $_SESSION["email"];
        


        $query = array(
            "SECKEY" => "FLWSECK_TEST-a3ffa2e77d3d067d4164a3ba92e18e28-X",
            "txref" => $ref
        );

        $data_string = json_encode($query);
                
        $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');                                                                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        curl_close($ch);

        $resp = json_decode($response, true);

        $paymentStatus = $resp['data']['status'];
        $chargeResponsecode = $resp['data']['chargecode'];
        $chargeAmount = $resp['data']['amount'];
        $chargeCurrency = $resp['data']['currency'];
        $fullname = $_SESSION["fullname"];
        $_SESSION["chargeAmount"] = $chargeAmount;


        if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $_SESSION["amount"]) && ($chargeCurrency == $_SESSION["currency"])){
        // creating payment object
        $paymentObject =  [
            'amount' => $chargeAmount,
            'currency' => $chargeCurrency,
            'txref'=> $ref,
            'email' => $email,
            'fullname'=> $fullname,
        ];

            //save payment object to database
            $paymentObject =  (object)$paymentObject;
            save_payment($paymentObject);

            redirect("paymentmail.php");
            
            
            // transaction was successful...
             // please check other things like whether you already gave value for this ref
          // if the email matches the customer who owns the product etc
          //Give Value and return to Success page
        } else {
            //Dont Give Value and return to Failure page
        }
    }
        else {
      die('No reference supplied');
    }

?>