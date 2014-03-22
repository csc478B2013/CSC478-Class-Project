
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
    <script src="js/github.info.js"></script>

	<title> Remove Course </title>
	
	<!-- Remove semester from database and then reload current page-->
	<?php
		if(isset($_POST['myFormSubmitted'])) {
			
			// local variables
			$course_id      	= $_POST['course_id'];
			
			// get record information from database for output use
			$courseOutput 		= Course::select($link, $course_id);

			// delete record from database
			Course::delete($link, $course_id);			
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
			<form action="modify_RemoveCourse.php" method="post" name="form">
			<fieldset>
			<legend>Remove Course</legend>
				<table>
				
					<!-- Select Semester and Dynamic Course -->
					<tr><?php drawSelect_DynamicCourse($link, $student_id); ?></tr>
					
					<!-- Force Gap Between Input and Buttons -->
					<tr><?php drawOther_Gap(); ?></tr>
					
					<!-- Submission Control Buttons -->
					<tr><?php drawButton_Remove(); ?></tr>
					
				</table>   
			</fieldset>
			</form>
			
			<!-- This section is to notify the user on the status of the request -->
			<?php
				if(isset($_POST['myFormSubmitted'])) {
					
					// get information
					$designation	= $courseOutput->designation;
					$name			= $courseOutput->name;
					
					// alert the user 
					echo "	<blockquote>
								<p class='text-success'>$designation, $name has been deleted successfully.</p>
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