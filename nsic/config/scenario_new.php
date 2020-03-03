<?php
// Author: Andrew Afonso
// Creates a new, blank scenario entry in the DB

// Session setup & admin verification
session_start();
include_once("session_validate.php");
include_once("admin_validate.php");

// POST var
$newscenarioname = filter_input(INPUT_POST, 'scenarioname');

// Provides the SQL connection object with write permissions to NSIC DB.
require_once('writeconnect.php');

// Prepared statement
if($stmt = $writeconn->prepare("INSERT INTO scenario (title) VALUES (?)")){
    if($stmt->bind_param("s", $newscenarioname)){
        if(!$stmt->execute()){
            die("ERR: Issue executing prepared statement: " . mysqli_error($writeconn));
        }else{
            // If successful, close the SQL write object, redirect back to admin page.
            $writeconn->close();
            header('Location: /nsic/admin');
        }
    }else{
        die("ERR: Issue binding prepared statement: " . mysqli_error($writeconn));
    }
}else{
    die("ERR: Issue preparing statement: " . mysqli_error($writeconn));
}
?>
