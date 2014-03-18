<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Page Header -->
	<header class="bg-dark" data-load='includes/header.html'></header>
    <header class="bg-white" data-load='includes/menu.html'></header>

	<!-- Connect to Database -->
    <?php require_once('includes/db_connect.php'); ?>   
    
    <!-- Include Resource Files -->
    <?php include 'includes/functions.php'; ?>
	
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

	<title> Optimal Plan </title>
</head>

<!-- Page Body -->
<body class="metro">
<div class="container">
    <div class="grid">
        <div class="row">
		
			<!-- Select Information-->
            <div class="span10 offset1">
                
				<form>
				<fieldset>
				<legend>Create Optimal Plan</legend>
				<table>
				
					<!-- Select Semester -->
					<tr>
						<td class="span2"><label>Semester:</label></td>
						<td class="span5">
							<div class="input-control select">
							<?php 
							
								// get student id from database
								$sql = "SELECT student_id 
										FROM Student 
										WHERE fname = 'Stephen'";
								$result = mysql_query($sql)or die(mysql_error());
								$row = mysql_fetch_array($result); 
								$student_id = $row['student_id']; 
								
								// get semester id from database
								$sql = "SELECT * 
										FROM Semester 
										WHERE (student_id = $student_id)
										ORDER BY isCurrent ASC, year, term";
								$result = mysql_query($sql)or die(mysql_error());
								
								// output selection row
								echo "<select>";
									while($row = mysql_fetch_array($result)){
										// get variables
										$semester_id    = $row['semester_id'];
										$year    		= $row['year'];
										$term           = $row['term'];
									
										echo "<option>".$term.', '.$year ."</option>";
									}
								echo "</select>";
								
							?>
							</div>
						</td>
					</tr>	
						
						
					<!-- Select Semester -->
					<tr>
						<td class="span2"><label>Class:</label></td>
						<td class="span5">
							<div class="input-control select">
							<?php 
							
								// get semester id from database
								$sql = "SELECT * 
										FROM Semester 
										WHERE (student_id = $student_id)
										ORDER BY isCurrent ASC, year, term";
								$result = mysql_query($sql)or die(mysql_error());
								
								// get course id from database
								$sql = "SELECT * 
										FROM Course 
										WHERE (semester_id = $semester_id)
										ORDER BY designation";
								$result = mysql_query($sql)or die(mysql_error());
								
								// output selection row
								echo "<select>";
									while($row = mysql_fetch_array($result)){
										// get variables
										$course_id    	= $row['course_id'];
										$designation 	= $row['designation'];
										$name           = $row['name'];
									
										echo "<option>".$designation.', '.$name ."</option>";
									}
								echo "</select>";
							
							?>
							</div>
						</td>
					</tr>
					
					
					
					<!-- Force Gap Between Input and Buttons -->
					<tr>
						<td class="span10"><div style="margin-top: 20px"></div></td>
					</tr>
					
					<!-- Submission Control Buttons -->
					<tr>
						<td class="span2"><input type="submit" class="span2" value="Optimize"></td>
						<td class="span2"><input type="reset" class="span2" value="Reset Form"></td>
					</tr>
					
				</table>   
				</fieldset>
				</form>
			
			</div>
		</div>
	</div>
</div>
                    
    
</body> 

<!-- Page Footer -->
<footer>

<!-- Close Database -->
<?php mysql_close($link); ?>

</footer> 
  
</html>