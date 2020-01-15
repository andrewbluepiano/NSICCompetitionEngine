<?php
// Author: Andrew Afonso
session_start();

include_once("config/session_validate.php");
include_once("config/admin_validate.php");

?>
<!doctype html>
<html>
	<head>
		<?php include("config/head.php"); ?>
	</head>
	<body>
		<?php 
		require_once('config/readconnect.php');

			$teamid = $_REQUEST['team'];
			$scenarionum = $_REQUEST['scenario'];
			/*echo "<p>". $teamid ."</p>";
			echo "<p>". $scenarionum ."</p>";*/
			$getquestions = "SELECT questionid, questionnum, question, value, submission FROM questions WHERE scenarionum='$scenarionum' ORDER BY questionnum ASC;";
			$getscenario = "SELECT title, fullBonus, brief, hidden FROM scenario WHERE scenarionum='$scenarionum';";
			$gettasks = "SELECT tasknum, task, taskid FROM tasks WHERE scenarionum='$scenarionum' ORDER BY tasknum ASC;";
			$getgraded = "SELECT service, svcid FROM gradedsvc WHERE scenarionum='$scenarionum';";
			$getteamname = mysqli_query($readconn, "SELECT tname FROM teams WHERE teamid='$teamid';");
			$teamname = $getteamname->fetch_assoc();
			/*echo var_dump($teamname);*/
			$questions=$readconn->query($getquestions); 
			$scenario=$readconn->query($getscenario); 
			$tasks=$readconn->query($gettasks); 
			$services=$readconn->query($getgraded); 
			$scenariodeets = mysqli_fetch_assoc($scenario);
			$headtext = "<h1>Scenario ". $scenarionum . ": " .$scenariodeets['title'] ."<br>Team: ". $teamname['tname']. "</h1>";
			//$readconn->close();

		?>
		<?php include("config/header.php"); ?>
		<section class="wrap scoring">
					<h3>Brief: </h3> 
					<p> <?php echo $scenariodeets['brief']; ?></p>

					<h3>Tasks:</h3>
						<ol>
						<?php
							while ($task = $tasks->fetch_assoc()){
								$watcher = 0;
								echo "<form method=\"post\" action=\"config/points.php?team=". $teamid ."&task=". $task['taskid'] ."&scenario=". $scenarionum ."\">
								<div class=\"scoring_columns\"><div class=\"col1\"><li> ".$task['task'] ."</div>";
								$taskstorage = $_SERVER["DOCUMENT_ROOT"]."/../private/competition/tasks". $teamid .".txt";
								if(file_exists($taskstorage)){
										$alines = file($taskstorage);
										foreach($alines as $aline){
											if(substr($aline, 0, strlen($task['taskid'])) == $task['taskid']){
												echo "<div class=\"col2\"><strong> !!!Already Scored!!! </strong></form></li></div></div>";
												$watcher = 1;
											}
										}
									}
									if($watcher==0){
										echo "<div class=\"col2\"><input id=\"orange_button\" type=\"submit\" name=\"taskscore\" value=\"POINTS!\"></form></li></div></div>";
									}
							}
						?>
						</ol>
					
					
					<h3>Graded Services:</h3>
						<ul>
						<?php
							while ($svc = $services->fetch_assoc()){
								$ticker = 0;
								echo "<form method=\"post\" action=\"config/points.php?team=". $teamid ."&service=". $svc['svcid'] ."&scenario=". $scenarionum ."\">
								<div class=\"scoring_columns\"><div class=\"col1\"><li> ".$svc['service']."</div>";
								 $svcstorage = $_SERVER["DOCUMENT_ROOT"]."/../private/competition/services". $teamid .".txt";
								 if(file_exists($svcstorage)){
										$clines = file($svcstorage);
										foreach($clines as $cline){
											if(substr($cline, 0, strlen($svc['svcid'])) == $svc['svcid']){
												echo "<div class=\"col2\"><strong> !!!Already Scored!!! </strong></form></li></div></div>";
												$ticker = 1;
											}
										}
									}
									if($ticker==0){
										echo "<div class=\"col2\"><input id=\"orange_button\" type=\"submit\" name=\"svcscore\" value=\"POINTS!\"></form></li></div></div>";
									}
							}
						?>
						</ul>
					

				<h3>Questions</h3>
					<ul>
						<?php
							while ($question = $questions->fetch_assoc()){
								$tracker = 0;
								echo "<form method=\"post\" action=\"config/points.php?team=". $teamid ."&question=". $question['questionid'] ."&scenario=". $scenarionum ."\">
								<div class=\"scoring_columns\"><div class=\"col1\"><li>Question:". $question['question'] ."<br>Value: ". $question['value'] ."";
								
								$storage = $_SERVER["DOCUMENT_ROOT"]."/../private/competition/questions". $teamid .".txt";
								$questscorestorage = $_SERVER["DOCUMENT_ROOT"]."/../private/competition/questionscore". $teamid .".txt";

								if(file_exists($storage)){
									$lines = file($storage);
									foreach($lines as $line){
										if(substr($line, 0, strlen($question['questionid'])) == $question['questionid']){
											echo "<br><strong>Response: </strong>".substr($line, strlen($question['questionid'])+2) ."</div>";
										}
									}
								}
								if(file_exists($questscorestorage)){
									$alines = file($questscorestorage);
									foreach($alines as $aline){
										if(substr($aline, 0, strlen($question['questionid'])) == $question['questionid']){
											echo "<div class=\"col2\"><strong>!!!Already Scored!!!</strong> </form></li></div></div>";
											$tracker = 1;
										}
									}
								}
								if($tracker==0){
									echo "<div class=\"col2\"><input type=\"number\" name=\"custquestscore\" placeholder=\"Enter Score\"><input id=\"orange_button\" type=\"submit\" name=\"questscore\" value=\"Score!\"></form></li></div></div>";
								}
								/*echo "</form></li>";*/
							}
								
			
						?>
					</ul>
			
			</section>
		<?php include("config/footer.php"); ?>
	</body>
</html>
