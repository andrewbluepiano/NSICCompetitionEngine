<?php
// Author: Andrew Afonso
// If a valid user, but not an NSICAdmin, redirect. To be replaced with something DB based.
if($_SESSION['login_info']['isAdmin'] != 1) {
    header('Location: accessdenied');
}
?> 
