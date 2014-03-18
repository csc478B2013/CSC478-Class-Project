/*
	This is the class used to connect to the assignment table and provide methods for accessing the table
*/
<?php
include_once 'DAO.php';
require_once('Assignment.php');
require_once('Course.php');
require_once('Semester.php');
require_once('SemesterDAO.php');
require_once('Student.php');
require_once('StudentDAO.php');

class AssignmentDAO extends DAO
{
	private static $ErrorForNotValidSemesterObject 		= "Not a Valid Semester Object";
	private static $ErrorForNotValidStudentObject 		= "Not a Valid Student Object";
	private static $ErrorForNotValidCourseObject 		= "Not a Valid Course Object";
	private static $ErrorForNotValidAssignmentObject 	= "Not a Valid Assignment Object";
	private static $ErrorPDOException 					= "Error: %s";
	private static $ErrorForInvalidId 					= "Invaild Id";
	private static $ErrorForInvalidEmail 				= "Invaild Email";
	
	private static $NameOfDatabase 			= "Assignment";
	private static $SemesterNameOfDatabase 	= "Semester";
	private static $StudentNameOfDatabase 	= "Student";
	
	//strings for SQL statement
	//
	private static $SQLAddStatement 					= "insert into assignment (student_id, semester_id, course_id, assignment_type, name, due_date, studytime, points_allowed, points_recieved) values ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')";
	private static $SQLLoadAllStatement 				= "select * from assignment";
	private static $SQLLoadByIdStatement				= "select * from assignment where assignment_id = '%s'";
	private static $SQLLoadByCourseIdStatement			= "select * from assignment where course_id = '%s'";
	private static $SQLLoadByStudentIdStatement			= "select * from assignment where student_id = '%s'";
	private static $SQLLoadBySemesterIdStatement		= "select * from assignment where semester_id = '%s'";
	private static $SQLDeleteStatement 					= "delete from assignment where assignment_id = '%s' ";
	private static $SQLUpdateStatement 					= "update assignment set student_id='%s', semester_id='%s', course_id='%s', assignment_type='%s', name='%s', due_date='%s', studytime='%s', points_allowed='%s', points_recieved='%s' where assignment_id = %s";
	private static $SQLLoadByCourseIdAndDateStatement	= "select * from assignment where course_id = '%s' and due_date >= '%s' and due_date <= '%s'";
	
	/*
		This method allows us to add a new assignment
		Takes a assignment object and adds it to the database
	*/
	public static function addNew($passedAssignment)
	{
		//ok lets  check to see what class we are getting and make sure it is the course class
		//
		if(get_class($passedAssignment) == "Assignment")
		{
			try
			{
				//set up database connection
				//
				$databaseConnection = self::getDataBaseConnection();
				
				//prep our sql statment to add to the course database
				//
				$sqlStatement = sprintf(self::$SQLAddStatement, $passedAssignment->getStudentId(), 	
										$passedAssignment->getSemesterId(),$passedAssignment->getCourseId(),
										$passedAssignment->getAssignmentType(),$passedAssignment->getName(),
										$passedAssignment->getDueDate(),$passedAssignment->getStudyTime(),
										$passedAssignment->getPointsAllowed(),$passedAssignment->getPointsRecieved());
				try
				{
					//ok now here we go with the transaction
					//
					$databaseConnection->beginTransaction();
					$result = $databaseConnection->exec($sqlStatement);
					$passedAssignment->setAssignmentId($databaseConnection->lastInsertId());
					$databaseConnection->commit();
				}
				catch(PDOException $e)
				{
					$databaseConnection->rollback();
					sprintf(self::$ErrorPDOException,$e->getMessage());
				}
				
				$databaseConnection = null;
			}
			catch(PDOException $e)
			{
				sprintf(self::$ErrorPDOException,$e->getMessage());
			}
		}
		else
		{
			throw new InvalidArgumentException(self::$ErrorForNotValidAssignmentObject);
		}
		
		return $passedAssignment;
	}
	
