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
    
	<title> Current Semester </title>
</head>

<!-- Page Body -->
<body class="metro">
<div class="container">
<div class="grid">
   
    <!-- Test Row -->
    <div class="row">
        <div class="span10 offset1">
      
            <!-- Page Title -->
			<?php drawLabel_Title("Current Semester"); ?>
       
			<?php
				
				// if no current semester exists...
				if (Semester::existsCurrent($link, $student_id)) {
				
					// get current semester from database
					$semesterObject = Semester::select_current($link, $student_id);
					$semester_id 	= $semesterObject->semester_id;
					$semester_GPA 	= $semesterObject->semester_GPA;
					
					// display current semester gpa
					echo "<p class='subheader'>GPA: $semester_GPA</p>";

					// draw current semester
					drawAccordian_Courses($link, $semester_id);
				}

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