<?php  require_once("alert.php");

function is_user_loggedIn(){
    if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
        return true;
    }
    return false;
}

function is_token_set(){
   if(!is_token_set_in_get() || !is_token_set_in_session()){
        return true;
    }
    return false;
} 

function is_token_set_in_session(){
    return isset($_SESSION['token']);
}

function is_token_set_in_get(){
    return isset($_GET['token']);
}

function find_user($email = ""){
    //check the database if the user exists
    // count all users
    if (!$email){
        set_alert("error","User Email is not set");
        die();
    }
    $allUsers = scandir("db/users");
    
    $countAllUsers = count($allUsers);
    for ($counter = 0; $counter < $countAllUsers; $counter++){
        $currentUser = $allUsers[$counter];
        if($currentUser == $email .".json"){
            // get user fro the database
            $userString = file_get_contents("db/users/" . $currentUser);
            // decode user
            $userObject = json_decode($userString);
            
            return $userObject;
           
        }
    }

    return false;
}

function filter_files($var){
    $arr = [];
    for ($counter = 0; $counter < count($var); $counter++){
        $appointment = $var[$counter];
        if (strlen($appointment) > 4){
            array_push($arr,$appointment);
        }           
    }
    return $arr;
}

function get_appointments($email){
    //get all appoitments
    $allAppointments = scandir("db/appointments");
    $files = filter_files($allAppointments);

    $arr = [];
    $countAllApp = count($files);
    for ($counter = 0; $counter < $countAllApp; $counter++){
        $appointment = $files[$counter];

            // get appointment from the database
            $userString = file_get_contents("db/appointments/" . $appointment);
            // decode appointment object
            $userObject = json_decode($userString);
            
            if ($userObject ->email == $email ){
                array_push($arr,$userObject);
            }
           
    }

    return $arr;
}

function get_department_appointments($department){
    //get all appoitments
    $allAppointments = scandir("db/appointments");
    $files = filter_files($allAppointments);

    $arr = [];
    $countAllApp = count($files);
    for ($counter = 0; $counter < $countAllApp; $counter++){
        $appointment = $files[$counter];

            // get appointment from the database
            $userString = file_get_contents("db/appointments/" . $appointment);
            // decode appointment object
            $userObject = json_decode($userString);
            
            if ($userObject ->department == $department ){
                array_push($arr,$userObject);
            }
           
    }

    return $arr;
}

function get_staffs(){
    //get all appoitments
    $allUsers = scandir("db/users");
    $users = filter_files($allUsers);

    $arr = [];
    $countAllusers = count($users);
    for ($counter = 0; $counter < $countAllusers; $counter++){
        $user = $users[$counter];

            // get appointment from the database
            $userString = file_get_contents("db/users/" . $user);
            // decode appointment object
            $userObject = json_decode($userString);
            
            if ($userObject ->designation == "Medical Team" || $userObject ->designation == "Super Admin" ){
                array_push($arr,$userObject);
            }
           
    }

    return $arr;
}

function get_patients(){
    //get all appoitments
    $allUsers = scandir("db/users");
    $users = filter_files($allUsers);

    $arr = [];
    $countAllusers = count($users);
    for ($counter = 0; $counter < $countAllusers; $counter++){
        $user = $users[$counter];

            // get appointment from the database
            $userString = file_get_contents("db/users/" . $user);
            // decode appointment object
            $userObject = json_decode($userString);
            
            if ($userObject ->designation == "Patients"){
                array_push($arr,$userObject);
            }
           
    }

    return $arr;
}








function save_user($userObject){
    file_put_contents( "db/users/" . $userObject->email . ".json", json_encode($userObject));
}

function save_appointment($userObject){
    file_put_contents( "db/appointments/" . $userObject->appointment_id . ".json", json_encode($userObject));
}

