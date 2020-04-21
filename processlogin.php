<?php
session_start();
require_once("functions/alert.php");
require_once("functions/redirect.php");
require_once("functions/users.php");

// collecting data
$email = $_POST['email'];
$password = $_POST['password'];

// error count
$errorCount = 0;

// verifying data
$email == "" ? $errorCount++ : $email;
$password == "" ? $errorCount++ : $password;

// Saving data to Session
$_SESSION['email'] = $email;

// checking error count and displaying appropriate message
if ($errorCount == 1) {
    //Give feedback to user
    set_alert("error","You have " . $errorCount . " error in your form submission");
    redirect("login.php");
}else if($errorCount > 1){
    set_alert("error","You have " . $errorCount . " errors in your form submission");
    redirect("login.php");
}
else {
    $userExists = find_user($email);
    
        if($userExists){
            // get user fro the database
            $userString = file_get_contents("db/users/" . $email .".json");
            // decode user
            $userObject = json_decode($userString);
            $passwordFromDb = $userObject->password;
            
            // compare database password with user-input password
            if (password_verify($password,$passwordFromDb)){
                
                // Saving more data to Session if user password is correct

                $_SESSION['loggedIn'] = $userObject->id;
                $_SESSION["fullname"] = $userObject->first_name . " " . $userObject->last_name;
                $_SESSION["firstname"] = $userObject->first_name;
                $_SESSION["lastname"] =$userObject->last_name;
                $_SESSION["role"] = $userObject->designation;
                $_SESSION["department"] = $userObject->department;
                $_SESSION["date-of-registration"] = $userObject->dateofregistration;
                $_SESSION["last-login-time"] = $userObject->lastlogintime;
                $_SESSION["last-login-date"] = $userObject->lastlogindate;
                //set time zone
                date_default_timezone_set("Africa/Lagos");
                // converting userobject to array in order to add more items
                $userObject = (array)$userObject;
                $userObject["lastlogintime"] = date("h:i:sa");
                $userObject["lastlogindate"] = date("Y.m.d");
                $userObject = (object)$userObject;

                // add user object to database
                file_put_contents( "db/users/" . $email . ".json", json_encode($userObject));
                
                // redirect user to patients dashboard if user is a patient
                if($userObject->designation == 'Patients'){
                    redirect("patient.php");
                    die();
                // redirect user to Medical Team dashboard if user is part of the Medical Team
                }else if ($userObject->designation == 'Medical Team') {
                    redirect("mt.php");
                    die();
                // redirect user to Super Admin Dashboard
                }else {
                    redirect("dashboard.php");
                    die();
                }
               
            }
            
           
        }
         
  

    set_alert("error","Invalid Email or Password");
    redirect("login.php");
    die();

}


?>