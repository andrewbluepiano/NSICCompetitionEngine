<?php
// Author: Andrew Afonso
// Login handler for NSIC engine

// Parameters from form
$username = $_POST['username'];
$passwd = $_POST['password'];

require_once('readconnect.php');
require_once('nsic_vars.php');

// Uses bound statements
if($stmt = $readconn->prepare("SELECT * FROM users WHERE compuser=?")){
    if($stmt->bind_param("s", $username)){
        if(!$stmt->execute()){
            die("ERR: Issue executing prepared statement: " . mysqli_error($readconn));
        }
        
        if($returned = $stmt->get_result()){
            $row = $returned->fetch_assoc();
            if($returned->num_rows != 1){
                header('Location: ../login');
                // Keep this, and the matching message later the same to prevent blind SQL attacks attacks on passwords
                die("False - Username or password was invalid");
            }
            
            if($row['comppass'] === md5($passwd) && $row['enabled'] === 1){
                // Successful Login
                
                // Clear any existing session info
                session_unset();
                session_destroy();
                $sess_id = session_start();
                session_regenerate_id(true);
                
                // Set session variables
                $_SESSION['username'] = $_POST['username'];
                // To differentiate between sessions if the engine is run from a subdirectory on a larger site.
                $_SESSION['type'] = $typeVar;
                // Set a teamID session variable to track across the session
                $_SESSION['teamID'] = $row['teamid'];
                // Set login info to track session validity.
                $_SESSION['login_info'] = ['start_time' => time(),'ip' => $_SERVER['REMOTE_ADDR'],'sess_valid' => true, 'isAdmin' => $row['trust']];
                // Go to secured page
                header('Location: ../scoreboard');
                die("True - login successful");
            }else{
                header('Location: ../login');
                // Keep message the same as the one above to prevent blind SQL attacks on passwords
                die('False - Username or password was invalid');
            }
        }
    }else{
        die("ERR: Issue binding prepared statement: " . mysqli_error($readconn));
    }
}else{
    die("ERR: Issue preparing statement: " . mysqli_error($readconn));
}
?>
