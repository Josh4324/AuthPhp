<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to SNG : Hospital for the ignorant</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
<?php session_start() ?>

<nav class="navbar navbar-expand-lg navbar-dark text-white bg-primary ">
<a class="navbar-brand text-white" href="index.php">StartNG Hospital</a>
    <ul class="navbar-nav ml-auto ">
    <li class='text-white nav-item active'><a class="nav-link text-white" href="index.php">Home</a> </li>
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'Super Admin'){
        echo "<li class='text-white nav-item'><a class='nav-link' href='dashboard.php'>Dashboard</a></li>" . "  "  . " <li class='text-white nav-item'><a class='nav-link' href='reset.php'>Reset Password</a></li> " . "<li class='text-white bg-danger rounded nav-item'><a class='nav-link' href='logout.php'>Logout</a></li>"; 
    }else if(isset($_SESSION['loggedIn']) && $_SESSION['role'] == 'Medical Team'){
        echo "<li class='text-white nav-item'><a class='nav-link' href='mt.php'>Dashboard</a></li>" . " <li class='text-white nav-item'><a class='nav-link' href='reset.php'>Reset Password</a></li>" . "<li class='text-white bg-danger nav-item rounded'><a class='nav-link' href='logout.php'>Logout</a></li>";
    }else if(isset($_SESSION['loggedIn']) && $_SESSION['role'] == 'Patients'){
        echo "<li class='text-white nav-item'><a class='nav-link' href='patient.php'>Dashboard</a></li>" . " <li class='text-white nav-item'><a class='nav-link' href='reset.php'>Reset Password</a></li> " . "<li class='text-white nav-item bg-danger rounded'><a class='nav-link' href='logout.php'>Logout</a></li>";
    }else{
        echo "<li class='text-white nav-item'><a class='nav-link' href='login.php'>Login</a></li>" . "  " . "<li class='text-white nav-item'><a class='nav-link' href='register.php'>Register</a></li>" . "  ".  "<li class='text-white nav-item'><a class='nav-link' href='forgot.php'>Forgot Password</a></li>";
    }?>

    </ul>
    
</nav>
