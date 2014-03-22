
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
</head>

<!-- Page Body -->
<body class="metro">

	<div class="grid span10 offset1">
		<div class="row span8">
			<form>
			<fieldset>
			<legend>Select Course</legend>
				<table>
				
					<!-- Select Semester -->
					<tr>
						<td class="span2"><label>Semester:</label></td>
						<td class="span5">
							<div class="input-control select">
								<select>
									<option>Summer 2014</option>	<!-- select current semester by default -->
									<option>Spring 2014</option>
								</select>
							</div>
						</td>
					</tr>
					
					<!-- Select Course -->
					<tr>
						<td class="span2"><label>Course:</label></td>	<!-- load courses from semester -->
						<td class="span5">
							<div class="input-control select">
								<select>
									<option>CSC 470, Android App Development</option>
									<option>CSC 478, Software Engineering Capstone</option>
									<option>CSC 574, Advanced Database Concepts</option>
								</select>
							</div>
						</td>
					</tr>
					
				</table>   
			</fieldset>
			</form>
		</div>

		<div class="row span8">
			<form>
			<fieldset>
			<legend>Update Course</legend>
				<table>

					<!-- Select Course Designation -->
					<tr>
						<td class="span2"><label>Course Designation:</label></td>
						<td class="span5">
							<div class="input-control text" data-role="input-control">
								<input type="text" placeholder="ex. CSC 478">
								<button class="btn-clear" tabindex="-1" type="button"></button>
							</div>
						</td>
					</tr>
					
					<!-- Select Course Name -->
					<tr>
						<td class="span2"><label>Course Name:</label></td>
						<td class="span5">
							<div class="input-control text" data-role="input-control">
								<input type="text" placeholder="ex. Software Engineering Capstone">
								<button class="btn-clear" tabindex="-1" type="button"></button>
							</div>
						</td>
					</tr>
					
					<!-- Select Course Credits -->
					<tr>
						<td class="span2"><label>Credits:</label></td>
						<td class="span5">
							<div class="input-control text">
								<input type="text" value="" placeholder="ex. 4"/>
								<button class="btn-clear"></button>
							</div>
						</td>
					</tr>					
					
					<!-- Force Gap Between Input and Buttons -->
					<tr>
						<td class="span10"><div style="margin-top: 20px"></div></td>
					</tr>
					
					<!-- Submission Control Buttons -->
					<tr>
						<td class="span2"><input type="submit" class="span2" value="Update"></td>
						<td class="span2"><input type="reset" class="span2" value="Reset Form"></td>
					</tr>
					
				</table>   
			</fieldset>
			</form>
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