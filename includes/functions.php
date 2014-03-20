<?php

// Test Function

    function test() {  
        $return = "test worked";
       
        return $studentObject;
    }

	
	
// Page Functions

	function db_connect() {
		// Website Connection
		$hostname = "mysql.myuplan.com";   
		$username = "uisadmin";   
		$password = "CodeMonkeys1";
		$database = "myuplan";

		// Local Connection (TEMP)
		$hostname = "localhost";   

		// Connect to Database
		$link = mysql_connect($hostname,$username,$password);
		
		// Check connection
		mysql_select_db($database) or die("Unable to select database");
		
		return $link;
	}
	
	function Redirect($url, $permanent = false) {
		header('Location: ' . $url, true, $permanent ? 301 : 302);
		exit();
	}
  
  
  
  
// Class Objects

	class Student {
        
        // object properties
        public $student_id;
        public $fname;
        public $ema;
        public $phone;
        public $date_created;
        
        // new object construction
        public function __construct() {
            // not used
        }
        
        public static function insert($link, $fname, $email, $phone, $password) {
        
            // create new object to insert int database
            $instance = new self();
            
            // set object properties
            $instance->fname = $fname;
            $instance->email = $email;
            $instance->phone = $phone;
            $instance->password = $password;
            
            // insert into database
            insertStudent($link, $instance);
        }
        
        public static function update($link, $student_id, $fname, $email, $phone, $password) {
        
            // select the object
            $instance = Student::select($link, $student_id);
            
            // set object properties
            $instance->fname = $fname;
            $instance->email = $email;
            $instance->phone = $phone;
            $instance->password = $password;
            
            // insert into database
            updateStudent($link, $instance);
        }
        
        public static function delete($link, $student_id) {
            
            // select the object
            $instance = Student::select($link, $student_id);    
            
            // delete from database
            deleteStudent($link, $instance);
        }
        
        public static function select($link, $student_id) {
            
            // create new object to return
            $instance = new self();
            
            // select object attributes
            $query = selectStudent($link, $student_id);
            $row = mysql_fetch_array($query);
            
            // set object properties
            $instance->student_id = $row['student_id'];
            $instance->fname = $row['fname'];
            $instance->email = $row['email'];
            $instance->phone = $row['phone'];
            $instance->password = $row['password'];
            $instance->date_created = $row['date_created']; 
            
            // return student instance
            return $instance;
        }
    }
    
    class Settings {
    
    }
    
	class Semester {
        
		// object properties
        public $student_id;
        public $semester_id;
        public $year;
        public $term;
        public $start_date;
        public $end_date;
		public $semester_GPA;
        public $isCurrent;
		
		
        // new object construction
        public function __construct() {
            // not used
        }
        
        public static function insert($link, $student_id, $year, $term, $start_date, $end_date) {
        
            // create new object to insert int database
            $instance = new self();
            
            // set object properties
            $instance->student_id 		= $student_id;
            $instance->year 			= $year;
            $instance->term 			= $term;
			$instance->start_date 		= $start_date;
			$instance->end_date 		= $end_date;
			$instance->isCurrent 		= compute_isCurrent($year, $term);
            
            // insert into database
            insertSemester($link, $instance);
        }
        
        public static function update($link, $semester_id, $year, $term, $start_date, $end_date) {
        
            // select the object
            $instance = Semester::select($link, $semester_id);
            
            // set object properties
            $instance->year 			= $year;
            $instance->term 			= $term;
			$instance->start_date 		= $start_date;
			$instance->end_date 		= $end_date;
            $instance->semester_GPA 	= compute_gpa($link, $semester_id);
			$instance->isCurrent 		= compute_isCurrent($year, $term);
			
            // insert into database
            updateSemester($link, $instance); 
        }
        
        public static function delete($link, $semester_id) {
            
            // select the object
            $instance = Semester::select($link, $semester_id);    
            
            // delete from database
            deleteSemester($link, $instance);
        }
        
        public static function select($link, $semester_id) {
            
            // create new object to return
            $instance = new self();
            
            // select object attributes
            $query 	= selectSemester($link, $semester_id);
            $row 	= mysql_fetch_array($query);
            
			// set object properties
            $instance->student_id 		= $row['student_id'];
            $instance->semester_id 		= $row['semester_id'];
            $instance->year 			= $row['year'];
            $instance->term 			= $row['term'];
			$instance->start_date 		= $row['start_date'];
			$instance->end_date 		= $row['end_date'];
			$instance->semester_GPA 	= $row['semester_GPA'];
			$instance->isCurrent 		= $row['isCurrent'];
			
			
            // return student instance
            return $instance;
        }

		public static function select_current($link, $student_id) {
			// create new object to return
            $instance = new self();
            
            // select object attributes
            $query 	= selectSemester_Current($link, $student_id);
            $row 	= mysql_fetch_array($query);
            
			// set object properties
            $instance->student_id 		= $row['student_id'];
            $instance->semester_id 		= $row['semester_id'];
            $instance->year 			= $row['year'];
            $instance->term 			= $row['term'];
			$instance->start_date 		= $row['start_date'];
			$instance->end_date 		= $row['end_date'];
			$instance->semester_GPA 	= $row['semester_GPA'];
			$instance->isCurrent 		= $row['isCurrent'];
			
			
            // return student instance
            return $instance;
		}
	}
	
	class Course {
        
        // object properties
        public $student_id;
        public $semester_id;
        public $course_id;
        public $designation;
        public $name;
        public $credits;
		public $grade;
        
        // new object construction
        public function __construct() {
            // not used
        }
        
        public static function insert($link, $student_id, $semester_id, $designation, $name, $credits) {
        
            // create new object to insert int database
            $instance = new self();
            
            // set object properties
            $instance->student_id = $student_id;
            $instance->semester_id = $semester_id;
            $instance->designation = $designation;
            $instance->name = $name;
			$instance->credits = $credits;
            
            // insert into database
            insertCourse($link, $instance);
        }
        
        public static function update($link, $course_id, $designation, $name, $credits) {
        
            // select the object
            $instance = Course::select($link, $course_id);
            
            // set object properties
            $instance->designation = $designation;
            $instance->name = $name;
			$instance->credits = $credits;
			$instance->grade = ''; //calculate_grade($link, $course_id);
            
            // insert into database
            updateCourse($link, $instance);
        }
        
        public static function delete($link, $course_id) {
            
            // select the object
            $instance = Course::select($link, $course_id);    
            
            // delete from database
            deleteCourse($link, $instance);
        }
        
        public static function select($link, $course_id) {
            
            // create new object to return
            $instance = new self();
            
            // select object attributes
            $query = selectCourse($link, $course_id);
            $row = mysql_fetch_array($query);
            
            // set object properties
			$instance->student_id = $row['student_id'];
			$instance->semester_id = $row['semester_id'];
			$instance->course_id = $row['course_id'];
			$instance->designation = $row['designation'];
            $instance->name = $row['name'];
			$instance->credits = $row['credits'];
			$instance->grade = $row['grade'];
            
            // return student instance
            return $instance;
        }
    
	}
	
	class Assignment {
        
		// object properties
        public $student_id;
        public $semester_id;
        public $course_id;
        public $assignment_id;
        public $assignment_type;
        public $name;
        public $due_date;
        public $studytime;
        public $points_allowed;
        public $points_received;
		
		
        // new object construction
        public function __construct() {
            // not used
        }
        
        public static function insert($link, $student_id, $semester_id, $course_id, $assignment_type, $name, $due_date, $points_allowed) {
        
            // create new object to insert int database
            $instance = new self();
            
            // set object properties
            $instance->student_id 		= $student_id;
            $instance->semester_id 		= $semester_id;
            $instance->course_id 		= $course_id;
            $instance->assignment_type 	= $assignment_type;
			$instance->name 			= $name;
			$instance->due_date 		= $due_date;
			$instance->studytime 		= '';							// GET STUDY TIME
			$instance->points_allowed 	= $points_allowed;
            
            // insert into database
            insertAssignment($link, $instance);
        }
        
        public static function update($link, $assignment_id, $assignment_type, $name, $due_date, $points_allowed, $points_received) {
        
            // select the object
            $instance = Assignment::select($link, $assignment_id);
            
            // set object properties
            $instance->assignment_type 	= $assignment_type;
            $instance->name 			= $name;
			$instance->due_date 		= $due_date;
			$instance->studytime 		= '';							// GET STUDY TIME
			$instance->points_allowed 	= $points_allowed;
            $instance->points_received 	= $points_received;
			
            // insert into database
            updateAssignment($link, $instance);
        }
        
        public static function delete($link, $assignment_id) {
            
            // select the object
            $instance = Assignment::select($link, $assignment_id);    
            
            // delete from database
            deleteAssignment($link, $instance);
        }
        
        public static function select($link, $assignment_id) {
            
            // create new object to return
            $instance = new self();
            
            // select object attributes
            $query = selectAssignment($link, $assignment_id);
            $row = mysql_fetch_array($query);
            
			// set object properties
			$instance->student_id 		= $row['student_id'];
            $instance->semester_id 		= $row['semester_id'];
            $instance->course_id 		= $row['course_id'];
			$instance->assignment_id 	= $row['assignment_id'];
            $instance->assignment_type 	= $row['assignment_type'];
			$instance->name 			= $row['name'];
			$instance->due_date 		= $row['due_date'];
			$instance->studytime 		= $row['studytime'];
			$instance->points_allowed 	= $row['points_allowed'];
			$instance->points_received 	= $row['points_received'];
			
            // return student instance
            return $instance;
        }
	}
	
	
	
	
