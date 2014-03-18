<?php

/**
	Unit tests for the Controller Class
**/
include_once 'includeUtil.php';
require_once('Controller.php');
require_once('Assignment.php');


class ControllerUnitTest extends PHPUnit_Framework_TestCase
{

	/**
		Simple test for assignment sorting by due date
	**/
	public function testSortAssignmentArrayByDueDate()
	{
		//set up vars
		//
		//set up vars for the various properties
		//
		$testStudentID1 		= '2';
		$testSemesterID1		= '2';
		$testCourseID1			= '2';
		$testAssignmentType1 	= 'quiz';
		$testName1 				= 'Software Engineering Capstone Quiz 7';
		$testDueDate1 			= '2013-02-02';
		$testStudyTime1 		= '4';
		$testPointsAllowed1 	= '5';
		$testPointsRecieved1	= '5';
		
		$testStudentID2 		= '3';
		$testSemesterID2		= '3';
		$testCourseID2			= '3';
		$testAssignmentType2 	= 'quiz';
		$testName2 				= 'Software Engineering Capstone Quiz 8';
		$testDueDate2 			= '2013-02-12';
		$testStudyTime2 		= '4';
		$testPointsAllowed2 	= '5';
		$testPointsRecieved2	= '5';

		
		//create assignment object
		//
		$assignmentTestObj1 = new Assignment();
		
		$assignmentTestObj1 ->setStudentId($testStudentID1);
		$assignmentTestObj1 ->setSemesterId($testSemesterID1);
		$assignmentTestObj1 ->setCourseId($testCourseID1);
		$assignmentTestObj1 ->setAssignmentType($testAssignmentType1);
		$assignmentTestObj1 ->setName($testName1);
		$assignmentTestObj1 ->setDueDate($testDueDate1);
		$assignmentTestObj1 ->setStudyTime($testStudyTime1);
		$assignmentTestObj1 ->setPointsAllowed($testPointsAllowed1);
		$assignmentTestObj1 ->setPointsRecieved($testPointsRecieved1);
		
		$assignmentTestObj2 = new Assignment();

		$assignmentTestObj2 ->setStudentId($testStudentID2);
		$assignmentTestObj2 ->setSemesterId($testSemesterID2);
		$assignmentTestObj2 ->setCourseId($testCourseID2);
		$assignmentTestObj2 ->setAssignmentType($testAssignmentType2);
		$assignmentTestObj2 ->setName($testName2);
		$assignmentTestObj2 ->setDueDate($testDueDate2);
		$assignmentTestObj2 ->setStudyTime($testStudyTime2);
		$assignmentTestObj2 ->setPointsAllowed($testPointsAllowed2);
		$assignmentTestObj2 ->setPointsRecieved($testPointsRecieved2);
		
		$assignmentArray = array($assignmentTestObj1,$assignmentTestObj2);
		
		//use the simple usort with a call back
		//
		usort( $assignmentArray, 'Controller::assignmentSortByDueDateCompareable' );
		
		//ok test the function
		//
		$this->assertEquals($assignmentArray[0]->getDueDate(), $testDueDate2);
		$this->assertEquals($assignmentArray[1]->getDueDate(), $testDueDate1);
	}
	
	/**
		Simple test isOnlyLetters
	**/
	public function testIsOnlyLetters()
	{
		//set up vars
		//
		$testInput1 = 'OnlyLetters';
		$testInput2 = 'Software Engineering Capstone';
		$testInput3 = '4.40';
		
		//ok test the function
		//
		$this->assertEquals(Controller::isOnlyLetters($testInput1),TRUE);
		$this->assertEquals(Controller::isOnlyLetters($testInput2),FALSE);
		$this->assertEquals(Controller::isOnlyLetters($testInput3),FALSE);

	}
	
	
	/**
		Simple test isEmail
	**/
	public function testIsEmail()
	{
		//set up vars
		//
		$testInput1 = 'foo@bar.com.co';
		$testInput2 = 'Software Engineering Capstone';
		$testInput3 = '4.40';
		
		//ok test the function
		//
		$this->assertEquals(Controller::isEmail($testInput1),TRUE);
		$this->assertEquals(Controller::isEmail($testInput2),FALSE);
		$this->assertEquals(Controller::isEmail($testInput3),FALSE);

	}
	
	/**
		Simple test isNumber
	**/
	public function testIsNumber()
	{
		//set up vars
		//
		$testInput1 = '1.2';
		$testInput2 = '6';
		$testInput3 = 'Software Engineering Capstone';
		$testInput4 = 'four1';
		
		//ok test the function
		//
		$this->assertEquals(Controller::isNumber($testInput1),TRUE);
		$this->assertEquals(Controller::isNumber($testInput2),TRUE);
		$this->assertEquals(Controller::isNumber($testInput3),FALSE);
		$this->assertEquals(Controller::isNumber($testInput4),FALSE);

	}
	
	/**
		Simple test isNumber
	**/
	public function testGeneralTextInputCleanUp()
	{
		//set up vars
		//
		$testInput1 		= 'this\./\/.os';
		$testInput1Clean 	= 'this.//.os';
		$testInput2 = 'Software Engineering Capstone';

		
		//ok test the function
		//
		$this->assertEquals(Controller::generalTextInputCleanUp($testInput1),$testInput1Clean);
		$this->assertEquals(Controller::generalTextInputCleanUp($testInput2),$testInput2);
	}
	
	/**
		Simple test isNumber
	**/
	public function testAuthenticateUser()
	{
		//set up vars
		//
		$testEmail1 	= 'joe@foo.com';
		$testPassword1 	= 'password';
		
		$testEmail2 	= 'juniper@foo.com';
		$testPassword2 	= 'what';
		
		//ok test the function
		//
		$this->assertEquals(Controller::authenticateUser($testEmail1, $testPassword1),TRUE);
		$this->assertEquals(Controller::authenticateUser($testEmail2, $testPassword2),FALSE);
	}
	
	
}





?>