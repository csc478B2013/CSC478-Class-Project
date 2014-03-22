
<!-- User Authentication -->
<?php
	include 'includes/auth.php';
	authenticateUserCookie();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Page Header -->
	<header class="bg-dark" data-load='includes/header.php'></header>
    <header class="bg-white" data-load='includes/menu.html'></header>
	
	
	<!-- PHP Header Scripts -->
	<?php
		// include resource files
		include 'includes/functions.php';
		include 'includes/drawTables.php';
		include 'includes/drawForms.php';
		
		// set user authentication
		$student_id = 1;
		
		// connect to database
		$link = db_connect();
	?>

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
    
	<title> Account </title>
</head>

<!-- Page Body -->
<?php
	// get information from database
	$studentObject 		= Student::select($link, $student_id);
	//$settingsObject 	= Settings::select($link, $student_id);		<- Need to Implement Settings Class

	// set variables
	$fname 				= $studentObject->fname;
	$email 				= $studentObject->email;
	$phone 				= $studentObject->phone;
	$password 			= $studentObject->password;

?>


<body class="metro">
<div class="container">
    <div class="grid">
        <div class="row">
		
            <form action="account.php" method="post">
			<fieldset>
			<legend>Update Student Settings</legend>
				<table>

					<!-- Get First Name -->
					<tr>
						<td class="span2"><label>First Name:</label></td>
						<td class="span5">
							<div class="input-control text" data-role="input-control">
								<input type="text" name="name" value="<?php echo $fname; ?>">
								<button class="btn-clear" tabindex="-1""></button>
							</div>
						</td>
					</tr>
					
					<!-- Get Email -->
					<tr>
						<td class="span2"><label>Email:</label></td>
						<td class="span5">
							<div class="input-control text" data-role="input-control">
								<input type="email" name="email" value="<?php echo $email; ?>">
								<button class="btn-clear" tabindex="-1"></button>
							</div>
						</td>
					</tr>
					
					<!-- Get Phone Number -->
					<tr>
						<td class="span2"><label>Phone Number:</label></td>
						<td class="span5">
							<div class="input-control text" data-role="input-control">
								<input type="tel" name="phone" value="<?php echo $phone; ?>">
								<button class="btn-clear" tabindex="-1"></button>
							</div>
						</td>
					</tr>
					
					<!-- Get Password -->
					<tr>
						<td class="span2"><label>Password:</label></td>
						<td class="span5">
							<div class="input-control password" data-role="input-control">
								<input type="password" name="password" value="<?php echo $password; ?>">
								<button class="btn-reveal" tabindex="-1"></button>
							</div>
						</td>
					</tr>
					
					<!-- Force Gap Between Input and Buttons -->
					<tr>
						<td class="span10"><div style="margin-top: 20px"></div></td>
					</tr>
					
					<!-- Submission Control Buttons -->
					<tr>
						<td class="span2"><input type="submit" class="primary span2" value="Update" name="myFormSubmitted"></td>
					</tr>
				</table>   
			</fieldset>
			</form>
			
			<!-- PHP POST Handling (Form Submittal) -->
			<?php

				// Add student to database and then redirect to add semester
				if(isset($_POST['myFormSubmitted'])) {
					
					// local variables
					$fname = $_POST['name'];
					$email = $_POST['email'];
					$phone = $_POST['phone'];
					$password = $_POST['password'];
					
					// insert record into database
					Student::update($link, $student_id, $fname, $email, $phone, $password);

					Redirect('account.php');
				}
			?>
			
			
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