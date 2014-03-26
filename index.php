<?php
	
	// include resource files
		include 'includes/functions.php';
		include 'includes/drawTables.php';
		include 'includes/drawForms.php';
		
	// connect to database
	$link = db_connect();
		
	//perform log in validation here
	$isValidUserLogin = false;
	if(isset($_POST['loginForm'])) {
		$isValidUserLogin = authenticateUserWithCookie($link, $_POST['login'], $_POST['password']);	
		
		// if user is logged in, direct them to the dashboard
		if ($isValidUserLogin) {
			Redirect("dashboard.php");
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Page Header -->
	<header class="bg-dark" data-load='includes/public_header.php'></header>	
    
	<!-- Load CSS Libraries -->
    <link href="css/metro-bootstrap.css" rel="stylesheet">
    <link href="css/metro-bootstrap-responsive.css" rel="stylesheet">
    <link href="css/iconFont.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
    <link href="js/prettify/prettify.css" rel="stylesheet">
	
	<!-- Load JavaScript Libraries -->
    <script src="js/jquery/jquery.min.js"></script>
    <script src="js/jquery/jquery.widget.min.js"></script>
    <script src="js/jquery/jquery.mousewheel.js"></script>
    <script src="js/prettify/prettify.js"></script>

    <!-- Metro UI CSS JavaScript plugins -->
    <script src="js/load-metro.js"></script>
	
    <!-- Load JavaScript Local Libraries-->
    <script src="js/docs.js"></script>

	<title> MyUPlan</title>
</head>

<!-- Page Body -->
<body class="metro">
<div class="container">
	<div class="grid">
		<div class="row">
		<div class="span6 offset3" style="margin-top: 50px">
			<legend>Student Login</legend>
			<form class="user-input" action="index.php" method="post" >
				
				<!-- Enter student email address -->
				<label>Email</label>
				<div class="input-control text">
					<input type="text" name="login"><button class="btn-clear"></button>
				</div>
				
				<!-- Enter student password -->
				<label>Password</label>
				<div class="input-control password">
					<input type="password" name="password"><button class="btn-reveal"></button>
				</div>
				
				<!-- Create a gap between the input and submission buttons -->
				<div style="margin-top: 20px"></div>
				
				<!-- Submission actions -->
				<div class="form-actions">
				<label></label>
					<div class="place-left">
						<button class="button primary span2" type="submit" name="loginForm">Login</button>&nbsp;
					</div>
					<div class="place-right">
						<button class="button info span2"><a href="account_newuser.php">Create Account</a></button></a>&nbsp;
					</div>
				</div>
				
			</form>	
			
		</div>
		</div>
		
		<!-- if the user inputs invalid username and password, notify them -->
		<?php
			echo "	<div class='row'>";
			echo "  <div class='span6 offset3' style='margin-top: 20px'>";

			// if login attempt was made with invalide credentials 
			if(isset($_POST['loginForm']) && !$isValidUserLogin) {
				echo "	<span class='fg-red'>
							Sorry, your Email and Password are incorrect.
						</span>";
			}
			
			echo "	</div>";
			echo "	</div>";
		?>
			
	</div>
</div>			
	 
</body>  
 
<!-- Page Footer -->
<footer>

    <?php
        // include footer files
        include 'includes/footer.html';

        // close database
        mysql_close($link);
    ?>

</footer> 

</html>