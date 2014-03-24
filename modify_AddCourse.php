
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
		
		// set the student id
		$student_id = $_COOKIE["UserIdent"];
		
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
    <script src="js/github.info.js"></script>

	<title>Add Course</title>
	
	<!-- Add Course to database -->
	<?php
		if(isset($_POST['myFormSubmitted'])) {
			
			// local variables
			$semester_id    = $_POST['semester_id'];
			$designation    = $_POST['designation'];
			$name           = $_POST['name'];
			$credits        = $_POST['credits'];
			
			// insert into database
			Course::insert($link, $student_id, $semester_id, $designation, $name, $credits);

			// get record information from database for output use
			$semesterOutput = Semester::select($link, $semester_id);
			$courseOutput 	= new Course();
			
			// pass information for output use
			$courseOutput->designation 	= $designation;
			$courseOutput->name 		= $name;
		}
	?>
			
			
</head>

<!-- Page Body -->
<body class="metro">
	<div class="grid">
		<div class="row">
		<div class="span10 offset1">
			<form action="modify_AddCourse.php" method="post" name="form">
			<fieldset>
			<legend>Add Course</legend>
				<table>
				
					<!-- Select Semester -->
					<tr><?php drawSelect_Semester($link, $student_id); ?></tr>
					
					<!-- Select Course Designation -->
					<tr><?php drawText("Designation", "designation", "ex. CSC 478"); ?></tr>
					
					<!-- Select Course Name -->
					<tr><?php drawText("Name", "name", "ex. Software Engineering Capstone"); ?></tr>
					
					<!-- Select Course Credits -->
					<tr><?php drawText("Credits", "credits", "ex. 4"); ?></tr>					
					
					<!-- Force Gap Between Input and Buttons -->
					<tr><?php drawOther_Gap(); ?></tr>
					
					<!-- Submission Control Buttons -->
					<tr> 
						<?php drawButton_Submit("Add"); ?>
						<?php drawButton_Reset(); ?>
						<?php drawButton_Link("modify_AddAssignment.php", "Add Assignment"); ?>
					</tr>
					
				</table>   
			</fieldset>
			</form>
			
			<!-- This section is to notify the user on the status of the request -->
			<?php
				if(isset($_POST['myFormSubmitted'])) {

					// get semester information
					$year           = $semesterOutput->year;
					$term           = $semesterOutput->term;
					
					// get course information
					$designation    = $courseOutput->designation;
					$name           = $courseOutput->name;
					
					// let the user know that the course has been added. prompt options
					echo "<p class='text-success'>$designation, $name has been added to $term, $year. </p>"; 
					echo "<blockquote>
							<p class='text-info'>
								<strong>Add</strong> another course, 
								<strong>Add</strong> an assignment, or 
								<strong>Return</strong> to dashboard.
							</p>
						</blockquote>";
					exit;
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