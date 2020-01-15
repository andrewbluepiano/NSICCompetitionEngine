<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		header('Location: login');
	}
?>
<!DOCTYPE HTML>
<html>
<!-- Yo, its Andrew Here -->
	<head>
		<title>NSIC 2020 Registration</title>
		<meta name="description" content="NSIC, a sysadmin competition by NextHop" />
        <?php include("config/head.php"); ?>
	</head>
	<body>
	<!-- Header -->
	<?php $headtext = "<h1>NSIC 2020 Registration</h1>"; include("config/header.php"); ?>
	
	<section class="vcentercontent nsicreg">
		<article class="text wrap">
			<p>You may register a team with 4 or 5 Members ( If you register 4 we will fill the 5th slot with one of the individuals <br>
			If you are searching for a team please fill out this form: https://goo.gl/forms/DU8H29jNrYctmdId2<br>
			To pay the registration fee, please go use this link: https://campusgroups.rit.edu/store?store_id=562<br>
			For more information about the competition please visit: nexthop.network/nsic</p>
	
			<form method="post" action="config/register.php">
				<p>Team Name <input id="softfield" type="text" name="teamname" required></p>
				<p>School <input id="softfield" type="text" name="school" required></p>
				<p>Additional Comments <input id="softfield" type="text" name="addcomments"></p>
				<p>Dietary Restrictions <input id="softfield" type="text" name="diet"></p>
				<p>Interpreter Needed
				<input type="radio" name="asl" value="1">Yes
				<input type="radio" name="asl" value="0" checked>No
				</p>
				<p>Member 1: Name <input id="softfield" type="text" name="fnameone" placeholder="First" required><input id="softfield" type="text" name="lnameone" placeholder="Last" required> Email<input id="softfield" type="email" name="emailone" required> Shirt Size
				<select name="shirtone">
					<option value="s">S</option>
					<option value="m">M</option>
					<option value="l">L</option>
					<option value="xl">XL</option>
					<option value="xxl">XXL</option>
				</select>
				</p>
				<p>Member 2: Name <input id="softfield" type="text" name="fnametwo" placeholder="First" required><input id="softfield" type="text" name="lnametwo" placeholder="Last" required> Email<input id="softfield" type="email" name="emailtwo" required> Shirt Size
				<select name="shirttwo">
					<option value="s">S</option>
					<option value="m">M</option>
					<option value="l">L</option>
					<option value="xl">XL</option>
					<option value="xxl">XXL</option>
				</select>
				</p>
				<p>Member 3: Name <input id="softfield" type="text" name="fnamethree" placeholder="First" required><input id="softfield" type="text" name="lnamethree" placeholder="Last" required> Email<input id="softfield" type="email" name="emailthree" required> Shirt Size
				<select name="shirtthree">
					<option value="s">S</option>
					<option value="m">M</option>
					<option value="l">L</option>
					<option value="xl">XL</option>
					<option value="xxl">XXL</option>
				</select>
				</p>
				<p>Member 4: Name <input id="softfield" type="text" name="fnamefour" placeholder="First" required><input id="softfield" type="text" name="lnamefour" placeholder="Last" required> Email<input id="softfield" type="email" name="emailfour" required> Shirt Size
				<select name="shirtfour">
					<option value="s">S</option>
					<option value="m">M</option>
					<option value="l">L</option>
					<option value="xl">XL</option>
					<option value="xxl">XXL</option>
				</select>
				</p>
				<p>Member 5: Name <input id="softfield" type="text" name="fnamefive" placeholder="First" required><input id="softfield" type="text" name="lnamefive" placeholder="Last" required> Email<input id="softfield" type="email" name="emailfive" required> Shirt Size
				<select name="shirtfive">
					<option value="s">S</option>
					<option value="m">M</option>
					<option value="l">L</option>
					<option value="xl">XL</option>
					<option value="xxl">XXL</option>
				</select>
				</p>
			
			
				<input id="softbtn" type="submit" value="Submit">
			</form>
		</article>
	</section>
	
	<?php include("config/footer.php"); ?>
	</body>
</html>
