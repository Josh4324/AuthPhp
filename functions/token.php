<?php

function generate_token(){
    $token = ""; //TODO on token generation
    // Generate Token generation
    $alphabet = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G',
    'H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

    for ($i = 0; $i < 20; $i++){
        $index = mt_rand(0,count($alphabet));
        $token = $token . $alphabet[$index];
    }

    return $token;
}

function find_token($email=""){
    $allUsersTokens = scandir("db/tokens");
    $countAllUsersTokens = count($allUsersTokens);
    

    for ($counter = 0; $counter < $countAllUsersTokens; $counter++){
        $currentTokenFile = $allUsersTokens[$counter];
       
        if($currentTokenFile == $email .".json"){
            $usertoken = file_get_contents("db/tokens/" . $currentTokenFile);
            $tokenObject = json_decode($usertoken);
            $tokenFrmDB = $tokenObject->token;


            return $tokenFrmDB;
        }
    }
    return false;
}
