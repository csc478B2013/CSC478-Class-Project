
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
    
	<title> Current Semester </title>
</head>

<!-- Page Body -->
<body class="metro">
<div class="grid">
   
    <!-- Test Row -->
    <div class="row">
        <div class="span10 offset1">
      
            <p class="subheader">Current Semester</p>
            <div style="margin-top: 10px"></div>
       
			<?php
				
				// get current semester from database
				$semesterObject = Semester::select_current($link, $student_id);
				$semester_id 	= $semesterObject->semester_id;
				$semester_GPA 	= $semesterObject->semester_GPA;
				
				// display current semester gpa
				echo "<legend>GPA: $semester_GPA</legend>";

				// draw current semester
				drawAccordian_Courses($link, $semester_id);

			?>         

            </div>
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