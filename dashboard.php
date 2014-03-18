<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Page Header -->
	<header class="bg-dark" data-load='includes/header.html'></header>
    <header class="bg-white" data-load='includes/menu.html'></header>
    
    <!-- Include Utility -->
    <?php require_once('includeUtil.php'); ?>   
    
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
    
	<title> Dashboard </title>
</head>

<!-- Page Body -->

<body class="metro">
<div class="container">
    <div class="grid">
        <div class="row">

            <!-- Upcoming Coursework Table -->
            <div class="span5 offset1">
                <p class="subheader" >Upcoming Course Work</p>
                            
                <?php
                    // get date and set date range
                    $date = "2013-08-01";                                               // test date (TEMP)
                    $range = 14;                                                        // set date range for assignments displayed
                    //$date = date('Y/m/d', time());                                    // current date
                    $date_temp = date('Y/m/d',strtotime($date . "+$range days"));       // current date + 7
                    $date_range = str_replace('/', '-', $date_temp);

                    
                    // get student id from database
                    $sql = "SELECT * FROM Student WHERE fname = 'Stephen'";
                    $result = mysql_query($sql)or die(mysql_error());
					$row = mysql_fetch_array($result);
					$student_id = $row['student_id'];  
                    //$student_id = mysql_fetch_array($result)['student_id'];  
                    
                    // get semester id from database
                    $sql = "SELECT * FROM Semester WHERE (student_id = $student_id AND isCurrent = '1')";
                    $result = mysql_query($sql)or die(mysql_error());
					$row = mysql_fetch_array($result);
					$semester_id = $row['semester_id']; 
                    //$semester_id = mysql_fetch_array($result)['semester_id'];  
                    
                    // get assignments from database
                    $sql = "SELECT * 
                            FROM Assignment 
                            WHERE (student_id = $student_id AND semester_id = $semester_id) 
                            ORDER BY due_date";
                    $result = mysql_query($sql)or die(mysql_error());
                    
                    // create table
                    echo "<div class='listview-outlook' data-role='listview'>";
                    echo "<div class='group-content'>";
                                 
                         
                    // fill table
                    while($row = mysql_fetch_array($result)){
                        
                        // set variables
                        $course_id  		= $row['course_id'];
                        $name       		= $row['name'];  
                        $due_date   		= $row['due_date']; 
						$points_recieved 	= $row['points_recieved'];
                        
                        // restrict the displayed results to only the next 7 days
                        if ($due_date >= $date AND $due_date < $date_range AND $points_recieved == NULL) {
                            // get course id from database
                            $sql = "SELECT designation, name
                                    FROM Course 
                                    WHERE (course_id = $course_id)";
                            $result_course = mysql_query($sql)or die(mysql_error());
                            $course_row = mysql_fetch_array($result_course);
                            $course_name = $course_row['name'];
                            $course_des = $course_row['designation'];
                            
                            // fill row
                            echo"    <a class='list'>";
                            echo"		<div class='list-content'>";
                            echo"			<span class='list-title'>$name</span>";
                            echo"			<span class='list-subtitle'>Due Date: $due_date</span>";
                            echo"			<span class='list-remark'>$course_des, $course_name</span>";
                            echo"		</div>";
                            echo"	</a>";   
                        }                        
                    } // end loop for table
                    
                    echo "</div>";       
                    echo "</div>";
                ?>
            </div>

            
            <!-- Current Grades Table -->
            <div class="span5 offset1">
                <p class="subheader">Current Grades</p>
                            
                <?php
 
                    // get student id from database
                    $sql = "SELECT * FROM Student WHERE fname = 'Stephen'";
                    $result = mysql_query($sql)or die(mysql_error());
					$row = mysql_fetch_array($result);
					$student_id = $row['student_id'];  
                    
                    // get semester id from database
                    $sql = "SELECT * FROM Semester WHERE (student_id = $student_id AND isCurrent = '1')";
                    $result = mysql_query($sql)or die(mysql_error());
					$row = mysql_fetch_array($result);
					$semester_id = $row['semester_id'];   
                    
                    // get course id from database
                    $sql = "SELECT * FROM Course WHERE (student_id = $student_id AND semester_id = $semester_id)";
                    $result = mysql_query($sql)or die(mysql_error());
                     
                    
                    // create table
                    echo "<table class='table'>";
                    echo "<thead><tr>
                            <th class='text-left'>Course</th>
                            <th class='text-left'>Name</th>
                            <th class='text-left'>Grade</th>
                        </tr></thead>";
                    
                    // fill table
                    while($row = mysql_fetch_array($result)){
                        
                        // set variables
						$course_id		= $row['course_id'];
                        $designation    = $row['designation'];
                        $name           = $row['name'];
                        $credits        = $row['credits'];
                        
						// calculate grade
						$grade = calculate_grade($course_id);
						
                        // fill row
                        echo "<tr>
                                <td>".$designation."</td>
                                <td>".$name."</td>
                                <td>".$grade."</td>
                            </tr>";
                        
                    } // end loop for table
                    
                    // calculate GPA
                    $semester_GPA = calculate_gpa($semester_id);
                    
                    // output gpa to footer of table
                    echo "<tfoot>";
                    echo "<tr><td>Semester GPA</td><td></td><td class='right'>$semester_GPA</td></tr>";
                    echo "</tfoot>";
                    echo "</table>" 
                ?>
            </div>
        </div>
    </div>
</div>

</body>

<!-- Page Footer -->
<footer>


</footer>        
        
</html>