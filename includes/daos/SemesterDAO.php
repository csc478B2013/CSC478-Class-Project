/*
	This is the class used to connect to the semester table and provide methods for accessing the table
*/
<?php
include_once 'DAO.php';
require_once('Semester.php');
require_once('Student.php');
require_once('StudentDAO.php');

class SemesterDAO extends DAO
{
	private static $ErrorForNotValidSemesterObject 	= "Not a Valid Semester Object";
	private static $ErrorPDOException 				= "Error: %s";
	private static $ErrorForInvalidId 				= "Invaild Id";
	private static $ErrorForInvalidEmail 			= "Invaild Email";
	private static $ErrorForInvalidPassword			= "Invaild Password";
	
	private static $NameOfDatabase 			= "Semester";
	private static $StudentNameOfDatabase 	= "Student";
	
	//strings for SQL statement
	//
	private static $SQLAddStatement 				= "insert into semester (student_id, year, term, start_date, end_date, semester_GPA, isCurrent) values ('%s', '%s', '%s', '%s', '%s', '%s', '%s')";
	private static $SQLLoadAllStatement 			= "select * from semester";
	private static $SQLLoadByIdStatement			= "select * from semester where semester_id = %s";
	private static $SQLLoadByStudentIdStatement		= "select * from semester where student_id = '%s'";
	private static $SQLCurrentByStudentIdStatement	= "select * from semester where student_id = '%s'  and isCurrent = '1'";
	private static $SQLDeleteStatement 				= "delete from semester where semester_id = %s";
	private static $SQLUpdateStatement 				= "update semester set student_id='%s', year='%s', term='%s', start_date='%s', end_date='%s', semester_GPA='%s', isCurrent='%s' where semester_id = %s";
	
