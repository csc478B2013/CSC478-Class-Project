<?php
	// include files
	include 'includes/auth.php';
	include 'includes/functions.php';
	include 'includes/drawTables.php';
	include 'includes/drawForms.php';
	
	// authenticate user
	authenticateUserCookie();
	
	// set the student id
	$student_id = $_COOKIE["UserIdent"];
		
	// connect to database
	$link = db_connect();

	
		// Add student to database and then redirect to add semester
		if(isset($_POST['myFormSubmitted'])) {
		
			// local variables
			$study_tod 		= $_POST['study_tod'];
			$st_exam 		= $_POST['st_exam'];
			$st_quiz 		= $_POST['st_quiz'];
			$st_project 	= $_POST['st_project'];
			$st_homework 	= $_POST['st_homework'];
			$st_discussion 	= $_POST['st_discussion'];
			$st_other 		= $_POST['st_other'];
			
			// insert record into database
			Settings::insert($link, $student_id, $study_tod, $st_exam, $st_quiz, $st_project, $st_homework, $st_discussion, $st_other);
				
			// send them to the new account info page
			Redirect("modify_AddSemester.php");
		}
		
	?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Page Header -->
	<header class="bg-dark" data-load='includes/header.php'></header>
	
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
    <script src="js/jquery.validate.min.js"></script>
	<script>
	$(document).ready(function(){
	$("#newUserInfoForm").validate({
	  	rules: 
		{
		
		
		st_exam: 
		{
		required: true,
		maxlength: 1,
		minlength: 1,
		digits: true
		},
		
		st_quiz: 
		{
		required: true,
		maxlength: 1,
		minlength: 1,
		digits: true
		},
		
		st_project: 
		{
		required: true,
		maxlength: 1,
		minlength: 1,
		digits: true
		},
		
		st_homework: 
		{
		required: true,
		maxlength: 1,
		minlength: 1,
		digits: true
		},
		
		st_discussion: 
		{
		required: true,
		maxlength: 1,
		minlength: 1,
		digits: true
		},
		
		st_other: 
		{
		required: true,
		maxlength: 1,
		minlength: 1,
		digits: true
		}
	  	}
	});
	});
	</script>
	<title> New User </title>
</head>

<!-- Page Body -->
<body class="metro">
	<div class="grid">
		<div class="row">
		<div class="span10 offset1">
			<form action="account_newuserinfo.php" method="post" name="form" id="newUserInfoForm">
			<fieldset>
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
					
					<!-- Force Gap Between Input and Buttons -->
					<tr><?php drawOther_Gap(); ?></tr>
					
					<!-- Submission Control Buttons -->
					<tr> 
						<?php drawButton_Submit("Create!"); ?> 
						<?php drawButton_Reset(); ?>
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