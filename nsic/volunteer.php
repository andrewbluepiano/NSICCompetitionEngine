<!doctype html>
<html>
	<head>
		<title>NSIC 2020 Volunteer Sign Up</title>
		<meta name="description" content="NSIC volunteer sign up" />
		<meta name="author" content="Andrew Afonso," />
		<meta name="keywords" content="NSIC, Volunteer, NextHop, RIT, Alum" />
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
						alert("Something went wrong on our end. You arent registered yet. Please contact the site admins.");
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
	<?php $headtext = "<h1>NSIC 2020 Volunteer Sign Up</h1>"; include("config/header.php"); ?>
	
	<section class="wrap text registration">
        <ul class="noul center normLines">
            <li>NSIC is April 4-5 2020. Please slack us too.</li>
        </ul>
        
        <form class="trans-orange rounded-containers" method="post" action="config/register_volunteer.php">
            <fieldset>
                <legend>Volunteer Sign Up</legend>
                
                <label>Name <input type="text" name="vol_fname" placeholder="First" required></label>
                <input type="text" name="vol_lname" placeholder="Last" required>
                <br>
                <label>Email <input type="email" name="vol_email" required></label>
                <br>
                <label>Shirt Size
                <select name="vol_shirt">
                    <option value="1">S</option>
                    <option value="2">M</option>
                    <option value="3">L</option>
                    <option value="4">XL</option>
                    <option value="5">XXL</option>
                </select>
                </label>
                <br>
                <label>Additional Comments <input type="textarea" name="vol_comments"></label>
                <br>
                <label>Interpreter Needed
                <input type="radio" name="vol_asl" value="1">Yes
                <input type="radio" name="vol_asl" value="0" checked>No
                </label>
                <br>
                <br>
                What do you want to help with?
                <br>
                <label>Setup <input type="checkbox" name="vol_area[Setup]" value="1" />
                <br>
                <label>Teardown <input type="checkbox" name="vol_area[Teardown]" value="1" />
                <br>
                <label>Driving / Food pick up <input type="checkbox" name="vol_area[Driving]" value="1" />
                <br>
                <label>Administrative Duties <input type="checkbox" name="vol_area[Admin]" value="1" />
                <br>
                <br>
                What days can you help?
                <br>
                <label>Friday Night (April 3) <input type="checkbox" name="vol_days[Friday]" value="1" />
                <br>
                <label>Saturday (April 4) <input type="checkbox" name="vol_days[Saturday]" value="1" />
                <br>
                <label>Sunday (April 5) <input type="checkbox" name="vol_days[Sunday]" value="1" />
                <br>
                <label>Whenever <input type="checkbox" name="vol_days[Whenever]" value="1" />
                <br>
                <div class="g-recaptcha middle_ten" data-sitekey="6LfCrwITAAAAAF1qYP5piLPloS_e9NidjSy8xhOA"></div>
                
                <br>
                
                <input class="btn_one" type="submit" value="Sign up">
                
            </fieldset>
        </form>
	</section>
	
	<?php include("config/footer.php"); ?>
	</body>
</html>
