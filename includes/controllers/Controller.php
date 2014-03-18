/*
	This is the base class for all of the controller objects
*/
<?php
include_once 'includeUtil.php'; 
require_once('StudentDAO.php');
require_once('Assignment.php');

class Controller 
{
	//set up our constants here
	//
	private static $BadAuthRedirectLink = "../default.php";
	private static $NameOfSecurityCookie = "UserIdent";
	private static $ExpirationTimeOfSecurityCookie = 604800; 
	private static $ErrorForNotValidAssignmentObject 	= "Not a Valid Assignment Object";
	
	/*
		Utility Methods
	*/
	
	/*
		Method for comparing assignment due dates
	*/
	public static function assignmentSortByDueDateCompareable($passedAssignmentA, $passedAssignmentB) 
	{
		if((get_class($passedAssignmentA) == "Assignment") && (get_class($passedAssignmentB) == "Assignment"))
		{

			if ($passedAssignmentA->getDueDate() == $passedAssignmentB->getDueDate()) return 0;
				    return (strtotime($passedAssignmentA->getDueDate()) < strtotime($passedAssignmentB->getDueDate())) ? 1 : -1;
		}
		else
		{
				throw new InvalidArgumentException(self::$ErrorForNotValidAssignmentObject);
		}
	}

	
	
	/*
		Check if a cookie exists with a numeric value return true if so return false if not
		SIDE NOTE: THIS IS SHITTY SECURITY BUT THIS IS A CLASS PROJECT SO WE NEED TO FOCUS ON OTHER ASPECTS OF THE CODE
		TODO: Fix this weak security
	*/
	public static function authenticateUserCookie()
	{
		if (!isset($_COOKIE[self::$NameOfSecurityCookie]))
		{
			header("Location: http://" . self::$BadAuthRedirectLink);
			exit();
		}	
	}
	
	/*
		Check if user email and password pair match
		SIDE NOTE: THIS IS SHITTY SECURITY BUT THIS IS A CLASS PROJECT SO WE NEED TO FOCUS ON OTHER ASPECTS OF THE CODE
		TODO: Fix this weak security
	*/
	public static function authenticateUser($passedEmail, $passedPassword)
	{
		$isAuthenticatedUser = FALSE;
		
		//first lets see if the email and password pair match
		//
		if(StudentDAO::isPasswordValid($passedEmail, $passedPassword))
		{
			//ok so we are good
			//
			$studentObj = StudentDAO::loadByEmail($passedEmail);			
			$isAuthenticatedUser = TRUE;
		}
		
		return $isAuthenticatedUser;
	}
	
	/*
		Check if user email and password pair match
		SIDE NOTE: THIS IS SHITTY SECURITY BUT THIS IS A CLASS PROJECT SO WE NEED TO FOCUS ON OTHER ASPECTS OF THE CODE
		TODO: Fix this weak security
	*/
	public static function authenticateUserWithCookie($passedEmail, $passedPassword)
	{
		$isAuthenticatedUser = FALSE;
		
		//first lets see if the email and password pair match
		//
		if(StudentDAO::isPasswordValid($passedEmail, $passedPassword))
		{
			//ok so we are good here so now lets set up the cookie
			//
			$studentObj = StudentDAO::loadByEmail($passedEmail);
			
			setcookie(self::$NameOfSecurityCookie, $studentObj->getStudentId(), self::$ExpirationTimeOfSecurityCookie);
			
			$isAuthenticatedUser = TRUE;
		}
		
		return $isAuthenticatedUser;
	}
	
	
	/*
		Cleans up any input for a form feild
	*/
	public static function generalTextInputCleanUp($passedFormString)
	{
		$passedFormString = trim($passedFormString);
		$passedFormString = stripslashes($passedFormString);
		$passedFormString = htmlspecialchars($passedFormString);
		return $passedFormString;
	}
	
	
	/*
		Methods for input validation returns true if ok and returns false if an error
	*/
	
	/*
		check if the passed in item is a number
	*/
	public static function isNumber($passedNumber)
	{
		$isNumber = FALSE;
		
		if($passedNumber > 0)
		{
			$isNumber = TRUE;
		}
		
		return $isNumber;	
	}
	
	/*
		Function to check if the email is valid
	*/
	public static function isEmail($passedEmail)
	{
		$isEmail = FALSE;
		
		if(preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $passedEmail))
		{
			$isEmail = TRUE;
		}
		
		return $isEmail;
	}
	
	/*
		Function to check if there is only alpha characters in string
	*/
	public static function isOnlyLetters($passedText)
	{
		$isOnlyLetters = FALSE;
		
		if (preg_match("/^[a-zA-Z]*$/",$passedText))
		{
			$isOnlyLetters = TRUE;
		}
		
		return $isOnlyLetters;
	}
}



?>