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
		<title>NSIC 2020 Administration</title>
		<meta name="description" content="NSIC 2020 administration page" />
        <?php include("config/head.php"); ?>
	</head>
	<body>
		<!-- Header -->
		<?php $headtext = "<h1>NSIC 2020 Admin</h1>"; 
		include("config/header.php"); ?>
	
		<section class="center vcentercontent admin">
			<article class="wrap text">
				<form method="post" action="config/scoreadmin.php">
					<p>Manually set score
					<select id="softselect" name="teamset">
						<?php 
						require_once('config/readconnect.php');
						$sql = mysqli_query($readconn, "SELECT tname, teamid FROM teams");
						while ($row = $sql->fetch_assoc()){
							echo "<option value=\"". $row['teamid']."\">" . $row['tname'] . "</option>";
						}
						?>
					</select>
					<input id="softfield" type="number" name="manscore" placeholder="Enter Score">
					<input id="softbtn" type="submit" name="setscore" value="Set Score">
					</p>
				</form>
			
				<form method="post" action="config/loadteamscoring.php">
					<p>Score Team: 
					<select id="softselect" name="teamselect">
						<?php 
						$sqltoscore = mysqli_query($readconn, "SELECT tname, teamid FROM teams");
						while ($grow = $sqltoscore->fetch_assoc()){
							echo "<option value=\"". $grow['teamid']."\">" . $grow['tname'] . "</option>";
						}
						?>
					</select>
					 on scenario
					<select id="softselect" name="scenarioscore">
							<?php 
							require_once('config/readconnect.php');
							$sqlone = mysqli_query($readconn, "SELECT title, scenarionum FROM scenario");
							while ($rowone = $sqlone->fetch_assoc()){
								echo "<option value=\"". $rowone['scenarionum']."\">". $rowone['scenarionum'].": " . $rowone['title'] . "</option>";
							}
							?>
						</select>
					<input id="softbtn" type="submit" name="scoring" value="Score Team">
					</p>
				</form>
			
				<form method="post" action="config/addcontent.php">
					<p>Create new Scenario
						<input id="softfield" type="text" name="scenarioname" placeholder="Enter Scenario Name">
						<input id="softbtn" type="submit" name="scenariocreate" value="Create Scenario">
					</p>
				</form>
				
				
				<form method="post" action="config/loadscenario.php">
					<p>Select Scenario to Edit
						<select id="softselect" name="scenario">
							<?php 
							require_once('config/readconnect.php');
							$sqlone = mysqli_query($readconn, "SELECT title, scenarionum FROM scenario");
							while ($rowone = $sqlone->fetch_assoc()){
								echo "<option value=\"". $rowone['scenarionum']."\">". $rowone['scenarionum'].": " . $rowone['title'] . "</option>";
							}
							?>
						</select>
						<input id="softbtn" type="submit" name="scenarioedit" value="Edit Scenario">
					</p>		
				</form>
			</article>
		</section>
	
		<?php include("config/footer.php"); ?>
	</body>
</html>
