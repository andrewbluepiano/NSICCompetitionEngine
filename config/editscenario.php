<!-- Copyright (c) 2019 Andrew Afonso, just leave my name in comments if you reuse -->
<?php
	require_once('writeconnect.php');
	$scenarioname = filter_input(INPUT_POST, 'scenarioname');
	$scenarionum = $_REQUEST['scenarionum'];
	$hide = filter_input(INPUT_POST, 'hidden');
	$bonus = filter_input(INPUT_POST, 'fullbonus');
	$brief = filter_input(INPUT_POST, 'brief');
	$tasktodelete = filter_input(INPUT_POST, 'tasksel');
	$taskpoints = filter_input(INPUT_POST, 'taskpoints');
	$newtasknum = filter_input(INPUT_POST, 'taskindnum');
	$newtask = $_REQUEST['taskcontent'];
	$svctodelete = filter_input(INPUT_POST, 'svcsel');
	$newsvc = $_REQUEST['newsvc'];
	$questtoupdate = filter_input(INPUT_POST, 'questtoupdate');
	$newquestnum = filter_input(INPUT_POST, 'newquestnum');
	$submission = filter_input(INPUT_POST, 'submission');
	$points = filter_input(INPUT_POST, 'pointvalue');
	$svcpoints = filter_input(INPUT_POST, 'svcpoints');
	$questiontext = filter_input(INPUT_POST, 'questiontext');
	
	echo "<meta http-equiv=\"Refresh\" content=\"1; url=https://nexthop.network/nsic/scenario_editor.php?scenarionumber=". $scenarionum ."\">";
	
	if(isset($_POST['scenarioedit'])){
		if(isset($hide)){
			$sqltwo = "UPDATE scenario SET hidden = '$hide' WHERE scenarionum = '$scenarionum'";
			if($writeconn->query($sqltwo)){
				echo "<p>Scenario hidden value updated sucessfully</p>";
			}else{
				echo "<p>Scenario hidden Update Error: ". $sqltwo ."
				". $writeconn->error."</p>";
			}
		}
		if(!empty($bonus)){
			$sqlthree = "UPDATE scenario SET fullBonus = '$bonus' WHERE scenarionum = '$scenarionum'";
			if($writeconn->query($sqlthree)){
				echo "<p>Scenario bonus value updated sucessfully</p>";
			}else{
				echo "<p>Scenario bonus Update Error: ". $sqlthree ."
				". $writeconn->error."</p>";
			}
		}
		if(!empty($brief)){
			$sqlbrief = "UPDATE scenario SET brief = '$brief' WHERE scenarionum = '$scenarionum'";
			if($writeconn->query($sqlbrief)){
				echo "<p>Scenario brief value updated sucessfully</p>";
			}else{
				echo "<p>Scenario brief Update Error: ". $sqlbrief ."
				". $writeconn->error."</p>";
			}
		}
		if(!empty($scenarioname)){
			$sqlname = "UPDATE scenario SET title = '$scenarioname' WHERE scenarionum = '$scenarionum'";
			if($writeconn->query($sqlname)){
				echo "<p>Scenario name updated sucessfully</p>";
			}else{
				echo "<p>Scenario name Update Error: ". $sqlname ."
				". $writeconn->error."</p>";
			}
		}
	 } 
	 
	 if(isset($_POST['deletetask'])){
		$taskdelete = "DELETE FROM tasks WHERE taskid = '$tasktodelete'";
		if($writeconn->query($taskdelete)){
			echo "<p>Task deleted sucessfully</p>";
		}else{
			echo "<p>Task delete Error: ". $taskdelete ."
			". $writeconn->error."</p>";
		}
	}
	
	if(isset($_POST['createtask'])){
		$taskcreate = "INSERT INTO tasks (tasknum, task, scenarionum, points) VALUES ('$newtasknum', '$newtask', '$scenarionum', '$taskpoints')";
		if($writeconn->query($taskcreate)){
			echo "<p>Task created sucessfully</p>";
		}else{
			echo "<p>Task creation Error: ". $taskcreate ."
			". $writeconn->error."</p>";
		}
	}
	
	 if(isset($_POST['deletesvc'])){
		$svcdelete = "DELETE FROM gradedsvc WHERE svcid = '$svctodelete'";
		if($writeconn->query($svcdelete)){
			echo "<p>Service deleted sucessfully</p>";
		}else{
			echo "<p>Service delete Error: ". $svcdelete ."
			". $writeconn->error."</p>";
		}
	}
	
	if(isset($_POST['createsvc'])){
		$svccreate = "INSERT INTO gradedsvc (service, scenarionum, points) VALUES ('$newsvc', '$scenarionum', '$svcpoints')";
		if($writeconn->query($svccreate)){
			echo "<p>Service created sucessfully</p>";
		}else{
			echo "<p>Service creation Error: ". $svccreate ."
			". $writeconn->error."</p>";
		}
	}
		
	if(isset($_POST['createquest'])){
		$questcreate = "INSERT INTO questions (question, value, submission, questionnum, scenarionum) VALUES ('$questiontext', '$points', '$submission', '$newquestnum', '$scenarionum')";
		if($writeconn->query($questcreate)){
			echo "<p>Question created sucessfully</p>";
		}else{
			echo "<p>Question creation Error: ". $questcreate ."
			". $writeconn->error."</p>";
		}
	 }
	 
	if(isset($_POST['updatequest'])){
		if(!empty($points)){
			$setpoints = "UPDATE questions SET value = '$points' WHERE questionid = '$questtoupdate'";
			if($writeconn->query($setpoints)){
				echo "<p>Question points updated sucessfully</p>";
			}else{
				echo "<p>Question points update Error: ". $setpoints ."
				". $writeconn->error."</p>";
			}
		}
		if(!empty($questiontext)){
			$updatequesttxt = "UPDATE questions SET question = '$questiontext' WHERE questionid = '$questtoupdate'";
			if($writeconn->query($updatequesttxt)){
				echo "<p>Question content updated sucessfully</p>";
			}else{
				echo "<p>Question content update Error: ". $updatequesttxt ."
				". $writeconn->error."</p>";
			}
		}
		if(isset($submission)){
			$updatesubmit = "UPDATE questions SET submission = '$submission' WHERE questionid = '$questtoupdate'";
			if($writeconn->query($updatesubmit)){
				echo "<p>Question submission type updated sucessfully</p>";
			}else{
				echo "<p>Question submission type update Error: ". $updatesubmit ."
				". $writeconn->error."</p>";
			}
		}
	 }	
	 
	if(isset($_POST['deletequest'])){
		$questdelete = "DELETE FROM questions WHERE questionid = '$questtoupdate'";
		if($writeconn->query($questdelete)){
			echo "<p>Question deleted sucessfully</p>";
		}else{
			echo "<p>Question delete Error: ". $questdelete ."
			". $writeconn->error."</p>";
		}
	}
		
?>