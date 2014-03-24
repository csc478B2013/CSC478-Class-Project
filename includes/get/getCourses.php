<?php
	// GET php scripts
	$semester_id = intval($_GET['semester_id']);
	
	// include functions file
	include '../functions.php';
	
	// connect to database
	$link = db_connect();
	
	// create course selection table
	echo "<select name='course_id' onchange='showAssignments(this.value)'>";
    $courseResults = selectCourse_Semester($link, $semester_id);
	
	// create empty row
	echo "<option value='$course_id' onselect=getOption_Course()></option>";
	
	while($row = mysql_fetch_array($courseResults)) {
		// set variables
		$course_id  		= $row['course_id'];
		$designation       	= $row['designation'];  
		$name   			= $row['name']; 
	
		echo "<option value='$course_id' onselect=getOption_Course()>".$designation.", ".$name."</option>";
	}
	echo "</select>";

	// close database
	mysql_close($link)
?>