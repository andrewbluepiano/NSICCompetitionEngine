<?php
// Author: Andrew Afonso

// Parameters from form
$username = $_POST['username'];
$passwd = $_POST['password'];

require_once('readconnect.php');

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
                // Successful Login, Set session variables
                session_unset();
                session_destroy();
                $sess_id = session_start();
                session_regenerate_id(true);
                $_SESSION['username'] = $_POST['username'];
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
