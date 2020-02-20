<?php
// Author: Andrew Afonso
// Registers a team

// Captcha Checks
if($_POST['g-recaptcha-response'] == "" || is_null($_POST['g-recaptcha-response']) ){
	// If captcha incorrect, send back to contact page with captcha failure code.
	header('Location: ../registration.php?reg=0');
	die();
}else{ // Verify that completed captcha is correct

	// parse ini file to get captcha secret
	$config = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/../private/config.ini");
	
	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array(
		'secret' => $config['captchaSec'],
		'response' => $_POST["g-recaptcha-response"]
	);
	$options = array(
		'http' => array (
			'method' => 'POST',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$verify = file_get_contents($url, false, $context);
	$captcha_success=json_decode($verify);

	if ($captcha_success->success==false) {
		// If captcha unsuccessful, send back to registration page with captcha failure code
		header('Location: ../registration.php?reg=0');
		die();
	} else if ($captcha_success->success==true) {
		// Captcha all good

		// Import a NSIC DB write object
		require_once('writeconnect.php');

		// What happens if the sql operations fail.
		function sqlFailure($statement, $connection) {
			// Normal - Close connection, redirect back to registration page with backend failure message to contact site admins.
			$connection->close();
			header('Location: ../registration.php?reg=1');
			die();
			
			// Debugging - Leave turned off always for live site to prevent possible data disclosure
			// var_dump($statement);
			// echo "<br>";
			// die("ERR: Issue binding prepared statement: " . mysqli_error($connection));
		}

		// Sanatize strings
		$teamname = mysqli_real_escape_string( $writeconn, $_POST['teamname']);
		$teamschool = mysqli_real_escape_string( $writeconn, $_POST['school']);
		$addcomments = mysqli_real_escape_string( $writeconn, $_POST['addcomments']);
		$loginid = mysqli_real_escape_string( $writeconn, $_POST['loginid']);
		$fnameone = mysqli_real_escape_string( $writeconn, $_POST['fnameone']);
		$lnameone = mysqli_real_escape_string( $writeconn, $_POST['lnameone']);
		$fnametwo = mysqli_real_escape_string( $writeconn, $_POST['fnametwo']);
		$lnametwo = mysqli_real_escape_string( $writeconn, $_POST['lnametwo']);
		$fnamethree = mysqli_real_escape_string( $writeconn, $_POST['fnamethree']);
		$lnamethree = mysqli_real_escape_string( $writeconn, $_POST['lnamethree']);
		$fnamefour = mysqli_real_escape_string( $writeconn, $_POST['fnamefour']);
		$lnamefour = mysqli_real_escape_string( $writeconn, $_POST['lnamefour']);
		$fnamefive = mysqli_real_escape_string( $writeconn, $_POST['fnamefive']);
		$lnamefive = mysqli_real_escape_string( $writeconn, $_POST['lnamefive']);

		// Sanatize ints
		$diet = intval($_POST['diet']);
		$asl = intval( $_POST['asl']);
		$shirtone = intval( $_POST['shirtone']);
		$shirttwo = intval( $_POST['shirttwo']);
		$shirtthree = intval( $_POST['shirtthree']);
		$shirtfour = intval( $_POST['shirtfour']);
		$shirtfive = intval( $_POST['shirtfive']);

		// Sanatize emails
		$teamEmail = filter_var($_POST['teamEmail'], FILTER_VALIDATE_EMAIL);
		$emailone = filter_var($_POST['emailone'], FILTER_VALIDATE_EMAIL);
		$emailtwo = filter_var($_POST['emailtwo'], FILTER_VALIDATE_EMAIL);
		$emailthree = filter_var($_POST['emailthree'], FILTER_VALIDATE_EMAIL);
		$emailfour = filter_var($_POST['emailfour'], FILTER_VALIDATE_EMAIL);
		$emailfive = filter_var($_POST['emailfive'], FILTER_VALIDATE_EMAIL);

		// Check if any of the emails are duplicates
		$emails = [$teamEmail, $teamEmail, $emailtwo, $emailthree, $emailfour, $emailfive];
		foreach($emails as $oneEmail){
			$sql = mysqli_query($writeconn, "SELECT email FROM solo_unplaced WHERE email='$oneEmail' UNION ALL SELECT email FROM participants WHERE email='$oneEmail' UNION ALL SELECT email FROM volunteers WHERE email='$oneEmail'");
			if($sql->num_rows != 0){
				sqlFailure($sql, $writeconn);
			}
		}

		// Insert the data
		if($stmt = $writeconn->prepare("INSERT INTO teams (tname, school, addcomments, diet, asl, email) VALUES (?,?,?,?,?,?)")){
			if($stmt->bind_param("ssssis", $teamname, $teamschool, $addcomments, $diet, $asl, $teamEmail)){
				if(!$stmt->execute()){
					sqlFailure($stmt, $writeconn);
				}
			}else{
				sqlFailure($stmt, $writeconn);
			}
		}else{
			sqlFailure($stmt, $writeconn);
		}

		$teamid = mysqli_insert_id($writeconn);

		if($stmt = $writeconn->prepare("INSERT INTO users (compuser, teamid, trust, enabled) VALUES (?,?,0,0)")){
			if($stmt->bind_param("si", $loginid, $teamid)){
				if(!$stmt->execute()){
					sqlFailure($stmt, $writeconn);
				}
			}else{
				sqlFailure($stmt, $writeconn);
			}
		}else{
			sqlFailure($stmt, $writeconn);
		}


		if($stmt = $writeconn->prepare("INSERT INTO participants (email, fname, lname, shirtsize, teamid) VALUES (?,?,?,?,?)")){
			if($stmt->bind_param("sssii", $emailone, $fnameone, $lnameone, $shirtone, $teamid)){
				if(!$stmt->execute()){
					sqlFailure($stmt, $writeconn);
				}
			}else{
				sqlFailure($stmt, $writeconn);
			}
		}else{
			sqlFailure($stmt, $writeconn);
		}

		if($stmt = $writeconn->prepare("INSERT INTO participants (email, fname, lname, shirtsize, teamid) VALUES (?,?,?,?,?)")){
			if($stmt->bind_param("sssii", $emailtwo, $fnametwo, $lnametwo, $shirttwo, $teamid)){
				if(!$stmt->execute()){
					sqlFailure($stmt, $writeconn);
				}
			}else{
				sqlFailure($stmt, $writeconn);
			}
		}else{
			sqlFailure($stmt, $writeconn);
		}

		if($stmt = $writeconn->prepare("INSERT INTO participants (email, fname, lname, shirtsize, teamid) VALUES (?,?,?,?,?)")){
			if($stmt->bind_param("sssii", $emailthree, $fnamethree, $lnamethree, $shirtthree, $teamid)){
				if(!$stmt->execute()){
					sqlFailure($stmt, $writeconn);
				}
			}else{
				sqlFailure($stmt, $writeconn);
			}
		}else{
			sqlFailure($stmt, $writeconn);
		}

		if($stmt = $writeconn->prepare("INSERT INTO participants (email, fname, lname, shirtsize, teamid) VALUES (?,?,?,?,?)")){
			if($stmt->bind_param("sssii", $emailfour, $fnamefour, $lnamefour, $shirtfour, $teamid)){
				if(!$stmt->execute()){
					sqlFailure($stmt, $writeconn);
				}
			}else{
				sqlFailure($stmt, $writeconn);
			}
		}else{
			sqlFailure($stmt, $writeconn);
		}

		
		if($stmt = $writeconn->prepare("INSERT INTO participants (email, fname, lname, shirtsize, teamid) VALUES (?,?,?,?,?)")){
			if($stmt->bind_param("sssii", $emailfive, $fnamefive, $lnamefive, $shirtfive, $teamid)){
				if(!$stmt->execute()){
					sqlFailure($stmt, $writeconn);
				}
			}else{
				sqlFailure($stmt, $writeconn);
			}
		}else{
			sqlFailure($stmt, $writeconn);
		}

		// JS That uses an iFrame to load the getCal file that downloads the calendar file.
		echo '<iframe id="my_iframe" style="display:none;"></iframe>';
		echo '<script>';
		echo 'alert("You will now be redirected to pay the registration fee.");';
		echo "document.getElementById('my_iframe').src = \"getCal.php\";";
		echo '</script>';

		// Redirects to the store to pay registration. Refresh must at least be 1.
		header('Refresh: 1;url=https://campusgroups.rit.edu/store?store_id=562');
	}
}
?>
