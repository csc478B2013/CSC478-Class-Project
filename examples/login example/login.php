<?php

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if ($username && $password) {

	// connect to database
	$connect = mysql_connect("localhost", "uisadmin", "CodeMonkeys1") or die("Error Connecting");
	mysql_select_db("phplogin") or die("Unable to select database");
	
	// check database for user
	$query = mysql_query("	SELECT * 
							FROM users 
							WHERE username = '$username'");
	
	$numrows = mysql_num_rows($query);
	
	// if user exists...
	if ($numrows != 0) {
		// code to login
		while ($row = mysql_fetch_assoc($query)) {
			
			$dbusername = $row['username'];
			$dbpassword = $row['password'];	
		
		
			// check to see if they match
			if  ($username == $dbusername && $password == $dbpassword) {
				echo "You're in! <a href='member.php'>Click</a> here to enter.";
				$_SESSION['username'] = $dbusername;
			}
			else {
				echo "Incorrect password!";
			}
		
		}
	}
	// else user does not exist
	else
		die("That user doesn't exist");
}

else
	die("Please enter a username and password");



?>
