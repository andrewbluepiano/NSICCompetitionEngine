<!-- Copyright (c) 2019 Andrew Afonso, just leave my name in comments if you reuse -->
<?php
	require_once('writeconnect.php');
	$teamid = $_REQUEST['team'];
	$questionid = $_REQUEST['question'];
	$scenarioid = $_REQUEST['scenario'];
	$answer = filter_input(INPUT_POST, 'answer');
	$storage = $_SERVER["DOCUMENT_ROOT"]."/PATH/questions". $teamid .".txt";
	echo "<meta http-equiv=\"Refresh\" content=\"0; url=https://nexthop.network/nsic/scenario.php?number=". $scenarioid ."\">";

	$rewrite = array();
	if(file_exists($storage)){
		$lines = file($storage);
		/*$raw = file_get_contents($storage);
		$lines =  unserialize($raw);
		echo print_r($lines, true);*/
		foreach($lines as $line){
			/*echo substr($line, 0, strlen($questionid));
			echo "<br>";
			echo $questionid;*/
			if(substr($line, 0, strlen($questionid)) != $questionid){
				array_push($rewrite, $line);
			}
		}
	}
	
    $new = "". $questionid . ", ". $answer."\n";
    array_push($rewrite, $new);
   	/*$serialized = serialize($rewrite);*/
    file_put_contents($storage, $rewrite);
   
?>