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
	<script src="includes/code.js"></script>
	
	<title>Add Assignment</title>
	
	<!-- Add Assignment to database -->
	<?php
		if(isset($_POST['myFormSubmitted'])) {
			
			// local variables
			$semester_id        = $_POST['semester_id'];
			$course_id          = $_POST['course_id'];
			$assignment_type    = $_POST['assignment_type'];
			$name               = $_POST['name'];
			$due_date           = $_POST['due_date'];
			$points_allowed     = $_POST['points_allowed'];
			
			// insert assignment into database
			Assignment::insert($link, $student_id, $semester_id, $course_id, $assignment_type, $name, $due_date, $points_allowed);
					
			// get course information from database
			$courseOutput 				= Course::select($link, $course_id);
			$assignmentOutput			= new Assignment();
			
			// pass information for output use
			$assignmentOutput->name 	= $name;
		}
	?>
		
	<!-- Javascript functions -->
	<script>
		// dynamic function that fills the course row based on the semester selection
		function showCourses(str){			
			if (window.XMLHttpRequest)
				xmlhttp=new XMLHttpRequest();					// code for IE7+, Firefox, Chrome, Opera, Safari
			else
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); // code for IE6, IE5

			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("courselist").innerHTML=xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET","includes/get/getCourses.php?semester_id="+str,true);
			xmlhttp.send();
		}
	</script>
</head>

<!-- Page Body -->
<body class="metro">
	<div class="grid">
		<div class="row">
		<div class="span10 offset1">
			<form action="modify_AddAssignment.php" method="post" name="form">
			<fieldset>
			<legend>Add Assignment</legend>
				<table>

					<!-- Select Semester and Dynamic Course -->
					<tr><?php drawSelect_DynamicCourse($link, $student_id); ?></tr>
					
					<!-- Select Assignment Type -->
					<tr><?php drawSelect_AssignmentType(); ?>					
						
					<!-- Select Assignment Name:-->
					<tr><?php drawText("Assignment Name", "name", "ex. Final Exam"); ?></tr>
						
					<!-- Select Due Date -->
					<tr><?php drawOther_Datepicker("Due Date", "due_date"); ?>
					
					<!-- Select Points Possible -->
					<tr><?php drawText("Points Possible", "points_allowed", "ex. 100"); ?></tr>
					
					<!-- Force Gap Between Input and Buttons -->
					<tr><?php drawOther_Gap(); ?></tr>
					
					<!-- Submission Control Buttons -->
					<tr> 
						<?php drawButton_Submit("Add"); ?>
						<?php drawButton_Reset(); ?>
						<?php drawButton_Link("modify_AddCourse.php", "Add Course"); ?>
					</tr>
				</table>   
			</fieldset>
			</form>
			
			<!-- This section is to notify the user on the status of the request -->
			<?php
			
				if(isset($_POST['myFormSubmitted'])) {
					
					// get course information
					$designation    	= $courseOutput->designation;
					$name           	= $courseOutput->name;
					
					// get assignment information
					$assignment_name 	= $assignmentOutput->name;

					// let the user know that the course has been added. prompt options
					echo "<p class='text-success'>$assignment_name has been added successfully to $designation, $name.</p>"; 
					echo "<blockquote>
							<p class='text-info'>
								<strong>Add</strong> another assignment, a
								<strong>New</strong> course, or 
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