	/*
		This method allows us to add a new semester
		Takes a semester object and adds it to the database
	*/
	public static function addNew($passedSemester)
	{
		//ok lets  check to see what class we are getting and make sure it is the semester class
		//
		if(get_class($passedSemester) == "Semester")
		{
			try
			{
				//set up database connection
				//
				$databaseConnection = self::getDataBaseConnection();
				
				//prep our sql statment to add to the semester database
				//
				$sqlStatement = sprintf(self::$SQLAddStatement, $passedSemester->getStudentId(), $passedSemester->getYear(),
										$passedSemester->getTerm(), $passedSemester->getStartDate(),$passedSemester->getEndDate(),
										 $passedSemester->getSemesterGPA(), $passedSemester->getIsCurrent());
				try
				{
					//ok now here we go with the transaction
					//
					$databaseConnection->beginTransaction();
					$result = $databaseConnection->exec($sqlStatement);
					$passedSemester->setSemesterId($databaseConnection->lastInsertId());
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
		
		return $passedSemester;
	}
	
	/*
		This method allows us to get all of the semesters in a database
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
		
		$listOfSemesters = $result->fetchALL(PDO::FETCH_CLASS, self::$NameOfDatabase);
		
		$databaseConnection = null;
		return $listOfSemesters;
	}
	
	/*
		This method allows us to load a semester by the semester id
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
			
			//prep our sql statment load all from the semester database
			//
			$sqlStatement = sprintf(self::$SQLLoadByIdStatement, $passedId);
			
			$result = $databaseConnection->query($sqlStatement);
			
			$semester = $result->fetchALL(PDO::FETCH_CLASS, self::$NameOfDatabase);
		}
		catch(PDOException $e)
		{
			sprintf(self::$ErrorPDOException,$e->getMessage());	
		}
		
		$databaseConnection = null;
		return $semester[0];
	}
	
	/*
		This method allows us to update a semester
	*/
	public static function update($passedSemester)
	{
		//ok lets  check to see what class we are getting and make sure it is the semester class
		//
		if(get_class($passedSemester) == "Semester")
		{
			try
			{
				//set up database connection
				//
				$databaseConnection = self::getDataBaseConnection();

				//prep our sql statment load all from the student database
				//
				$sqlStatement = sprintf(self::$SQLUpdateStatement, $passedSemester->getStudentId(), 	
										$passedSemester->getYear(),$passedSemester->getTerm(),$passedSemester->getStartDate(),
										 $passedSemester->getEndDate(),$passedSemester->getSemesterGPA()
										,$passedSemester->getIsCurrent(),$passedSemester->getSemesterId());

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
		return $passedSemester;
	}
	
	/*
		This method allows us to delete a semester by the semester id
	*/
	public static function delete($passedSemester)
	{
		//ok lets  check to see what class we are getting and make sure it is the semester class
		//
		if(get_class($passedSemester) == "Semester")
		{
			//set up database connection
			//
			$databaseConnection = self::getDataBaseConnection();
			
			//prep our sql statment load all from the semester database
			//
			$sqlStatement = sprintf(self::$SQLDeleteStatement, $passedSemester->getSemesterId());
			$databaseConnection->query($sqlStatement);
		}
		else
		{
			throw new InvalidArgumentException(self::$ErrorForNotValidSemesterObject);
		}
		
		$databaseConnection = null;
		return $passedSemester;
	}
	

	/*
		This method allows us to get semesters based on user name
	*/
	public static function findAllSemestersByStudentEmail($passedStudentEmail)
	{
		//ok make sure that we check the id param
		//
		if ($passedStudentEmail == null or $passedStudentEmail == "")
		{
			throw new InvalidArgumentException(self::$ErrorForInvalidEmail);
		}
			
		try
		{
			//set up database connection
			//
			$databaseConnection = self::getDataBaseConnection();
			
			//call out to the student dao for the student id
			//
			$student = StudentDAO::loadByEmail($passedStudentEmail);
			
			//prep our sql statment load all from the semester database
			//		
			$sqlStatement = sprintf(self::$SQLLoadByStudentIdStatement, $student->getStudentId());
			$result = $databaseConnection->query($sqlStatement);
			$semester = $result->fetchALL(PDO::FETCH_CLASS, self::$NameOfDatabase);
		}
		catch(PDOException $e)
		{
			sprintf(self::$ErrorPDOException,$e->getMessage());	
		}
		
		$databaseConnection = null;
		return $semester;
	}
	
	/*
		This method allows us to get semesters based on student id
	*/
	public static function findAllSemestersByStudentId($passedStudentId)
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
			$semester = $result->fetchALL(PDO::FETCH_CLASS, self::$NameOfDatabase);
		}
		catch(PDOException $e)
		{
			sprintf(self::$ErrorPDOException,$e->getMessage());	
		}
		
		$databaseConnection = null;
		return $semester;
	}
	
	
	
	/*
		This method allows us to load the current semester by the student id
	*/
	public static function loadCurrentSemesterByStudentId($passedStudentId)
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
			$sqlStatement = sprintf(self::$SQLCurrentByStudentIdStatement, $student->getStudentId());
			
			$result = $databaseConnection->query($sqlStatement);
			
			$semester = $result->fetchALL(PDO::FETCH_CLASS, self::$NameOfDatabase);
		}
		catch(PDOException $e)
		{
			sprintf(self::$ErrorPDOException,$e->getMessage());	
		}
		
		$databaseConnection = null;
		return $semester[0];
	}
	
	/*
		This method allows us to load the current semester by the student email
	*/
	public static function loadCurrentSemesterByStudentEmail($passedStudentEmail)
	{
		//ok make sure that we check the id param
		//
		if ($passedStudentEmail == null or $passedStudentEmail == "")
		{
			throw new InvalidArgumentException(self::$ErrorForInvalidEmail);
		}
			
		try
		{
			//set up database connection
			//
			$databaseConnection = self::getDataBaseConnection();
			
			//call out to the student dao for the student id
			//
			$student = StudentDAO::loadByEmail($passedStudentEmail);
			
			//prep our sql statment load all from the semester database
			//
			$sqlStatement = sprintf(self::$SQLCurrentByStudentIdStatement, $student->getStudentId());
			
			$result = $databaseConnection->query($sqlStatement);
			
			$semester = $result->fetchALL(PDO::FETCH_CLASS, self::$NameOfDatabase);
		}
		catch(PDOException $e)
		{
			sprintf(self::$ErrorPDOException,$e->getMessage());	
		}
		
		$databaseConnection = null;
		return $semester[0];
	}

}


?>