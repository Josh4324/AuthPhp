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
    <nav class="col-md-2 d-none d-md-block bg-dark vh-100  bg-primary sidebar">
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
            <a class="nav-link" href="status.php">
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
    <h1 class="h2">Book Appointment</h1>
    <p>LoggedIn User ID: <?php echo $_SESSION["loggedIn"] ?></p>
  </div>
      
  <form method="POST" action="processbook.php" class="form shadow px-3 pb-3 pt-3">

    <p class="form-group">
        <label for="">Date of Appointment</label>
        <input  class="form-control" required
        type="Date" name="date" placeholder="Date" 
       required>
    </p>

    <p class="form-group">
        <label for="">Time of Appointment</label>
        <input  class="form-control" required
        type="Time" name="time" placeholder="Time" 
       required>
    </p>

    <p class="form-group">
        <label for="">Nature of Appointment</label>
        <input required class="form-control" required
        <?php
            //display department if saved in session 
            if(isset($_SESSION['nature'])){
                echo "value=" . $_SESSION['nature'];
            } 
        ?>
        type="text" name="nature" placeholder="Nature of Appointment" required />
    </p>

    <p class="form-group">
        <label for="">Initial Complaint</label>
        <input required class="form-control" required
        <?php
            //display department if saved in session 
            if(isset($_SESSION['complaint'])){
                echo "value=" . $_SESSION['complaint'];
            } 
        ?>
        type="text" name="complaint" placeholder="Initial Complaint" required />
    </p>

    <p class="form-group">
        <label for="">Department</label>
        <input required class="form-control" required
        type="text" name="department" placeholder="Department" required />
    </p>

    <p class="form-group">
        <button type="submit" class="form-control bg-primary text-white">Book Appointment</button>
    </p>
    </form>
      
</main>
      
      

<?php include_once("lib/footer.php") ?>