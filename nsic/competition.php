<?php
// Author: Andrew Afonso
// Description: Competition main page. Lists enabled scenarios.

// Overall Status: Functionally fine, but still draft. 
// Security: No inline vulns seen
// Styling: Unstyled

// Session setup & verification (User verification)
session_start();
include_once("config/session_validate.php");
?>
<!doctype html>
<html>
<head>
	<title>Competition</title>
	<meta name="description" content="NSIC 2020 Competition" />
	<meta name="author" content="Andrew Afonso" />
	<!-- <meta http-equiv="refresh" content="15"> -->
	<?php include("config/head.php"); ?>
</head>
<body>
<?php
	$headtext = "<h1>NSIC 2020 Competition</h1>";
	include("config/header.php");
?>
<section class="center vcentercontent">
	<ul class="noul">
		<?php
			// Import SQL DB read connection object.
			require_once('config/readconnect.php');
			
			// Get enabled scenarios and display them
			$sqlEnabled = mysqli_query($readconn, "SELECT scenarionum FROM scenario WHERE hidden = 1");
			while ($num = $sqlEnabled->fetch_assoc()){
				$sqlTitles = mysqli_query($readconn, "SELECT title FROM scenario WHERE scenarionum = ".$num['scenarionum'] ."");
				while ($title = $sqlTitles->fetch_assoc()){
					?>
					<li>Scenario <?php echo $num['scenarionum']; ?>: <a href="scenario.php?number=<?php echo $num['scenarionum'];?>"><?php echo  "".$title['title'] ."";?></a></li>
					<?php
				}
			}
		?>
	</ul>
</section>
<?php include("config/footer.php"); ?>
</body>
</html>
