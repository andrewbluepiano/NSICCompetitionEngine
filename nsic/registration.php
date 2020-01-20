<!doctype html>
<html>
	<head>
		<title>NSIC 2020 Registration</title>
		<meta name="description" content="NSIC, a sysadmin competition by NextHop" />
        <?php include("config/head.php"); ?>
	</head>
	<body>
	<?php $headtext = "<h1>NSIC 2020 Registration</h1>"; include("config/header.php"); ?>
	
	<section class="wrap text registration">
        <ul class="noul normLines">
            <li>You may register a team with 4 or 5 Members ( If you register 4 we will fill the 5th slot with one of the individuals )</li>
            <li>Individuals searching for a team can register at end of page</li>
            <li>To pay the registration fee, please go use this link: https://campusgroups.rit.edu/store?store_id=562</li>
            <li>For more information about the competition please visit: nexthop.network/nsic</li>
            </ul>

        <form method="post" action="config/register_team.php">
            <fieldset>
                <legend>Team Registration</legend>
                <div class="two_columns">
                    <div class="col">
                        <label>Team Name:<input id="softfield" type="text" name="teamname" required></label>
                        <br>
                        <label>Desired Login ID (One string):<input id="softfield" type="text" name="loginid" required></label>
                        <br>
                        <label>School:<input id="softfield" type="text" name="school" required></label>
                        <br>
                        <label>Dietary Restrictions <input id="softfield" type="text" name="diet"></label>
                        <br>
                        <label>Interpreter Needed
                        <input type="radio" name="asl" value="1">Yes
                        <input type="radio" name="asl" value="0" checked>No
                        </label>
                        <br>
                        <label for="addcomments">Additional Comments: </label>
                        <br>
                        <textarea id="softfield" name="addcomments" cols="40" rows="10"></textarea>
                        <br>
                        
                        <input id="softbtn" type="submit" value="Submit">
                        
                    </div>
                    <div class="col">
                        Member 1:
                        <br>
                        <label>Name <input id="softfield" type="text" name="fnameone" placeholder="First" required></label>
                        <input id="softfield" type="text" name="lnameone" placeholder="Last" required>
                        <br>
                        <label>Email <input id="softfield" type="email" name="emailone" required></label>
                        <br>
                        <label>Shirt Size
                        <select name="shirtone">
                            <option value="s">S</option>
                            <option value="m">M</option>
                            <option value="l">L</option>
                            <option value="xl">XL</option>
                            <option value="xxl">XXL</option>
                        </select>
                        </label>
                        <br><br>
                        
                        Member 2:
                        <br>
                        <label>Name <input id="softfield" type="text" name="fnametwo" placeholder="First" required></label>
                        <input id="softfield" type="text" name="lnametwo" placeholder="Last" required>
                        <br>
                        <label>Email <input id="softfield" type="email" name="emailtwo" required></label>
                        <br>
                        <label>Shirt Size
                        <select name="shirttwo">
                            <option value="s">S</option>
                            <option value="m">M</option>
                            <option value="l">L</option>
                            <option value="xl">XL</option>
                            <option value="xxl">XXL</option>
                        </select>
                        </label>
                        <br><br>
                        
                        Member 3:
                        <br>
                        <label>Name <input id="softfield" type="text" name="fnamethree" placeholder="First" required></label>
                        <input id="softfield" type="text" name="lnamethree" placeholder="Last" required>
                        <br>
                        <label>Email <input id="softfield" type="email" name="emailthree" required></label>
                        <br>
                        <label>Shirt Size
                        <select name="shirtthree">
                            <option value="s">S</option>
                            <option value="m">M</option>
                            <option value="l">L</option>
                            <option value="xl">XL</option>
                            <option value="xxl">XXL</option>
                        </select>
                        </label>
                        <br><br>
                        
                        Member 4:
                        <br>
                        <label>Name <input id="softfield" type="text" name="fnamefour" placeholder="First" required></label>
                        <input id="softfield" type="text" name="lnamefour" placeholder="Last" required>
                        <br>
                        <label>Email <input id="softfield" type="email" name="emailfour" required></label>
                        <br>
                        <label>Shirt Size
                        <select name="shirtfour">
                            <option value="s">S</option>
                            <option value="m">M</option>
                            <option value="l">L</option>
                            <option value="xl">XL</option>
                            <option value="xxl">XXL</option>
                        </select>
                        </label>
                        <br><br>
                        
                        Member 5:
                        <br>
                        <label>Name <input id="softfield" type="text" name="fnamefive" placeholder="First"></label>
                        <input id="softfield" type="text" name="lnamefive" placeholder="Last">
                        <br>
                        <label>Email <input id="softfield" type="email" name="emailfive"></label>
                        <br>
                        <label>Shirt Size
                        <select name="shirtfive">
                            <option value="s">S</option>
                            <option value="m">M</option>
                            <option value="l">L</option>
                            <option value="xl">XL</option>
                            <option value="xxl">XXL</option>
                        </select>
                        </label>
                    </div>
                </div>
            </fieldset>
        </form>
        <br><br>
        
        <form method="post" action="config/register_solo.php">
            <fieldset>
                <legend>Individual Registration</legend>
                
                <label>Name <input id="softfield" type="text" name="solofname" placeholder="First" required></label>
                <input id="softfield" type="text" name="sololname" placeholder="Last" required>
                <br>
                <label>Email <input id="softfield" type="email" name="soloemail" required></label>
                <br>
                <label>Shirt Size
                <select name="soloshirt">
                    <option value="s">S</option>
                    <option value="m">M</option>
                    <option value="l">L</option>
                    <option value="xl">XL</option>
                    <option value="xxl">XXL</option>
                </select>
                </label>
                <br>
                <label>Networking Skill Level
                <select name="netskill">
                    <option value="1">None</option>
                    <option value="2">Beginner</option>
                    <option value="3">Intermediate</option>
                    <option value="4">Advanced</option>
                    <option value="5">Expert</option>
                </select>
                </label>
                <br>
                <label>Systems Administration Skill Level
                <select name="sysskill">
                    <option value="1">None</option>
                    <option value="2">Beginner</option>
                    <option value="3">Intermediate</option>
                    <option value="4">Advanced</option>
                    <option value="5">Expert</option>
                </select>
                </label>
                <br>
                <label>Additional Comments <input id="softfield" type="textarea" name="solocomments"></label>
                <br>
                <label>Dietary Restrictions <input id="softfield" type="text" name="solodiet"></label>
                <br>
                <label>Interpreter Needed
                <input type="radio" name="soloasl" value="1">Yes
                <input type="radio" name="soloasl" value="0" checked>No
                </label>
                
                <br>
                
                <input id="softbtn" type="submit" value="Submit">
                
            </fieldset>
        </form>
	</section>
	
	<?php include("config/footer.php"); ?>
	</body>
</html>
