<?php
// Author: Andrew Afonso
session_start();

include_once("config/session_validate.php");

?>
<!doctype html>
<html>
	<head>
		<?php include("config/head.php"); ?>
	</head>
	<body>
		<?php 
		require_once('config/readconnect.php');

			$scenarionum = $_REQUEST['number'];
			$username = $_SESSION['username']; 
			$getquestions = "SELECT questionid, questionnum, question, value, submission FROM questions WHERE scenarionum='$scenarionum' ORDER BY questionnum ASC;";
			$getscenario = "SELECT title, fullBonus, brief FROM scenario WHERE scenarionum='$scenarionum';";
			$getteamid = mysqli_query($readconn, "SELECT teamid FROM users WHERE compuser='$username';");
			$gettasks = "SELECT tasknum, task FROM tasks WHERE scenarionum='$scenarionum' ORDER BY tasknum ASC;";
			$getgraded = "SELECT service FROM gradedsvc WHERE scenarionum='$scenarionum';";
			
			$questions=$readconn->query($getquestions); 
			$scenario=$readconn->query($getscenario); 
			$tasks=$readconn->query($gettasks); 
			$services=$readconn->query($getgraded);
			$teamid = $getteamid->fetch_assoc();
			/*echo $teamid['teamid'];
			echo $username;*/
			$scenariodeets = mysqli_fetch_assoc($scenario);
			$headtext = "<h1>Scenario ".$scenarionum. ": ". $scenariodeets['title']. "</h1>";
			
			//$readconn->close();

		?>
	
	<?php include("config/header.php"); ?>
	<section class="wrap scenario">
		<article>
			<h3>Brief:</h3> 
			<div class="text">
				<p><?php echo $scenariodeets['brief']; ?></p>
			</div>
		</article>
		
		<article class="list">
			<h3>Tasks:</h3>
			<p>
				<ol>
				<?php
					while ($task = $tasks->fetch_assoc()){
						echo "<li> ".$task['task'] ."</li>";
					}
				?>
				</ol>
			</p>
		</article>
		
		<article class="list">
			<h3>Graded Services:</h3>
			<p>
				<ul>
				<?php
					while ($svc = $services->fetch_assoc()){
						echo "<li> ".$svc['service'] ."</li>";
					}
				?>
				</ul>
			</p>
		</article>
		
		<article class="questions">
			<h3>Questions:</h3>
			<?php 
				while ($quest = $questions->fetch_assoc()){
					if($quest['submission']==0){
						echo "<p>". $quest['question'] ."</p>";
					}
					if($quest['submission']==1){
						echo "<form method=\"post\" action=\"config/submitquestion.php?team=". $teamid['teamid'] ."&question=". $quest['questionid'] ."&scenario=". $scenarionum ."\">
						". $quest['question'] ."
						<br><span><input id=\"answerfield\" type=\"text\" name=\"answer\" placeholder=\"Answer question here\">
						<input id=\"softbtn\" type=\"submit\" name=\"answerbtn\" value=\"Submit Answer\"></span>
						</form>";
					}
				} 
			?>
		</article>	
	</section>
	<?php include("config/footer.php"); ?>
	</body>
</html>
