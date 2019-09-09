<!-- Copyright (c) 2019 Andrew Afonso, just leave my name in comments if you reuse -->
<?php
	require_once('writeconnect.php');
	$bad = 0;
	$teamname = filter_input(INPUT_POST, 'teamname');
	$teamschool = filter_input(INPUT_POST, 'school');
	$addcomments = filter_input(INPUT_POST, 'addcomments');
	$diet = filter_input(INPUT_POST, 'diet');
	$asl = filter_input(INPUT_POST, 'asl');

	$fnameone = filter_input(INPUT_POST, 'fnameone');
	$lnameone = filter_input(INPUT_POST, 'lnameone');
	$emailone = filter_input(INPUT_POST, 'emailone');
	$shirtone = filter_input(INPUT_POST, 'shirtone');

	$fnametwo = filter_input(INPUT_POST, 'fnametwo');
	$lnametwo = filter_input(INPUT_POST, 'lnametwo');
	$emailtwo = filter_input(INPUT_POST, 'emailtwo');
	$shirttwo = filter_input(INPUT_POST, 'shirttwo');

	$fnamethree = filter_input(INPUT_POST, 'fnamethree');
	$lnamethree = filter_input(INPUT_POST, 'lnamethree');
	$emailthree = filter_input(INPUT_POST, 'emailthree');
	$shirtthree = filter_input(INPUT_POST, 'shirtthree');

	$fnamefour = filter_input(INPUT_POST, 'fnamefour');
	$lnamefour = filter_input(INPUT_POST, 'lnamefour');
	$emailfour = filter_input(INPUT_POST, 'emailfour');
	$shirtfour = filter_input(INPUT_POST, 'shirtfour');

	$fnamefive = filter_input(INPUT_POST, 'fnamefive');
	$lnamefive = filter_input(INPUT_POST, 'lnamefive');
	$emailfive = filter_input(INPUT_POST, 'emailfive');
	$shirtfive = filter_input(INPUT_POST, 'shirtfive');
	echo "<meta http-equiv=\"Refresh\" content=\"3; url=https://nexthop.network/nsic/registration\">";
	/*if(empty($teamname)){
		echo "<p>teamname should not be empty</p>";
		$bad = 1;
	}
	if($bad == 1){
		die();
	}*/
	$sqlteam = "INSERT INTO teams (tname, school, addcomments, diet, asl) VALUES ('$teamname', '$teamschool', '$addcomments', '$diet', '$asl')";
	if ($writeconn->query($sqlteam)){
		echo "<p>New team is inserted sucessfully</p>";
	}
	else{
		echo "<p>Error: ". $sqlteam ."
		". $writeconn->error."</p>";
	}
	$teamid = mysqli_insert_id($writeconn);
	$sqlone = "INSERT INTO participants (email, fname, lname, shirtsize, teamid) VALUES ('$emailone', '$fnameone', '$lnameone', '$shirtone', '$teamid')";
	$sqltwo = "INSERT INTO participants (email, fname, lname, shirtsize, teamid) VALUES ('$emailtwo', '$fnametwo', '$lnametwo', '$shirttwo', '$teamid')";
	$sqlthree = "INSERT INTO participants (email, fname, lname, shirtsize, teamid) VALUES ('$emailthree', '$fnamethree', '$lnamethree', '$shirtthree', '$teamid')";
	$sqlfour = "INSERT INTO participants (email, fname, lname, shirtsize, teamid) VALUES ('$emailfour', '$fnamefour', '$lnamefour', '$shirtfour', '$teamid')";
	$sqlfive = "INSERT INTO participants (email, fname, lname, shirtsize, teamid) VALUES ('$emailfive', '$fnamefive', '$lnamefive', '$shirtfive', '$teamid')";
	if ($writeconn->query($sqlone)){
		echo "<p>Participant 1 inserted sucessfully</p>";
	}
	else{
		echo "<p>Error: ". $sqlone ."
		". $writeconn->error."</p>";
	}
	if ($writeconn->query($sqltwo)){
		echo "<p>Participant 2 inserted sucessfully</p>";
	}
	else{
		echo "<p>Error: ". $sqltwo ."
		". $writeconn->error."</p>";
	}
	if ($writeconn->query($sqlthree)){
		echo "<p>Participant 3 inserted sucessfully</p>";
	}
	else{
		echo "<p>Error: ". $sqlthree ."
		". $writeconn->error."</p>";
	}
	if ($writeconn->query($sqlfour)){
		echo "<p>Participant 4 inserted sucessfully</p>";
	}
	else{
		echo "<p>Error: ". $sqlfour ."
		". $writeconn->error."</p>";
	}
	if ($writeconn->query($sqlfive)){
		echo "<p>Participant 5 inserted sucessfully</p>";
	}
	else{
		echo "<p>Error: ". $sqlfive ."
		". $writeconn->error."</p>";
	}
?>