// MySQL Functions	

	// INSERT
    function insertStudent($link, $studentObject) {
		
        // set variables from object properties
        $fname 				= $studentObject->fname;
        $email 				= $studentObject->email;
        $phone 				= $studentObject->phone;
        $password 			= $studentObject->password;
		
		// insert into mysql database
		$sql = "INSERT INTO Student"."(fname, email, phone, password, date_created)".
			   "VALUES ('$fname', '$email', '$phone', '$password', NOW())";
		$retval = mysql_query( $sql, $link );
		
		// test if database operation was successful
        if(! $retval )
          die('Could not insert student data: ' . mysql_error());
	}
    
	function insertSemester($link, $semesterObject) {
		
		// set variables from object properties
        $student_id 		= $semesterObject->student_id;
        $year 				= $semesterObject->year;
        $term 				= $semesterObject->term;
		$start_date 		= $semesterObject->start_date;
		$end_date 			= $semesterObject->end_date;
		$isCurrent			= $semesterObject->isCurrent;
		
		// insert into mysql database
		$sql = "INSERT INTO Semester"."(student_id, year, term, start_date, end_date, isCurrent)".
			   "VALUES ('$student_id', '$year', '$term', '$start_date', '$end_date', '$isCurrent')";
		$retval = mysql_query( $sql, $link );
		
		// test if database operation was successful
        if(! $retval )
          die('Could not insert semester data: ' . mysql_error());
	}
	
	function insertCourse($link, $courseObject) {
		
		// set variables from object properties
        $student_id 		= $courseObject->student_id;
		$semester_id		= $courseObject->semester_id;
        $designation 		= $courseObject->designation;
        $name 				= $courseObject->name;
		$credits 			= $courseObject->credits;
		
		// insert into mysql database
		$sql = "INSERT INTO Course"."(student_id, semester_id, designation, name, credits)".
			   "VALUES ('$student_id', '$semester_id', '$designation', '$name', '$credits')";
		$retval = mysql_query( $sql, $link );
		
		// test if database operation was successful
        if(! $retval )
          die('Could not insert course data: ' . mysql_error());
	}
	
	function insertAssignment($link, $assignmentObject) {
		
		// set variables from object properties
        $student_id 		= $assignmentObject->student_id;
        $semester_id 		= $assignmentObject->semester_id;
        $course_id 			= $assignmentObject->course_id;
        $assignment_type 	= $assignmentObject->assignment_type;
		$name 				= $assignmentObject->name;
		$due_date 			= $assignmentObject->due_date;
		$studytime			= $assignmentObject->studytime;
		$points_allowed		= $assignmentObject->points_allowed;
		
		// insert into mysql database
		$sql = "INSERT INTO Assignment"."(student_id, semester_id, course_id, assignment_type, name, due_date, studytime, points_allowed)".
			   "VALUES ('$student_id', '$semester_id', '$course_id', '$assignment_type', '$name', '$due_date', '$studytime', '$points_allowed')";
		$retval = mysql_query( $sql, $link );
		
		// test if database operation was successful
        if(! $retval )
          die('Could not insert assignment data: ' . mysql_error());
	}
	
	
	// UPDATE	
    function updateStudent($link, $studentObject) {
        // set variables from object properties
        $student_id 	= $studentObject->student_id;
        $fname 			= $studentObject->fname;
        $email 			= $studentObject->email;
        $phone 			= $studentObject->phone;
        $password 		= $studentObject->password;

		// update mysql database
        $sql = "UPDATE Student 
                SET fname = '$fname', email = '$email', phone = '$phone', password = '$password' 
                WHERE student_id = '$student_id'";
		$retval = mysql_query( $sql, $link );
        
        // test if database operation was successful
        if(! $retval )
          die('Could not update student data: ' . mysql_error());
    }

	function updateSemester($link, $semesterObject) {
        // set variables from object properties
		$semester_id	= $semesterObject->semester_id;
        $year 			= $semesterObject->year;
        $term 			= $semesterObject->term;
		$start_date 	= $semesterObject->start_date;
		$end_date 		= $semesterObject->end_date;
		$isCurrent		= $semesterObject->isCurrent;
		// update mysql database
        $sql = "UPDATE Semester 
                SET year = '$year', term = '$term', start_date = '$start_date', end_date = '$end_date', isCurrent = '$isCurrent' 
                WHERE semester_id = '$semester_id'";
		$retval = mysql_query( $sql, $link );
        
        // test if database operation was successful
        if(! $retval )
          die('Could not update semester data: ' . mysql_error());
    }
	
	function updateCourse($link, $courseObject) {
        // set variables from object properties
		$course_id		= $courseObject->course_id;
        $designation 	= $courseObject->designation;
        $name 			= $courseObject->name;
		$credits 		= $courseObject->credits;
		$grade 			= $courseObject->grade;

		// update mysql database
        $sql = "UPDATE Course 
                SET designation = '$designation', name = '$name', credits = '$credits', grade = '$grade' 
                WHERE course_id = '$course_id'";
		$retval = mysql_query( $sql, $link );
        
        // test if database operation was successful
        if(! $retval )
          die('Could not update course data: ' . mysql_error());
    }
	
	function updateAssignment($link, $assignmentObject) {

		// set variables from object properties
		$assignment_id		= $assignmentObject->assignment_id;
        $assignment_type 	= $assignmentObject->assignment_type;
		$name 				= $assignmentObject->name;
		$due_date 			= $assignmentObject->due_date;
		$studytime			= $assignmentObject->studytime;
		$points_allowed		= $assignmentObject->points_allowed;
		$points_received	= $assignmentObject->points_received;

		// update mysql database
        $sql = "UPDATE Assignment 
                SET assignment_type = '$assignment_type', name = '$name', due_date = '$due_date', studytime = '$studytime', points_allowed = '$points_allowed', points_received = '$points_received'
                WHERE assignment_id = '$assignment_id'";
		$retval = mysql_query( $sql, $link );
        
        // test if database operation was successful
        if(! $retval )
          die('Could not update assignment data: ' . mysql_error());
    }
	
	
	// DELETE	
    function deleteStudent($link, $studentObject) {
        // set variables from object properties
        $student_id = $studentObject->student_id;
        
		// delete record from mysql database
		$sql = "DELETE FROM Student
                WHERE student_id = $student_id";
		$retval = mysql_query( $sql, $link );
		
		// test if database operation was successful
        if(! $retval )
          die('Could not delete student data: ' . mysql_error());
    }
    
	function deleteSemester($link, $semesterObject) {
        // set variables from object properties
        $semester_id = $semesterObject->semester_id;
        
		// delete record from mysql database
		$sql = "DELETE FROM Semester
                WHERE semester_id = $semester_id";
		$retval = mysql_query( $sql, $link );
		
		// test if database operation was successful
        if(! $retval )
          die('Could not delete semester data: ' . mysql_error());
    }
   
	function deleteCourse($link, $courseObject) {
        // set variables from object properties
        $course_id = $courseObject->course_id;
        
		// delete record from mysql database
		$sql = "DELETE FROM Course
                WHERE course_id = $course_id";
		$retval = mysql_query( $sql, $link );
		
		// test if database operation was successful
        if(! $retval )
          die('Could not delete course data: ' . mysql_error());
    }

	function deleteAssignment($link, $assignmentObject) {
        // set variables from object properties
        $assignment_id = $assignmentObject->assignment_id;
        
		// delete record from mysql database
		$sql = "DELETE FROM Assignment
                WHERE assignment_id = $assignment_id";
		$retval = mysql_query( $sql, $link );
		
		// test if database operation was successful
        if(! $retval )
			die('Could not delete assignment data: ' . mysql_error());
    }
	
	
	// SELECT 	
	function selectStudent_All($link) {							// select all students in the database
		// get information from database
		$sql = "SELECT * 
				FROM Student
				ORDER BY student_id";
		$result = mysql_query($sql)or die(mysql_error());
		
		// test if database operation was successful
        if (mysql_num_rows($result) == 0)
			echo "selectStudent_All returned 0 rows<br>";
			
		// return information
		return $result;
	}
	
	function selectStudent($link, $student_id) {				// select a specific student
		// get information from database
		$sql = "SELECT * 
				FROM Student
				WHERE student_id = $student_id";
		$result = mysql_query($sql)or die(mysql_error());
		
		// test if database operation was successful
        if (mysql_num_rows($result) == 0)
			echo "selectStudent_All returned 0 rows<br>";
			
		// return information
		return $result;
	}
	
	
	function selectStudentSettings_All($link) {					// select all students settings in the database
		// get information from database
		$sql = "SELECT * 
				FROM Student_Settings
				ORDER BY student_id";
		$result = mysql_query($sql)or die(mysql_error());
		
		// test if database operation was successful
        if (mysql_num_rows($result) == 0)
			echo "selectStudent_All returned 0 rows<br>";
			
		// return information
		return $result;
	}
	
	function selectStudentSettings($link, $student_id) {		// select a specific student's settings
		// select item from mysql database
		$sql = "SELECT * 
				FROM Student_Settings
				WHERE student_id = $student_id";
		$result = mysql_query($sql)or die(mysql_error());
		
		// test if database operation was successful
        if (mysql_num_rows($result) == 0)
			echo "selectStudent returned 0 rows<br>";
			
		// return information
		return $result;
	}
	

	function selectSemester_All($link) {						// select all semesters in the database
		// get information from database
		$sql = "SELECT * 
				FROM Semester
				ORDER BY semester_id";
		$result = mysql_query($sql)or die(mysql_error());
		
		// test if database operation was successful
		if (mysql_num_rows($result) == 0)
			echo "selectSemester_All returned 0 rows<br>";
			
		// return information
		return $result;
	}
	
	function selectSemester_Student($link, $student_id) {		// select all semesters for a student
		// get information from database
		$sql = "SELECT * 
				FROM Semester
				WHERE student_id = $student_id
				ORDER BY term, year";
		$result = mysql_query($sql)or die(mysql_error());
		
		// test if database operation was successful
		if (mysql_num_rows($result) == 0)
			echo "selectSemester_Student returned 0 rows<br>";
			
		// return information
		return $result;
	}
	
	function selectSemester($link, $semester_id) {				// select a specific semester
		// select item from mysql database
		$sql = "SELECT * 
				FROM Semester
				WHERE semester_id = $semester_id";
		$result = mysql_query($sql)or die(mysql_error());

		// test if database operation was successful
		if (mysql_num_rows($result) == 0)
			echo "selectSemester returned 0 rows<br>";

		// return information
		return $result;
	}
	
	function selectSemester_Current($link, $student_id) {		// select the current semester
		// get information from database
		$sql = "SELECT * 
				FROM Semester
				WHERE student_id = $student_id AND isCurrent = '1'";
		$result = mysql_query($sql)or die(mysql_error());
		
		// test if database operation was successful
		if (mysql_num_rows($result) == 0)
			echo "selectSemester_Current returned 0 rows<br>";
			
		// return information
		return $result;
	}
	
	
	function selectCourse_All($link) {							// select all courses in the database
		// get information from database
		$sql = "SELECT * 
				FROM Course
				ORDER BY course_id";
		$result = mysql_query($sql)or die(mysql_error());
		
		// test if database operation was successful
		if (mysql_num_rows($result) == 0)
			echo "selectCourse_All returned 0 rows<br>";
			
		// return information
		return $result;
	}
	
	function selectCourse_Student($link, $student_id) {			// select all courses for a student
		// get information from database
		$sql = "SELECT * 
				FROM Course
				WHERE student_id = $student_id
				ORDER BY semester_id, designation";
		$result = mysql_query($sql)or die(mysql_error());
		
		// test if database operation was successful
		if (mysql_num_rows($result) == 0)
			echo "selectCourse_Student returned 0 rows<br>";
			
		// return information
		return $result;
	}

	function selectCourse_Semester($link, $semester_id) {		// select all courses for a semester
		// get information from database
		$sql = "SELECT * 
				FROM Course
				WHERE semester_id = $semester_id
				ORDER BY designation";
		$result = mysql_query($sql)or die(mysql_error());
		
		// test if database operation was successful
		if (mysql_num_rows($result) == 0)
			echo "selectCourse_Semester returned 0 rows<br>";
			
		// return information
		return $result;
	}
	
	function selectCourse($link, $course_id) {					// select a specific course
		// select item from mysql database
		$sql = "SELECT * 
				FROM Course
				WHERE course_id = $course_id";
		$result = mysql_query($sql)or die(mysql_error());
		
		// test if database operation was successful
		if (mysql_num_rows($result) == 0)
			echo "selectCourse returned 0 rows<br>";
		
		// return information
		return $result;
	}
	
	
	function selectAssignment_All($link) {						// select all assignments in the database
		// get information from database
		$sql = "SELECT * 
				FROM Assignment
				ORDER BY assignment_id";
		$result = mysql_query($sql)or die(mysql_error());
		
		// test if database operation was successful
		if (mysql_num_rows($result) == 0)
			echo "selectAssignment_All returned 0 rows<br>";
			
		// return information
		return $result;
	}
	
	function selectAssignment_Student($link, $student_id) {		// select all assignments for a student
		// get information from database
		$sql = "SELECT * 
				FROM Assignment
				WHERE student_id = $student_id
				ORDER BY semester_id, course_id, assignment_id";
		$result = mysql_query($sql)or die(mysql_error());
		
		// test if database operation was successful
		if (mysql_num_rows($result) == 0)
			echo "selectAssignment_Student returned 0 rows<br>";
			
		// return information
		return $result;
	}
	
	function selectAssignment_Semester($link, $semester_id) {	// select all assignments for a semester
		// get information from database
		$sql = "SELECT * 
				FROM Assignment
				WHERE semester_id = $semester_id
				ORDER BY course_id, assignment_id";
		$result = mysql_query($sql)or die(mysql_error());
		
		// test if database operation was successful
		if (mysql_num_rows($result) == 0)
			echo "selectAssignment_Semester returned 0 rows<br>";
			
		// return information
		return $result;
	}
	
	function selectAssignment_Course($link, $course_id) {		// select all assignments for a course
		// get information from database
		$sql = "SELECT * 
				FROM Assignment
				WHERE course_id = $course_id
				ORDER BY due_date ASC";
		$result = mysql_query($sql)or die(mysql_error());
		
		// test if database operation was successful
		if (mysql_num_rows($result) == 0)
			echo "selectAssignment_Course returned 0 rows<br>";
			
		// return information
		return $result;
	}
	
	function selectAssignment($link, $assignment_id) {			// select a specific assignment
		// select item from mysql database
		$sql = "SELECT * 
				FROM Assignment
				WHERE assignment_id = $assignment_id";
		$result = mysql_query($sql)or die(mysql_error());
		
		// test if database operation was successful
		if (mysql_num_rows($result) == 0)
			echo "selectAssignment returned 0 rows<br>";

		// return information
		return $result;
	}
   
   
    
