/*
	This is the class used to connect to the student table and provide methods for accessing the table
*/
<?php
include_once 'DAO.php';
require_once('Student.php');

class StudentDAO extends DAO
{
	private static $ErrorForNotValidStudentObject 	= "Not a Valid Student Object";
	private static $ErrorPDOException 				= "Error: %s";
	private static $ErrorForInvalidId 				= "Invaild Id";
	private static $ErrorForInvalidEmail 			= "Invaild Email";
	private static $ErrorForInvalidPassword			= "Invaild Password";
	
	private static $NameOfDatabase = "Student";
	
	//strings for SQL statement
	//
	private static $SQLAddStatement 			= "insert into student (fname, email, phone, password) values ('%s', '%s', '%s', '%s')";
	private static $SQLLoadAllStatement 		= "select * from student";
	private static $SQLLoadByIdStatement		= "select * from student where student_id = %s";
	private static $SQLLoadByEmailStatement		= "select * from student where email = '%s'";
	private static $SQLDeleteStatement 			= "delete from student where student_id = %s";
	private static $SQLUpdateStatement 			= "update student set fname='%s', email='%s', phone='%s', password='%s' where student_id = %s";
	
	/*
		This method allows us to add a new student
		Takes a stundent object and adds it to the database
	*/
	public static function addNew($passedStudent)
	{
		//ok lets  check to see what class we are getting and make sure it is the student class
		//
		if(get_class($passedStudent) == "Student")
		{
			try
			{
				//set up database connection
				//
				$databaseConnection = self::getDataBaseConnection();
				
				//prep our sql statment to add to the student database
				//
				$sqlStatement = sprintf(self::$SQLAddStatement, $passedStudent->getStudentFirstName(), $passedStudent->getEmail(),
										$passedStudent->getPhoneNumber(), $passedStudent->getHashedPassword());
				try
				{
					//ok now here we go with the transaction
					//
					$databaseConnection->beginTransaction();
					$result = $databaseConnection->exec($sqlStatement);
					$passedStudent->setStudentId($databaseConnection->lastInsertId());
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
			throw new InvalidArgumentException(self::$ErrorForNotValidStudentObject);
		}
		
		return $passedStudent;
	}
	
	/*
		This method allows us to get all of the students in a database
	*/
	public static function loadAll()
	{
		//set up database connection
		//
		$databaseConnection = self::getDataBaseConnection();
			
		//prep our sql statment load all from the student database
		//
		$sqlStatement = self::$SQLLoadAllStatement;
			
		$result = $databaseConnection->query($sqlStatement);
		
		$listOfStudents = $result->fetchALL(PDO::FETCH_CLASS, self::$NameOfDatabase);
		
		$databaseConnection = null;
		return $listOfStudents;
	}
	
	/*
		This method allows us to load a student by the student id
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
			
			$student = $result->fetchALL(PDO::FETCH_CLASS, self::$NameOfDatabase);
		}
		catch(PDOException $e)
		{
			sprintf(self::$ErrorPDOException,$e->getMessage());	
		}
		
		$databaseConnection = null;
		return $student[0];
	}
	
	/*
		This method allows us to load a student by the student email
	*/
	public static function loadByEmail($passedEmail)
	{
		//ok make sure that we check the passedEmail param
		//
		if ($passedEmail == null or $passedEmail == "")
		{
			throw new InvalidArgumentException(self::$ErrorForInvalidEmail);
		}
			
		try
		{
			//set up database connection
			//
			$databaseConnection = self::getDataBaseConnection();
			
			//prep our sql statment load all from the student database
			//
			$sqlStatement = sprintf(self::$SQLLoadByEmailStatement, $passedEmail);
			
			$result = $databaseConnection->query($sqlStatement);
			
			$student = $result->fetchALL(PDO::FETCH_CLASS, self::$NameOfDatabase);
		}
		catch(PDOException $e)
		{
			sprintf(self::$ErrorPDOException,$e->getMessage());	
		}
		
		$databaseConnection = null;
		return $student[0];
	}
	
	
	/*
		This method allows us to update a student
	*/
	public static function update($passedStudent)
	{
		//ok lets  check to see what class we are getting and make sure it is the student class
		//
		if(get_class($passedStudent) == "Student")
		{
			try
			{
				//set up database connection
				//
				$databaseConnection = self::getDataBaseConnection();

				//prep our sql statment load all from the student database
				//
				$sqlStatement = sprintf(self::$SQLUpdateStatement, $passedStudent->getStudentFirstName(), 	
										$passedStudent->getEmail(),$passedStudent->getPhoneNumber(),
										 $passedStudent->getHashedPassword(),$passedStudent->getStudentId());

				$result = $databaseConnection->query($sqlStatement);
			}
			catch(PDOException $e)
			{
				sprintf(self::$ErrorPDOException,$e->getMessage());	
			}
		}
		else
		{
			throw new InvalidArgumentException(self::$ErrorForNotValidStudentObject);
		}
		
		$databaseConnection = null;
		return $passedStudent;
	}
	
	/*
		This method allows us to delete a student by the student id
	*/
	public static function delete($passedStudent)
	{
		//ok lets  check to see what class we are getting and make sure it is the student class
		//
		if(get_class($passedStudent) == "Student")
		{
			//set up database connection
			//
			$databaseConnection = self::getDataBaseConnection();
			
			//prep our sql statment load all from the student database
			//
			$sqlStatement = sprintf(self::$SQLDeleteStatement, $passedStudent->getStudentId());
			$databaseConnection->query($sqlStatement);
		}
		else
		{
			throw new InvalidArgumentException(self::$ErrorForNotValidStudentObject);
		}
		
		$databaseConnection = null;
		return $passedStudent;
	}
	
	
	/*
		This method allows us to check if a user is a member of a database
	*/
	public static function doesEmailExist($passedEmail)
	{
		//set up our boolean if the email exists in our dataabase
		//
		$emailExistInDB = False;
		
		//ok make sure that we check the email param
		//
		if ($passedEmail == null or $passedEmail == "")
		{
			throw new InvalidArgumentException(self::$ErrorForInvalidEmail);
		}
			
		try
		{
			//set up database connection
			//
			$databaseConnection = self::getDataBaseConnection();
			
			//prep our sql statment load all from the student database
			//
			$sqlStatement = sprintf(self::$SQLLoadByEmailStatement, $passedEmail);
			
			$result = $databaseConnection->query($sqlStatement);
			
			$student = $result->fetchALL(PDO::FETCH_CLASS, self::$NameOfDatabase);
			
			//check if we have anything
			//
			if(sizeOf($student) > 0)
			{
				$emailExistInDB = True;
			}
		}
		catch(PDOException $e)
		{
			sprintf(self::$ErrorPDOException,$e->getMessage());	
		}
		
		$databaseConnection = null;
		return $emailExistInDB;
	}
	
	/*
		This method allows us to check if a user email and password match
	*/
	public static function isPasswordValid($passedEmail, $passedPassword)
	{
		//set up our boolean if the password is valid
		//
		$isPasswordValid = False;
		
		//ok make sure that we check the email param
		//
		if ($passedEmail == null or $passedEmail == "")
		{
			throw new InvalidArgumentException(self::$ErrorForInvalidEmail);
		}
		
		//ok make sure that we check the password param
		//
		if ($passedPassword == null or $passedPassword == "")
		{
			throw new InvalidArgumentException(self::$ErrorForInvalidPassword);
		}
			
		try
		{
			//set up database connection
			//
			$databaseConnection = self::getDataBaseConnection();
			
			//prep our sql statment load all from the student database
			//
			$sqlStatement = sprintf(self::$SQLLoadByEmailStatement, $passedEmail);
			
			$result = $databaseConnection->query($sqlStatement);
			
			$student = $result->fetchALL(PDO::FETCH_CLASS, self::$NameOfDatabase);
			
			//check if the password mactch
			//
			if(strcmp($student[0]->getHashedPassword(), $passedPassword) == 0)
			{
				$isPasswordValid = True;
			}
		}
		catch(PDOException $e)
		{
			sprintf(self::$ErrorPDOException,$e->getMessage());	
		}
		
		$databaseConnection = null;
		return $isPasswordValid;
	}

}


?>