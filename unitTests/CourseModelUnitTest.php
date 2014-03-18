<?php

/**
	Unit tests for the Course Model Class
**/
include_once 'includeUtil.php';
require_once('Course.php');

class CourseModelUnitTest extends PHPUnit_Framework_TestCase
{

	/**
		Simple test of Course object
	**/
	public function testCourseObject()
	{
		//set up vars for the various properties
		//
		$testStudentID 		= '1';
		$testSemesterID		= '1';
		$testCourseID 		= '2';
		$testDesignation 	= 'CSC470';
		$testName 			= 'Software Engineering Capstone';
		$testCredits 		= '5';
		$testGrade 			= '4.40';

		
		//create Course object
		//
		$courseTestObj = new Course();
		
		$courseTestObj->setStudentId($testStudentID);
		$courseTestObj->setSemesterId($testSemesterID);
		$courseTestObj->setCourseId($testCourseID);
		$courseTestObj->setDesignation($testDesignation);
		$courseTestObj->setName($testName);
		$courseTestObj->setCredits($testCredits);
		$courseTestObj->setGrade($testGrade);
		
		//ok test them accessors and mutators
		//
		$this->assertEquals($courseTestObj->getStudentId(),$testStudentID);
		$this->assertEquals($courseTestObj->getSemesterId(),$testSemesterID);
		$this->assertEquals($courseTestObj->getCourseId(),$testCourseID);
		$this->assertEquals($courseTestObj->getDesignation(),$testDesignation);
		$this->assertEquals($courseTestObj->getName(),$testName);
		$this->assertEquals($courseTestObj->getCredits(),$testCredits);
		$this->assertEquals($courseTestObj->getGrade(),$testGrade);

	}
	
}





?>