<?php include_once("lib/header.php");
      require_once("functions/alert.php"); 
?>

<p> 
   <?php
      //display error message if vallidation fails
      print_alert();
      session_destroy();
   ?>
</p>



<form action="processforgot.php" method="POST" class="form shadow px-3 pb-3 mt-5">
   <h3 class="text-center pt-2">Forgot Password</h3>
   <p class="text-center">Provide the email address associated with your account</p>   
   <p class="form-group">
      <label for="">Email</label>
      <input value="
      <?php if(isset($_SESSION['email'])){
            echo(!empty($_SESSION['email']) ? $_SESSION['email'] : " ");
            } 
      ?>"
      type="email" class="form-control" name="email" placeholder="Email" >
   </p>

   <p>
      <button class="form-control bg-primary text-white" type="submit">Send Reset Code</button>
   </p>
   </form>
<?php include_once("lib/footer.php") ?>