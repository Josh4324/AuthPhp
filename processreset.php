<?php session_start();
      require_once("functions/users.php");
      require_once("functions/alert.php");
      require_once("functions/redirect.php");
      require_once("functions/email.php");
      require_once("functions/token.php");

// error count
$errorCount = 0;

// get token if user is not loggedIn
if(!is_user_loggedIn()){
    $token = $_POST['token'];
    $token == "" ? $errorCount++ : $token;
    $_SESSION['token'] = $token;
}

//collecting the data
$email = $_POST['email'];
$password = $_POST['password'];

//Verifying the data, validation
$email == "" ? $errorCount++ : $email;
$password == "" ? $errorCount++ : $password;

// Saving data to Session
$_SESSION['email'] = $email;

// checking error count and displaying appropriate message
if ($errorCount == 1) {
    //Give feedback to user
    set_alert("error","You have " . $errorCount . " error in your form submission");
    redirect("reset.php");
}else if($errorCount > 1){
    set_alert("error","You have " . $errorCount . " errors in your form submission");
    redirect("reset.php");
}else {

    if(is_user_loggedIn()){
        $checkToken = true;
    }else{
        $tokenFrmDb = find_token($email);
        if ($tokenFrmDb == $token){
            $checkToken = true;
       }
    }

    if($checkToken){
                
        //check if the user already exists.
        $userExists = find_user($email);
                
        //check if the user already exists.
               
        if($userExists){
                        
            $currentUser = $email .".json";
            
            $userString = file_get_contents("db/users/" . $currentUser);
        
            $userObject = json_decode($userString);
            
            $userObject->password = password_hash($password, PASSWORD_DEFAULT);
                        
            unlink("db/users/" . $currentUser); //delete previous file
            if($token){
                unlink("db/tokens/" . $currentUser); //delete previous file
            }
                        
            save_user($userObject);
                        

            //inform user of password reset
            
            $subject = "Password Reset Successful";
            $message = "Your account on smh has been updated, your password has changed, 
            if you did not initiate the password change, please visi smh.org and reset the password now.";
            send_mail($subject,$message,$email);
            if ($_SESSION['role'] == 'Super Admin'){
                redirect("dashboard.php");
                die();
            }else if ($_SESSION['role'] == 'Medical Team'){
                redirect("mt.php");
                die();
            }else{
                redirect("patient.php");
                die();
            }
               
                        
        }
                
           
    }     
         
    set_alert("message","Password Reset Failed, token or email invalid or expired");
    redirect("login.php");
    die();

}
?>