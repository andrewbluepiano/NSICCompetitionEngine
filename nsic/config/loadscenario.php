<?php
	$scenario = filter_input(INPUT_POST, 'scenario');
	echo "<meta http-equiv=\"Refresh\" content=\"0; url=/nsic/scenario_editor.php?scenarionumber=". $scenario ."\">";
?>
