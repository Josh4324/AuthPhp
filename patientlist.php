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
    <h1 class="h2">Patients</h1>
    <p>LoggedIn User ID: <?php echo $_SESSION["loggedIn"] ?></p>
  </div>
  
  
  <div>
    <?php  
        $patients = get_patients();
        for ($counter = 0; $counter < count($patients); $counter++){
            $currentpatient = $patients[$counter];
            echo "

            <div class='bg-primary rounded d-flex justify-content-between mb-3'>
            <p class='mt-2 ml-2 text-white'>
            Patient Name : " . $currentpatient->first_name . " " . $currentpatient->last_name .
            "
            </p>
            <button  class='my-2 mr-4 btn btn-primary but'>Show Details</button>
        </div>
  
  
        <table class='table d-none'>
            <thead class='thead-dark'>
                <tr>
                <th scope='col'>Patient Name</th>
                    <th scope='col'>Email</th>
                    <th scope='col'>Gender</th>
                    <th scope='col'>Role</th>
                    <th scope='col'>Department</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope='row'> " . $currentpatient->first_name . " " . $currentpatient->last_name . " </th>
                <td> " . $currentpatient->email . " </td>
                <td> " . $currentpatient->gender . " </td>
                <td> " . $currentpatient->designation . " </td>
                <td> " . $currentpatient->department . " </td>
                </tr>
            </tbody>
        </table>
        
            ";
        }
    ?>
  </div>
  
</main>
      
<?php include_once("lib/footer.php") ?>