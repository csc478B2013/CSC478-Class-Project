<?php
	
session_start();

if ($_SESSION['username']) {
	echo "Welcome, ".$_SESSION['username']."!<br><br><br>";
	echo "<a href='logout.php'>Click</a> here to logout.";
}
else {
	header('Location: test_login.php');		// redirect to login page
	exit();
}

?>