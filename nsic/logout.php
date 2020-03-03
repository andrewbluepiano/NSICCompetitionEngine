<?php
// Author: Andrew Afonso
// Description: NSIC logout

// Status: Done

// Initialize the session
session_start();

// Reset the session ID, then destroy the session.
session_regenerate_id(true);
session_destroy();

// Redirect to login page
header('Location: login');
?>
