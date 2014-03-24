
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

	<title>Update Semester</title>
		
		
	<!-- Update semester in database -->
	<?php
		if(isset($_POST['myFormSubmitted'])) {
			
			// local variables
			$semester_id        = $_POST['semester_id'];
			$year        		= $_POST['year'];
			$term        		= $_POST['term'];
			$start_date        	= $_POST['start_date'];
			$end_date        	= $_POST['end_date'];

			// delete record from database
			Semester::update($link, $semester_id, $year, $term, $start_date, $end_date);			
		}
	?>	
		
</head>

<!-- Page Body -->
<body class="metro">
	<div class="grid">
		<div class="row">
		<div class="span10 offset1">
			<form action="modify_UpdateSemester.php" method="post" name="form">
			<fieldset>
			
			<!-- Select Data to be Updated -->
			<legend>Select Semester</legend>
				<table>
					<!-- Select Semester -->
					<tr><?php drawSelect_Semester($link, $student_id); ?></tr>
					
					<!-- Force Gap -->
					<tr><?php drawOther_Divider(); ?></tr>
					<tr><?php drawOther_Gap(); ?></tr>
				</table	>
					
			<!-- Fill in Updated Data -->
			<legend>Update Semester</legend>
				<table>	
					<!-- Select Year -->
					<tr><?php drawSelect_Year(); ?></tr>
					
					<!-- Select Term -->
					<tr><?php drawSelect_Term(); ?></tr>
					
					<!-- Select Start Date -->
					<tr><?php drawOther_Datepicker("Start Date", "start_date"); ?>
					
					<!-- Select End Date -->
					<tr><?php drawOther_Datepicker("End Date", "end_date"); ?>

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
								<p class='text-success'>$term, $year has been updated successfully.</p>
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