// Calculation Functions

	function compute_gpa($link, $semester_id) {					// compute semester gpa
		// calculation variables
        $credits_attempted = 0;
        $gradepoints_earned = 0;
        $gpa = 0.000;
	
		// get course id from database
        $result = selectCourse_Semester($link, $semester_id);

        // fill table
        while($row = mysql_fetch_array($result)){
            
            // set variables
			$course_id		= $row['course_id'];
            $credits        = $row['credits'];
			$grade			= $row['grade'];
			
            // add to grade points attempted
			if ($grade <> 'N/A')
				$credits_attempted += $credits;
            
            // determine grade points earned
            switch ($grade) {
                case 'A':
                    $gradepoints_earned += (4.0 * $credits);
                    break;
                case 'A-':
                    $gradepoints_earned += (3.7 * $credits);
                    break;
                case 'B+':
                    $gradepoints_earned += (3.3 * $credits);
                    break;
                case 'B':
                    $gradepoints_earned += (3.0 * $credits);
                    break;
                case 'B-':
                    $gradepoints_earned += (2.7 * $credits);
                    break;
                case 'C+':
                    $gradepoints_earned += (2.3 * $credits);
                    break;
                case 'C':
                    $gradepoints_earned += (2.0 * $credits);
                    break;
                case 'C-':
                    $gradepoints_earned += (1.7 * $credits);
                    break;
                case 'D+':
                    $gradepoints_earned += (1.3 * $credits);
                    break;
                case 'D':
                    $gradepoints_earned += (1.0 * $credits);
                    break;
                case 'D-':
                    $gradepoints_earned += (0.7 * $credits);
                    break;
				case 'F':
					$gradepoints_earned += (0.0 * $credits);
                    break;
                default:
                    $gradepoints_earned += (0.0);
            }

        } // end loop
        
        // calculate GPA  (GPA = grade points earned / grade points attempted)
        if ($credits_attempted > 0) {
            $gpa = $gradepoints_earned / $credits_attempted;
            $gpa = number_format($gpa, 3);	// format the number to 3 decimal places
        }
        else
            $gpa = 0;
        
		return $gpa;
	
	}

	function compute_grade($link, $course_id) {					// compute course grade
		// calculation variables
        $totalpoints_attempted = 0;
        $totalpoints_earned = 0;
        $gradePercent = 0.0;
        $grade = '';
        
        // get course id from database
        $result = selectAssignment_Course($link, $course_id);
        
        // fill table
        while($row = mysql_fetch_array($result)){
            
            // set variables
            $points_allowed         = $row['points_allowed'];
            $points_received        = $row['points_received'];
            
            // compute grade
            if ($points_received <> NULL) {
                $totalpoints_attempted  += $points_allowed ;
                $totalpoints_earned += $points_received;
            } 
 
        } // end loop
		
		// calculate grade for the course ( % ). If there are no assignments, return N/A
		if ($totalpoints_attempted > 0)
			$gradePercent = $totalpoints_earned / $totalpoints_attempted * 100;
        else
			return $grade = 'N/A';
			
        // determine grade
        if ($gradePercent >= 93.5) $grade = 'A';
        else if ($gradePercent < 93.5 AND $gradePercent >= 90.0) $grade = 'A-';
        else if ($gradePercent < 90.0 AND $gradePercent >= 87.5) $grade = 'B+';
        else if ($gradePercent < 87.5 AND $gradePercent >= 83.5) $grade = 'B';
        else if ($gradePercent < 83.5 AND $gradePercent >= 80.0) $grade = 'B-';
        else if ($gradePercent < 80.0 AND $gradePercent >= 77.5) $grade = 'C+';
        else if ($gradePercent < 77.5 AND $gradePercent >= 73.5) $grade = 'C';
        else if ($gradePercent < 73.5 AND $gradePercent >= 70.0) $grade = 'C-';
        else if ($gradePercent < 70.0 AND $gradePercent >= 67.5) $grade = 'D+';
        else if ($gradePercent < 67.5 AND $gradePercent >= 63.5) $grade = 'D';
        else if ($gradePercent < 63.5 AND $gradePercent >= 60.0) $grade = 'D-';
        else if ($gradePercent < 60.0) $grade = 'F';
        else $grade = 'N/A';

        return $grade;
	
	}
   
    function compute_isCurrent($year, $term) {

        // initialize return variable to !isCurrent
        $isCurrent = '0';
        
        // set current date information
        $currentYear    = date("Y");
        $currentTerm    = get_currentTerm();

        // check that we are in the current year
        if ($year == $currentYear) {
            
            // check if we are in the current term
            if ($term == $currentTerm) {
                    $isCurrent = '1';
            }
        }
        
        // return the result
        return $isCurrent;
    }
    


