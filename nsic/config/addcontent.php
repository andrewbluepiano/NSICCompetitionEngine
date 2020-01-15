<?php
// Author: Andrew Afonso
// Session setup
session_start();
include_once("config/session_validate.php");
include_once("config/admin_validate.php");

$newscenarioname = filter_input(INPUT_POST, 'scenarioname');

require_once('writeconnect.php');

echo "<meta http-equiv=\"Refresh\" content=\"0; url=/nsic/admin\">";

if(isset($_POST['scenariocreate'])){
    $sqlone = "INSERT INTO scenario (title) VALUES ('$newscenarioname')";
    if($writeconn->query($sqlone)){
        echo "<p>New scenario created sucessfully</p>";
    }else{
        echo "<p>Scenario Create Error: ". $sqlone ."
        ". $writeconn->error."</p>";
    }
 }
$writeconn->close();
?>
