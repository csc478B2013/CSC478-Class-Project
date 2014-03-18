<?php

/**
	Unit tests for the Assignment Model Class
**/
include_once 'includeUtil.php';
require_once('Assignment.php');

class AssignmentModelUnitTest extends PHPUnit_Framework_TestCase
{

	/**
		Simple test of Assignment object
	**/
	public function testAssignmentObject()
	{
		//set up vars for the various properties
		//
		$testStudentID 		= '1';
		$testSemesterID		= '1';
		$testCourseID 		= '2';
		$testAssignmentID 	= '1';
		$testAssignmentType = 'Quiz';
		$testName 			= 'Software Engineering Capstone Quiz 7';
		$testDueDate 		= '2013-01-01';
		$testStudyTime 		= '4';
		$testPointsAllowed 	= '5';
		$testPointsRecieved	= '5';

		
		//create Course object
		//
		$assignmentTestObj = new Assignment();
		
		$assignmentTestObj ->setStudentId($testStudentID);
		$assignmentTestObj ->setSemesterId($testSemesterID);
		$assignmentTestObj ->setCourseId($testCourseID);
		$assignmentTestObj ->setAssignmentId($testAssignmentID);
		$assignmentTestObj ->setAssignmentType($testAssignmentType);
		$assignmentTestObj ->setName($testName);
		$assignmentTestObj ->setDueDate($testDueDate);
		$assignmentTestObj ->setStudyTime($testStudyTime);
		$assignmentTestObj ->setPointsAllowed($testPointsAllowed);
		$assignmentTestObj ->setPointsRecieved($testPointsRecieved);
		
		//ok test them accessors and mutators
		//
		$this->assertEquals($assignmentTestObj ->getStudentId(),$testStudentID);
		$this->assertEquals($assignmentTestObj ->getSemesterId(),$testSemesterID);
		$this->assertEquals($assignmentTestObj ->getCourseId(),$testCourseID);
		$this->assertEquals($assignmentTestObj ->getAssignmentId(),$testAssignmentID);
		$this->assertEquals($assignmentTestObj ->getAssignmentType(),$testAssignmentType);
		$this->assertEquals($assignmentTestObj ->getName(),$testName);
		$this->assertEquals($assignmentTestObj ->getDueDate(),$testDueDate);
		$this->assertEquals($assignmentTestObj ->getStudyTime(),$testStudyTime);
		$this->assertEquals($assignmentTestObj ->getPointsAllowed(),$testPointsAllowed);
		$this->assertEquals($assignmentTestObj ->getPointsRecieved(),$testPointsRecieved);

	}
	
}





?>