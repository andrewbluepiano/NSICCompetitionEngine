<?php
// Author: Andrew Afonso
// If a valid user, but not the admin, redirect. To be replaced with something DB based.
if(isset($_SESSION['username']) && $_SESSION['username'] != 'ADMIN') {
    header('Location: accessdenied');
}
?> 
