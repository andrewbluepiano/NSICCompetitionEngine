<!-- Copyright (c) 2019 Andrew Afonso, just leave my name in comments if you reuse -->
<?php
	require_once('writeconnect.php');
	$newscenarioname = filter_input(INPUT_POST, 'scenarioname');
	
	echo "<meta http-equiv=\"Refresh\" content=\"2; url=https://nexthop.network/nsic/admin\">";
	
	if(isset($_POST['scenariocreate'])){
		$sqlone = "INSERT INTO scenario (title, hidden, fullBonus, brief) VALUES ('$newscenarioname', '$hide', '$bonus', '$brief')";
		if($writeconn->query($sqlone)){
			echo "<p>New scenario created sucessfully</p>";
		}else{
			echo "<p>Scenario Create Error: ". $sqlone ."
			". $writeconn->error."</p>";
		}
	 } 
	 $writeconn->close();
?>