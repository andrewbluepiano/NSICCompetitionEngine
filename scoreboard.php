<!-- Copyright (c) 2019 Andrew Afonso, just leave my name in comments if you reuse -->
<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		header('Location: login');
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>NSIC 2020 Scoreboard</title>
		<meta name="description" content="NSIC 2020 Scoreboard" />
		<meta http-equiv="refresh" content="15">
        <?php include("config/head.php"); ?>
	</head>
	<body>
		<!-- Header -->
		<?php $headtext = "<h1>NSIC 2020 Scoreboard</h1>";
		include("config/header.php"); ?>
			
		<section class="vcentercontent">
			<article class="text wrap scoreboard">
				<!--<div class="vcenter">
					<div class="vcenterholder two_columns">-->
						<?php require_once('config/readconnect.php');
							$query = "SELECT tname AS 'Team Name', score AS Score FROM teams ORDER BY Score DESC";
							$result = mysqli_query($readconn, $query);
							$row = mysqli_fetch_assoc($result);
							$boo = 0;
							echo "<div class=\"two_columns\">";
							foreach ($row as $field => $value){
								if($boo == 1){
									echo "<div class=\"col left\"><strong>".$field. "</strong></div>";
								}
								if($boo == 0){
									echo "<div class=\"col right\"><strong>".$field. "</strong></div>";
									$boo = 1;
								}
							} 
							echo "</div>";
							$data = mysqli_query($readconn, $query);
							if (mysqli_num_rows($data) > 0) {
								while($crow = mysqli_fetch_assoc($data)) {
									echo "<div class=\"two_columns\">";
									echo "<div class=\"col right\">". $crow["Team Name"]. "</div><div class=\"col left\">". $crow["Score"]. "</div>";
									echo "</div>";
								}		
							}
							?>
					<!-- </div>
				</div>-->
			</article>
		</section>
	
		<?php include("config/footer.php"); ?>
	</body>
</html>
