<?php include_once("lib/header.php");
      require_once("functions/alert.php");
      require_once("functions/redirect.php");
      require_once("functions/users.php");

    if (!is_user_loggedIn()){
    redirect("login.php");
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
            <?php  if ($_SESSION["role"] == "Super Admin"){
                echo "
                    <li class='nav-item'>
                        <a class='nav-link' href='adminregister.php'>
                        <span data-feather='shopping-cart'></span>
                        Add User
                        </a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='staffs.php'>
                        <span data-feather='shopping-cart'></span>
                        Staffs
                        </a>
                    </li>
                    <li class='nav-item'>
                         <a class='nav-link' href='patientlist.php'>
                        <span data-feather='users'></span>
                        Patients
                        </a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='paymentlist.php'>
                        <span data-feather='users'></span>
                        Payments
                        </a>
                    </li>
                ";
            }else if($_SESSION["role"] == "Medical Team"){
                echo "
                    <li class='nav-item'>
                        <a class='nav-link' href='appointment.php'>
                        <span data-feather='shopping-cart'></span>
                        Appointments
                        </a>
                    </li>
                ";
            }else {
                echo "
                
                <li class='nav-item'>
                    <a class='nav-link' href='book.php'>
                    <span data-feather='shopping-cart'></span>
                    Book Apointment
                    </a>
                </li>
                <li class='nav-item'>
                <a class='nav-link' href='status.php'>
                  <span data-feather='shopping-cart'></span>
                  Apointments Status
                </a>
              </li>
                <li class='nav-item'>
                    <a class='nav-link' href='bill.php'>
                    <span data-feather='users'></span>
                    Pay Bill
                    </a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='ph.php'>
                    <span data-feather='users'></span>
                    Payment History
                    </a>
                </li>
                
                ";
            }     
        ?>
          
        </ul>
      </div>
    </nav>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 over">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Profile</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <p>LoggedIn User ID: <?php echo $_SESSION["loggedIn"] ?></p>
        </div>
        </div>
        <div>
        </div>

    <form method="POST" action="processregister.php" class="form pt-5">


    <p class="form-group">
        <label for="">First name</label>
        <input  class="form-control" readonly
        value="<?php 
                    //display firstname if saved in session
                    if(isset($_SESSION['firstname'])){
                        echo(!empty($_SESSION['firstname']) ? $_SESSION['firstname'] : " ");
                    }
                ?>"
        type="text" name="first_name" placeholder="First Name" pattern="^[a-zA-Z]{2,}$" 
        title="Name should not have numbers, less than 2 or blank" required>
    </p>

    <p class="form-group">
        <label for="">Last name</label>
        <input class="form-control"  readonly
        value="<?php
                    //display last name if saved in session 
                    if(isset($_SESSION['lastname'])){
                        echo(!empty($_SESSION['lastname']) ? $_SESSION['lastname'] : " ");
                    } 
                ?>"
        type="text" name="last_name" placeholder="Last Name"  
        required>
    </p>

    <p class="form-group">
        <label for="">Email</label>
        <input class="form-control"  readonly
        value="<?php
                    //display email if saved in session  
                    if(isset($_SESSION['email'])){
                        echo(!empty($_SESSION['email']) ? $_SESSION['email'] : " ");
                    } 
                ?>"
        type="email" name="email" placeholder="Email" >
    </p>

    <p class="form-group">
        <label for="">Designation</label>
        <select name="designation"  disabled class="form-control" required>
            <option value="">Select One</option>
            <option
            <?php
                //display designation if saved in session 
                if(isset($_SESSION['role']) && $_SESSION['role'] == "Medical Team"){
                    echo "selected";
                } 
            ?>
            >Medical Team</option>
            <option
            <?php
                //display designation if saved in session 
                if(isset($_SESSION['role']) && $_SESSION['role'] == "Patients"){
                    echo "selected";
                } 
            ?>
            >Patients</option>
            <option
            <?php
                //display designation if saved in session 
                if(isset($_SESSION['role']) && $_SESSION['role'] == "Super Admin"){
                    echo "selected";
                } 
            ?>
            >Super Admin</option>
        </select>
    </p>

    <p class="form-group">
        <label for="">Department</label>
        <input required class="form-control"  readonly
        <?php
            //display department if saved in session 
            if(isset($_SESSION['department'])){
                echo "value=" . $_SESSION['department'];
            } 
        ?>
        type="text" name="department" placeholder="Department" required />
    </p>

    </form>


</main>
    

<?php include_once("lib/footer.php") ?>