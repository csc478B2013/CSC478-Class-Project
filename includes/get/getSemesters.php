<?php
	// GET php scripts
	$student_id = intval($_GET['student_id']);
	
	// include functions file
	include '../functions.php';
	
	// connect to database
	$link = db_connect();
	
	// create course selection table
	echo "<select name='semester_id'>";
    $semesterResults = selectSemester_Student($link, $student_id);
	
	while($row = mysql_fetch_array($courseResults)){
		// set variables
		$semester_id  		= $row['semester_id'];
		$year       		= $row['year'];  
		$term   			= $row['term']; 
		
		echo "<option value=$semester_id>$year, $term</option>";

	}
	echo "</select>";

	// close database
	mysql_close($link)
?>