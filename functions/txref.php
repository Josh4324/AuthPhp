<?php  
    function generate_txref(){
    $random = "rave-"; //TODO on token generation
    // Generate Token generation
    $alphabet = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G',
    'H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

    for ($i = 0; $i < 20; $i++){
        $index = mt_rand(0,count($alphabet));
        $random = $random . $alphabet[$index];
    }

    return $random;
    }
?>