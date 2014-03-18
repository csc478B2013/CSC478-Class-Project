/*
	This is the class used to connect to the student settings table and provide methods for accessing the table
*/
<?php
include_once 'DAO.php';
require_once('Student_Settings.php');

class Student_SettingsDAO extends DAO
{
	private static $ErrorForNotValidStudentSettingsObject 	= "Not a Valid Student Settings Object";
	private static $ErrorPDOException 						= "Error: %s";
	private static $ErrorForInvalidId 						= "Invaild Id";
	
	private static $NameOfDatabase = "Student_Settings";
	
	//strings for SQL statement
	//
	private static $SQLAddStatement 			= "insert into student_settings (study_tod, st_exam, st_quiz, st_project, st_homework, st_discussion, st_other) values ('%s', '%s', '%s', '%s', '%s', '%s', '%s')";
	private static $SQLLoadAllStatement 		= "select * from student_settings";
	private static $SQLLoadByIdStatement		= "select * from student_settings where student_id = %s";
	private static $SQLDeleteStatement 			= "delete from student_settings where student_id = %s";
	private static $SQLUpdateStatement 			= "update student_settings set study_tod='%s', st_exam='%s', st_quiz='%s', st_project='%s', st_homework='%s', st_discussion='%s', st_other='%s' where student_id = %s";
	
	/*
		This method allows us to add a new student setting
		Takes a stundent settings object and adds it to the database
	*/
	public static function addNew($passedStudentSettings)
	{
		//ok lets  check to see what class we are getting and make sure it is the student setting class
		//
		if(get_class($passedStudentSettings) == "Student_Settings")
		{
			try
			{
				//set up database connection
				//
				$databaseConnection = self::getDataBaseConnection();
				
				//prep our sql statment to add to the student settings database
				//
				$sqlStatement = sprintf(self::$SQLAddStatement,$passedStudentSettings->getStudyTimeTimeOfDay(),$passedStudentSettings->getStudyTimeForExam(),
				 $passedStudentSettings->getStudyTimeForQuiz(),$passedStudentSettings->getStudyTimeForProject(),
			$passedStudentSettings->getStudyTimeForHomework(),$passedStudentSettings->getStudyTimeForDiscussion(),
				$passedStudentSettings->getStudyTimeForOther(),$passedStudentSettings->getStudentId());
				try
				{
					//ok now here we go with the transaction
					//
					$databaseConnection->beginTransaction();
					$result = $databaseConnection->exec($sqlStatement);
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
			throw new InvalidArgumentException(self::$ErrorForNotValidStudentSettingsObject);
		}
		
		return $passedStudentSettings;
	}
	
	/*
		This method allows us to get all of the student settings in a database
	*/
	public static function loadAll()
	{
		//set up database connection
		//
		$databaseConnection = self::getDataBaseConnection();
			
		//prep our sql statment load all from the student settings database
		//
		$sqlStatement = self::$SQLLoadAllStatement;
			
		$result = $databaseConnection->query($sqlStatement);
		
		$listOfStudentsSettings = $result->fetchALL(PDO::FETCH_CLASS, self::$NameOfDatabase);
		
		$databaseConnection = null;
		return $listOfStudentsSettings;
	}
	
	/*
		This method allows us to load a student setting by the student id
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
			
			//prep our sql statment load all from the student database
			//
			$sqlStatement = sprintf(self::$SQLLoadByIdStatement, $passedId);
			
			$result = $databaseConnection->query($sqlStatement);
			
			$studentSettings = $result->fetchALL(PDO::FETCH_CLASS, self::$NameOfDatabase);
		}
		catch(PDOException $e)
		{
			sprintf(self::$ErrorPDOException,$e->getMessage());	
		}
		
		$databaseConnection = null;
		return $studentSettings[0];
	}
	
	/*
		This method allows us to update a student settings
	*/
	public static function update($passedStudentSettings)
	{
		//ok lets  check to see what class we are getting and make sure it is the student settings class
		//
		if(get_class($passedStudentSettings) == "Student_Settings")
		{
			try
			{
				//set up database connection
				//
				$databaseConnection = self::getDataBaseConnection();

				//prep our sql statment load all from the student settings database
				//
				$sqlStatement = sprintf(self::$SQLUpdateStatement, 	
										$passedStudentSettings->getStudyTimeTimeOfDay(),$passedStudentSettings->getStudyTimeForExam(),
										 $passedStudentSettings->getStudyTimeForQuiz(),$passedStudentSettings->getStudyTimeForProject(),
									$passedStudentSettings->getStudyTimeForHomework(),$passedStudentSettings->getStudyTimeForDiscussion(),
										$passedStudentSettings->getStudyTimeForOther(),$passedStudentSettings->getStudentId());

				$result = $databaseConnection->query($sqlStatement);
			}
			catch(PDOException $e)
			{
				sprintf(self::$ErrorPDOException,$e->getMessage());	
			}
		}
		else
		{
			throw new InvalidArgumentException(self::$ErrorForNotValidStudentSettingsObject);
		}
		
		$databaseConnection = null;
		return $passedStudentSettings;
	}
	
	/*
		This method allows us to delete a student setting by the student id
	*/
	public static function delete($passedStudentSettings)
	{
		//ok lets  check to see what class we are getting and make sure it is the student setting class
		//
		if(get_class($passedStudentSettings) == "Student_Settings")
		{
			//set up database connection
			//
			$databaseConnection = self::getDataBaseConnection();
			
			//prep our sql statment load all from the student database
			//
			$sqlStatement = sprintf(self::$SQLDeleteStatement, $passedStudentSettings->getStudentId());
			$databaseConnection->query($sqlStatement);
		}
		else
		{
			throw new InvalidArgumentException(self::$ErrorForNotValidStudentSettingsObject);
		}
		
		$databaseConnection = null;
		return $passedStudentSettings;
	}
	
}


?>