// Get Functions

	function get_date() {
		// get current date from system
		$date = date('Y/m/d', time());
		
		// return date
		return $date;
	}
   
	function get_dateRange($date, $offset) {
		
		// calculate the date with the offset
		$date_temp = date('Y/m/d',strtotime($date . "+$offset days"));
		$dateOffset = str_replace('/', '-', $date_temp);
		
		// return date with offset
		return $dateOffset;
	}
	
	function get_currentTerm() {
        
        // initialize return variable
        $currentTerm = '';
    
        // set current date information
        $currentMonth   = date("m");
        
        // set your default semester term start months
        $spring         = 1;
        $summer         = 6;
        $fall           = 8;
        
        // check if we are currently in spring semester
        if ($currentMonth < $summer)
            $currentTerm = 'Spring';
        
        // check if we are currently in summer semester
        if ($currentMonth >= $summer AND $currentMonth < $fall)
            $currentTerm = 'Summer';
        
        // check if we are currently in fall semester
        if ($currentMonth >= $fall)
            $currentTerm = 'Fall';

        // return current term
        return $currentTerm;
    }

	
	
	
	
	
	
	
	
	
	
// OBSOLUTE BELOW //


// Calculation Functions
    
	function optimize_semester($semester_id) {
	
	
	}	
	
	function optimize_course($course_id) {
	
	
	}
	
    function compute_isCurrent_dates_backup($start_date) {

        // initialize return variable to !isCurrent
        $isCurrent = '0';
        
        // set current date information
        $currentDate    = date("Y-m-d");
        $currentYear    = date("Y");
        
        // set your default semester term start dates
        $spring         = date_create("$currentYear-01-01");
        $summer         = date_create("$currentYear-06-01");
        $fall           = date_create("$currentYear-08-01");
        
        // get the start year
        $startYear      = date_format($start_date, 'Y');

        // check that we are in the correct year
        if ($startYear = $currentYear) {
            // check if we are currently in spring semester
            if ($currentDate < $summer) {
                // check if the start date is in the current semester
                if ($start_date < $summer)
                    $isCurrent = '1';
            }
            
            // check if we are currently in summer semester
            if ($currentDate >= $summer AND $currentDate < $fall) {    
                // check if the start date is in the current semester
                if ($start_date >= $summer AND $start_date < $fall)
                    $isCurrent = '1';
            }
            
            // check if we are currently in fall semester
            if ($currentDate >= $fall) {    
                // check if the start date is in the current semester
                if ($start_date >= $fall)
                    $isCurrent = '1';
            } 
        }
        
        // return the result
        return $isCurrent;
    }



