<?php
// Author: Andrew Afonso

// Session setup & admin verification
session_start();
include_once("config/session_validate.php");
include_once("config/admin_validate.php");

// Creates a read only SQL connection object
require_once('config/readconnect.php');
?>
<!doctype html>
<html>
	<head>
		<title>NSIC 2020 Administration</title>
		<meta name="description" content="NSIC 2020 administration page" />
        <?php include("config/head.php"); ?>
	</head>
	<body onload="oneTable()">
		<!-- Header -->
		<?php $headtext = "<h1>NSIC 2020 Admin</h1>"; 
		include("config/header.php"); ?>
	
		<section class="wrap center admin">
			<article class="text">
                <ul class="noul">
                    <li>
                        <form method="post" action="team_scoring.php">
                            <div class="holder">
                                Score Team:
                                <select class="softselect" name="teamselect">
                                    <?php
                                    $sqlteams = mysqli_query($readconn, "SELECT tname, teamid FROM teams");
                                    while ($grow = $sqlteams->fetch_assoc()){
                                        echo "<option value=\"". $grow['teamid']."\">" . $grow['tname'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="holder">
                                 on scenario
                                <select class="softselect" name="scenarioscore">
                                    <?php
                                    require_once('config/readconnect.php');
                                    $sqlone = mysqli_query($readconn, "SELECT title, scenarionum FROM scenario");
                                    while ($rowone = $sqlone->fetch_assoc()){
                                        echo "<option value=\"". $rowone['scenarionum']."\">". $rowone['scenarionum'].": " . $rowone['title'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="holder">
                                <input class="softbtn" type="submit" name="scoring" value="Score Team">
                            </div>
                        </form>
                    </li>
                    
                    <li>
                        <form method="post" action="config/scenario_new.php">
                            <div class="holder">Create new Scenario</div>
                            
                            <div class="holder">
                                <input class="softfield" type="text" name="scenarioname" placeholder="Enter Scenario Name">
                            </div>
                            
                            <div class="holder">
                                <input class="softbtn" type="submit" name="scenariocreate" value="Create Scenario">
                            </div>
                        </form>
                    </li>
                        
                    <li>
                        <form method="post" action="scenario_editor.php">
                            <div class="holder">Select Scenario to Edit</div>
                            
                            <div class="holder">
                                <select class="softselect" name="scenario">
                                    <?php
                                    require_once('config/readconnect.php');
                                    $sqlone = mysqli_query($readconn, "SELECT title, scenarionum FROM scenario");
                                    while ($rowone = $sqlone->fetch_assoc()){
                                        echo "<option value=\"". $rowone['scenarionum']."\">". $rowone['scenarionum'].": " . $rowone['title'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="holder">
                                <input class="softbtn" type="submit" name="scenarioedit" value="Edit Scenario">
                            </div>
                        </form>
                    </li>
                    
                    <hr>
                    
                    <!-- Team management section -->
                    <li>
                        <form method="post" action="config/teammanagement.php">
                            <fieldset>
                                <legend>Team Info</legend>
                                <button type="button" style="padding:5px" onclick="teamDetails()">Team Details</button>
                                <button type="button" style="padding:5px" onclick="teamMembers()">Members</button>
                                
                                <script>
                                function oneTable() {
                                  var memberTab = document.getElementById("teamMemberTable");
                                  memberTab.style.display = "none";
                                }
                                
                                function teamMembers() {
                                  var memberTab = document.getElementById("teamMemberTable");
                                  var detailsTab = document.getElementById("teamDetailsTable");
                                  detailsTab.style.display = "none";
                                  memberTab.style.display = "table";
                                }
                                
                                function teamDetails() {
                                  var memberTab = document.getElementById("teamMemberTable");
                                  var detailsTab = document.getElementById("teamDetailsTable");
                                  memberTab.style.display = "none";
                                  detailsTab.style.display = "table";
                                }
                                </script>
                                
                                <table style="width:100%" id="teamMemberTable">
                                    <tr class="normLines">
                                        <th>Team Name</th>
                                        <th colspan="5">Members</th>
                                    </tr>
                                    
                                    <?php
                                    // Query to return teamid, and team name (tname).
                                    $sqlteams = mysqli_query($readconn, "SELECT teamid, tname, email FROM teams");
                                    
                                    while($oneentry = $sqlteams->fetch_assoc()){
                                        echo "<tr><td><a href=\"mailto:" . $oneentry['email'] . "\">" . $oneentry['tname'] . "</a></td>";
                                        
                                        $sqlmembers = mysqli_query($readconn, "SELECT fname, lname FROM participants WHERE teamid=" . $oneentry['teamid'] . " ORDER BY lname ASC");
                                        
                                        while($auser = $sqlmembers->fetch_assoc()){
                                            echo "<td>". $auser['fname']. " " . $auser['lname'][0] . " </td>";
                                        }

                                        echo "</tr>";
                                    }
                                    ?>
                                </table>
                                
                                <table style="width:100%" id="teamDetailsTable">
                                    <tr class="normLines">
                                        <th>Team Name</th>
                                        <th>School</th>
                                        <th>Interpreter</th>
                                        <th>Dietary</th>
                                        <th>Comments</th>
                                    </tr>
                                    
                                    <?php
                                    // Query to return teamid, and team name (tname).
                                    $sqlteams = mysqli_query($readconn, "SELECT tname, school, diet, asl, addcomments, email FROM teams");
                                    
                                    while($ateam = $sqlteams->fetch_assoc()){
                                        echo "<tr><td><a href=\"mailto:" . $ateam['email'] . "\">" . $ateam['tname'] . "</a></td><td>" . $ateam['school'] . "</td><td>" . $ateam['asl'] . "</td><td>" . $ateam['diet'] . "</td><td>" . $ateam['addcomments'] . "</td></tr>";
                                    }
                                    ?>
                                </table>
                                
                            </fieldset>
                        </form>
                    </li>
                    
                    <hr>
                    
                    <li>
                        <form method="post" action="config/solo_management.php">
                            <fieldset>
                                <legend>Solo Participant Management</legend>
                                <table style="width:100%">
                                    <tr class="normLines">
                                        <th>Name</th>
                                        <th>Networking<br>Skill</th>
                                        <th>Sysadmin<br>Skill</th>
                                        <th>Additional<br>Comments</th>
                                        <th>Set Team</th>
                                    </tr>
                                    
                                    <?php
                                        $sql = mysqli_query($readconn, "SELECT fname, lname, networkingskill, sysadminskill, addcomments, uid, email FROM solo_unplaced");
                                        while ($rowone = $sql->fetch_assoc()){
                                            echo "<tr><td><a href=\"mailto:" . $rowone['email'] . "\">" . $rowone['fname']. " " . $rowone['lname'] . "</a></td><td>" . $rowone['networkingskill'] . "</td><td>" . $rowone['sysadminskill'] . "</td><td>" . $rowone['addcomments'] . "</td><td><select class=\"softselect\" name=\"teamset[]\"><option value=\"unset\">No Team</option>";
                                            $sqlteams = mysqli_query($readconn, "SELECT tname, teamid FROM teams");
                                            while ($grow = $sqlteams->fetch_assoc()){
                                                echo "<option value=\"". $grow['teamid'] ."|" . $rowone['uid'] ."\">" . $grow['tname'] . "</option>";
                                            }
                                            echo "</select></td></tr>";
                                        }
                                
                                    ?>
                                </table>
                            
                                <input class="softbtn" type="submit" name="usermanage" value="Update">
                            </fieldset>
                        </form>
                    </li>
                    
                    <hr>
                    
                    <li>
                        <table style="width:100%">
                            <caption>Volunteers</caption>
                            
                            <tr class="normLines">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Areas</th>
                                <th>Days</th>
                                <th>Additional<br>Comments</th>
                            </tr>
                            
                            <?php
                                $sqlVolunt = mysqli_query($readconn, "SELECT fname, lname, email, areas, days, addcomments FROM volunteers");
                                
                                while ($aVolunt = $sqlVolunt->fetch_assoc()){
                                    $areasVol = array_keys(unserialize($aVolunt['areas']), "1");
                                    $daysVol = array_keys(unserialize($aVolunt['days']), "1");
                                    
                                    echo "<tr><td>". $aVolunt['fname'] . " " . $aVolunt['lname'] . "</td><td><a href=\"mailto:" . $aVolunt['email'] . "\">" . $aVolunt['email'] . "</a></td><td>";
                                    
                                    
                                    foreach($areasVol as $val){
                                        if($val != end($areasVol)){
                                            echo $val . ", ";
                                        }
                                        else{
                                            echo $val;
                                        }
                                    }
                                    
                                    echo "</td><td>";
                                    
                                    foreach($daysVol as $dayVol){
                                        if($dayVol != "Whenever"){
                                            echo substr($dayVol, 0, 3);
                                        }
                                        else{
                                            echo $dayVol;
                                        }
                                        
                                        if($dayVol != end($daysVol)){
                                            echo ", ";
                                        }
                                    }
                                    
                                    echo "<td>" . $aVolunt['addcomments'] . "</td></tr>";
                                }
                        
                            ?>
                        </table>
                    </li>
                    
                    
                </ul>
			</article>
		</section>
	
		<?php include("config/footer.php"); ?>
	</body>
</html>