	/*
		This method allows us to get all of the assignments in a database
	*/
	public static function loadAll()
	{
		//set up database connection
		//
		$databaseConnection = self::getDataBaseConnection();
			
		//prep our sql statment load all from the semester database
		//
		$sqlStatement = self::$SQLLoadAllStatement;
			
		$result = $databaseConnection->query($sqlStatement);
		
		$listOfAssignments = $result->fetchALL(PDO::FETCH_CLASS, self::$NameOfDatabase);
		
		$databaseConnection = null;
		return $listOfAssignments;
	}
	
	/*
		This method allows us to load a assignment by the assignment id
	*/
	public static function loadById($passedId)
	{
		//ok make sure that we check the id param
		//
		if ($passedId == null or $passedId == "")
		{
			throw new InvalidArgumentException(self::$ErrorForInvalidId);
		}
			
		try
		{
			//set up database connection
			//
			$databaseConnection = self::getDataBaseConnection();
			
			//prep our sql statment load all from the assignment database
			//
			$sqlStatement = sprintf(self::$SQLLoadByIdStatement, $passedId);
			
			$result = $databaseConnection->query($sqlStatement);
			
			$assignment = $result->fetchALL(PDO::FETCH_CLASS, self::$NameOfDatabase);
		}
		catch(PDOException $e)
		{
			sprintf(self::$ErrorPDOException,$e->getMessage());	
		}
		
		$databaseConnection = null;
		return $assignment[0];
	}
	
	/*
		This method allows us to update a assignment
	*/
	public static function update($passedAssignment)
	{
		//ok lets  check to see what class we are getting and make sure it is the course class
		//
		if(get_class($passedAssignment) == "Assignment")
		{
			try
			{
				//set up database connection
				//
				$databaseConnection = self::getDataBaseConnection();

				//prep our sql statment load all from the course database
				//
				$sqlStatement = sprintf(self::$SQLUpdateStatement, $passedAssignment->getStudentId(), 	
										$passedAssignment->getSemesterId(),$passedAssignment->getCourseId(),
										$passedAssignment->getAssignmentType(),$passedAssignment->getName(),
										$passedAssignment->getDueDate(),$passedAssignment->getStudyTime(),
										$passedAssignment->getPointsAllowed(),$passedAssignment->getPointsRecieved(),
										$passedAssignment->getAssignmentId());				

				$result = $databaseConnection->query($sqlStatement);
			}
			catch(PDOException $e)
			{
				print "Exception" . $e->getMessage();
				sprintf(self::$ErrorPDOException,$e->getMessage());	
			}
		}
		else
		{
			throw new InvalidArgumentException(self::$ErrorForNotValidAssignmentObject);
		}
		
		$databaseConnection = null;
		return $passedAssignment;
	}
	
	/*
		This method allows us to delete a course by the course id
	*/
	public static function delete($passedAssignment)
	{
		//ok lets  check to see what class we are getting and make sure it is the course class
		//
		if(get_class($passedAssignment) == "Assignment")
		{
			//set up database connection
			//
			$databaseConnection = self::getDataBaseConnection();
			
			//prep our sql statment load all from the course database
			//
			$sqlStatement = sprintf(self::$SQLDeleteStatement, $passedAssignment->getAssignmentId());
			$databaseConnection->query($sqlStatement);
		}
		else
		{
			throw new InvalidArgumentException(self::$ErrorForNotValidSemesterObject);
		}
		
		$databaseConnection = null;
		return $passedAssignment;
	}
	

