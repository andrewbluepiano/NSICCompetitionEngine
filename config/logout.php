<!-- Copyright (c) 2019 Andrew Afonso, just leave my name in comments if you reuse -->
<?php
	session_start();
	unset($_SESSION['username']);
	header('Location: /nsic');
?>