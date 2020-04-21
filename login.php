<?php 
   include_once("lib/header.php");
   require_once("functions/alert.php");
   require_once("functions/users.php");

   //redirect to dashboard if the user is already logged in
   if (is_user_loggedIn()){
   //redirect to dashboard
   header("Location: dashboard.php");
   }
?>
   
<p>
   <?php
      //display success message if vallidation pass or error message if vallidation fails
      print_alert();
      session_destroy();
   ?>
</p>


<form action="processlogin.php" method="POST" class=" shadow form pt-2 mt-5 px-3 pb-3">
<h3 class="text-center">Login</h3>
   <p class="form-group">
      <label for="">Email</label>
         <input 
         value="<?php 
                   //display email if saved in session
                  if(isset($_SESSION['email'])){
                     echo(!empty($_SESSION['email']) ? $_SESSION['email'] : " ");
                  } 
            ?>"
         type="email" class="form-control" name="email" placeholder="Email" >
   </p>

   <p v>
      <label for="">Password</label>
      <input type="password" class="form-control" name="password" placeholder="Password" required>
   </p>

   <p class="text-center"><a href="forgot.php">Forget Password</a> </p>
   <p class="text-center"><a href="register.php">Dont have an Account ? Register</a> </p>

   <p class="form-group">
      <button class="form-control text-white bg-primary" type="submit">Login</button>
   </p>
   
   </form>
<?php include_once("lib/footer.php") ?>