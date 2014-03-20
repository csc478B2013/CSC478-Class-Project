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
    
	<title> New User </title>
</head>

<!-- Page Body -->
<body class="metro">
	<div class="grid span10 offset1">
		<div class="row span8">
			<form>
			<fieldset>
				<legend>New User Questionaire</legend>
				<table>

					<!-- Get Study Time of Day -->
					<tr>
						<td class="span7">
							<label>What time during the day do you prefer to study?</label>
							<div class="input-control select">
								<select>
									<option>Morning</option> 
									<option>Afternoon</option>
									<option>Evening</option>
									<option>Insomniac!</option>
								</select>
							</div>
						</td>
					</tr>
					
					<!-- Force Gap Between Input and Buttons -->
					<tr>
						<td class="span10"><div style="margin-top: 20px"></div></td>
					</tr>
					
					<!-- Get Study Times -->
					<tr>
						<td class="span7">
						<label>How much time do you typically need to study for each type of assignment?</label>
						<table>
							<tr>
								<td class="span2"><label>Exam:</label></td>
								<td class="span2">
									<div class="input-control text" data-role="input-control">
										<input type="tel" placeholder="ex. 3.0">
										<button class="btn-clear" tabindex="-1" type="button"></button>
									</div>
								</td>
							</tr>
							<tr>
								<td class="span2"><label>Quiz:</label></td>
								<td class="span2">
									<div class="input-control text" data-role="input-control">
										<input type="tel" placeholder="ex. 2.0">
										<button class="btn-clear" tabindex="-1" type="button"></button>
									</div>
								</td>
							</tr>
							<tr>
								<td class="span2"><label>Project:</label></td>
								<td class="span2">
									<div class="input-control text" data-role="input-control">
										<input type="tel" placeholder="ex. 10.0">
										<button class="btn-clear" tabindex="-1" type="button"></button>
									</div>
								</td>
							</tr>
							<tr>
								<td class="span2"><label>Homework:</label></td>
								<td class="span2">
									<div class="input-control text" data-role="input-control">
										<input type="tel" placeholder="ex. 1.5">
										<button class="btn-clear" tabindex="-1" type="button"></button>
									</div>
								</td>
							</tr>
							<tr>
								<td class="span2"><label>Discussion:</label></td>
								<td class="span2">
									<div class="input-control text" data-role="input-control">
										<input type="tel" placeholder="ex. 1.0">
										<button class="btn-clear" tabindex="-1" type="button"></button>
									</div>
								</td>
							</tr>
							<tr>
								<td class="span2"><label>Other:</label></td>
								<td class="span2">
									<div class="input-control text" data-role="input-control">
										<input type="tel" placeholder="ex. 3.0">
										<button class="btn-clear" tabindex="-1" type="button"></button>
									</div>
								</td>
							</tr>
						</table>
					</tr>
					
					<!-- Force Gap Between Input and Buttons -->
					<tr>
						<td class="span10"><div style="margin-top: 20px"></div></td>
					</tr>
					
					<!-- Submission Control Buttons -->
					<tr>
						<td class="span2"><input type="submit" class="span2" value="Create!"></td>
						<td class="span2"><input type="reset" class="span2" value="Reset Form"></td>
					</tr>
				</table>
			</fieldset>
			</form>
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