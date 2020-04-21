<?php  
    include_once("lib/header.php"); 
    require_once("functions/redirect.php");
    require_once("functions/alert.php");

if (!$_SESSION['role'] == "Super Admin"){
    redirect("login.php");
    $_SESSION["message"] = "";
}
?>


<div class="container-fluid">
  <div class="row ">
    <nav class="col-md-2 d-none d-md-block bg-dark  bg-primary sidebar">
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
            <a class="nav-link" href="adminregister.php">
              <span data-feather="shopping-cart"></span>
              Add User
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="staffs.php">
              <span data-feather="shopping-cart"></span>
              Staffs
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="patientlist.php">
              <span data-feather="users"></span>
              Patients
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 over">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Admin Dashboard</h1>
        <p>LoggedIn User ID: <?php echo $_SESSION["loggedIn"] ?></p>
      </div>

    <p>
        <?php
            print_alert();
            $_SESSION["message"] = "";
            $_SESSION["error"] = "";
            
        ?>
    </p>
      
    <form method="POST" action="processregister.php"  class="shadow px-3 pb-3 mb-3 form mt-4">
        <h3 class="text-center pt-2">Register</h3>
        <p class="text-center">All Fields are required</p>
        <hr>
    <p class="form-group">
        <label for="">First name</label>
        <input class="form-control" value="<?php if(isset($_SESSION['first_name'])){
            echo(!empty($_SESSION['first_name']) ? $_SESSION['first_name'] : " ");
        }?>"

        type="text" name="first_name" placeholder="First Name" pattern="^[a-zA-Z]{2,}$" 
        title="Name should not have numbers, less than 2 or blank" required>
    </p>

    <p class="form-group">
        <label for="">Last name</label>
        <input class="form-control" value="<?php if(isset($_SESSION['last_name'])){
                echo(!empty($_SESSION['last_name']) ? $_SESSION['last_name'] : " ");
        } ?>"
            type="text" name="last_name" placeholder="Last Name"  
            title="Name should not have numbers, less than 2 or blank" pattern="^[a-zA-Z]{2,}$" required>
    </p>

    <p class="form-group">
        <label for="">Email</label>
        <input class="form-control" value="<?php if(isset($_SESSION['email'])){
            echo(!empty($_SESSION['email']) ? $_SESSION['email'] : " ");
        } ?>"
        type="text" name="email" placeholder="Email" >
    </p>

    <p class="form-group">
        <label for="">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
    </p>
    <hr />

    <p class="form-group">
        <label for="">Gender</label>
        <select class="form-control"
        
        name="gender" required>
            <option value="">Select One</option>
            <option
            <?php if(isset($_SESSION['gender']) && $_SESSION['gender'] == "Female"){
            echo "selected";
        } ?>
            >Female</option>
            <option
            <?php if(isset($_SESSION['gender']) && $_SESSION['gender'] == "Male"){
            echo "selected";
        } ?>
            >Male</option>
        </select>
    </p>

    <p class="form-group">
        <label for="">Designation</label>
        <select class="form-control"
        name="designation" required>
            <option value="">Select One</option>
            <option
            <?php if(isset($_SESSION['designation']) && $_SESSION['designation'] == "Medical Team"){
            echo "selected";
        } ?>
            >Medical Team</option>
            <option
            <?php if(isset($_SESSION['designation']) && $_SESSION['designation'] == "Patients"){
            echo "selected";
        } ?>
            >Patients</option>
            <option
            <?php if(isset($_SESSION['designation']) && $_SESSION['designation'] == "Super Admin"){
            echo "selected";
        } ?>
            >Super Admin</option>
        </select>
    </p>

    <p class="form-group">
        <label for="">Department</label>
        <input required class="form-control"
        <?php if(isset($_SESSION['department'])){
            echo "value=" . $_SESSION['department'];
        } ?>
        type="text" name="department" placeholder="Department" required />
    </p>

    <p>
        <button class="form-control bg-primary text-white" type="submit">Register</button>
    </p>
</form>

</main>

<?php include_once("lib/footer.php") ?>