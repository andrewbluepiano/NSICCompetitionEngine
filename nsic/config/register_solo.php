<?php
// Author: Andrew Afonso
// Registers a solo participant who needs a team

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
		
		// Import NSIC SQL DB write object
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
			// die("ERR: Issue with: " . mysqli_error($connection));
		}
		
		// Sanatize strings
		$addcomments = mysqli_real_escape_string( $writeconn, $_POST['solocomments']);
		$diet = mysqli_real_escape_string( $writeconn, $_POST['solodiet']);
		$fname = mysqli_real_escape_string( $writeconn, $_POST['solofname']);
		$lname = mysqli_real_escape_string( $writeconn, $_POST['sololname']);
		
		// Sanatize ints
		$asl = intval($_POST['soloasl']);
		$netskill = intval( $_POST['netskill']);
		$sysskill = intval( $_POST['sysskill']);
		$shirt = intval( $_POST['soloshirt']);
		
		// Sanatize email
		$email = filter_var($_POST['soloemail'], FILTER_VALIDATE_EMAIL);

		// Check if email already registered to someone on a team, or a registered solo user.
		$sql = mysqli_query($writeconn, "SELECT email FROM solo_unplaced WHERE email='$email' UNION ALL SELECT email FROM participants WHERE email='$email' UNION ALL SELECT email FROM volunteers WHERE email='$email'");
		if($sql->num_rows != 0){
			sqlFailure($sql, $writeconn);
		}


		// The data insertion
		if($stmt = $writeconn->prepare("INSERT INTO solo_unplaced (fname, lname, email, addcomments, diet, asl, shirtsize, networkingskill, sysadminskill) VALUES (?,?,?,?,?,?,?,?,?)")){
			if($stmt->bind_param("sssssiiii", $fname, $lname, $email, $addcomments, $diet, $asl, $shirt, $netskill, $sysskill)){
				if(!$stmt->execute()){
					sqlFailure($stmt, $writeconn);
				}
			}else{
				sqlFailure($stmt, $writeconn);
			}
		}else{
			sqlFailure($stmt, $writeconn);
		}
		$writeconn->close();

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
