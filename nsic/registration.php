<!doctype html>
<html>
	<head>
		<title>NSIC 2020 Registration</title>
		<meta name="description" content="NSIC, a sysadmin competition by NextHop" />
		<meta name="author" content="Andrew Afonso," />
		<meta name="keywords" content="NSIC, Competition, Rochester, NextHop, RIT, Rochester Institute of Technology, Networking, System Administration" />
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		<script>
			// Function that returns the value of the URL parameter referenced by argument 'name'
			function get(name){
				if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
					return decodeURIComponent(name[1]);
			}
			
			// When the page 'loads', run this:
			window.addEventListener('load', function () {
				// Pause one second, then run the alerts function. This allows some of the page to load first.
				setTimeout(alerts, 1000);
				
				// The alerts function
				var alerts = function(){
					var registered = get('reg');
					if(registered == 1){
						alert("Something went wrong on our end. You arent registered yet. Please contact the site admins. Dont buy a ticket yet!");
					}
					if(registered == 0){
						alert("Captcha failure. Try that again please!");
					}
				}
				alerts();
			})
		</script>
		
        <?php include("config/head.php"); ?>
	</head>
	<body>
	<?php $headtext = "<h1>NSIC 2020 Registration</h1>"; include("config/header.php"); ?>
	
	<section class="wrap text registration">
        <ul class="noul normLines">
            <li>You may register a team with 5 Members</li>
            <li>Individuals searching for a team can register at end of page</li>
            <li>(Teams of 4 may register by contacting us directly. They will be matched with a solo participant.)</li>
            <li>After registering, you will be redirected to campusgroups to pay the registration fee. This is also linked to the side.</li>
            <li>For more information about the competition please visit: <a href="https://nexthop.network/nsic">nexthop.network/nsic</a></li>
            <li>NSIC is April 4, 9:00 am - April 5, 5:00 pm 2020</li>
        </ul>

        <form class="trans-orange rounded-containers" method="post" action="config/register_team.php">
            <fieldset>
                <legend>Team Registration</legend>
                <div class="two_columns">
                    <div class="col">
                        <label>Team Name:<input type="text" name="teamname" required></label>
                        <br>
                        <label>Desired Login ID (One string):<input type="text" name="loginid" required></label>
                        <br>
                        <label>School:<input type="text" name="school" required></label>
                        <br>
                        <label>Team Contact Email:<input type="email" name="teamEmail" required></label>
                        <br>
                        <label>Dietary Restrictions <input type="text" name="diet"></label>
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
                    </div>
                    
                    <div class="col">
                        Member 1:
                        <br>
                        <label>Name <input type="text" name="fnameone" placeholder="First" required></label>
                        <input type="text" name="lnameone" placeholder="Last" required>
                        <br>
                        <label>Email <input type="email" name="emailone" required></label>
                        <br>
                        <label>Shirt Size
                        <select name="shirtone">
                            <option value="1">S</option>
                            <option value="2">M</option>
                            <option value="3">L</option>
                            <option value="4">XL</option>
                            <option value="5">XXL</option>
                        </select>
                        </label>
                        <br><br>
                        
                        Member 2:
                        <br>
                        <label>Name <input type="text" name="fnametwo" placeholder="First" required></label>
                        <input type="text" name="lnametwo" placeholder="Last" required>
                        <br>
                        <label>Email <input type="email" name="emailtwo" required></label>
                        <br>
                        <label>Shirt Size
                        <select name="shirttwo">
                            <option value="1">S</option>
                            <option value="2">M</option>
                            <option value="3">L</option>
                            <option value="4">XL</option>
                            <option value="5">XXL</option>
                        </select>
                        </label>
                        <br><br>
                        
                        Member 3:
                        <br>
                        <label>Name <input type="text" name="fnamethree" placeholder="First" required></label>
                        <input type="text" name="lnamethree" placeholder="Last" required>
                        <br>
                        <label>Email <input type="email" name="emailthree" required></label>
                        <br>
                        <label>Shirt Size
                        <select name="shirtthree">
                            <option value="1">S</option>
                            <option value="2">M</option>
                            <option value="3">L</option>
                            <option value="4">XL</option>
                            <option value="5">XXL</option>
                        </select>
                        </label>
                        <br><br>
                        
                        Member 4:
                        <br>
                        <label>Name <input type="text" name="fnamefour" placeholder="First" required></label>
                        <input type="text" name="lnamefour" placeholder="Last" required>
                        <br>
                        <label>Email <input type="email" name="emailfour" required></label>
                        <br>
                        <label>Shirt Size
                        <select name="shirtfour">
                            <option value="1">S</option>
                            <option value="2">M</option>
                            <option value="3">L</option>
                            <option value="4">XL</option>
                            <option value="5">XXL</option>
                        </select>
                        </label>
                        <br><br>
                        
                        Member 5:
                        <br>
                        <label>Name <input type="text" name="fnamefive" placeholder="First" required></label>
                        <input type="text" name="lnamefive" placeholder="Last" required>
                        <br>
                        <label>Email <input type="email" name="emailfive" required></label>
                        <br>
                        <label>Shirt Size
                        <select name="shirtfive">
                            <option value="1">S</option>
                            <option value="2">M</option>
                            <option value="3">L</option>
                            <option value="4">XL</option>
                            <option value="5">XXL</option>
                        </select>
                        </label>
                    </div>
                </div>
                
                <div class="g-recaptcha middle_ten center" data-sitekey="6LfCrwITAAAAAF1qYP5piLPloS_e9NidjSy8xhOA"></div>
                
                <br>

                <input class="btn_one center_object" type="submit" value="Register">
                
            </fieldset>
        </form>
        <br><br>
        
        <form class="trans-orange rounded-containers" method="post" action="config/register_solo.php">
            <fieldset>
                <legend>Individual Registration</legend>
                
                <label>Name <input type="text" name="solofname" placeholder="First" required></label>
                <input type="text" name="sololname" placeholder="Last" required>
                <br>
                <label>Email <input type="email" name="soloemail" required></label>
                <br>
                <label>Shirt Size
                <select name="soloshirt">
                    <option value="1">S</option>
                    <option value="2">M</option>
                    <option value="3">L</option>
                    <option value="4">XL</option>
                    <option value="5">XXL</option>
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
                <label>Additional Comments <input type="textarea" name="solocomments"></label>
                <br>
                <label>Dietary Restrictions <input type="text" name="solodiet"></label>
                <br>
                <label>Interpreter Needed
                <input type="radio" name="soloasl" value="1">Yes
                <input type="radio" name="soloasl" value="0" checked>No
                </label>
                
                <br>
                <div class="g-recaptcha middle_ten" data-sitekey="6LfCrwITAAAAAF1qYP5piLPloS_e9NidjSy8xhOA"></div>
                <br>
                
                <input class="btn_one" type="submit" value="Submit">
                
            </fieldset>
        </form>
	</section>
	
	<?php include("config/footer.php"); ?>
	</body>
</html>
