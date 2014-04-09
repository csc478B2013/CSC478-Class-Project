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
		$fname 			= $_POST['fname'];
		$email 			= $_POST['email'];
		$phone 			= $_POST['phone'];
		$password 		= $_POST['password'];
			
		$study_tod		= $_POST['study_tod'];
		$st_exam		= $_POST['st_exam'];
		$st_quiz		= $_POST['st_quiz'];
		$st_project		= $_POST['st_project'];
		$st_homework	= $_POST['st_homework'];
		$st_discussion	= $_POST['st_discussion'];
		$st_other		= $_POST['st_other'];
		
		// update records in database
		Student::update($link, $student_id, $fname, $email, $phone, $password);
		Settings::update($link, $student_id, $study_tod, $st_exam, $st_quiz, $st_project, $st_homework, $st_discussion, $st_other);
		
		//Redirect('account.php');
	}
?>
			
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Page Header -->
	<header class="bg-dark" data-load='includes/header.php'></header>
    <header class="bg-white" data-load='includes/menu.html'></header>

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
	$("#accountForm").validate({
	  	rules: 
		{
		
		fname: 
		{
		required: true,
		},
		
	    email: 
		{
	      required: true,
	      email: true
	    },
	
		phone: 
		{
		required: true,
		},
		
		password: 
		{
		required: true,
		},
		
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
    
	<title> Account </title>
</head>

<!-- Page Body -->
<?php
	// get information from database
	$studentObject 		= Student::select($link, $student_id);
	$settingsObject 	= Settings::select($link, $student_id);
	
	// set variables
	$fname 				= $studentObject->fname;
	$email 				= $studentObject->email;
	$phone 				= $studentObject->phone;
	$password 			= $studentObject->password;

    $study_tod			= $settingsObject->study_tod;
    $st_exam			= $settingsObject->st_exam;
	$st_quiz			= $settingsObject->st_quiz;
	$st_project			= $settingsObject->st_project;
	$st_homework		= $settingsObject->st_homework;
	$st_discussion		= $settingsObject->st_discussion;
	$st_other			= $settingsObject->st_other;

?>


<body class="metro">
<div class="container">
    <div class="grid">
        <div class="row">
		
            <form action="account.php" method="post" id="accountForm">
			<fieldset>
			<legend>Account Settings</legend>
				<table>

					<!-- Display Account Information -->
					<tr><?php drawTextValue("First Name", "fname", $fname); ?></tr>
					<tr><?php drawTextValue("Email", "email", $email); ?></tr>
					<tr><?php drawTextValue("Phone Number", "phone", $phone); ?></tr>
					<tr><?php drawTextValue_Password("Password", "password", $password); ?></tr>
					
				<!-- Force Divider -->
				<tr><?php drawOther_Divider(); ?></tr>
					
					<!-- Display Student Settings -->
					<tr><?php drawSelect_TOD_Value($study_tod); ?></tr>
					<tr><?php drawLabel_st(); ?></tr>
					<tr><?php drawText_ST_Value("Exam", "st_exam", $st_exam); ?></tr>
					<tr><?php drawText_ST_Value("Quiz", "st_quiz", $st_quiz); ?></tr>
					<tr><?php drawText_ST_Value("Project", "st_project", $st_project); ?></tr>
					<tr><?php drawText_ST_Value("Homework", "st_homework", $st_homework); ?></tr>
					<tr><?php drawText_ST_Value("Discussion", "st_discussion", $st_discussion); ?></tr>
					<tr><?php drawText_ST_Value("Other", "st_other", $st_other); ?></tr>
					
				<!-- Force Divider -->
				<tr><?php drawOther_Divider(); ?></tr>
				
					<!-- Force Gap Between Input and Buttons -->
					<tr><?php drawOther_Gap(); ?></tr>
					
					<!-- Submission Control Buttons -->
					<tr><?php drawButton_Submit("Update"); ?> </td>
					
					
				</table>   
			</fieldset>
			</form>	
			
			<?php
				if(isset($_POST['myFormSubmitted'])) {
					
				// alert the user 
				echo "	<blockquote>
							<p class='text-success'>Student settings have been updated successfully.</p>
						</blockquote>";
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