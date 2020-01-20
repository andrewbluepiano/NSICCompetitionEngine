<?php
// Author: Andrew Afonso
session_start();
?>
<div id="smallWrap">
<div id="smallWrapContent">
<header>
<nav id="NSICNav">
	<?php echo $headtext; ?>
 	<section id="NSICHamburgToggle">
		<input type="checkbox"/>
		<span></span>
		<span></span>
		<span></span>
		<ul id="NSICMenu">
            <?php
            if(session_status() != PHP_SESSION_ACTIVE || !isset($_SESSION['username'])){
                echo "<a href=\"registration\"><li>Register</li></a>";
                echo "<a href=\"login\"><li>Login</li></a>";
            }
            
            if(session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['username'])){
                echo "<a href=\"competition\"><li>Competition</li></a>";
                echo "<a href=\"scoreboard\"><li>Scoreboard</li></a>";
                if($_SESSION['login_info']['isAdmin'] === 1){
                    echo "<a href=\"admin\"><li>Admin</li></a>";
                }
                echo "<a class=\"NSICLogout\" href=\"logout\"><li>Logout</li></a>";
            }
            
            ?>
		</ul>
  </section>
</nav>
</header>
