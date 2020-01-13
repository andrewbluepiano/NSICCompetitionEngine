<?php
// Author: Andrew Afonso

// Parameters passed from form
$username = $_POST['username'];
$passwd = $_POST['password'];

// Parse config file for sensitive credentials
$config = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/../private/config.ini");

// Create SQL server connection
$mysqli = new mysqli($config['rdserver'], $config['rdusername'], $config['rdpassword'], $config['rddbname']);

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

if($stmt = $mysqli->prepare("SELECT * FROM users WHERE compuser=?")){
    if($stmt->bind_param("s", $username)){
        if(!$stmt->execute()){
            die("ERR: Issue executing prepared statement: " . mysqli_error($mysqli));
        }
        
        if($returned = $stmt->get_result()){
            $row = $returned->fetch_assoc();
            if($returned->num_rows != 1){
                // Keep this, and the matching one later the same to prevent blind SQL attacks attacks on passwords
                die("False - Username or password was invalid");
            }
            
            if($row['comppass'] === md5($passwd)){
                // Successful Login, Set session variables
                session_unset();
                session_destroy();
                $sess_id = session_start();
                session_regenerate_id(true);
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['login_info'] = ['start_time' => time(),'ip' => $_SERVER['REMOTE_ADDR'],'sess_valid' => true];
                // Go to secured page
                header('Location: scoreboard.php');
                die("True - login successful");
            }else{
                header('Location: login.php');
                // Keep the same as the one above to prevent blind SQL attacks on passwords
                die('False - Username or password was invalid');
            }
        }
    }else{
        die("ERR: Issue binding prepared statement: " . mysqli_error($mysqli));
    }
}else{
    die("ERR: Issue preparing statement: " . mysqli_error($mysqli));
}
?>

