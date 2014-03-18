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

                <!-- Check Student Table -->               
                <?php
                    					
                    // get student id from database
                    $sql = "SELECT student_id 
							FROM Student 
							WHERE fname = 'Stephen'";
                    $result = mysql_query($sql)or die(mysql_error());
					$row = mysql_fetch_array($result);
                    $student_id = $row['student_id'];  
                    
                    // get semester id from database
                    $sql = "SELECT semester_id 
							FROM Semester 
							WHERE (student_id = $student_id AND isCurrent = '1')";
                    $result = mysql_query($sql)or die(mysql_error());
					$row = mysql_fetch_array($result);
                    $semester_id = $row['semester_id'];  
                    
                    // get course id's from database
                    $sql = "SELECT * 
							FROM Course 
							WHERE (student_id = $student_id AND semester_id = $semester_id)";
                    $result = mysql_query($sql)or die(mysql_error());                    
                    
                    while($row = mysql_fetch_array($result)){
                        // set local variables
						$total_points_allowed = 0;
						$total_points_recieved = 0;
					
						// set variables
                        $course_id      = $row['course_id'];
                        $designation    = $row['designation'];
                        $name           = $row['name'];
						
                        // create course accordion table
                        echo "<div class='accordion with-marker' data-role='accordion'>";
                        echo "<div class='accordion-frame'>"; 
                        echo "<a class='heading bg-cobalt fg-white' href='#'>$designation, $name</a>";
                        echo "<div class='content'>";
                        
                            // get assignments for course from database
                            $sql = "SELECT * 
                                    FROM Assignment 
                                    WHERE (student_id = $student_id AND semester_id = $semester_id AND course_id = $course_id) 
                                    ORDER BY due_date DESC";
                            $assignments = mysql_query($sql)or die(mysql_error());
							
							// calculate and display course grade
							$grade			= calculate_grade($course_id);
							echo "<p class='subheader'> Grade: ".$grade."</p>";
							
                            // create assignment table
                            echo "<table class='table'>";
                            echo "<thead><tr>
                                    <th class='text-left'>Due Date</th>
                                    <th class='text-left'>Assignment Type</th>
                                    <th class='text-left'>Name</th>
                                    <th class='text-left'>Points</th>
                                    <th class='text-left'>Grade</th>
                                </tr></thead>";
                            
                            // fill table
                            while($row = mysql_fetch_array($assignments)){
                                
                                // set variables
                                $assignment_id      = $row['assignment_id'];
                                $assignment_type    = $row['assignment_type'];
                                $name               = $row['name'];
                                $due_date           = $row['due_date'];
                                $points_allowed     = $row['points_allowed'];
                                $points_recieved    = $row['points_recieved'];
                                
                                // compute assignment grade
                                if ($points_recieved == NULL) {
                                    $assignment_grade = "-";
                                    $points_recieved = "-";
                                } 
                                else {
                                    $assignment_grade = (($points_recieved / $points_allowed) * 100);
									$assignment_grade = number_format($assignment_grade, 2);	// format the number
									$total_points_allowed += $points_allowed;
									$total_points_recieved += $points_recieved;
								}
									
                                // fill row
                                echo "<tr>
										<td>".$due_date."</td>
                                        <td>".$assignment_type."</td>
                                        <td>".$name."</td>
                                        <td>".$points_recieved.' / '.$points_allowed."</td>";
										if ($assignment_grade <> '-') echo "<td>".(float)$assignment_grade.' %'."</td>";
										else echo "<td>".$assignment_grade."</td>
									</tr>";
                                 
                            }  // end loop for table
							
							// output totals to footer of table if there is a valid grade for the course
							if ($grade <> 'N/A') {
								// calculate courset grade ( % )
								$course_grade = $total_points_recieved / $total_points_allowed * 100;
								$course_grade = number_format($course_grade, 2);	// format the number
							
								echo "<tfoot>";
								echo "<tr>
										<td>Course Grade</td>
										<td></td>
										<td></td>
										<td>".$total_points_recieved.' / '.$total_points_allowed."</td>
										<td>".(float)$course_grade.' %'."</td>
									</tr>";
								echo "</tfoot>";
							}
							
							echo "</table>";	// end table
                        
                        echo "</div>";
                        echo "</div>";
                    
                    }// end loop for table
                    
                ?>         

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