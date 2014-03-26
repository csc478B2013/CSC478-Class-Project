<?php

// Input
	function drawSelect_Test() {
		echo "	<td class='span2'>";
		echo "		<label>Select Test:</label>";
		echo "	</td>";
		echo "	<td class='span5'>";
		echo "		<div class='input-control select'>";
		echo "			<select name='test'>";
        echo "				<option value=0></option>";
		echo "				<option value=1>Insert</option>";
		echo "				<option value=2>Select</option>";
		echo "				<option value=3>Fill Scores</option>";
		echo "				<option value=11>Delete</option>";
		echo "				<option value=100>All</option>";
		echo "			</select>";
		echo "		</div>";
		echo "	</td>";
	}
	
	function drawButton_SelectTest() {
		echo "<td class='span2'><input type='submit' class='primary span2' value='Select' name='myFormSubmitted'></td>";
	}


	
// Insert Test
	function testInsert($link) {
	
		testInsert_Students($link);										// INSERT a set of students

		// Get all of the students from the database
		// For each student, insert a set of semesters
		$students = selectStudent_All($link);
		while($row = mysql_fetch_array($students)){
			$student_id			= $row['student_id'];					// SELECT student id
			testInsert_StudentSettings($link, $student_id);				// INSERT student settings
			testInsert_Semesters($link, $student_id);					// INSERT a set of semesters
			
			// Get all of the semesters for the student
			// For each semester, insert a set of courses
			$semesters = selectSemester_Student($link, $student_id);					
			while($row = mysql_fetch_array($semesters)){
				$semester_id	= $row['semester_id'];					// SELECT semester id
				$term			= $row['term'];							// SELECT term for use in assignment additions
				testInsert_Courses($link, $student_id, $semester_id);	// INSERT a set of courses
			
				// Get all of the courses for the semester
				// For each course, insert a set of assignments
				$courses = selectCourse_Semester($link, $semester_id);						
				while($row = mysql_fetch_array($courses)){
					$course_id = $row['course_id'];													// SELECT course id
					testInsert_Assignments($link, $student_id, $semester_id, $course_id, $term); 	// INSERT a set of assignments
				}
			}
		}
		
		echo "	<div class='row'>
					<div class='span10 offset1'>
						Insert Test Complete
					</div>
				</div>";
	}

	function testInsert_Students($link) {
		Student::insert($link, 'Stephen', 'stephen@gmail.com', '999-888-7777', '123');
		Student::insert($link, 'Joe', 'joe@gmail.com', '111-222-3333', '123');
		Student::insert($link, 'Mike', 'mike@gmail.com', '444-555-6666', '123');
		Student::insert($link, 'Christy', 'christy@gmail.com', '777-888-9999', '123');
		Student::insert($link, 'Luis', 'luis@gmail.com', '123-456-7890', '123');
	}

	function testInsert_StudentSettings($link, $student_id) {
	
		switch($student_id % 3) {
		
			case(0):
				Settings::insert($link, $student_id, 'Morning', 1, 2, 3, 4, 5, 6);
				break;
			
			case(1):
				Settings::insert($link, $student_id, 'Afternoon', 11, 12, 13, 14, 15, 16);
				break;
				
			case(2):
				Settings::insert($link, $student_id, 'Evening', 21, 22, 23, 24, 25, 26);
				break;
				
			default:
				echo "student id does not exist.";
				break;
		}
	}
	
	function testInsert_Semesters($link, $student_id) {
		Semester::insert($link, $student_id, 2014, 'Spring');
		Semester::insert($link, $student_id, 2014, 'Summer');
		Semester::insert($link, $student_id, 2014, 'Fall');
	}

	function testInsert_Courses($link, $student_id, $semester_id) {
		Course::insert($link, $student_id, $semester_id, 'CSC '.($semester_id*10+1), 'Class '.($semester_id*10+1), 1);
		Course::insert($link, $student_id, $semester_id, 'CSC '.($semester_id*10+2), 'Class '.($semester_id*10+2), 1);
		Course::insert($link, $student_id, $semester_id, 'CSC '.($semester_id*10+3), 'Class '.($semester_id*10+3), 1);
		Course::insert($link, $student_id, $semester_id, 'CSC '.($semester_id*10+4), 'Class '.($semester_id*10+4), 1);
		Course::insert($link, $student_id, $semester_id, 'CSC '.($semester_id*10+5), 'Class '.($semester_id*10+5), 1);
	}
	
	function testInsert_Assignments($link, $student_id, $semester_id, $course_id, $term) {
	
		switch($term) {
			case('Spring'):
				Assignment::insert($link, $student_id, $semester_id, $course_id, 'Exam', 'Exam '.($course_id*10+1), '2014-01-02', 100);
				Assignment::insert($link, $student_id, $semester_id, $course_id, 'Quiz', 'Quiz '.($course_id*10+2), '2014-01-04', 90);
				Assignment::insert($link, $student_id, $semester_id, $course_id, 'Project', 'Project '.($course_id*10+3), '2014-01-06', 80);
				Assignment::insert($link, $student_id, $semester_id, $course_id, 'Homework', 'Homework '.($course_id*10+4), '2014-01-08', 70);
				Assignment::insert($link, $student_id, $semester_id, $course_id, 'Discussion', 'Discussion '.($course_id*10+5), '2014-01-10', 60);
				Assignment::insert($link, $student_id, $semester_id, $course_id, 'Other', 'Other '.($course_id*10+6), '2014-01-12', 50);
				break;
				
			case('Summer'):
				Assignment::insert($link, $student_id, $semester_id, $course_id, 'Exam', 'Exam '.($course_id*10+1), '2014-06-02', 100);
				Assignment::insert($link, $student_id, $semester_id, $course_id, 'Quiz', 'Quiz '.($course_id*10+2), '2014-06-04', 90);
				Assignment::insert($link, $student_id, $semester_id, $course_id, 'Project', 'Project '.($course_id*10+3), '2014-06-06', 80);
				Assignment::insert($link, $student_id, $semester_id, $course_id, 'Homework', 'Homework '.($course_id*10+4), '2014-06-08', 70);
				Assignment::insert($link, $student_id, $semester_id, $course_id, 'Discussion', 'Discussion '.($course_id*10+5), '2014-06-10', 60);
				Assignment::insert($link, $student_id, $semester_id, $course_id, 'Other', 'Other '.($course_id*10+6), '2014-06-12', 50);
				break;
			
			case('Fall'):
				Assignment::insert($link, $student_id, $semester_id, $course_id, 'Exam', 'Exam '.($course_id*10+1), '2014-08-02', 100);
				Assignment::insert($link, $student_id, $semester_id, $course_id, 'Quiz', 'Quiz '.($course_id*10+2), '2014-08-04', 90);
				Assignment::insert($link, $student_id, $semester_id, $course_id, 'Project', 'Project '.($course_id*10+3), '2014-08-06', 80);
				Assignment::insert($link, $student_id, $semester_id, $course_id, 'Homework', 'Homework '.($course_id*10+4), '2014-08-08', 70);
				Assignment::insert($link, $student_id, $semester_id, $course_id, 'Discussion', 'Discussion '.($course_id*10+5), '2014-08-10', 60);
				Assignment::insert($link, $student_id, $semester_id, $course_id, 'Other', 'Other '.($course_id*10+6), '2014-08-12', 50);
				break;
			
			default:
				echo "term does not exist.";
				break;
		}
	}

	
	
