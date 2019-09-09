<!-- Copyright (c) 2019 Andrew Afonso, just leave my name in comments if you reuse -->
<?php
	require_once('writeconnect.php');
	$teamid = $_REQUEST['team'];
	$scenarioid = $_REQUEST['scenario'];
	$questscore = filter_input(INPUT_POST, 'custquestscore');
	$svcstorage = $_SERVER["DOCUMENT_ROOT"]."/PATH/services". $teamid .".txt";
	$questscorestorage = $_SERVER["DOCUMENT_ROOT"]."/PATH/questionscore". $teamid .".txt";
	$taskstorage = $_SERVER["DOCUMENT_ROOT"]."/PATH/tasks". $teamid .".txt";
	echo "<meta http-equiv=\"Refresh\" content=\"3; url=https://nexthop.network/nsic/team_scoring.php?team=". $teamid ."&scenario=". $scenarioid ."\">";
	
	if(isset($_POST['svcscore'])){
		$serviceid = $_REQUEST['service'];
		$rewrite = array();
		if(file_exists($svcstorage)){
			$lines = file($svcstorage);
			foreach($lines as $line){
				if(substr($line, 0, strlen($serviceid)) != $serviceid){
					array_push($rewrite, $line);
				}
			}
		}
		$new = "". $serviceid . ", 1\n";
		array_push($rewrite, $new);
		file_put_contents($svcstorage, $rewrite);
		$getscore = mysqli_query($writeconn, "SELECT score FROM teams WHERE teamid='$teamid';");
		$getpoints = mysqli_query($writeconn, "SELECT points FROM gradedsvc WHERE svcid='$serviceid';");
		$score= $getscore->fetch_assoc();
		$points= $getpoints->fetch_assoc();
		$newscore =  intval($score['score']) +  intval($points['points']);
		$sqlone = "UPDATE teams SET score = '$newscore' WHERE teamid ='$teamid.';";
		if ($writeconn->query($sqlone)){
			echo "<p>Score for team:\"". $teamid."\" has been updated</p>";
		}
		else{
			echo "<p>Error: ". $sqlone ."
			". $writeconn->error."</p>";
		}
	
    }
    
    if(isset($_POST['taskscore'])){
		$taskid = $_REQUEST['task'];
		$arewrite = array();
		if(file_exists($taskstorage)){
			$blines = file($taskstorage);
			foreach($blines as $bline){
				if(substr($bline, 0, strlen($taskid)) != $taskid){
					array_push($arewrite, $bline);
				}
			}
		}
		$new = "". $taskid . ", 1\n";
		array_push($arewrite, $new);
		file_put_contents($taskstorage, $arewrite);
		$getscore = mysqli_query($writeconn, "SELECT score FROM teams WHERE teamid='$teamid';");
		$getpoints = mysqli_query($writeconn, "SELECT points FROM tasks WHERE taskid='$taskid';");
		$score= $getscore->fetch_assoc();
		$points= $getpoints->fetch_assoc();
		$newscore =  intval($score['score']) +  intval($points['points']);
		$sqltask = "UPDATE teams SET score = '$newscore' WHERE teamid ='$teamid.';";
		if ($writeconn->query($sqltask)){
			echo "<p>Score for team:\"". $teamid."\" has been updated</p>";
		}
		else{
			echo "<p>Error: ". $sqltask ."
			". $writeconn->error."</p>";
		}
	
    }
    
	if(isset($_POST['questscore'])){
		$questionid = $_REQUEST['question'];
		$crewrite = array();
		if(file_exists($questscorestorage)){
			$lines = file($questscorestorage);
			foreach($lines as $line){
				if(substr($line, 0, strlen($questionid)) != $questionid){
					array_push($crewrite, $line);
				}
			}
		}
		$new = "". $questionid . ", ". $questscore ."\n";
		array_push($crewrite, $new);
		file_put_contents($questscorestorage, $crewrite);
		$getscore = mysqli_query($writeconn, "SELECT score FROM teams WHERE teamid='$teamid';");
		$score= $getscore->fetch_assoc();
		$cnewscore =  intval($score['score']) + $questscore;
		$sqlquestscore = "UPDATE teams SET score = '$cnewscore' WHERE teamid ='$teamid.';";
		if ($writeconn->query($sqlquestscore)){
			echo "<p>Score for team:\"". $teamid."\" has been updated</p>";
		}
		else{
			echo "<p>Error: ". $sqlquestscore ."
			". $writeconn->error."</p>";
		}

	}
?>