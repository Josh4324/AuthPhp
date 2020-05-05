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
          <li class="nav-item">
            <a class="nav-link" href="paymentlist.php">
              <span data-feather="users"></span>
              Payments
            </a>
          </li>
        </ul>
      </div>
    </nav>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 over">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Payment List</h1>
    <p>LoggedIn User ID: <?php echo $_SESSION["loggedIn"] ?></p>
  </div>
  
  
  <div>
    <?php  
        $payments = get_payments();
        
        for ($counter = 0; $counter < count($payments); $counter++){
            $currentpayment = $payments[$counter];
            echo "

            <div class='bg-primary rounded d-flex justify-content-between mb-3'>
            <p class='mt-2 ml-2 text-white'>
            Patient Name : " . $currentpayment->fullname . 
            "
            </p>
            <button  class='my-2 mr-4 btn btn-primary but'>Show Details</button>
        </div>
  
  
        <table class='table d-none'>
            <thead class='thead-dark'>
                <tr>
                <th scope='col'>Patient Name</th>
                    <th scope='col'>Amount</th>
                    <th scope='col'>Reference number</th>
                    <th scope='col'>Currency</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope='row'> " . $currentpayment->fullname . " </th>
                <td> " . $currentpayment->amount . " </td>
                <td> " . $currentpayment->txref . " </td>
                <td> " . $currentpayment->currency . " </td>
                </tr>
            </tbody>
        </table>
        
            ";
        }
    ?>
  </div>
  
</main>
      
<?php include_once("lib/footer.php") ?>