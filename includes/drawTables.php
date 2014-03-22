<?php


// Accordians
	function drawAccordian_Semesters($link, $student_id) {
		
		// get semester id from database
		$semesterResults = selectSemester_Student($link, $student_id); 
		
		// create semester drop down menus
		while($row = mysql_fetch_array($semesterResults)){
			// set variables
			$semester_id    = $row['semester_id'];
			$term           = $row['term'];
			$year           = $row['year'];
			$semester_GPA   = $row['semester_GPA'];
            
			// create semester accordion table
			echo "<div class='accordion with-marker' data-role='accordion'>";
			echo "<div class='accordion-frame'>"; 
			echo "<a class='heading bg-amber fg-white' href='#'>$term, $year</a>";
			echo "<div class='content clearfix'>"; 
            
            // display current semester gpa
            echo "<legend>GPA: $semester_GPA</legend>";
			
            // draw the accordian for all courses in the semester
            drawAccordian_Courses($link, $semester_id);
			
			echo "</div>";
			echo "</div>";
			echo "</div>";  
		}// end loop
	}

	function drawAccordian_Courses($link, $semester_id) {
		
		// get course id's from database
		$courseResults = selectCourse_Semester($link, $semester_id);                   

		// create course drop down menus
		while($row = mysql_fetch_array($courseResults)){

			// set variables
			$course_id      = $row['course_id'];
			$designation    = $row['designation'];
			$name           = $row['name'];
			$grade			= $row['grade'];
			
			// create course accordion table
			echo "<div class='accordion with-marker' data-role='accordion'>";
			echo "<div class='accordion-frame'>"; 
			echo "<a class='heading bg-cobalt fg-white' href='#'>$designation, $name</a>";
			echo "<div class='content'>";
			
            // draw the table for all assignments in the semester
			drawTable_Assignments($link, $course_id);
			
			echo "</div>";
			echo "</div>";
			echo "</div>";
		} // end loop for table
	}

	
	
