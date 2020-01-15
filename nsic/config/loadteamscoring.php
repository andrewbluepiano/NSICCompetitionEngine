<?php
	$teamid = filter_input(INPUT_POST, 'teamselect');
	$scenarioid = filter_input(INPUT_POST, 'scenarioscore');
	echo "<meta http-equiv=\"Refresh\" content=\"0; url=/nsic/team_scoring.php?team=". $teamid ."&scenario=". $scenarioid ."\">";
?>