// Select Test	
	function testSelect($link) {
		
		// create row
		echo "	<div class='row'><div class='span10 offset1'>";
		echo "	<legend>Results</legend>";
		
			// draw all tables
			testSelect_Students($link);
			testSelect_Settings($link);
			testSelect_Semesters($link);
			testSelect_Courses($link);
			testSelect_Assignments($link);
		
		// end row
		echo "</div></div>";
	}
	
	function testSelect_Students($link) {
		
		// local variables
		$count = 0;		// count entries in table
					
		// get information from database
		$studentResults = selectStudent_All($link);	
		
		// create accordion table
		echo "<div class='accordion with-marker' data-role='accordion'>";
		echo "<div class='accordion-frame'>"; 
		echo "<a class='heading bg-cobalt fg-white' href='#'>Students</a>";
		echo "<div class='content'>";
			
		// create table
		echo "<table class='table'>";
		echo "<thead><tr>
				<th class='text-left'>Student ID</th>
				<th class='text-left'>Name</th>
				<th class='text-left'>Email</th>
				<th class='text-left'>Phone</th>
				<th class='text-left'>Date Created</th>
				<th class='text-left'>Password</th>
			</tr></thead>";
		
		// fill table
		while($row = mysql_fetch_array($studentResults)){
			
			// set variables
			$student_id     = $row['student_id'];
			$fname          = $row['fname'];
			$email          = $row['email'];
			$phone          = $row['phone'];
			$date_created   = $row['date_created'];
			$password   	= $row['password'];
			
			// fill row
			echo "<tr>
					<td>".$student_id."</td>
					<td>".$fname."</td>
					<td>".$email."</td>
					<td>".$phone."</td>
					<td>".$date_created."</td>
					<td>".$password."</td>
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
			</tr>";
		echo "</tfoot>";
		echo "</table>";	// end table
		
		echo "</div></div></div>";
	}
	
	function testSelect_Settings($link) {
		
		// local variables
		$count = 0;		// count entries in table
					
		// get information from database
		$settingsResults = selectSettings_All($link);
		
		// create accordion table
		echo "<div class='accordion with-marker' data-role='accordion'>";
		echo "<div class='accordion-frame'>"; 
		echo "<a class='heading bg-green fg-white' href='#'>Settings</a>";
		echo "<div class='content'>";
		
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
		while($row = mysql_fetch_array($settingsResults)){
			
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
		
		echo "</div></div></div>";
	}
	
	function testSelect_Semesters($link) {
		
		// local variables
		$count = 0;		// count entries in table
					
		// get information from database
		$semesterResults = selectSemester_All($link);
		
		// create accordion table
		echo "<div class='accordion with-marker' data-role='accordion'>";
		echo "<div class='accordion-frame'>"; 
		echo "<a class='heading bg-indigo fg-white' href='#'>Semesters</a>";
		echo "<div class='content'>";
		
		// create table
		echo "<table class='table'>";
		echo "<legend>Semesters</legend>";
		echo "<thead><tr>
				<th class='text-left'>Student ID</th>
				<th class='text-left'>Semester ID</th>
				<th class='text-left'>Year</th>
				<th class='text-left'>Term</th>
				<th class='text-left'>Semeser GPA</th>
				<th class='text-left'>Current?</th>
			</tr></thead>";
		
		// fill table
		while($row = mysql_fetch_array($semesterResults)){
                        
			// set variables
			$student_id     = $row['student_id'];
			$semester_id    = $row['semester_id'];
			$year           = $row['year'];
			$term           = $row['term'];
			$semester_GPA   = $row['semester_GPA'];
			$isCurrent      = $row['isCurrent'];
			
			// fill row
			echo "<tr>
					<td>".$student_id."</td>
					<td>".$semester_id."</td>
					<td>".$year."</td>
					<td>".$term."</td>
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
			</tr>";
		echo "</tfoot>";
		echo "</table>";	// end table
		
		echo "</div></div></div>";
	}
	
	function testSelect_Courses($link) {
		
		// local variables
		$count = 0;		// count entries in table
					
		// get information from database
		$courseResults = selectCourse_All($link);	
		
		// create accordion table
		echo "<div class='accordion with-marker' data-role='accordion'>";
		echo "<div class='accordion-frame'>"; 
		echo "<a class='heading bg-steel fg-white' href='#'>Courses</a>";
		echo "<div class='content'>";
		
		// create table
		echo "<table class='table'>";
		echo "<legend>Courses</legend>";
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
		while($row = mysql_fetch_array($courseResults)){
			
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
		
		echo "</div></div></div>";
	}
	
	function testSelect_Assignments($link) {
		
		// local variables
		$count = 0;		// count entries in table
					
		// get information from database
		$assignmentResults = selectAssignment_All($link);	
		
		// create accordion table
		echo "<div class='accordion with-marker' data-role='accordion'>";
		echo "<div class='accordion-frame'>"; 
		echo "<a class='heading bg-crimson fg-white' href='#'>Assignments</a>";
		echo "<div class='content'>";
		
		// create table
		echo "<table class='table'>";
		echo "<legend>Assignments</legend>";
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
		while($row = mysql_fetch_array($assignmentResults)){
			
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
			$points_received    = $row['points_received'];
			
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
					<td>".$points_received."</td>
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
		
		echo "</div></div></div>";
	}
	
	
	
// Update Test
	function testUpdate($link) {
		
		// Get all of the students from the database
		// For each student and settings, update an attribute
		$students = selectStudent_All($link);
		while($row = mysql_fetch_array($students)){
			$student_id			= $row['student_id'];					// SELECT student id
			testUpdate_Students($link, $student_id);					// UPDATE student
			testUpdate_Settings($link, $student_id);					// UPDATE student settings
			
			// Get all of the semesters for the student
			// For each semester, update an attribute
			$semesters = selectSemester_Student($link, $student_id);					
			while($row = mysql_fetch_array($semesters)){
				$semester_id	= $row['semester_id'];					// SELECT semester id
				testUpdate_Semesters($link, $semester_id);	// UPDATE semester
				
				// Get all of the courses for the semester
				// For each course, update an attribute
				$courses = selectCourse_Semester($link, $semester_id);						
				while($row = mysql_fetch_array($courses)){
					$course_id = $row['course_id'];						// SELECT course id
					testUpdate_Courses($link, $course_id); 				// UPDATE course
					
					// Get all of the assignments for the course
					// For each assignment, update an attribute
					$assignments = selectAssignment_Course($link, $course_id);						
					while($row = mysql_fetch_array($assignments)){
						$assignment_id = $row['assignment_id'];			// SELECT assignment id
						testUpdate_Assignments($link, $assignment_id); 	// UPDATE assignment
					}
				}
			}
		}
		
		echo "	<div class='row'>
					<div class='span10 offset1'>
						Update Test Complete
					</div>
				</div>";
	}

	function testUpdate_Students($link, $student_id) {
		
		// get information from database
		$student = Student::select($link, $student_id);
		
		// set attributes
        $fname 		= $student->fname;
        $email 		= $student->email;
        $phone 		= $student->phone;
        $password 	= $student->password;
		
		// perform update operation
		switch($student_id % 3) {

			case(0):
				Student::update($link, $student_id, 'Updated Name', $email, $phone, $password);
				break;
			
			case(1):
				Student::update($link, $student_id, $fname, $email, '000-000-0000', $password);
				break;
				
			case(2):
				Student::update($link, $student_id, $fname, $email, $phone, 'update');
				break;
				
			default:
				echo "student id does not exist.";
				break;
		}
	}
	
	function testUpdate_Settings($link, $student_id) {
		
		// get information from database
		$settings = Settings::select($link, $student_id);
		
		// set attributes
        $study_tod 		= $settings->study_tod;
        $st_exam 		= $settings->st_exam;
        $st_quiz 		= $settings->st_quiz;
        $st_project 	= $settings->st_project;
		$st_homework 	= $settings->st_homework;
		$st_discussion 	= $settings->st_discussion;
		$st_other 		= $settings->st_other;
		
		// perform update operation
		switch($student_id % 6) {

			case(0):
				Settings::update($link, $student_id, $study_tod, 99, $st_quiz, $st_project, $st_homework, $st_discussion, $st_other);
				break;
			
			case(1):
				Settings::update($link, $student_id, $study_tod, $st_exam, 99, $st_project, $st_homework, $st_discussion, $st_other);
				break;
				
			case(2):
				Settings::update($link, $student_id, $study_tod, $st_exam, $st_quiz, 99, $st_homework, $st_discussion, $st_other);
				break;
				
			case(3):
				Settings::update($link, $student_id, $study_tod, $st_exam, $st_quiz, $st_project, 99, $st_discussion, $st_other);
				break;
				
			case(4):
				Settings::update($link, $student_id, $study_tod, $st_exam, $st_quiz, $st_project, $st_homework, 99, $st_other);
				break;
				
			case(5):
				Settings::update($link, $student_id, $study_tod, $st_exam, $st_quiz, $st_project, $st_homework, $st_discussion, 99);
				break;
				
			default:
				echo "student id does not exist.";
				break;
		}
	}
	
	function testUpdate_Semesters($link, $semester_id) {
	
		// get information from database
		$semester = Semester::select($link, $semester_id);
		
		// set attributes
        $year 			= $semester->year;
        $term 			= $semester->term;
		
		// perform update operation
		switch($semester_id % 2) {

			case(0):
				Semester::update($link, $semester_id, 9999, $term);
				break;
			
			case(1):
				Semester::update($link, $semester_id, 0000, $term);
				break;
							
			default:
				echo "semester id does not exist.";
				break;
		}
	}
	
	function testUpdate_Courses($link, $course_id) {
		
		// get information from database
		$course = Course::select($link, $course_id);
		
		// set attributes
        $designation 	= $course->designation;
        $name 			= $course->name;
        $credits 		= $course->credits;
		
		// perform update operation
		switch($course_id % 3) {

			case(0):
				Course::update($link, $course_id, 'Update101', $name, $credits);
				break;
			
			case(1):
				Course::update($link, $course_id, $designation, 'Updated Class Name', $credits);
				break;
				
			case(2):
				Course::update($link, $course_id, $designation, $name, 99);
				break;
				
			default:
				echo "course id does not exist.";
				break;
		}
	}
	
	function testUpdate_Assignments($link, $assignment_id) {
	
		// get information from database
		$assignment = Assignment::select($link, $assignment_id);
		
		// set attributes
        $assignment_type 	= $assignment->assignment_type;
        $name 				= $assignment->name;
        $due_date 			= $assignment->due_date;
        $points_allowed 	= $assignment->points_allowed;
		$points_received 	= $assignment->points_received;
		
		// perform update operation
		switch($assignment_id % 3) {

			case(0):
				Assignment::update($link, $assignment_id, $assignment_type, 'Updated Assignment', $due_date, $points_allowed, $points_received);
				break;
			
			case(1):
				Assignment::update($link, $assignment_id, $assignment_type, $name, $due_date, 999, $points_received);
				break;
				
			case(2):
				Assignment::update($link, $assignment_id, $assignment_type, $name, $due_date, $points_allowed, 999);
				break;
				
			default:
				echo "assignment id does not exist.";
				break;
		}
	}
	

// Update Scores Test
	function testUpdate_Scores($link) {
		
		// Get all of the students from the database
		// For each student and settings, update an attribute
		$students = selectStudent_All($link);
		while($row = mysql_fetch_array($students)){
			$student_id			= $row['student_id'];					// SELECT student id
			
			// Get all of the semesters for the student
			// For each semester, update an attribute
			$semesters = selectSemester_Student($link, $student_id);					
			while($row = mysql_fetch_array($semesters)){
				$semester_id	= $row['semester_id'];					// SELECT semester id
				
				// Get all of the courses for the semester
				// For each course, update an attribute
				$courses = selectCourse_Semester($link, $semester_id);						
				while($row = mysql_fetch_array($courses)){
					$course_id = $row['course_id'];						// SELECT course id
					
					// Get all of the assignments for the course
					// For each assignment, update an attribute
					$assignments = selectAssignment_Course($link, $course_id);						
					while($row = mysql_fetch_array($assignments)){
						$assignment_id = $row['assignment_id'];			// SELECT assignment id
						testUpdate_Scores_Assignments($link, $assignment_id); 	// UPDATE assignment
					}
				}
			}
		}
		
		echo "	<div class='row'>
					<div class='span10 offset1'>
						Update Scores Test Complete
					</div>
				</div>";
	}
	
	function testUpdate_Scores_Assignments($link, $assignment_id) {
	
		// get information from database
		$assignment = Assignment::select($link, $assignment_id);
		
		// set attributes
		$semester_id 		= $assignment->semester_id;
		$course_id 			= $assignment->course_id;
        $points_allowed 	= $assignment->points_allowed;
		
		// set random parameters
		$max = $points_allowed;
		$min = $max*.60;
		
		// perform update operation
		switch(mt_rand(0, 1)) {

			case(0):
				$points_received = mt_rand($min, $max);
				Assignment::updateScore($link, $assignment_id, $points_received);
				break;
			
			case(1):
				$points_received = mt_rand($min, $max);
				//Assignment::updateScore($link, $assignment_id, $points_received);
				break;
				
			default:
				echo "assignment id does not exist.";
				break;
		}
	}
	
// Delete Test	
	function testDelete($link) {
		// Technically, we could delete all data just by deleting the student, but this
		// tests all of the functions individually.
		
		// Get all of the students from the database
		$students = selectStudent_All($link);
		while($row = mysql_fetch_array($students)){
			$student_id			= $row['student_id'];					// SELECT student id
			
			// Get all of the semesters for the student
			$semesters = selectSemester_Student($link, $student_id);					
			while($row = mysql_fetch_array($semesters)){
				$semester_id	= $row['semester_id'];					// SELECT semester id
			
				// Get all of the courses for the semester
				$courses = selectCourse_Semester($link, $semester_id);						
				while($row = mysql_fetch_array($courses)){
					$course_id = $row['course_id'];						// SELECT course id
					
					// Get all of the assignments for the semester
					$assignments = selectAssignment_Course($link, $course_id);
					while($row = mysql_fetch_array($assignments)){
						$assignment_id = $row['assignment_id'];			// Select Assignment id
						Assignment::delete($link, $assignment_id);		// Delete Assignment
					}
					
					Course::delete($link, $course_id);					// Delete Course
				}
				
				Semester::delete($link, $semester_id);
			}
			
            Settings::delete($link, $student_id);                       // Delete Student Settings
			Student::delete($link, $student_id);						// Delete Student
		}
		
		echo "	<div class='row'>
					<div class='span10 offset1'>
						Delete Test Complete
					</div>
				</div>";
	}
	
	


	
	
	
?>