<?php
// Author: Andrew Afonso
// Description: NSIC scenario editor

// Overall Status: In progress. Long term todo: Make editing and displaying the current text values happen in one field. Also, just fix the backend implementation. Need to redo how data is pulled.
// Security: ??
// Styling: A rough draft is styled.. Styleize (make bold and not left) the ol's. Make labels default block. Make hover tooltips.

// Session initialized, checked for valid user, and valid admin.
session_start();
include_once("config/session_validate.php");
include_once("config/admin_validate.php");

// Creates a read only SQL connection object
require_once('config/readconnect.php');

// Sanitize scenario number just in case
$scenarionum = intval($_POST['scenario']);

// Get the scenario details
$getquestions = "SELECT questionid, questionnum, question, value, submission FROM questions WHERE scenarionum='$scenarionum' ORDER BY questionnum ASC;";
$getscenario = "SELECT title, fullBonus, brief, hidden FROM scenario WHERE scenarionum='$scenarionum';";
$gettasks = "SELECT taskid, tasknum, task, points FROM tasks WHERE scenarionum='$scenarionum' ORDER BY tasknum ASC;";
$getgraded = "SELECT service, points FROM gradedsvc WHERE scenarionum='$scenarionum';";

$questions=$readconn->query($getquestions);
$scenario=$readconn->query($getscenario);
$tasks=$readconn->query($gettasks);
$services=$readconn->query($getgraded);
$scenariodeets = mysqli_fetch_assoc($scenario);
?>
<!doctype html>
<html>
	<head>
		<title>NSIC Scenario Editor</title>
		<meta name="description" content="NSIC scenario editor" />
		<meta name="author" content="Andrew Afonso," />
		<?php include("config/head.php"); ?>
		
		<script>
			function newQuestCheck(select) {
				if (select.value != "New") {
					document.getElementById("newQuestNum").style.display = "none";
				}else{
					document.getElementById("newQuestNum").style.display = "block";
				}
			}
		</script>
		
	</head>
	<body>
		<?php
			// Include header & set page heading
			$headtext = "<h1>Scenario ". $scenarionum . ": " .$scenariodeets['title'] ."</h1>";
			include("config/header.php");
		?>
		
		<h2><a href="admin"><
		
		
        <section class="wrap text editor">
		<form method="post" action="config/scenario_edit.php">
			
			<!-- Passes the scenario number to edit to the editing backend -->
			<input type="hidden" name="scenarioNum" value=<?php echo $scenarionum; ?> />
            
            <section class="two_columns">
				<div class="col">
					<h2>Current Values</h2>
				</div>
			
				<div class="col">
					<h2>New value entry</h2>
				</div>
			</section>
			
			<hr>
			
			<h2 class="center">Scenario Info</h2>
			
			<section class="two_columns">
				<div class="col">
					<h4>Title:</h4>
					<?php echo $scenariodeets['title']; ?>
				</div>
			
				<div class="col">
					<fieldset>
						<label><h4>Title: <input type="text" name="scenarioname" placeholder="New Title"></h4></label>
					</fieldset>
				</div>
			</section>
			
			<section class="two_columns">
				<div class="col">
					<h4>Brief:</h4>
					<?php
						// It is assumed the values pulled are safe, this just makes sure the browser can display it. This is not providing any 'security'
						$brief = htmlspecialchars($scenariodeets['brief'], ENT_QUOTES, 'UTF-8');
						if($brief = "" || $brief = " " ){
							echo "Nothing here!!";
						}else{
							echo $brief;
						}
					?>
				</div>
			
				<div class="col">
					<textarea name="brief" placeholder="New Brief" rows="8" cols="40"></textarea>
				</div>
			</section>
			
			
			<?php // SET TO A BUTTON ?>
			<section class="two_columns">
				<div class="col">
					<h4>Display Status:</h4>
					<?php 
						if($scenariodeets['hidden']==1){
							echo "Showing";
						}else{
							echo "Hidden";
						};
					?>
				</div>
			
				<div class="col">
					<fieldset>
						<label>Show: <input type="radio" name="hidden" value="1"></label>
						<label>Hide: <input type="radio" name="hidden" value="0"></label>
					</fieldset>
				</div>
			</section>
			
			<section class="two_columns">
				<div class="col">
					<h4>Full completion bonus: </h4>
					<?php echo $scenariodeets['fullBonus']; ?>
				</div>
			
				<div class="col">
					<fieldset>
						<label>Full completion bonus: <input type="number" name="fullbonus" placeholder="Bonus Points"></label>
					</fieldset>
				</div>
			</section>
			
			<div class="center">
				<input class="softbtn center" type="submit" name="scenarioedit" value="Update Scenario">
			</div>
			
			<br><br>
			
			<h2 class="center">Tasks</h2>
			
			<section class="two_columns">
				<div class="col">
					<h4>Existing:</h4>
					<ul class="noul">
					<?php
						while ($task = $tasks->fetch_assoc()){
							echo "<li>" . $task['tasknum'] . ". " . $task['task'] ."<br>&nbsp&nbsp&nbsp&nbspPoints: ". $task['points'] ."</li>";
						}
					?>
					</ul>
					
					<hr style="margin: 0 50px 10px">
					
					<fieldset>
						<label><h3 class="inline">Delete task: </h3>
						<select class="softselect" name="tasksel">
							<?php
								$gettasks = "SELECT taskid, tasknum FROM tasks WHERE scenarionum='$scenarionum' ORDER BY tasknum ASC;";
								$tasks=$readconn->query($gettasks);
								while ($taskone = $tasks->fetch_assoc()){
									echo "<option value=\"". $taskone['taskid']."\">" . $taskone['tasknum'] . "</option>";
								}
							?>
						</select>
						</label>
					<input class="softbtn" type="submit" name="deletetask" value="Delete">
				</div>
			
				<div class="col">
					<fieldset>
						<legend><h3>Create task:</h3></legend>
						<label>Task Number: <input type="number" name="taskindnum" placeholder="Task Num"></label>
						<br>
						<label>Points: <input type="number" name="taskpoints" placeholder="Pts"></label>
						<br>
						<textarea name="taskcontent" placeholder="Task Content" rows="8" cols="40"></textarea>
						<br>
						<input class="softbtn" type="submit" name="createtask" value="Create">
					</fieldset>
				</div>
			</section>
					
			
			<br><br>
					
			<h2 class="center">Graded Services</h2>
		
			<section class="two_columns">
				<div class="col">
					<h4>Existing:</h4>
					<ul class="noul">
					<?php
						while ($svc = $services->fetch_assoc()){
							echo "<li> ".$svc['service'] .": ". $svc['points'] ."</li>";
						}
					?>
					</ul>
					
					
				</div>
			
				<div class="col">
					<fieldset>
						<legend><h3>Create service:</h3></legend>
						<label>Service Name: <input type="text" name="newsvc" placeholder="Name"></label>
						<br>
						<label>Points: <input class="numinput" type="number" name="svcpoints" placeholder="Pts"></label>
						<div class="inline" style="float:right; margin-right: 40px;">
							<input class="softbtn" type="submit" name="createsvc" value="Create">
						</div>
					
						<hr style="margin: 5px 50px">

						<label><h3>Delete service:</h3>
						<select class="softselect" name="svcsel">
							<?php
							$getgraded = "SELECT svcid, service FROM gradedsvc WHERE scenarionum='$scenarionum';";
							$services=$readconn->query($getgraded);
							while ($serv = $services->fetch_assoc()){
								echo "<option value=\"". $serv['svcid']."\">" . $serv['service'] . "</option>";
							}
							?>
						</select>
						</label>
						<input class="softbtn" type="submit" name="deletesvc" value="Delete">
					</fieldset>
				</div>
			</section>
			
			
			<br><br>
			
			<h2 class="center">Questions</h2>
			
			<section class="two_columns">
				<div class="col">
					<h4>Existing</h4>
					<ul class="noul">
						<?php
							while ($question = $questions->fetch_assoc()){
								echo "<li>";
								echo "<strong>" . $question['questionnum'] . "</strong>&nbsp&nbsp&nbsp&nbsp";
								echo "Sub Type: ";
								if((int)$question['submission']==0){
									echo "None";
								}
								if((int)$question['submission']==1){
									echo "Text";
								}
								if((int)$question['submission']==2){
									echo "File";
								} 
								echo " | Value: ". $question['value'];
								echo "<br>";
								echo "&nbsp&nbspContent: ". $question['question'];
								echo "</li>";
							}
						?>
					</ul>
				</div>
			
				<div class="col">
					<fieldset>
						<legend><h3>Create / Edit / Delete</h3></legend>
						<label>Select the question you want to edit, or 'new' to create
						<select class="softselect" name="questtoupdate" onchange="newQuestCheck(this)">
							<option value="New">New</option>
							<?php 
							$sqltwo = mysqli_query($readconn, "SELECT questionnum, questionid FROM questions WHERE scenarionum='$scenarionum'");
							while ($rowtwo = $sqltwo->fetch_assoc()){
								echo "<option value=\"". $rowtwo['questionid']."\">" . $rowtwo['questionnum'] . "</option>";
							}
							?>
						</select>
						</label>
						<br>
						<div id="newQuestNum">
							<label>New Question Number: <input type="number" name="newquestnum" placeholder="Q num"></label>
						</div>
						Response type:
						<label>None-<input type="radio" name="submission" value="0"></label>
						<label>Text-<input type="radio" name="submission" value="1"></label>
						<label>File-<input type="radio" name="submission" value="2"></label>
						<br>
						<label>Points: <input type="number" name="pointvalue" placeholder="Val"></label>
						<br>
						<label>Question content:<br>
						<textarea name="questiontext" placeholder="Text" rows="8" cols="40"></textarea>
						</label>
					</fieldset>
					
					<input class="softbtn" type="submit" name="createquest" value="Create Question">
					<input class="softbtn" type="submit" name="updatequest" value="Update Question">
					<input class="softbtn" type="submit" name="deletequest" value="Delete Question">
				</div>
			</section>
		</form>
		</section>
		<?php include("config/footer.php"); ?>
	</body>
</html>
