<?php
// Author: Andrew Afonso
session_start();

include_once("config/session_validate.php");

?>
<!doctype html>
<html>
	<head>
		<title>NSIC 2020 Competition</title>
		<meta name="description" content="NSIC 2020 Competition" />
		<!-- <meta http-equiv="refresh" content="15"> -->
		<?php include("config/head.php"); ?>
	</head>
	<body>
	<?php $headtext = "<h1>NSIC 2020 Competition</h1>"; 
		include("config/header.php"); ?>
	<section class="center vcentercontent">
        <ul class="noul">
		<?php 
		require_once('config/readconnect.php');
		$sqlone = mysqli_query($readconn, "SELECT scenarionum FROM scenario WHERE hidden = 1");
		while ($num = $sqlone->fetch_assoc()){
			$sqltwo = mysqli_query($readconn, "SELECT title FROM scenario WHERE scenarionum = ".$num['scenarionum'] ."");
			while ($title = $sqltwo->fetch_assoc()){
				?>
				<li><?php echo "Scenario ".$num['scenarionum'] .": " ?><a href="scenario.php?number=<?php echo $num['scenarionum'];?>"><?php echo  "".$title['title'] ."";?></a></li>
				<?php
			}
		} 
		?>
        </ul>
	</section>
	<?php include("config/footer.php"); ?>
	</body>
</html>
