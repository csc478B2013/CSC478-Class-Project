<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Page Header -->
	<header class="bg-dark" data-load='includes/public_header.php'></header>
	
	<!-- PHP Header Scripts -->
	<?php
		// include resource files
		include 'includes/functions.php';
		include 'includes/drawTables.php';
		include 'includes/drawForms.php';
		
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
	<div class="container">

	<div class="grid">
	<div class="row">
		<div class="span10 offset1">
		<form action="account_newuser.php" method="post">
		<fieldset>
			<div class="wizard" id="wizard">
				<div class="steps">
				
	<!-- Page 1 -->	<div class="step" style="height: 450px">
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
							
						</table>

					</div>
					
					
	<!-- Page 2 -->	<div class="step" style="height: 450px">
						<legend>New User Questionaire</legend>
						<table>
						
							<!-- Select Study Time of Day -->
							<tr><?php drawSelect_TOD(); ?></tr>
							
							<!-- Force Gap -->
							<tr><?php drawOther_Gap(); ?></tr>
							
							<!-- Select Study Time for Each Assignment Type -->
							<tr><?php drawLabel_st(); ?></tr>
							<tr><?php drawText_ST("Exam", "st_exam", "ex. 5"); ?></tr>
							<tr><?php drawText_ST("Quiz", "st_quiz", "ex. 4"); ?></tr>
							<tr><?php drawText_ST("Project", "st_project", "ex. 3"); ?></tr>
							<tr><?php drawText_ST("Homework", "st_homework", "ex. 2"); ?></tr>
							<tr><?php drawText_ST("Discussion", "st_discussion", "ex. 1"); ?></tr>
							<tr><?php drawText_ST("Other", "st_other", "ex. 5"); ?></tr>		
							
						</table> 
					</div>
				</div>
			</div>

		</fieldset>
		</form>	
		</div>
	</div>
	</div>
	</div>
	
	<script>
		$(function(){
			$('#wizard').wizard({
				locale: 'en',
				onCancel: function(){
					$.Dialog({
						title: 'Wizard',
						content: 'Cancel button clicked',
						shadow: true,
						padding: 10
					});
				},

				onFinish: function(){
					$.Dialog({
						title: 'Wizard',
						content: 'Finish button clicked',
						shadow: true,
						padding: 10
					});
				}
			});
		});
	</script>
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