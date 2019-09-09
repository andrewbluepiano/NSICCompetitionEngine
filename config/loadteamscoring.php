<!-- Copyright (c) 2019 Andrew Afonso, just leave my name in comments if you reuse -->
<?php
	$teamid = filter_input(INPUT_POST, 'teamselect');
	$scenarioid = filter_input(INPUT_POST, 'scenarioscore');
	echo "<meta http-equiv=\"Refresh\" content=\"0; url=https://nexthop.network/nsic/team_scoring.php?team=". $teamid ."&scenario=". $scenarioid ."\">";
?>