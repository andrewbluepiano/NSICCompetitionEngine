<?php
// Author: Andrew Afonso
// Session validity tests for NSIC engine.
if((session_status() == PHP_SESSION_ACTIVE)){

    require_once('nsic_vars.php');

    if(!isset($_SESSION['username']) or $_SESSION['type'] != $typeVar) {
        session_destroy();
        session_regenerate_id(true);
        header('Location: login');
    }
    
    
    
    // Check if the IP detected by the server for the client matches the IP that created the session
    if($_SERVER['REMOTE_ADDR'] !== $_SESSION['login_info']['ip']){
        session_destroy();
    }
    
    // Check if the session has been active too long
    if($_SESSION['login_info']['start_time'] < time() - 300){
        session_destroy();
    }
    
    // Update session active time
    $_SESSION['login_info']['start_time'] = time();
}
?> 
