<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Page Header -->
	<header class="bg-dark" data-load='includes/header.html'></header>
    <header class="bg-white" data-load='includes/menu.html'></header>
    
    <!-- Connect to Database -->
    <?php require_once('includes/db_connect.php'); ?>          
   
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
    
	<title> DB Student </title>
</head>

<!-- Page Body -->
<body class="metro">
	<div class="grid">
    
        <!-- Check Student Table -->
		<div class="row">           
            <div class="span10 offset1">
                <p class="subheader">Database Table - Student</p>
                 
                <?php
					// local variables
					$count = 0;		// count entries in table
					
                    // get information from database
                    $sql = "SELECT * 
							FROM Student";
                    $result = mysql_query($sql)or die(mysql_error());
                     
                    // create table
                    echo "<table class='table'>";
                    echo "<thead><tr>
                            <th class='text-left'>Student ID</th>
                            <th class='text-left'>Name</th>
                            <th class='text-left'>Email</th>
                            <th class='text-left'>Phone</th>
                            <th class='text-left'>Date Created</th>
                        </tr></thead>";
                    
                    // fill table
                    while($row = mysql_fetch_array($result)){
                        
                        // set variables
                        $student_id     = $row['student_id'];
                        $fname          = $row['fname'];
                        $email          = $row['email'];
                        $phone          = $row['phone'];
                        $date_created   = $row['date_created'];
                        
                        // fill row
                        echo "<tr>
                                <td>".$student_id."</td>
                                <td>".$fname."</td>
                                <td>".$email."</td>
                                <td>".$phone."</td>
                                <td>".$date_created."</td>
                            </tr>";
							
						// increment result counter
                        $count += 1; 
                    } 
					echo "<tfoot>";
					echo "<tr>
							<td>Results:</td>
							<td>$count</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>";
					echo "</tfoot>";
					echo "</table>";	// end table
                ?>         
            </div>
		</div>
        
		
		<!-- Check Student Info Table -->
		<div class="row">           
            <div class="span10 offset1">
                <p class="subheader">Database Table - Student Settings</p>
                 
                <?php
					// local variables
					$count = 0;		// count entries in table
					
                    // get information from database
                    $sql = "SELECT * 
							FROM Student_Settings";
                    $result = mysql_query($sql)or die(mysql_error());
                     
                    // create table
                    echo "<table class='table'>";
                    echo "<thead><tr>
                            <th class='text-left'>Student ID</th>
                            <th class='text-left'>Study TOD</th>
                            <th class='text-left'>ST Exam</th>
                            <th class='text-left'>ST Quiz</th>
                            <th class='text-left'>ST Project</th>
                            <th class='text-left'>ST Homework</th>
                            <th class='text-left'>ST Discussion</th>
                            <th class='text-left'>ST Other</th>
                        </tr></thead>";
                    
                    // fill table
                    while($row = mysql_fetch_array($result)){
                        
                        // set variables
                        $student_id     = $row['student_id'];
                        $study_tod      = $row['study_tod'];
                        $st_exam        = $row['st_exam'];
                        $st_quiz        = $row['st_quiz'];
                        $st_project     = $row['st_project'];
                        $st_homework    = $row['st_homework'];
                        $st_discussion  = $row['st_discussion'];
                        $st_other       = $row['st_other'];
                        
                        // fill row
                        echo "<tr>
                                <td>".$student_id."</td>
                                <td>".$study_tod."</td>
                                <td>".$st_exam."</td>
                                <td>".$st_quiz."</td>
                                <td>".$st_project."</td>
                                <td>".$st_homework."</td>
                                <td>".$st_discussion."</td>
                                <td>".$st_other."</td>
                            </tr>";

						// increment result counter
                        $count += 1; 
						
                    } 
					echo "<tfoot>";
					echo "<tr>
							<td>Results:</td>
							<td>$count</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>";
					echo "</tfoot>";
					echo "</table>";	// end table
                ?>         
            </div>
		</div>
		
		
		<!-- Check Semester Table -->
		<div class="row">           
            <div class="span10 offset1">
                <p class="subheader">Database Table - Semester</p>
                 
                <?php
					// local variables
					$count = 0;		// count entries in table
					
                    // get information from database
                    $sql = "SELECT * 
							FROM Semester";
                    $result = mysql_query($sql)or die(mysql_error());
                     
                    // create table
                    echo "<table class='table'>";
                    echo "<thead><tr>
                            <th class='text-left'>Student ID</th>
                            <th class='text-left'>Semester ID</th>
                            <th class='text-left'>Year</th>
                            <th class='text-left'>Term</th>
                            <th class='text-left'>Start Date</th>
                            <th class='text-left'>End Date</th>
                            <th class='text-left'>Semeser GPA</th>
                            <th class='text-left'>Current?</th>
                        </tr></thead>";
                    
                    // fill table
                    while($row = mysql_fetch_array($result)){
                        
                        // set variables
                        $student_id     = $row['student_id'];
                        $semester_id    = $row['semester_id'];
                        $year           = $row['year'];
                        $term           = $row['term'];
                        $start_date     = $row['start_date'];
                        $end_date       = $row['end_date'];
                        $semester_GPA   = $row['semester_GPA'];
                        $isCurrent      = $row['isCurrent'];
                        
                        // fill row
                        echo "<tr>
                                <td>".$student_id."</td>
                                <td>".$semester_id."</td>
                                <td>".$year."</td>
                                <td>".$term."</td>
                                <td>".$start_date."</td>
                                <td>".$end_date."</td>
                                <td>".$semester_GPA."</td>
                                <td>".$isCurrent."</td>
                            </tr>";
                        
						// increment result counter
						$count += 1; 
						
                    } 
					echo "<tfoot>";
					echo "<tr>
							<td>Results:</td>
							<td>$count</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>";
					echo "</tfoot>";
					echo "</table>";	// end table
                ?>         
            </div>
		</div>
		
		
		<!-- Check Course Table -->
		<div class="row">           
            <div class="span10 offset1">
                <p class="subheader">Database Table - Course</p>
                 
                <?php
					// local variables
					$count = 0;		// count entries in table
					
                    // get information from database
                    $sql = "SELECT * 
							FROM Course";
                    $result = mysql_query($sql)or die(mysql_error());
                     
                    // create table
                    echo "<table class='table'>";
                    echo "<thead><tr>
                            <th class='text-left'>Student ID</th>
                            <th class='text-left'>Semester ID</th>
                            <th class='text-left'>Course ID</th>
                            <th class='text-left'>Designation</th>
                            <th class='text-left'>Name</th>
                            <th class='text-left'>Credits</th>
                            <th class='text-left'>Grade</th>
                        </tr></thead>";
                    
                    // fill table
                    while($row = mysql_fetch_array($result)){
                        
                        // set variables
                        $student_id     = $row['student_id'];
                        $semester_id    = $row['semester_id'];
                        $course_id      = $row['course_id'];
                        $designation    = $row['designation'];
                        $name           = $row['name'];
                        $credits        = $row['credits'];
                        $grade          = $row['grade'];
                        
                        // fill row
                        echo "<tr>
                                <td>".$student_id."</td>
                                <td>".$semester_id."</td>
                                <td>".$course_id."</td>
                                <td>".$designation."</td>
                                <td>".$name."</td>
                                <td>".$credits."</td>
                                <td>".$grade."</td>
                            </tr>";
                        
						// increment result counter
                        $count += 1; 
						
                    } 
					echo "<tfoot>";
					echo "<tr>
							<td>Results:</td>
							<td>$count</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>";
					echo "</tfoot>";
					echo "</table>";	// end table
                ?>         
            </div>
		</div>
		
		
		<!-- Check Assignment Table -->
		<div class="row">           
            <div class="span10 offset1">
                <p class="subheader">Database Table - Assignment</p>
                 
                <?php
					// local variables
					$count = 0;		// count entries in table
					
                    // get information from database
                    $sql = "SELECT * 
							FROM Assignment";
                    $result = mysql_query($sql)or die(mysql_error());
                     
                    // create table
                    echo "<table class='table'>";
                    echo "<thead><tr>
                            <th class='text-left'>Student ID</th>
                            <th class='text-left'>Semester ID</th>
                            <th class='text-left'>Course ID</th>
                            <th class='text-left'>Assignment ID</th>
                            <th class='text-left'>Assignment Type</th>
                            <th class='text-left'>Name</th>
                            <th class='text-left'>Due Date</th>
                            <th class='text-left'>Study Time</th>
                            <th class='text-left'>Points Allowed</th>
                            <th class='text-left'>Points Received</th>
                        </tr></thead>";
                    
                    // fill table
                    while($row = mysql_fetch_array($result)){
                        
                        // set variables
                        $student_id         = $row['student_id'];
                        $semester_id        = $row['semester_id'];
                        $course_id          = $row['course_id'];
                        $assignment_id      = $row['assignment_id'];
                        $assignment_type    = $row['assignment_type'];
                        $name               = $row['name'];
                        $due_date           = $row['due_date'];
                        $studytime          = $row['studytime'];
                        $points_allowed     = $row['points_allowed'];
                        $points_recieved    = $row['points_recieved'];
                        
                        // fill row
                        echo "<tr>
                                <td>".$student_id."</td>
                                <td>".$semester_id."</td>
                                <td>".$course_id."</td>
                                <td>".$assignment_id."</td>
                                <td>".$assignment_type."</td>
                                <td>".$name."</td>
                                <td>".$due_date."</td>
                                <td>".$studytime."</td>
                                <td>".$points_allowed."</td>
                                <td>".$points_recieved."</td>
                            </tr>";
                        
						// increment result counter
                        $count += 1;  
						
                    } 
					echo "<tfoot>";
					echo "<tr>
							<td>Results:</td>
							<td>$count</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>";
					echo "</tfoot>";
					echo "</table>";	// end table
                ?>         
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