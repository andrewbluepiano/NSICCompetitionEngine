<?php
// Author: Andrew Afonso
session_start();

include_once("config/session_validate.php");
include_once("config/admin_validate.php");

?>
<!doctype html>
<html>
	<head>
		<title>NSIC 2020 Administration</title>
		<meta name="description" content="NSIC 2020 administration page" />
        <?php include("config/head.php"); ?>
	</head>
	<body>
		<!-- Header -->
		<?php $headtext = "<h1>NSIC 2020 Admin</h1>"; 
		include("config/header.php"); ?>
	
		<section class="center vcentercontent admin">
			<article class="wrap text">
                <ul class="noul">
                    <li>
                        <form method="post" action="config/scoreadmin.php">
                            <div class="holder">Manually set score</div>
                            
                            <div class="holder">
                            <select id="softselect" name="teamset">
                                <?php
                                require_once('config/readconnect.php');
                                $sql = mysqli_query($readconn, "SELECT tname, teamid FROM teams");
                                while ($row = $sql->fetch_assoc()){
                                    echo "<option value=\"". $row['teamid']."\">" . $row['tname'] . "</option>";
                                }
                                ?>
                            </select>
                            <input id="softfield" type="number" name="manscore" placeholder="Enter Score">
                            </div>
                            
                            <div class="holder">
                            <input id="softbtn" type="submit" name="setscore" value="Set Score">
                            </div>
                        </form>
                    </li>
                    
                    <li>
                        <form method="post" action="config/loadteamscoring.php">
                            <div class="holder">
                            Score Team:
                            <select id="softselect" name="teamselect">
                                <?php
                                $sqlteams = mysqli_query($readconn, "SELECT tname, teamid FROM teams");
                                while ($grow = $sqlteams->fetch_assoc()){
                                    echo "<option value=\"". $grow['teamid']."\">" . $grow['tname'] . "</option>";
                                }
                                ?>
                            </select>
                            
                            <div class="holder">
                             on scenario
                            <select id="softselect" name="scenarioscore">
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
                                <input id="softbtn" type="submit" name="scoring" value="Score Team">
                            </div>
                        </form>
                    </li>
                    
                    <li>
                        <form method="post" action="config/addcontent.php">
                            <div class="holder">Create new Scenario</div>
                            
                            <div class="holder">
                                <input id="softfield" type="text" name="scenarioname" placeholder="Enter Scenario Name">
                            </div>
                            
                            <div class="holder">
                                <input id="softbtn" type="submit" name="scenariocreate" value="Create Scenario">
                            </div>
                        </form>
                    </li>
                        
                    <li>
                        <form method="post" action="config/loadscenario.php">
                            <div class="holder">Select Scenario to Edit</div>
                            
                            <div class="holder">
                                <select id="softselect" name="scenario">
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
                                <input id="softbtn" type="submit" name="scenarioedit" value="Edit Scenario">
                            </div>
                        </form>
                    </li>
                    
                    <li>
                        <form method="post" action="config/solomanagement.php">
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
                                        $sql = mysqli_query($readconn, "SELECT fname, lname, networkingskill, sysadminskill, addcomments, uid FROM solo_unplaced");
                                        while ($rowone = $sql->fetch_assoc()){
                                            echo "<tr><td>". $rowone['fname']. " " . $rowone['lname'] . " </td><td> " . $rowone['networkingskill'] . "</td><td>" . $rowone['sysadminskill'] . "</td><td>" . $rowone['addcomments'] . "</td><td><select id=\"softselect\" name=\"teamset[]\"><option value=\"unset\">No Team</option>";
                                            $sqlteams = mysqli_query($readconn, "SELECT tname, teamid FROM teams");
                                            while ($grow = $sqlteams->fetch_assoc()){
                                                echo "<option value=\"". $grow['teamid'] ."|" . $rowone['uid'] ."\">" . $grow['tname'] . "</option>";
                                            }
                                            echo "</select></td></tr>";
                                        }
                                
                                    ?>
                                </table>
                            
                                <input id="softbtn" type="submit" name="usermanage" value="Update">
                            </fieldset>
                        </form>
                    </li>
                    
                    <li>
                        <form method="post" action="config/teammanagement.php">
                            <fieldset>
                                <legend>Team Management</legend>
                                <?php
                                    $sqlone = mysqli_query($readconn, "SELECT title, scenarionum FROM scenario");
                            
                                ?>
                            </fieldset>
                        </form>
                    </li>
                </ul>
			</article>
		</section>
	
		<?php include("config/footer.php"); ?>
	</body>
</html>
