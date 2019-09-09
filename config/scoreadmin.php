<!-- Copyright (c) 2019 Andrew Afonso, just leave my name in comments if you reuse -->
<?php
	require_once('writeconnect.php');
	$manscore = filter_input(INPUT_POST, 'manscore');
	$teamid = filter_input(INPUT_POST, 'teamset');
	$teamtoscoreid = filter_input(INPUT_POST, 'teamselect');
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
	if(isset($_POST['scoring'])){
		
	}
	$writeconn->close();
?>