// MySQL Functions
	
// Insert Functions
	function Insert_Student($link, $fname, $email, $phone, $password) {
		
		// Insert record into database
		$sql = "INSERT INTO Student"."(fname, email, phone, password, date_created)".
			   "VALUES ('$fname', '$email', '$phone', '$password', NOW())";
		$retval = mysql_query( $sql, $link );
		
		// Check if insert was successful
		if(!$retval) { 
			die('Could not enter data: ' . mysql_error()); 
			return 0;
		}
		else
			return 1;
	}
	
	function Insert_Semester($link, $student_id, $year, $term, $start_date, $end_date) {
		
		// Insert record into database
		$sql = "INSERT INTO Semester"."(student_id, year, term, start_date, end_date)".
			   "VALUES ('$student_id', '$year', '$term', '$start_date', '$end_date')";
		$retval = mysql_query( $sql, $link );
		
		// Check if insert was successful
		if(!$retval) { 
			die('Could not enter data: ' . mysql_error()); 
			return 0;
		}
		else
			return 1;
	}

	function Insert_Course($link, $student_id, $semester_id, $designation, $name, $credits) {
		
		// Insert record into database
		$sql = "INSERT INTO Course"."(student_id, semester_id, designation, name, credits)".
			   "VALUES ('$student_id', '$semester_id', '$designation', '$name', '$credits')";
		$retval = mysql_query( $sql, $link );
		
		// Check if insert was successful
		if(!$retval) { 
			die('Could not enter data: ' . mysql_error()); 
			return 0;
		}
		else
			return 1;
	}
	
	function Insert_Assignment($link, $student_id, $semester_id, $course_id, $assignment_type, $name, $due_date, $points_allowed) {
		
		// Insert record into database
		$sql = "INSERT INTO Assignment"."(student_id, semester_id, course_id, assignment_type, name, due_date, points_allowed)".
			   "VALUES ('$student_id', '$semester_id', '$course_id', '$assignment_type', '$name', '$due_date', '$points_allowed')";
		$retval = mysql_query( $sql, $link );
		
		// Check if insert was successful
		if(!$retval) { 
			die('Could not enter data: ' . mysql_error()); 
			return 0;
		}
		else
			return 1;
	}
	

	
