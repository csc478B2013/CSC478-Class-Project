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
    <script src="js/github.info.js"></script>
	<script src="includes/code.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script>
	$(document).ready(function(){
	$("#updateAssignmentForm").validate({
	  	rules: 
		{	
		points_received: 
		{
			required: true,
			minlength: 1,
			digits: true
		}
	  	}
	});
	});
	</script>
	<title>Update Assignment Score</title>
	
	<!-- Remove assignment from database and then reload current page-->
	<?php
		if(isset($_POST['myFormSubmitted'])) {
			
			// local variables
			$semester_id        = $_POST['semester_id'];
			$course_id          = $_POST['course_id'];
			$assignment_id      = $_POST['assignment_id'];
			$points_received    = $_POST['points_received'];
			
			// update assignment score in database
			Assignment::updateScore($link, $assignment_id, $points_received);
			
			// get record information from database for output use
			$assignmentOutput 	= Assignment::select($link, $assignment_id);		
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
				
		// dynamic function that fills the assignments row based on the semester selection
		function showAssignments(str){			
			if (window.XMLHttpRequest)
				xmlhttp=new XMLHttpRequest();					// code for IE7+, Firefox, Chrome, Opera, Safari
			else
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); // code for IE6, IE5

			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("assignmentlist").innerHTML=xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET","includes/get/getAssignments.php?course_id="+str,true);
			xmlhttp.send();
		}
	</script>
</head>

<!-- Page Body -->
<body class="metro">
	<div class="grid">
		<div class="row">
		<div class="span10 offset1">
			<form action="modify_UpdateAssignment.php" method="post" name="form" id="updateAssignmentForm">
			<fieldset>
			<legend>Update Assignment Score</legend>
				<table>

					<!-- Select Semester and Dynamic Course -->
					<tr><?php drawSelect_DynamicAssignment($link, $student_id); ?></tr>

				<!-- Force Divider -->
				<tr><?php drawOther_Divider(); ?></tr>
				
					<!-- Select Semester and Dynamic Course -->
					<tr><?php drawText("Points Received", "points_received", " Input Score Received"); ?></tr>
					
					<!-- Force Gap Between Input and Buttons -->
					<tr><?php drawOther_Gap(); ?></tr>
					
					<!-- Submission Control Buttons -->
					<tr><?php drawButton_Submit("Update"); ?></tr>
				</table>   
			</fieldset>
			</form>
		
			<!-- This section is to notify the user on the status of the request -->
			<?php
				if(isset($_POST['myFormSubmitted'])) {
					
					// get information
					$assignment_type	= $assignmentOutput->assignment_type;
					$name				= $assignmentOutput->name;
					
					// alert the user 
					echo "	<blockquote>
								<p class='text-success'>$assignment_type, $name has been updated successfully.</p>
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