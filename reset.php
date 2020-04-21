<?php include_once("lib/header.php");
      require_once("functions/alert.php");
      require_once("functions/users.php");
      require_once("functions/redirect.php");
?> 

<p> 
    <?php
        // checks if user is authorized to view the reset page
        if(!is_user_loggedIn() && !is_token_set()){
            set_alert("error","You are not authorized to view that page");
            redirect("login.php");
        }
    ?>
</p>

<p>
   <?php
      //display success message if vallidation pass or error message if vallidation fails
      print_alert();
   ?>
</p>


<form action="processreset.php" method="POST" class="form shadow px-3 pb-3 mt-5">
    <h3 class="text-center pt-3">Reset Password</h3>
    <p class="text-center">Reset Password associated with your account </p>

    <p> 
        <input type="hidden" name="token" 
        value="<?php
                    //display token if saved in GET object
                    if (is_token_set_in_get()){
                        echo $_GET['token'];
                    } 
                ?>">
    </p>
    
    <p class="form-group">
        <label for="">Email</label>
        <input class="form-control" value="<?php
                        //display email if saved in session
                        if(isset($_SESSION['email'])){
                            echo $_SESSION['email'];
                        } 
                      ?>"
        type="email" name="email" placeholder="Email" >
    </p>
        
    <p class="form-group">
        <label for="">Password</label>
        <input class="form-control" type="password" name="password" placeholder="Password" required>
    </p>

    <p>
        <button class="form-control bg-primary text-white" type="submit">Reset Password</button>
    </p>
    
   </form>
<?php include_once("lib/footer.php") ?>