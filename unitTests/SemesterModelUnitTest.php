<?php

/**
	Unit tests for the Semester Model Class
**/
include_once 'includeUtil.php';
require_once('Semester.php');

class SemesterModelUnitTest extends PHPUnit_Framework_TestCase
{

	/**
		Simple test of Semester object
	**/
	public function testSemesterObject()
	{
		//set up vars for the various properties
		//
		
		$testStudentID = '1';
		$testSemesterID	= '1';
		$testYear = '2014';
		$testTerm= 'Spring';
		$testStartDate = '2014-01-01';
		$testEndDate = '2014-04-01';
		$testSemesterGPA= '3.4';
		$testIsCurrent= TRUE;
		
		//create Semester object
		//
		$semesterTestObj = new Semester();
		
		$semesterTestObj->setStudentId($testStudentID);
		$semesterTestObj->setSemesterId($testSemesterID);
		$semesterTestObj->setYear($testYear);
		$semesterTestObj->setTerm($testTerm);
		$semesterTestObj->setStartDate($testStartDate);
		$semesterTestObj->setEndDate($testEndDate);
		$semesterTestObj->setSemesterGPA($testSemesterGPA);
		$semesterTestObj->setIsCurrent($testIsCurrent);
		
		//ok test them accessors and mutators
		//
		$this->assertEquals($semesterTestObj->getStudentId(),$testStudentID);
		$this->assertEquals($semesterTestObj->getSemesterId(),$testSemesterID); 
		$this->assertEquals($semesterTestObj->getYear(),$testYear); 	
		$this->assertEquals($semesterTestObj->getTerm(),$testTerm);	
		$this->assertEquals($semesterTestObj->getStartDate(),$testStartDate);
		$this->assertEquals($semesterTestObj->getEndDate(),$testEndDate); 
		$this->assertEquals($semesterTestObj->getSemesterGPA(),$testSemesterGPA); 	
		$this->assertEquals($semesterTestObj->getIsCurrent(),$testIsCurrent);
	}
	
}





?>