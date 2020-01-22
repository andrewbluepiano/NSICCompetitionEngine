<!doctype html>
<html>
	<head>
		<title>NSIC 2020 Volunteer Sign Up</title>
		<meta name="description" content="NSIC volunteer sign up" />
        <?php include("config/head.php"); ?>
	</head>
	<body>
	<?php $headtext = "<h1>NSIC 2020 Volunteer Sign Up</h1>"; include("config/header.php"); ?>
	
	<section class="wrap text registration">
        <ul class="noul center normLines">
            <li>NSIC is April 4-5 2020. Please slack us too.</li>
        </ul>
        
        <form method="post" action="config/register_volunteer.php">
            <fieldset>
                <legend>Volunteer Sign Up</legend>
                
                <label>Name <input class="softfield" type="text" name="vol_fname" placeholder="First" required></label>
                <input class="softfield" type="text" name="vol_lname" placeholder="Last" required>
                <br>
                <label>Email <input class="softfield" type="email" name="vol_email" required></label>
                <br>
                <label>Shirt Size
                <select name="vol_shirt">
                    <option value="s">S</option>
                    <option value="m">M</option>
                    <option value="l">L</option>
                    <option value="xl">XL</option>
                    <option value="xxl">XXL</option>
                </select>
                </label>
                <br>
                <label>Additional Comments <input class="softfield" type="textarea" name="vol_comments"></label>
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
                
                <input class="btn_one" type="submit" value="Submit">
                
            </fieldset>
        </form>
	</section>
	
	<?php include("config/footer.php"); ?>
	</body>
</html>
