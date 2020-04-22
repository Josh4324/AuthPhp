<?php 
    include_once("lib/header.php"); 
    require_once("functions/users.php");
    require_once("functions/redirect.php");
    
    if (!is_user_loggedIn()){
    redirect("login.php");
    }

    if (!($_SESSION["role"] == "Patients")){
      redirect("index.php");
    }
?>

<div class="container-fluid">
  <div class="row ">
    <nav class="col-md-2 d-none vh-100 d-md-block bg-dark  bg-primary sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href=<?php 
                    if ($_SESSION["role"] == "Super Admin"){
                        echo "dashboard.php";
                    }else if($_SESSION["role"] == "Medical Team"){
                        echo "mt.php";
                    }else {
                        echo "patient.php";
                    }?>
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile.php">
              <span data-feather="file"></span>
              Profile
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="book.php">
              <span data-feather="shopping-cart"></span>
              Book Apointment
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="status.php">
              <span data-feather="shopping-cart"></span>
              Apointments Status
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="bill.php">
              <span data-feather="users"></span>
              Pay Bill
            </a>
          </li>
        </ul>
      </div>
    </nav>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 over">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Patient Dashboard</h1>
    <p>LoggedIn User ID: <?php echo $_SESSION["loggedIn"] ?></p>
  </div>
  
  <div class="d-flex justify-content-between">
    <h3>Welcome <?php echo $_SESSION['fullname'] ?></h3>
    <div>
      <p><?php echo $_SESSION["department"] ?> Department</p>
      <p> <?php echo isset($_SESSION["last-login-date"]) ? "Last login Date : " . $_SESSION["last-login-date"] . " | " . $_SESSION["last-login-time"] : " "; ?></p></p>
      <p>Date of Registration : <?php echo $_SESSION["date-of-registration"] ?></p>
      <p>Role : <?php echo $_SESSION["role"] ?></p>
      
    </div>
    
    
  </div>

  <p>
      <?php
            print_alert();
            $_SESSION["message"] = "";
            $_SESSION["error"] = "";
            
        ?>
    </p>
  
  <div class='mx-auto mt-3 d-flex justify-content-between' style='width: 400px;'>
        <a class="py-4 px-4 btn btn-primary" href="bill.php">Pay Bill</a>
        <a class="py-4 px-4 btn btn-primary ml-auto text-left" href="book.php">Book Apointment</a>
  </div>
  
  
</main>
      

<?php include_once("lib/footer.php") ?>