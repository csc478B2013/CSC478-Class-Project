<?php

//Authentication Functions

	// SIDE NOTE: THIS IS Low-SECURITY  SOLUTION BUT THIS IS A CLASS PROJECT SO WE NEED TO FOCUS ON OTHER ASPECTS OF THE CODE
	// TODO: Fix this weak security
	function authenticateUserCookie() {
		
		if (!isset($_COOKIE["UserIdent"])) {
			header("Location: index.php");
			exit();
		}	

	}

	function authenticateUserCookieLogged() {
		
		$userLoggedIn = 0;
		
		if (isset($_COOKIE["UserIdent"])) {
			$userLoggedIn = 1;
		}	

		return $userLoggedIn;
	}

?>