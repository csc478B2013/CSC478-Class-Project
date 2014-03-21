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
    
	<title>Test</title>
</head>

<!-- Page Body -->

<body class="metro">
<div class="container">
    <div class="grid">
        <div class="row">
        <?php

			Semester::insert($link, 1, 2014, 'Spring', '2014-01-01', '2014-05-25');
			Semester::insert($link, 1, 2015, 'Spring', '2014-01-01', '2014-05-25');
			Semester::insert($link, 1, 2016, 'Spring', '2014-01-01', '2014-05-25');
            Semester::insert($link, 1, 2014, 'Summer', '2014-01-01', '2014-05-25');
			Semester::insert($link, 1, 2015, 'Summer', '2014-01-01', '2014-05-25');
			Semester::insert($link, 1, 2016, 'Summer', '2014-01-01', '2014-05-25');
			Semester::insert($link, 1, 2014, 'Fall', '2014-01-01', '2014-05-25');
			Semester::insert($link, 1, 2015, 'Fall', '2014-01-01', '2014-05-25');
			Semester::insert($link, 1, 2016, 'Fall', '2014-01-01', '2014-05-25');
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