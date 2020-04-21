<?php include_once("lib/header.php");
      require_once("functions/alert.php"); 
      require_once("functions/users.php"); 
?>

<p>
   <?php
      //display message
      print_alert();
      $_SESSION["message"] = "";
      $_SESSION["error"] = "";
      
   ?>
</p>

<div class="t1">
   <h1 class="text-center">Welcome to SNH</h2>
   <p class="text-center font-weight-bold">Hospital for the ignorant</p>
   <p class="text-center font-weight-normal">This is a specialist hospital to cure ignorance, Come as you are, it is completely free </p>

   <?php     
   
   if (is_user_loggedIn()){
      echo " ";
   }else {
      echo "
      <div class='mx-auto mt-3' style='width: 200px;'>
         <a class='btn btn-outline-primary' href='login.php'>Login</a></button>
         <a class='btn btn-outline-primary ml-3' href='register.php'>Register</a>
      </div>
      ";
   }
   ?>
   
</div>

<?php include_once("lib/footer.php") ?>