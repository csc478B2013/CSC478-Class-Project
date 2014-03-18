/*
	This is the class used to connect to the course table and provide methods for accessing the table
*/
<?php
include_once 'DAO.php';
require_once('Course.php');
require_once('Semester.php');
require_once('SemesterDAO.php');
require_once('Student.php');
require_once('StudentDAO.php');

class CourseDAO extends DAO
{
	private static $ErrorForNotValidSemesterObject 	= "Not a Valid Semester Object";
	private static $ErrorForNotValidStudentObject 	= "Not a Valid Student Object";
	private static $ErrorPDOException 				= "Error: %s";
	private static $ErrorForInvalidId 				= "Invaild Id";
	private static $ErrorForInvalidEmail 			= "Invaild Email";
	
	private static $NameOfDatabase 			= "Course";
	private static $SemesterNameOfDatabase 	= "Semester";
	private static $StudentNameOfDatabase 	= "Student";
	
	//strings for SQL statement
	//
	private static $SQLAddStatement 				= "insert into course (student_id, semester_id, designation, name, credits, grade) values ('%s', '%s', '%s', '%s', '%s', '%s')";
	private static $SQLLoadAllStatement 			= "select * from course";
	private static $SQLLoadByIdStatement			= "select * from course where course_id = '%s'";
	private static $SQLLoadByStudentIdStatement		= "select * from course where student_id = '%s'";
	private static $SQLLoadBySemesterIdStatement	= "select * from course where semester_id = '%s'";
	private static $SQLDeleteStatement 				= "delete from course where course_id = '%s' ";
	private static $SQLUpdateStatement 				= "update course set student_id='%s', semester_id='%s', designation='%s', name='%s', credits='%s', grade='%s' where course_id = %s";
	
	/*
		This method allows us to add a new course
		Takes a course object and adds it to the database
	*/
	public static function addNew($passedCourse)
	{
		//ok lets  check to see what class we are getting and make sure it is the course class
		//
		if(get_class($passedCourse) == "Course")
		{
			try
			{
				//set up database connection
				//
				$databaseConnection = self::getDataBaseConnection();
				
				//prep our sql statment to add to the course database
				//
				$sqlStatement = sprintf(self::$SQLAddStatement, $passedCourse->getStudentId(), 	
										$passedCourse->getSemesterId(),$passedCourse->getDesignation(),$passedCourse->getName(),
										 $passedCourse->getCredits(),$passedCourse->getGrade());
				try
				{
					//ok now here we go with the transaction
					//
					$databaseConnection->beginTransaction();
					$result = $databaseConnection->exec($sqlStatement);
					$passedCourse->setCourseId($databaseConnection->lastInsertId());
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
			throw new InvalidArgumentException(self::$ErrorForNotValidSemesterObject);
		}
		
		return $passedCourse;
	}
	
	/*
		This method allows us to get all of the courses in a database
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
		
		$listOfCourses = $result->fetchALL(PDO::FETCH_CLASS, self::$NameOfDatabase);
		
		$databaseConnection = null;
		return $listOfCourses;
	}
	
	/*
		This method allows us to load a course by the course id
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
			
			//prep our sql statment load all from the course database
			//
			$sqlStatement = sprintf(self::$SQLLoadByIdStatement, $passedId);
			
			$result = $databaseConnection->query($sqlStatement);
			
			$course = $result->fetchALL(PDO::FETCH_CLASS, self::$NameOfDatabase);
		}
		catch(PDOException $e)
		{
			sprintf(self::$ErrorPDOException,$e->getMessage());	
		}
		
		$databaseConnection = null;
		return $course[0];
	}
	
	/*
		This method allows us to update a course
	*/
	public static function update($passedCourse)
	{
		//ok lets  check to see what class we are getting and make sure it is the course class
		//
		if(get_class($passedCourse) == "Course")
		{
			try
			{
				//set up database connection
				//
				$databaseConnection = self::getDataBaseConnection();

				//prep our sql statment load all from the course database
				//
				$sqlStatement = sprintf(self::$SQLUpdateStatement, $passedCourse->getStudentId(), 	
										$passedCourse->getSemesterId(),$passedCourse->getDesignation(),$passedCourse->getName(),
										 $passedCourse->getCredits(),$passedCourse->getGrade(),
										$passedCourse->getCourseId());				

				$result = $databaseConnection->query($sqlStatement);
			}
			catch(PDOException $e)
			{
				sprintf(self::$ErrorPDOException,$e->getMessage());	
			}
		}
		else
		{
			throw new InvalidArgumentException(self::$ErrorForNotValidSemesterObject);
		}
		
		$databaseConnection = null;
		return $passedCourse;
	}
	
	/*
		This method allows us to delete a course by the course id
	*/
	public static function delete($passedCourse)
	{
		//ok lets  check to see what class we are getting and make sure it is the course class
		//
		if(get_class($passedCourse) == "Course")
		{
			//set up database connection
			//
			$databaseConnection = self::getDataBaseConnection();
			
			//prep our sql statment load all from the course database
			//
			$sqlStatement = sprintf(self::$SQLDeleteStatement, $passedCourse->getCourseId());
			$databaseConnection->query($sqlStatement);
		}
		else
		{
			throw new InvalidArgumentException(self::$ErrorForNotValidSemesterObject);
		}
		
		$databaseConnection = null;
		return $passedCourse;
	}
	

	/*
		This method allows us to get courses based on student id
	*/
	public static function findAllCoursesByStudentId($passedStudentId)
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
			
			//prep our sql statment load all from the course database
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
		This method allows us to get course based on semester id
	*/
	public static function findAllCoursesBySemesterId($passedSemesterId)
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
			
			//call out to the semester dao for the student id
			//
			$semester = SemesterDAO::loadById($passedSemesterId);
			
			//prep our sql statment load all from the course database
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
	

}


?>