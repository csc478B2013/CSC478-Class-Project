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

	<title>Update Course</title>
		
		
	<!-- Remove semester from database and then reload current page-->
	<?php
		if(isset($_POST['myFormSubmitted'])) {
			
			// local variables
			$course_id    	= $_POST['course_id'];
			$designation    = $_POST['designation'];
			$name           = $_POST['name'];
			$credits        = $_POST['credits'];

			// delete record from database
			Course::update($link, $course_id, $designation, $name, $credits);			
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
			<form action="modify_UpdateCourse.php" method="post" name="form">
			<fieldset>
			
			<!-- Select Data to be Updated -->
			<legend>Select Course</legend>
				<table>
					<!-- Select Semester -->
					<tr><?php drawSelect_DynamicCourse($link, $student_id); ?></tr>
					
					<!-- Force Gap -->
					<tr><?php drawOther_Divider(); ?></tr>
					<tr><?php drawOther_Gap(); ?></tr>
				</table	>
			
			
			<!-- Fill in Updated Data -->
			<legend>Update Course</legend>
				<table>	
					<!-- Select Course Designation -->
					<tr><?php drawText("Designation", "designation", "ex. CSC 478"); ?></tr>
					
					<!-- Select Course Name -->
					<tr><?php drawText("Name", "name", "ex. Software Engineering Capstone"); ?></tr>
					
					<!-- Select Course Credits -->
					<tr><?php drawText("Credits", "credits", "ex. 4"); ?></tr>	

			<!-- Submit Data -->
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
				
					// alert the user 
					echo "	<blockquote>
								<p class='text-success'>$designation, $name has been updated successfully.</p>
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