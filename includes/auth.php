<?php

//Authentication Functions

	// SIDE NOTE: THIS IS Low-SECURITY  SOLUTION BUT THIS IS A CLASS PROJECT SO WE NEED TO FOCUS ON OTHER ASPECTS OF THE CODE
	// TODO: Fix this weak security
	function authenticateUserCookie() {
		
		if (!isset($_COOKIE["UserIdent"])) {
			//header("Location: http://uplan.site/index.php");
			header("Location: index.php");
			exit();
		}	

	}


?>