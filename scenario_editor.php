<!-- Copyright (c) 2019 Andrew Afonso, just leave my name in comments if you reuse -->
<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		header('Location: login');
	}
	
	if (isset($_SESSION['username']) && $_SESSION['username'] != 'ADMIN') {
		header('Location: accessdenied');
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<?php include("config/head.php"); ?>
	</head>
	<body>
		<?php 
		require_once('config/readconnect.php');

			$scenarionum = $_REQUEST['scenarionumber'];
			$getquestions = "SELECT questionid, questionnum, question, value, submission FROM questions WHERE scenarionum='$scenarionum' ORDER BY questionnum ASC;";
			$getscenario = "SELECT title, fullBonus, brief, hidden FROM scenario WHERE scenarionum='$scenarionum';";
			$gettasks = "SELECT tasknum, task, points FROM tasks WHERE scenarionum='$scenarionum' ORDER BY tasknum ASC;";
			$getgraded = "SELECT service, points FROM gradedsvc WHERE scenarionum='$scenarionum';";
			
			$questions=$readconn->query($getquestions); 
			$scenario=$readconn->query($getscenario); 
			$tasks=$readconn->query($gettasks); 
			$services=$readconn->query($getgraded); 
			$scenariodeets = mysqli_fetch_assoc($scenario);
			$headtext = "<h1>Scenario ". $scenarionum . ": " .$scenariodeets['title'] ."</h1>";
			//$readconn->close();

		?>
			<?php include("config/header.php"); ?>
		<section class="wrap text editor">
		<form method="post" action="config/editscenario.php?scenarionum=<?php echo $scenarionum; ?>">
			
			<div class="center">
				<p>Enter new title here for title change: <input id="softfield" type="text" name="scenarioname" placeholder="Enter Scenario Name"></p>
			</div>
			
			<section class="two_columns">
				<div class="col">
					<p>Current Brief: <br> <?php echo $scenariodeets['brief']; ?></p>
				</div>
			
				<div class="col">
					<textarea id="softfield" name="brief" placeholder="Enter Scenario Brief" rows="8" cols="40"></textarea>
				</div>
			</section>
			
			<section class="two_columns">
				<div class="col">
					<p>Currently Hidden or Showing? <br> 
					<?php 
						if($scenariodeets['hidden']==1){
							echo "Showing";
						}else{
							echo "Hidden";
						}; ?>
					</p>
				</div>
			
				<div class="col">
					<input type="radio" name="hidden" value="1">Show
					<input type="radio" name="hidden" value="0">Hide
				</div>
			</section>
			
			<section class="two_columns">
				<div class="col">
					<p>Current bonus for full completion: <?php echo $scenariodeets['fullBonus']; ?></p>
				</div>
			
				<div class="col">
					<p>Enter number of bonus points for full completion: 
						<input type="number" name="fullbonus" placeholder="Enter Bonus Points">
					</p>
				</div>
			</section>
			
			<div class="center">
				<input id="softbtn" type="submit" name="scenarioedit" value="Update Scenario">
			</div>
			
			<h2 class="center">Tasks</h2>
			
			<section class="two_columns">
				<div class="col">
					<p>Current Tasks:
						<ol>
						<?php
							while ($task = $tasks->fetch_assoc()){
								echo "<li> ".$task['task'] ."<br><strong>Points:</strong>". $task['points'] ."</li>";
							}
						?>
						</ol>
					</p>
				</div>
			
				<div class="col">
					<p>Create task: 
						<input id="softfield" type="number" name="taskindnum" placeholder="Task Number">
						<input id="numinput" type="number" name="taskpoints" placeholder="Points">
						<br>
						<textarea id="softfield" name="taskcontent" placeholder="Enter Task Content" rows="8" cols="40"></textarea>
						<br>
						<input id="softbtn" type="submit" name="createtask" value="Create">
					<p>
					
					
					<p>Delete task:
						<select id="softselect"  name="tasksel">
							<?php 
							$gettasks = "SELECT taskid, tasknum FROM tasks WHERE scenarionum='$scenarionum' ORDER BY tasknum DESC;";
							$tasks=$readconn->query($gettasks); 
							while ($taskone = $tasks->fetch_assoc()){
								echo "<option value=\"". $taskone['taskid']."\">" . $taskone['tasknum'] . "</option>";
							}
							?>
						</select>
						<input id="softbtn" type="submit" name="deletetask" value="Delete">
					</p>
				</div>
			</section>
					
			<h2 class="center">Graded Services</h2>
		
			<section class="two_columns">
				<div class="col">
					<p>Current Graded Services:
						<ul>
						<?php
							while ($svc = $services->fetch_assoc()){
								echo "<li> ".$svc['service'] .": ". $svc['points'] ."</li>";
							}
						?>
						</ul>
					</p>
				</div>
			
				<div class="col">
					<p>Create service: 
						<input id="softfield" type="text" name="newsvc" placeholder="Enter Service Name">
						<input id="numinput" type="number" name="svcpoints" placeholder="Points">
						<input id="softbtn" type="submit" name="createsvc" value="Create">
					<p>
					
					
					<p>Delete service:
						<select id="softselect" name="svcsel">
							<?php 
							$getgraded = "SELECT svcid, service FROM gradedsvc WHERE scenarionum='$scenarionum';";
							$services=$readconn->query($getgraded); 
							while ($serv = $services->fetch_assoc()){
								echo "<option value=\"". $serv['svcid']."\">" . $serv['service'] . "</option>";
							}
							?>
						</select>
						<input id="softbtn" type="submit" name="deletesvc" value="Delete">
					</p>
				</div>
			</section>
			
			<h2 class="center">Questions</h2>
			
			<section class="two_columns">
				<div class="col">Current Questions
					<ul>
						<?php
							while ($question = $questions->fetch_assoc()){
								echo "<li>Num:".$question['questionnum'] ."<br> Submission Type: ";
								if((int)$question['submission']==0){
									echo "None";
								}
								if((int)$question['submission']==1){
									echo "Text";
								}
								if((int)$question['submission']==2){
									echo "File";
								} 
								echo "<br> Value: ". $question['value'] ." <br> Question:". $question['question'] ."</li>";
							}
						?>
					</ul>
				</div>
			
				<div class="col">
					<p>Create Question or Select Existing
						<select id="softselect" name="questtoupdate">
							<option value="New">New</option>
							<?php 
							$sqltwo = mysqli_query($readconn, "SELECT questionnum, questionid FROM questions WHERE scenarionum='$scenarionum'");
							while ($rowtwo = $sqltwo->fetch_assoc()){
								echo "<option value=\"". $rowtwo['questionid']."\">" . $rowtwo['questionnum'] . "</option>";
							}
							?>
						</select>
						<br>
						(New) Question Number:<input type="number" name="newquestnum" placeholder="Question Number">
						<br>
						Submission / Response type
						<input type="radio" name="submission" value="0">None
						<input type="radio" name="submission" value="1">Text 
						<input type="radio" name="submission" value="2">File
						<br>
						Points: <input type="number" name="pointvalue" placeholder="Enter Point Value">
						<br>
						Question content:
						<br>
						<textarea id="softfield" name="questiontext" placeholder="Text" rows="8" cols="40"></textarea>
					</p>
					
					<input id="softbtn" type="submit" name="createquest" value="Create Question">
					<input id="softbtn" type="submit" name="updatequest" value="Update Question">
					<input id="softbtn" type="submit" name="deletequest" value="Delete Question">
				</div>
			</section>
		</form>
		</section>
		<?php include("config/footer.php"); ?>
	</body>
</html>
