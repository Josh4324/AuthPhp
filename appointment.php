<?php 
        include_once("lib/header.php"); 
        require_once("functions/alert.php");
        require_once("functions/redirect.php");
        require_once("functions/users.php");
    if (!is_user_loggedIn()){
        redirect("login.php");
        }
    if (!($_SESSION["role"] == "Medical Team")){
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
            <a class="nav-link" href="appointment.php">
              <span data-feather="shopping-cart"></span>
              Appointments
            </a>
          </li>
        </ul>
      </div>
    </nav>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 over">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Appointment</h1>
        <p>LoggedIn User ID: <?php echo $_SESSION["loggedIn"] ?></p>
  </div>
      
  <div>
            
      <?php
            $department = $_SESSION["department"];
            $appointments = get_department_appointments($department);
          if (count($appointments) < 1){
              echo " <h3> You have no pending appointments </h3>";
          }else {

          
          for ($counter = 0; $counter < count($appointments); $counter++){
              $currentappointment = $appointments[$counter];
              echo "
              <div class='bg-primary rounded d-flex justify-content-between mb-3'>
                  <p class='mt-2 ml-2'>
                  Appointment Id : " . $currentappointment->appointment_id .
                  "
                  </p>
                  <button  class='my-2 mr-4 btn btn-primary but'>Show Details</button>
              </div>


              <table class='table d-none'>
                  <thead class='thead-dark'>
                      <tr>
                      <th scope='col'>Patient Name</th>
                      <th scope='col'>Appointment Date</th>
                      <th scope='col'>Appointment Time</th>
                      <th scope='col'>Appointment Nature</th>
                      <th scope='col'>Complaint</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                      <th scope='row'> " .  $currentappointment->fullname . " </th>
                      <td> " . $currentappointment->appointment_date . " </td>
                      <td> " . $currentappointment->appointment_time . " </td>
                      <td> " . $currentappointment->appointment_nature . " </td>
                      <td> " . $currentappointment->complaint . " </td>
                      </tr>
                  </tbody>
              </table>
              
              ";
          }
      }
      ?>
            
    </div>
  
  </main>

<?php include_once("lib/footer.php") ?>