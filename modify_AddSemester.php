
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

	<title> Add Semester </title>
</head>

<!-- Page Body -->
<body class="metro">
	<div class="grid">
		<div class="row">
		<div class="span10 offset1">
			<form action="modify_AddSemester.php" method="post">
			<fieldset>
				<legend>Add Semester</legend>
				<table>

					<!-- Select Year -->
					<tr>
						<td class="span2"><label>Year:</label></td>
						<td class="span5">
							<div class="input-control select" data-role="input-control">
								<select name="year">
									<option><?php echo date("Y"); ?></option>
									<option><?php echo date("Y")+1; ?></option>
									<option><?php echo date("Y")+2; ?></option>
								</select>
							</div>
						</td>
					</tr>
					
					<!-- Select Term -->
					<tr>
						<td class="span2"><label>Term:</label></td>
						<td class="span5">
							<div class="input-control select" data-role="input-control">
								<select name="term">
									<option>Spring</option>
									<option>Summer</option>
									<option>Fall</option>
								</select>
							</div>
						</td>
					</tr>
					
					<!-- Select Start Date -->
					<tr><?php drawOther_Datepicker("Start Date", "start_date"); ?>
					
					<!-- Select End Date -->
					<tr><?php drawOther_Datepicker("End Date", "end_date"); ?>
					
					<!-- Force Gap Between Input and Buttons -->
					<tr><?php drawOther_Gap(); ?></tr>
					
					<!-- Submission Control Buttons -->
					<tr>
						<?php drawButton_Add(); ?> 
						<?php drawButton_Reset(); ?>
					</tr>

				</table>   
			</fieldset>
			</form>
			
			<!-- Add semester to database and then redirect to add course -->
			<?php
				if(isset($_POST['myFormSubmitted'])) {
					
                    // local variables
					$year           = $_POST['year'];
					$term           = $_POST['term'];
					$start_date     = $_POST['start_date'];
					$end_date       = $_POST['end_date'];
                    
                    // insert semester into database
                    Semester::insert($link, $student_id, $year, $term, $start_date, $end_date);

                    // go to the next page
                    Redirect('modify_AddCourse.php');
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