	/*
		This method allows us to get assignments based on student id
	*/
	public static function findAllAssignmentsByStudentId($passedStudentId)
	{
		//ok make sure that we check the id param
		//
		if ($passedStudentId == null or $passedStudentId == "")
		{
			throw new InvalidArgumentException(self::$ErrorForInvalidId);
		}
			
		try
		{
			//set up database connection
			//
			$databaseConnection = self::getDataBaseConnection();
			
			//call out to the student dao for the student id
			//
			$student = StudentDAO::loadById($passedStudentId);
			
			//prep our sql statment load all from the semester database
			//		
			$sqlStatement = sprintf(self::$SQLLoadByStudentIdStatement, $student->getStudentId());
			$result = $databaseConnection->query($sqlStatement);
			$course = $result->fetchALL(PDO::FETCH_CLASS, self::$NameOfDatabase);
		}
		catch(PDOException $e)
		{
			sprintf(self::$ErrorPDOException,$e->getMessage());	
		}
		
		$databaseConnection = null;
		return $course;
	}
	
	/*
		This method allows us to get assignment based on semester id
	*/
	public static function findAllAssignmentsBySemesterId($passedSemesterId)
	{
		//ok make sure that we check the id param
		//
		if ($passedSemesterId == null or $passedSemesterId == "")
		{
			throw new InvalidArgumentException(self::$ErrorForInvalidId);
		}
			
		try
		{
			//set up database connection
			//
			$databaseConnection = self::getDataBaseConnection();
			
			//call out to the semester dao for the semester id
			//
			$semester = SemesterDAO::loadById($passedSemesterId);
			
			//prep our sql statment load all from the semester database
			//		
			$sqlStatement = sprintf(self::$SQLLoadBySemesterIdStatement, $semester->getSemesterId());
			$result = $databaseConnection->query($sqlStatement);
			$course = $result->fetchALL(PDO::FETCH_CLASS, self::$NameOfDatabase);
		}
		catch(PDOException $e)
		{
			sprintf(self::$ErrorPDOException,$e->getMessage());	
		}
		
		$databaseConnection = null;
		return $course;
	}
	
	
	/*
		This method allows us to get assignment based on course id
	*/
	public static function findAllAssignmentsByCourseId($passedCourseId)
	{
		//ok make sure that we check the id param
		//
		if ($passedCourseId == null or $passedCourseId == "")
		{
			throw new InvalidArgumentException(self::$ErrorForInvalidId);
		}
			
		try
		{
			//set up database connection
			//
			$databaseConnection = self::getDataBaseConnection();
			
			//call out to the semester dao for the coures id
			//
			$course = CourseDAO::loadById($passedCourseId);
			
			//prep our sql statment load all from the course database
			//		
			$sqlStatement = sprintf(self::$SQLLoadBySemesterIdStatement, $course->getCourseId());
			$result = $databaseConnection->query($sqlStatement);
			$assignment = $result->fetchALL(PDO::FETCH_CLASS, self::$NameOfDatabase);
		}
		catch(PDOException $e)
		{
			sprintf(self::$ErrorPDOException,$e->getMessage());	
		}
		
		$databaseConnection = null;
		return $assignment;
	}
	
	/*
		This method allows us to get all assignments that are due on a certain date
	*/
	public static function findAllAssignmentsByTimeFromNow($passedCourseId,$passedTimeFromNow)
	{
		//ok make sure that we check the id param
		//
		if ($passedCourseId == null or $passedCourseId == "")
		{
			throw new InvalidArgumentException(self::$ErrorForInvalidId);
		}
			
		try
		{
			//get start and end dates
			//
			$startDate = date("Y-m-d");
			$endDate = date('Y/m/d',strtotime($startDate . "+$passedTimeFromNow days"));
			
			//set up database connection
			//
			$databaseConnection = self::getDataBaseConnection();
			
			//call out to the semester dao for the coures id
			//
			$course = CourseDAO::loadById($passedCourseId);
			
			//prep our sql statment load all from the course database
			//		
			$sqlStatement = sprintf(self::$SQLLoadByCourseIdAndDateStatement, $course->getCourseId(),$startDate,$endDate);
			$result = $databaseConnection->query($sqlStatement);
			$assignment = $result->fetchALL(PDO::FETCH_CLASS, self::$NameOfDatabase);
		}
		catch(PDOException $e)
		{
			sprintf(self::$ErrorPDOException,$e->getMessage());	
		}
		
		$databaseConnection = null;
		return $assignment;
	}
	

}


?>