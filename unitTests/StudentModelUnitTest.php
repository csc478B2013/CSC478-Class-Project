<?php

/**
	Unit tests for the Student Model Class
**/
include_once 'includeUtil.php';
require_once('Student.php');

class StudentModelUnitTest extends PHPUnit_Framework_TestCase
{

	/**
		Simple test of Student object
	**/
	public function testStudentObject()
	{
		//set up vars for the various properties
		//
		$testStudentName = 'Joe Jones';
		$testEmail	= 'joe@foo.com';
		$cryptTestSalt = 'phpIsFun';
		$testHashPassword = crypt('testpass', $cryptTestSalt);
		$testPhone = '650-555-1234';
		
		//create Student object
		//
		$studentTestObj = new Student();
		
		$studentTestObj->setStudentFirstName($testStudentName);
		$studentTestObj->setHashedPassword($testHashPassword);
		$studentTestObj->setEmail($testEmail);
		$studentTestObj->setPhoneNumber($testPhone);
		
		//ok test them accessors and mutators
		//
		$this->assertEquals($studentTestObj->getStudentFirstName(),$testStudentName);
		$this->assertEquals($studentTestObj->getEmail(),$testEmail); 
		$this->assertEquals($studentTestObj->getHashedPassword(),$testHashPassword); 	
		$this->assertEquals($studentTestObj->getPhoneNumber(),$testPhone);	
	}
	
}





?>