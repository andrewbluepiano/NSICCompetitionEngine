<?php
// Author: Andrew Afonso
// Description: Site header

// Navbar changes based on if the user is logged in, and if they are a competition admin.
session_start();
?>
<div id="smallWrap">
<div id="smallWrapContent">
<header>
<nav id="NSICNav">
	<?php
		// Displays the title of the page, set as $headtext in the page body.
		echo $headtext;
	?>
 	<section id="NSICHamburgToggle">
		<input type="checkbox"/>
		<span></span>
		<span></span>
		<span></span>
		<ul id="NSICMenu">
            <?php
            // Public navbar
            if(session_status() != PHP_SESSION_ACTIVE || !isset($_SESSION['username'])){
                echo "<a href=\"registration\"><li>Register</li></a>";
                echo "<a href=\"volunteer\"><li>Volunteer</li></a>";
                echo "<a href=\"https://campusgroups.rit.edu/store?store_id=562\"><li>Pay Fee</li></a>";
                echo "<a href=\"login\"><li>Login</li></a>";
            }
            
            // Navbar for logged in users
            if(session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['username'])){
                echo "<a href=\"competition\"><li>Competition</li></a>";
                echo "<a href=\"scoreboard\"><li>Scoreboard</li></a>";
                if($_SESSION['login_info']['isAdmin'] === 1){ // If user is admin, display admin link
                    echo "<a href=\"admin\"><li>Admin</li></a>";
                }
                echo "<a class=\"NSICLogout\" href=\"logout\"><li>Logout</li></a>";
            }
            
            ?>
		</ul>
  </section>
</nav>
</header>
