<?php
// Author: Andrew Afonso
// Submits scenario question responses

// Session setup verification
session_start();
require_once('session_validate.php');

// Import SQL write connection object
require_once('writeconnect.php');

$teamid = $_SESSION['teamID'];
$questionid = $_POST['question'];
$scenarioid = $_POST['scenario'];
$answer = filter_input(INPUT_POST, 'answer');

// Load teams responses
$sqlGetResponses = mysqli_query( $writeconn, "SELECT responses FROM teams WHERE teamid='$teamid';" );
$responses = $sqlGetResponses->fetch_assoc();
$responses = $responses['responses'];

// Create response data array with updated answer
if($responses != ""){
    $respArr = unserialize($responses);
    $respArr[$questionid] = $answer;
    $respSer = serialize($respArr);
}
else{
    $respArr = array();
    $respArr[$questionid] = $answer;
    $respSer = serialize($respArr);
}


// Inserts the data
if($stmt = $writeconn->prepare("UPDATE teams SET responses=? WHERE teamid=?")){
    if($stmt->bind_param("si", $respSer, $teamid)){
        if(!$stmt->execute()){
            die("ERR: Issue executing prepared statement: " . mysqli_error($writeconn));
        }else{
            // Closes the SQL connection
            $writeconn->close();
            
            // Back to sending page
            header('Location: ../scenario.php?number=' . $scenarioid);
        }
    }else{
        die("ERR: Issue binding prepared statement: " . mysqli_error($writeconn));
    }
}else{
    die("ERR: Issue preparing statement: " . mysqli_error($writeconn));
}

// Closes the SQL connection
$writeconn->close();
?>
