<?php 

function print_alert(){
    //for printing message or error
    $types = ["message","info","error"];
    $colors = ["alert-success","alert-info","alert-danger"];
    for($i = 0; $i < count($types); $i++){
        if(isset($_SESSION[$types[$i]]) && !empty($_SESSION[$types[$i]])){  
            echo "<div class='alert mx-auto text-center " .$colors[$i]." role='alert' style='width: 400px;'>" . $_SESSION[$types[$i]] . "</div>";
            
        }
    }
    
   }

function set_alert($type = "message", $content = ""){
    switch($type){
        case "message":
            $_SESSION["message"] = $content;
        break;
        case "error":
            $_SESSION["error"] = $content;
        break;
        case "message":
            $_SESSION["info"] = $content;
        break;
        default:
            $_SESSION["message"] = $content;
        break;
    }
}

?>