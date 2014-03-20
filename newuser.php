<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Page Header -->
	<header class="bg-dark" data-load='includes/public_header.php'></header>
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
    
	<title> New User </title>
</head>

<!-- Page Body -->
<body class="metro">
	<div class="grid">
		<div class="row">
		<div class="span10 offset1">
			<form action="newuser.php" method="post">
			<fieldset>
				<legend>New User Setup</legend>
				<table>

					<!-- Get First Name -->
					<tr>
						<td class="span2"><label>First Name:</label></td>
						<td class="span5">
							<div class="input-control text" data-role="input-control">
								<input type="text" name="name" placeholder="ex. John">
								<button class="btn-clear" tabindex="-1""></button>
							</div>
						</td>
					</tr>
					
					<!-- Get Email -->
					<tr>
						<td class="span2"><label>Email:</label></td>
						<td class="span5">
							<div class="input-control text" data-role="input-control">
								<input type="email" name="email" placeholder="ex. john@gmail.com">
								<button class="btn-clear" tabindex="-1"></button>
							</div>
						</td>
					</tr>
					
					<!-- Get Phone Number -->
					<tr>
						<td class="span2"><label>Phone Number:</label></td>
						<td class="span5">
							<div class="input-control text" data-role="input-control">
								<input type="tel" name="phone" placeholder="ex. (888)123-4567">
								<button class="btn-clear" tabindex="-1"></button>
							</div>
						</td>
					</tr>
					
					<!-- Get Password -->
					<tr>
						<td class="span2"><label>Password:</label></td>
						<td class="span5">
							<div class="input-control password" data-role="input-control">
								<input type="password" name="password" placeholder="input password" autofocus="">
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
						<td class="span2"><input type="submit" class="primary span2" value="Create" name="myFormSubmitted"></td>
						<td class="span2"><input type="reset" class="inverse span2" value="Reset Form"></td>
						<td class="span2"><button class="danger span2 offset1"><a href="index.php">Cancel</a></button></td>
					</tr>
				</table>
			</fieldset>
			</form>
			
			<?php

				// Add student to database and then redirect to add semester
				if(isset($_POST['myFormSubmitted'])) {
				
					// test variable
					$insertTest = 0;
					
					// local variables
					$fname = $_POST['name'];
					$email = $_POST['email'];
					$phone = $_POST['phone'];
					$password = $_POST['password'];
					
					// insert record into database
					$insertTest = Insert_Student($link, $fname, $email, $phone, $password);
					
					// test if insert was successful
					if ($insertTest) {
						Redirect('add_semester.php');
					}
					else
						echo "Insert Failed. Try Again";
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