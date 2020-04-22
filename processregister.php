<?php
session_start();
require_once("functions/users.php");
require_once("functions/alert.php");
require_once("functions/redirect.php");


//collecting the data

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$designation  = $_POST['designation'];
$department = $_POST['department'];


// error count
$errorCount = 0;


//Verifying the data, validation
(!preg_match("/^[a-zA-Z]{2,}$/",$first_name)) ? $errorCount++ : null;
(!preg_match("/^[a-zA-Z]{2,}$/",$last_name)) ? $errorCount++ : null;
(!filter_var($email, FILTER_VALIDATE_EMAIL)) ? $errorCount++ : null;

$password == "" ? $errorCount++ : $password;
$gender == "" ? $errorCount++ : $gender;
$designation  == "" ? $errorCount++ : $designation;
$department == "" ? $errorCount++ : $department;

// Saving data to Session

$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;
$_SESSION['email'] = $email;
$_SESSION['gender'] = $gender;
$_SESSION['designation'] = $designation;
$_SESSION['department'] = $department;


// checking error count and displaying appropriate message
if ($errorCount == 1) {
    //Give feedback to user
    set_alert("error","You have " . $errorCount . " error in your form submission");
    redirect("register.php");
}else if($errorCount > 1){
    set_alert("error","You have " . $errorCount . " errors in your form submission");
    redirect("register.php");
}

else {
    // count all users
    // Asign ID to the user
    $allUsers = scandir("db/users");
    $countAllUsers = count($allUsers);
    $newUserId = $countAllUsers - 1;
    
    // collecting date of registration
    $dateofregistration = date("Y.m.d"); 

    // creating user object
    $userObject =  [
        'id' => $newUserId,
        'first_name'=> $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'gender' => $gender,
        'designation' => $designation,
        'department' => $department,
        'dateofregistration' => $dateofregistration
    ];

    
    //check if the user already exists.
    $userExists = find_user($email);
    
    if($userExists){
        if ($_SESSION['role'] == 'Super Admin'){
            $error = "Registration Failed, User already exists";
            set_alert("error",$error);
            redirect("adminregister.php");
            die();
        }
        $error = "Registration Failed, User already exists";
        set_alert("error",$error);
        redirect("register.php");
        die();
    }

    //save userobject to database
   
    $userObject =  (object)$userObject;
    save_user($userObject);
    if ($_SESSION['role'] == 'Super Admin'){
        set_alert("message","Registration Successful, " . $first_name . " can now login");
        redirect("index.php");
    }else{
        $message = "Registration Successful, You can now login, " . $first_name;
        set_alert("message",$message);
        redirect("login.php");
    }
    
    
}

?>