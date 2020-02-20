<?php
// Author: Andrew Afonso
// Backend for volunteer registration

// Captcha Checks
if($_POST['g-recaptcha-response'] == "" || is_null($_POST['g-recaptcha-response']) ){
	// If captcha incorrect, send back to contact page with captcha failure code.
	header('Location: ../volunteer.php?reg=0');
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
		header('Location: ../volunteer.php?reg=0');
		die();
	} else if ($captcha_success->success==true) {
		// Captcha all good
		
		// Provides the SQL connection object with write permissions to NSIC DB.
		require_once('writeconnect.php');

		// What happens if the sql operations fail.
		function sqlFailure($statement, $connection) {
			// Normal - Close connection, redirect back to registration page with backend failure message to contact site admins.
			$connection->close();
			header('Location: ../volunteer.php?reg=1');
			die();
			
			// Debugging - Leave turned off always for live site to prevent possible data disclosure
			// var_dump($statement);
			// echo "<br>";
			// die("ERR: Issue binding prepared statement: " . mysqli_error($connection));
		}


		// Sanatize strings
		$addcomments = mysqli_real_escape_string( $writeconn, $_POST['vol_comments']);
		$fname = mysqli_real_escape_string( $writeconn, $_POST['vol_fname']);
		$lname = mysqli_real_escape_string( $writeconn, $_POST['vol_lname']);
		$email = mysqli_real_escape_string( $writeconn, $_POST['vol_email']);
		
		// Sanatize ints
		$shirt = intval($writeconn, $_POST['vol_shirt']);
		$asl = intval($writeconn, $_POST['vol_asl']);

		// Serializes the two check box arrays for SQL storage
		$area_ser = serialize($_POST['vol_area']);
		$days_ser = serialize($_POST['vol_days']);
		
		// Check if email already registered.
		$sql = mysqli_query($writeconn, "SELECT email FROM solo_unplaced WHERE email='$email' UNION ALL SELECT email FROM participants WHERE email='$email' UNION ALL SELECT email FROM volunteers WHERE email='$email'");
		if($sql->num_rows != 0){
			sqlFailure($sql, $writeconn);
		}

		// Inserts the data
		if($stmt = $writeconn->prepare("INSERT INTO volunteers (fname, lname, email, addcomments, asl, shirtsize, areas, days) VALUES (?,?,?,?,?,?,?,?)")){
			if($stmt->bind_param("ssssiiss", $fname, $lname, $email, $addcomments, $asl, $shirt, $area_ser, $days_ser)){
				if(!$stmt->execute()){
					sqlFailure($stmt, $writeconn);
				}
			}else{
				sqlFailure($stmt, $writeconn);
			}
		}else{
			sqlFailure($stmt, $writeconn);
		}

		// Closes the SQL connection
		$writeconn->close();

		// JS That uses an iFrame to load the getCal file that downloads the calendar file.
		echo '<iframe id="my_iframe" style="display:none;"></iframe>';
		echo '<script>';
		echo "document.getElementById('my_iframe').src = \"getCal.php\";";
		echo '</script>';

		// Redirects to home. Refresh must at least be 1.
		header('Refresh: 1;url=../');
	}
}
?>
