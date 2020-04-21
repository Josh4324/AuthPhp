<?php
session_start();
require_once("functions/users.php");
require_once("functions/alert.php");
require_once("functions/redirect.php");
require_once("functions/token.php");
require_once("functions/email.php");


//collecting the data

$appointment_date = $_POST['date'];
$appointment_time = $_POST['time'];
$appointment_nature = $_POST['nature'];
$complaint = $_POST['complaint'];
$department = $_POST['department'];
$email = $_SESSION["email"];
$fullname = $_SESSION["fullname"];

// error count
$errorCount = 0;


//Verifying the data, validation

$appointment_date == "" ? $errorCount++ : $appointment_date;
$appointment_time  == "" ? $errorCount++ : $appointment_time ;
$appointment_nature  == "" ? $errorCount++ : $appointment_nature;
$complaint  == "" ? $errorCount++ : $complaint;
$department == "" ? $errorCount++ : $department;

// Saving data to Session


$_SESSION['appointment_nature'] = $appointment_nature;
$_SESSION['complaint'] = $complaint;




// checking error count and displaying appropriate message
if ($errorCount == 1) {
    //Give feedback to user
    set_alert("error","You have " . $errorCount . " error in your form submission");
    redirect("book.php");
}else if($errorCount > 1){
    set_alert("error","You have " . $errorCount . " errors in your form submission");
    redirect("book.php");
}

else {
    // count all users
    // Asign ID to the user
    $allAppointments = scandir("db/appointments");
    $countAllUsers = count($allUsers);
    $newApptId = $countAllUsers - 1;
    
    // collecting date of registration
    $dateofappointment = date("Y.m.d"); 
    //generate appointment id
    $appointment_id = generate_token();

    // creating user object
    $appointmentObject =  [
        'appointment_id' => $appointment_id,
        'appointment_date' => $appointment_date,
        'appointment_time'=> $appointment_time,
        'appointment_nature' => $appointment_nature,
        'complaint' => $complaint,
        'department' => $department,
        'dateofappointmentregistration' => $dateofappointment,
        'email' => $email,
        'fullname'=> $fullname,
    ];
    

    //save appointmentobject to database
   
    $appointmentObject =  (object)$appointmentObject;
    save_appointment($appointmentObject);
    $subject = "Appointment Booked Successful";
    $message = "Your appointment was booked successfully, 
    if you did not initiate the booking, please visi smh.org and reset the password now.";
    send_mail($subject,$message,$email);
    set_alert("message", "Appointment Sent Successfully");
    redirect("index.php");
    
}

?>