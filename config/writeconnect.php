<!-- Copyright (c) 2019 Andrew Afonso, just leave my name in comments if you reuse -->
<?php
	function write_connect() {
		static $writeconn;

		if(!isset($writeconn)) {
			$config = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/PATH/config.ini"); 
			$writeconn = mysqli_connect($config['wrserver'], $config['wrusername'], $config['wrpassword'], $config['wrdbname']);
		}

		if ($writeconn === false){
			die('Connect Error ('. mysqli_connect_errno() .') '
			. mysqli_connect_error());
		}
		return $writeconn;
	}

	$writeconn = write_connect();

	if ($writeconn->connect_error) {
		die("NSIC write failure: ". $writeconn->connect_error);
	}
?> 