// Update Functions



// Delete Functions



// Query Functions

	// Get Student Information Functions
	function get_students_all($link) {
		// get information from database
		$sql = "SELECT * 
				FROM Student";
		$result = mysql_query($sql)or die(mysql_error());
		
		// return information
		return $result;
	}
	
	function get_student($link, $student_id) {
		// get information from database
		$sql = "SELECT * 
				FROM Student
				WHERE student_id = $student_id";
		$result = mysql_query($sql)or die(mysql_error());
		
		// return information
		return $result;
	
	}
	
	function get_student_fname($link, $studentResult) {
	
		// get information from database
		$row = mysql_fetch_array($studentResult);
		$fname = $row['fname'];
		
		// return information
		return $fname;
	}
	
	
	// Get Student Settings Information Functions
	function get_studentsettings_all($link) {
		// get information from database
		$sql = "SELECT * 
				FROM Student_Settings";
		$result = mysql_query($sql)or die(mysql_error());
		
		// return information
		return $result;
	}
	
	function get_studentsettings($link, $student_id) {
		// get information from database
		$sql = "SELECT * 
				FROM Student_Settings
				WHERE student_id = $student_id";
		$result = mysql_query($sql)or die(mysql_error());
		
		// return information
		return $result;
	}
	
	
	// Get Semester Information Functions
	function get_semesters_all ($link) {
		// get information from database
		$sql = "SELECT * 
				FROM Semester";
		$result = mysql_query($sql)or die(mysql_error());
		
		// return information
		return $result;
	}
	
	function get_semesters_student($link, $student_id) {
		// get information from database
		$sql = "SELECT * 
				FROM Semester
				WHERE student_id = $student_id
				ORDER BY year, term";
		$result = mysql_query($sql)or die(mysql_error());
		
		// return information
		return $result;
	}
	
	function get_semester_current($link, $student_id) {
	
		// get information from database
		$sql = "SELECT * 
				FROM Semester
				WHERE student_id = $student_id AND isCurrent ='1'";
		$result = mysql_query($sql)or die(mysql_error());
		
		// return information
		return $result;
	}

	function get_semester($link, $semester_id) {
		// get information from database
		$sql = "SELECT * 
				FROM Semester
				WHERE semester_id = $semester_id";
		$result = mysql_query($sql)or die(mysql_error());
		
		// return information
		return $result;
	}
	
	function get_semester_id($link, $semesterResult) {
		// parse information
		$row = mysql_fetch_array($semesterResult);
		$semester_id = $row['semester_id'];
		
		// return result
		return $semester_id;
	}
	
    function get_semester_gpa($link, $semester_id) {
		// parse information
		$row = mysql_fetch_array($semesterResult);
		$semester_GPA = $row['semester_GPA'];
		
		// return result
		return $semester_GPA;
	}
   
    function get_semester_info($link, $semester_id, $request) {
        // retrieve the desired semester from the database
        $query = get_semester($link, $semester_id);
        $row = mysql_fetch_array($query);
        
        // parse the requested information
        switch($request) {
            case 'student_id':
                $result = $row['student_id'];
                break;
            case 'semester_id':
                $result = $row['semester_id'];
                break;
            case 'year':
                $result = $row['year'];
                break;
            case 'term':
                $result = $row['term'];
                break;
            case 'start_date':
                $result = $row['start_date'];
                break;
            case 'end_date':
                $result = $row['end_date'];
                break;
            case 'semester_GPA':
                $result = $row['semester_GPA'];
                break;
            case 'isCurrent':
                $result = $row['isCurrent'];
                break;
            default:
                $result = NULL;
                break;
        }
        
        // return the requested information
        return $result;    
    }
	
    
	// Get Course Information Functions
	function get_courses_all ($link) {
		// get information from database
		$sql = "SELECT * 
				FROM Course";
		$result = mysql_query($sql)or die(mysql_error());
		
		// return information
		return $result;
	}
	
	function get_courses_student($link, $student_id) {
		// get information from database
		$sql = "SELECT * 
				FROM Course
				WHERE student_id = $student_id";
		$result = mysql_query($sql)or die(mysql_error());
		
		// return information
		return $result;
	}
	
	function get_courses_semester($link, $semester_id) {
	
		// get information from database
		$sql = "SELECT * 
				FROM Course
				WHERE semester_id = $semester_id";
		$result = mysql_query($sql)or die(mysql_error());
		
		// return information
		return $result;
	}
	
	function get_course ($link, $course_id) {
		// get information from database
		$sql = "SELECT * 
				FROM Course
				WHERE course_id = $course_id";
		$result = mysql_query($sql)or die(mysql_error());
		
		// return information
		return $result;
	}
	
	function get_course_designation($link, $courseResult) {
		// parse information
		$row = mysql_fetch_array($courseResult);
		$designation = $row['designation'];
		
		// return result
		return $designation;
	}
	
	function get_course_name($link, $courseResult) {
		// parse information
		$row = mysql_fetch_array($courseResult);
		$name = $row['name'];
		
		// return result
		return $name;
	}
	
    function get_course_info($link, $course_id, $request) {
        // retrieve the desired semester from the database
        $query = get_course($link, $course_id);
        $row = mysql_fetch_array($query);
        
        // parse the requested information
        switch($request) {
            case 'student_id':
                $result = $row['student_id'];
                break;
            case 'semester_id':
                $result = $row['semester_id'];
                break;
            case 'course_id':
                $result = $row['course_id'];
                break;
            case 'designation':
                $result = $row['designation'];
                break;
            case 'name':
                $result = $row['name'];
                break;
            case 'credits':
                $result = $row['credits'];
                break;
            case 'grade':
                $result = $row['grade'];
                break;
            default:
                $result = NULL;
                break;
        }
        
        // return the requested information
        return $result;    
    }
	
    
	// Get Assignment Information Functions
	function get_assignments_all ($link) {
		// get information from database
		$sql = "SELECT * 
				FROM Assignment";
		$result = mysql_query($sql)or die(mysql_error());
		
		// return information
		return $result;
	}
	
	function get_assignments_student($link, $student_id) {
		// get assignments from database
		$sql = "SELECT * 
				FROM Assignment 
				WHERE student_id = $student_id 
				ORDER BY due_date";
		$result = mysql_query($sql)or die(mysql_error());
		
		// return results
		return $result;
	}

	function get_assignments_semester($link, $semester_id) {
		// get assignments from database
		$sql = "SELECT * 
				FROM Assignment 
				WHERE semester_id = $semester_id 
				ORDER BY due_date";
		$result = mysql_query($sql)or die(mysql_error());
		
		// return results
		return $result;
	}
	
	function get_assignments_course($link, $course_id) {
		// get assignments from database
		$sql = "SELECT * 
				FROM Assignment 
				WHERE course_id = $course_id
				ORDER BY due_date";
		$result = mysql_query($sql)or die(mysql_error());
		
		// return results
		return $result;
	}

    function get_assignment($link, $assignment_id) {
        // get information from database
		$sql = "SELECT * 
				FROM Assignment
				WHERE assignment_id = $assignment_id";
		$result = mysql_query($sql)or die(mysql_error());
		
		// return information
		return $result;
    }
    
	function get_assignments_info($link, $assignment_id, $request) {
        // retrieve the desired semester from the database
        $query = get_assignment($link, $assignment_id);
        $row = mysql_fetch_array($query);
        
        // parse the requested information
        switch($request) {
            case 'student_id':
                $result = $row['student_id'];
                break;
            case 'semester_id':
                $result = $row['semester_id'];
                break;
            case 'course_id':
                $result = $row['course_id'];
                break;
            case 'assignment_id':
                $result = $row['assignment_id'];
                break;
            case 'assignment_type':
                $result = $row['assignment_type'];
                break;
            case 'name':
                $result = $row['name'];
                break;
            case 'due_date':
                $result = $row['due_date'];
                break;
            case 'studytime':
                $result = $row['studytime'];
                break;
            case 'points_allowed':
                $result = $row['points_allowed'];
                break;
            case 'points_received':
                $result = $row['points_received'];
                break;
            default:
                $result = NULL;
                break;
        }
        
        // return the requested information
        return $result;    
    }
	
?>
