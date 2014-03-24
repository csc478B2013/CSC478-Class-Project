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
    
	<title> Dashboard </title>
</head>

<!-- Page Body -->

<body class="metro">

    <div class="grid">
        <div class="row">
			<div class="span10 offset1">
      
            <!-- Page Title -->
			<?php drawLabel_Title("Student Dashboard"); ?>
                        
			<?php			
				
				// if no current semester exists...
				if (Semester::existsCurrent($link, $student_id)) {
				
				echo "<table><tr><td style='vertical-align:top'>";
				
					// Current Tasks Table ///////////////////////////////////////////
					// get date and set date range
					//$date = get_date();		// get current date
					$offset = 7;				// set date offset to show assignments
					$date = "2014-01-01";  		// get current date (temp)
					
					// create upcoming course work table
					drawTable_UpcomingCourseWork($link, $student_id, $date, $offset);
					
				echo "</td>";
				echo "<td style='vertical-align:top'>";
					
					// Current Grades Table /////////////////////////////////////////
					// get current semester id from database
					$semesterObject = Semester::select_current($link, $student_id);
					$semester_id = $semesterObject->semester_id;
				
					// draw grades table
					drawTable_Grades($link, $semester_id);
					
				echo "</td></tr></table>";
				}

			?>

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