// Tables
	function drawTable_Assignments($link, $course_id) {
		// set local variables
		$total_points_allowed = 0;
		$total_points_received = 0;
		
		// get course object and set variables				
		$courseObject = Course::select($link, $course_id);
		$grade = $courseObject->grade;
		
		// get assignments for course from database
		$assignmentResults = selectAssignment_Course($link, $course_id);
		
		// create assignment table
		echo "<table class='table'>";
		echo "<legend>Grade: $grade</legend>";
		echo "<thead><tr>
				<th class='text-left'>Due Date</th>
				<th class='text-left'>Assignment Type</th>
				<th class='text-left'>Name</th>
				<th class='text-left'>Points</th>
				<th class='text-left'>Grade</th>
			</tr></thead>";
		
		// fill table
		while($row = mysql_fetch_array($assignmentResults)){
			
			// set variables
			$assignment_id      = $row['assignment_id'];
			$assignment_type    = $row['assignment_type'];
			$name               = $row['name'];
			$due_date           = $row['due_date'];
			$points_allowed     = $row['points_allowed'];
			$points_received    = $row['points_received'];
			
			// compute assignment grade
			if ($points_received == NULL) {		// if assignment hasn't been graded, ignore it
				$assignment_grade = "-";
				$points_received = "-";
			} 
			else {								// else compute it
				$assignment_grade = (($points_received / $points_allowed) * 100);
				$assignment_grade = number_format($assignment_grade, 2);		// format the number
				$total_points_allowed += $points_allowed;						// increment the total counters
				$total_points_received += $points_received;
			}
				
			// fill row
			echo "<tr>
					<td>".$due_date."</td>
					<td>".$assignment_type."</td>
					<td>".$name."</td>
					<td>".$points_received.' / '.$points_allowed."</td>";
					if ($assignment_grade <> '-') 
                        echo "<td>".(float)$assignment_grade.' %'."</td>";
					else 
                        echo "<td>".$assignment_grade."</td>
				</tr>";
			 
		}  // end loop for table
		
		// output totals to footer of table if there is a valid grade for the course
		if ($grade <> 'N/A' AND $grade <> 0) {
			// calculate course grade ( % )
			$course_grade = $total_points_received / $total_points_allowed * 100;
			$course_grade = number_format($course_grade, 2);	// format the number
		
			echo "<tfoot>";
			echo "<tr>
					<td>Course Grade</td>
					<td></td>
					<td></td>
					<td>".$total_points_received.' / '.$total_points_allowed."</td>
					<td>".(float)$course_grade.' %'."</td>
				</tr>";
			echo "</tfoot>";
		}
		
		echo "</table>";	// end table	
	}
	
	function drawTable_Grades($link, $semester_id) {
		
		// draw table
		echo" <div class='span5 offset1'>";
        echo" <p class='subheader' style='margin-top: 10px'>Current Grades</p>";
		
		// get course id from database\		
		$coursesResult = selectCourse_Semester($link, $semester_id);

		// create table
		echo "<table class='table'>";
		echo "<thead><tr>
				<th class='text-left'>Course</th>
				<th class='text-left'>Name</th>
				<th class='text-left'>Grade</th>
			</tr></thead>";
		
		// fill table
		while($row = mysql_fetch_array($coursesResult)){
			
			// set variables
			$course_id		= $row['course_id'];
			$designation    = $row['designation'];
			$name           = $row['name'];
			$credits        = $row['credits'];
			$grade          = $row['grade'];
            		
			// fill row
			echo "<tr>
					<td>".$designation."</td>
					<td>".$name."</td>
					<td>".$grade."</td>
				</tr>";
			
		} // end loop for table
		
		// calculate GPA
        $semesterObject = Semester::select($link, $semester_id);
		$semester_GPA = $semesterObject->semester_GPA;
		
		// output gpa to footer of table
		echo "<tfoot>";
		echo "<tr><td>Semester GPA</td><td></td><td class='right'>$semester_GPA</td></tr>";
		echo "</tfoot>";
		echo "</table>";
		
		echo "</div>";
	
	}

	function drawTable_UpcomingCourseWork($link, $student_id, $date, $offset) {
		
		// draw section
		echo" <div class='span4 offset1'>";
        echo" <p class='subheader' style='margin-top: 10px'>Tasks</p>";
		
		// calculate date range
		$date_range = get_dateRange($date, $offset);
		
		// get current semester id from database
		$semesterObject = Semester::select_current($link, $student_id);
		$semester_id = $semesterObject->semester_id;
					
		// get assignments from database
		$result = selectAssignment_Semester($link, $semester_id);
		
		// create table
		echo "<div class='listview-outlook' data-role='listview'>";
		echo "<div class='group-content'>";
					  
		// fill table
		while($row = mysql_fetch_array($result)){
			
			// set variables
			$course_id  		= $row['course_id'];
			$name       		= $row['name'];  
			$due_date   		= $row['due_date']; 
			$points_allowed 	= $row['points_allowed'];
			$points_received 	= $row['points_received'];
			
			// restrict the displayed results to only the next 7 days
			if ($due_date >= $date AND $due_date < $date_range AND $points_received == NULL) {
			
				// get course info from database
				$courseObject 			= Course::select($link, $course_id);
				$course_name 			= $courseObject->name;
				$course_designation 	= $courseObject->designation;

				// fill row
				echo"    <a class='list'>";
				echo"		<div class='list-content'>";
				echo"			<span class='list-title'>$name 
									<span class='place-right'>$points_allowed pts</span>
								</span>";
				echo"			<span class='list-subtitle'>Due Date: $due_date</span>";
				echo"			<span class='list-remark'>$course_designation, $course_name</span>";
				echo"		</div>";
				echo"	</a>";   
			}                        
		} // end loop for table
		
		echo "</div>";       
		echo "</div>";
		echo "</div>";
	}

	
?>
