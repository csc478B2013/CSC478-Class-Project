<?php

/*
	Authentication Functions
*/

/*
	Check if a cookie exists with a numeric value return true if so return false if not
	SIDE NOTE: THIS IS SHITTY SECURITY BUT THIS IS A CLASS PROJECT SO WE NEED TO FOCUS ON OTHER ASPECTS OF THE CODE
	TODO: Fix this weak security
*/
function authenticateUserCookie()
{
	if (!isset($_COOKIE["UserIdent"]))
	{
		header("Location: http://uplan.site/index.php");
		exit();
	}	
}


?>