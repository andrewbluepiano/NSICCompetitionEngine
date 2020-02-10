<?php
// Author: Andrew Afonso
// Checks if the user is an admin. This is determined when the user begins their session. 
if($_SESSION['login_info']['isAdmin'] != 1) {
    header('Location: accessdenied');
}
?> 
