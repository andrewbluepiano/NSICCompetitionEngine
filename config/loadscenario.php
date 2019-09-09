<!-- Copyright (c) 2019 Andrew Afonso, just leave my name in comments if you reuse -->
<?php
	$scenario = filter_input(INPUT_POST, 'scenario');
	echo "<meta http-equiv=\"Refresh\" content=\"0; url=https://nexthop.network/nsic/scenario_editor.php?scenarionumber=". $scenario ."\">";
?>