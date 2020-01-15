<?php
	require_once('writeconnect.php');
	$manscore = filter_input(INPUT_POST, 'manscore');
	$teamid = filter_input(INPUT_POST, 'teamset');
	echo "<meta http-equiv=\"Refresh\" content=\"3; url=https://nexthop.network/nsic/admin\">";
	
	if(isset($_POST['setscore'])){
		$sqlone = "UPDATE teams SET score = ". $manscore." WHERE teamid LIKE '". $teamid."';";
		if ($writeconn->query($sqlone)){
			echo "<p>Score for team:\"". $teamid."\" has been set to ". $manscore."</p>";
		}
		else{
			echo "<p>Error: ". $sqlone ."
			". $writeconn->error."</p>";
		}
	}
	$writeconn->close();
	/*else{
		$sqlone = "INSERT INTO scoreboard (tname) SELECT tname FROM teams WHERE tname NOT IN (SELECT tname FROM scoreboard);";
		if ($writeconn->query($sqlone)){
			echo "<p>New participants have been inserted sucessfully</p>";
		}
		else{
			echo "<p>Error: ". $sqlone ."
			". $writeconn->error."</p>";
		}
		$writeconn->close();
	}*/
?>