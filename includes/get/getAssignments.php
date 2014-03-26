<?php
	// GET php scripts
	$course_id = intval($_GET['course_id']);
	
	// include functions file
	include '../functions.php';
	
	// connect to database
	$link = db_connect();
	
	// create course selection table
	echo "<select name='assignment_id'>";
    $assignmentResults = selectAssignment_Course($link, $course_id);
	
	// create empty row
	echo "<option value='$assignment_id'></option>";
	
	while($row = mysql_fetch_array($assignmentResults)){
		// set variables
		$assignment_id  	= $row['assignment_id'];
		$assignment_type  	= $row['assignment_type'];
		$name   			= $row['name']; 
		$points_allowed  	= $row['points_allowed'];
	
		echo "<option value='$assignment_id'>".$assignment_type.", ".$name." (".$points_allowed." points)</option>";
	}
	echo "</select>";

	// close database
	mysql_close($link)
?>