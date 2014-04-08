<?php
	// include files
	include 'includes/functions.php';
	include 'includes/drawTables.php';
	include 'includes/drawForms.php';
	
	// set the student id
	$student_id = $_COOKIE["UserIdent"];
		
	// connect to database
	$link = db_connect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Page Header -->
	<?php
		if ($userLogged) {
			echo "<header class='bg-dark' data-load='includes/header.php'></header>";
			echo "<header class='bg-white' data-load='includes/menu.html'></header>";
		} 
		else {
			echo "<header class='bg-dark' data-load='includes/public_header.php'></header>";
		}
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
    
	<title> Account </title>
</head>

<!-- Page Body -->
<body class="metro">
<div class="container">
    <div class="grid">
        <div class="row">
		
			Not Started
			
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