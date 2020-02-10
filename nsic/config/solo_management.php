<?php
// Author: Andrew Afonso
// Description: For moving a user from an unplaced solo participant object to a team, and updating data as necessary.
// Data moves: Name, Email, shirt size stay with individual, moved to participants DB
// Data moves: Interpreter, Dietary, and additional comments from the solo registrant are combined with the destination teams.

// Session setup & admin verification
session_start();
include_once("session_validate.php");
include_once("admin_validate.php");

// Provides the SQL connection object with write permissions to NSIC DB.
require_once('writeconnect.php');


if(!empty($_POST['teamset']) && isset($_POST['usermanage'])) {
    foreach($_POST['teamset'] as $check) {
		if($check != "unset"){
			echo $check . "<br>";
			// Seperate the two number string into an array, then set the values to independant variables
			$result_explode = explode('|', $check);
			// Sanitizing the variables to ensure theyre both just numbers
			$destTeamID = 0 + $result_explode[0];
			$soloID = 0 + $result_explode[1];
			
			$sqlSolo = mysqli_query( $writeconn, "SELECT * FROM solo_unplaced WHERE uid='$soloID'");
			$soloUser = $sqlSolo->fetch_assoc();
			
			$sqlDestTeam = mysqli_query( $writeconn, "SELECT * FROM teams WHERE teamid='$destTeamID'");
			$destTeamInfo = $sqlDestTeam->fetch_assoc();
			
			// Checks that there arent already 5 people on the team
			$sqlTeamCount = mysqli_query( $writeconn, "SELECT * FROM participants WHERE teamid='$destTeamID'");
			if($sqlTeamCount->num_rows >= 5){
				echo '<script>alert("This team is at capacity, try another");</script>';
				header('Refresh: 0;url=../admin');
                die();
            }
			
			// Insert the user into the participants table
			if($stmt = $writeconn->prepare("INSERT INTO participants (email, fname, lname, shirtsize, teamid) VALUES (?,?,?,?,?)")){
				if($stmt->bind_param("ssssi", $soloUser['email'], $soloUser['fname'], $soloUser['lname'], $soloUser['shirtsize'], $destTeamID)){
					if(!$stmt->execute()){
						die("ERR: Issue executing prepared statement: " . mysqli_error($writeconn));
					}
					else{
						// If user is inserted into participants sucessfully, update the relevant team values
						
						// If solo user requested an interpreter, move the request to the destination team.
						if($soloUser['asl'] == 1){
							$teamASLStmt = "UPDATE teams SET asl=1 WHERE teamid='$destTeamID';";
							if (!$writeconn->query($teamASLStmt)){
								die("ERR: Issue executing prepared statement: " . mysqli_error($writeconn));
							}
						}
						
						// Combine the solo additional comments with the team additional comments
						if(!is_null($soloUser['addcomments']) && $soloUser['addcomments'] != ""){
							$newComments = $destTeamInfo['addcomments'] . " " . $soloUser['addcomments'];
							// Prepared statement for the update. As all the data here should be safe, this isnt absolutely necessary, but better safe than sorry
							if($teamCommStmt = $writeconn->prepare("UPDATE teams SET addcomments=? WHERE teamid=?")){
								if($teamCommStmt->bind_param("si", $newComments, $destTeamID)){
									if(!$teamCommStmt->execute()){
										die("ERR: Issue executing prepared statement: " . mysqli_error($writeconn));
									}
								}else{
									die("ERR: Issue binding prepared statement: " . mysqli_error($writeconn));
								}
							}else{
								die("ERR: Issue preparing statement: " . mysqli_error($writeconn));
							}
						}
						
						// Combine the solo dietary comments with the team dietary comments
						if(!is_null($soloUser['diet']) && $soloUser['diet'] != ""){
							$newDiet = $destTeamInfo['diet'] . " " . $soloUser['diet'];
							// Prepared statement for the update. As all the data here should be safe, this isnt absolutely necessary, but better safe than sorry
							if($teamDietStmt = $writeconn->prepare("UPDATE teams SET diet=? WHERE teamid=?")){
								if($teamDietStmt->bind_param("si", $newDiet, $destTeamID)){
									if(!$teamDietStmt->execute()){
										die("ERR: Issue executing prepared statement: " . mysqli_error($writeconn));
									}
								}else{
									die("ERR: Issue binding prepared statement: " . mysqli_error($writeconn));
								}
							}else{
								die("ERR: Issue preparing statement: " . mysqli_error($writeconn));
							}
						}
						
						$sqlRemoveSolo = "DELETE FROM solo_unplaced WHERE uid='$soloID';";
						if (!$writeconn->query($sqlRemoveSolo)){
							die("Removal Error: " . mysqli_error($writeconn));
						}
						
						header('Location: ../admin');
					}
				}else{
					die("ERR: Issue binding prepared statement: " . mysqli_error($writeconn));
				}
			}else{
				die("ERR: Issue preparing statement: " . mysqli_error($writeconn));
			}
		}
    }
}
?>
