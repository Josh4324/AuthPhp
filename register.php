<?php     
    include_once("lib/header.php"); 
    require_once("functions/alert.php");
    require_once("functions/users.php");
    //redirect to dashboard if the user is already logged in
    if (is_user_loggedIn()){
    header("Location: dashboard.php");
    }
?>
<p>
        <?php
        //display error message if vallidation fails
        print_alert();
        ?>
    </p>


<form method="POST" action="processregister.php" class=" shadow px-3 pb-3 mb-3 form mt-4">
    
    <h3 class="text-center pt-2">Register</h3>
    <p class="text-center">All Fields are required</p>
    <hr>

    <p class="form-group">
        <label for="">First name</label>
        <input  class="form-control"
        value="<?php 
                    //display firstname if saved in session
                    if(isset($_SESSION['first_name'])){
                        echo(!empty($_SESSION['first_name']) ? $_SESSION['first_name'] : " ");
                    }
                ?>"
        type="text" name="first_name" placeholder="First Name" pattern="^[a-zA-Z]{2,}$" 
        title="Name should not have numbers, less than 2 or blank" required>
    </p>

    <p class="form-group">
        <label for="">Last name</label>
        <input class="form-control"
        value="<?php
                    //display last name if saved in session 
                    if(isset($_SESSION['last_name'])){
                        echo(!empty($_SESSION['last_name']) ? $_SESSION['last_name'] : " ");
                    } 
                ?>"
        type="text" name="last_name" placeholder="Last Name"  
        title="Name should not have numbers, less than 2 or blank" pattern="^[a-zA-Z]{2,}$" required>
    </p>

    <p class="form-group">
        <label for="">Email</label>
        <input class="form-control"
        value="<?php
                    //display email if saved in session  
                    if(isset($_SESSION['email'])){
                        echo(!empty($_SESSION['email']) ? $_SESSION['email'] : " ");
                    } 
                ?>"
        type="email" name="email" placeholder="Email" >
    </p>

    <p class="form-group">
        <label for="">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
    </p>

    <hr />

    <p class="form-group">
        <label for="">Gender</label>
        <select name="gender" class="form-control" required>
            <option value="">Select One</option>
            <option
            <?php
                //display gender if saved in session 
                if(isset($_SESSION['gender']) && $_SESSION['gender'] == "Female"){
                    echo "selected";
                } 
            ?>
            >Female</option>

            <option
            <?php
                //display gender if saved in session 
                if(isset($_SESSION['gender']) && $_SESSION['gender'] == "Male"){
                    echo "selected";
                } 
            ?>
            >Male</option>
        </select>
    </p>

    <p class="form-group">
        <label for="">Designation</label>
        <select name="designation" class="form-control" required>
            <option value="">Select One</option>
            <option
            <?php
                //display designation if saved in session 
                if(isset($_SESSION['designation']) && $_SESSION['designation'] == "Medical Team"){
                    echo "selected";
                } 
            ?>
            >Medical Team</option>
            <option
            <?php
                //display designation if saved in session 
                if(isset($_SESSION['designation']) && $_SESSION['designation'] == "Patients"){
                    echo "selected";
                } 
            ?>
            >Patients</option>
        </select>
    </p>

    <p class="form-group">
        <label for="">Department</label>
        <input required class="form-control"
        <?php
            //display department if saved in session 
            if(isset($_SESSION['department'])){
                echo "value=" . $_SESSION['department'];
            } 
        ?>
        type="text" name="department" placeholder="Department" required />
    </p>

    <p class="form-group">
        <button class="form-control bg-primary text-white" type="submit">Register</button>
    </p>

    <p class="text-center">
        <a  href="login.php">Already Have an account? Log In</a>
    </p>
    
    </form>

<?php include_once("lib/footer.php") ?>