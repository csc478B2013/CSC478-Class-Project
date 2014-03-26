<?php
	// include files
	include 'includes/auth.php';
	include 'includes/functions.php';
	include 'includes/drawTables.php';
	include 'includes/drawForms.php';
		
	// connect to database
	$link = db_connect();
?>

<?php
	// Add student to database and then redirect to add semester
	if(isset($_POST['myFormSubmitted'])) {
	
		// local variables
		$fname = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$password = $_POST['password'];
		
		// insert record into database
		Student::insert($link, $fname, $email, $phone, $password);
		
		// log the new user in
		$isValidUserLogin = authenticateUserWithCookie($link, $email, $password);
		
		// send them to the new account info page
		Redirect("account_newuserinfo.php");
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
    
	<title> New User </title>
</head>

<!-- Page Body -->
<body class="metro">
	<div class="grid">
		<div class="row">
		<div class="span10 offset1">
			<form action="account_newuser.php" method="post">
			<fieldset>
				<legend>New User Setup</legend>
				<table>

					<!-- Get First Name -->
					<tr><?php drawText("First Name", "name", "ex. John"); ?></tr>
					
					<!-- Get Email -->
					<tr><?php drawText("Email", "email", "ex. john@gmail.com"); ?></tr>
					
					<!-- Get Phone Number -->
					<tr><?php drawText("Phone Number", "phone", "ex. (888)123-4567"); ?></tr>
					
					<!-- Get Password -->
					<tr><?php drawText_Password("Password", "password", "input password"); ?></tr>
					
					<!-- Force Gap Between Input and Buttons -->
					<tr><?php drawOther_Gap(); ?></tr>
					
					<!-- Submission Control Buttons -->
					<tr>
						<?php drawButton_Submit("Add"); ?> 
						<?php drawButton_Reset(); ?>
						<?php drawButton_Link("index.php", "Cancel"); ?>
					</tr>
				</table>
			</fieldset>
			</form>
	
		</div>
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