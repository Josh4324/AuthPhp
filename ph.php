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
          <li class="nav-item">
            <a class="nav-link" href="ph.php">
              <span data-feather="users"></span>
              Payment History
            </a>
          </li>
        </ul>
      </div>
    </nav>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 over">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Payment History</h1>
    <p>LoggedIn User ID: <?php echo $_SESSION["loggedIn"] ?></p>
  </div>
  
  <div>
  <table class="table">
            <thead class="thead-dark">
                <tr>
                  <th scope="col">Amount</th>
                  <th scope="col">Reference</th>
                  <th scope="col">Currency</th>
                  </tr>
            </thead>
            <tbody>
                    <?php

                        $email = $_SESSION["email"];
                        $payments = get_payments_history($email);

                        for ($counter = 0; $counter < count($payments); $counter++){
                            $currentpayment = $payments[$counter];
                            echo 
                            "<tr>
                              <td> " . $currentpayment->amount . " </td>
                              <td> " . $currentpayment->txref . "  </td>
                              <td> " . $currentpayment->currency . " </td>
                             </tr>";
                        }
                    
                    ?>
              </tbody>
            </table>
    
  </div>

  
  
  
  
  
</main>
      

<?php include_once("lib/footer.php") ?>