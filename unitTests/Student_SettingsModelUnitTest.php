<?php

/**
	Unit tests for the Student Model Class
**/
include_once 'includeUtil.php';
require_once('Student_Settings.php');

class Student_SettingsModelUnitTest extends PHPUnit_Framework_TestCase
{

	/**
		Simple test of Student Settings object
	**/
	public function testStudentSettingsObject()
	{
		//set up vars for the various properties
		//
		$testStudentID 				= '1';
		$testStudyTimeOfDay			= 'morning';
		$testStudyTimeExam 			= '2';
		$testStudyTimeQuiz 			= '3';
		$testStudyTimeProject 		= '4';
		$testStudyTimeHomework 		= '5';
		$testStudyTimeDiscussion 	= '6';
		$testStudyTimeOther			= '7';
		
		//create Student Settings object
		//
		$studentSettingsTestObj = new Student_Settings();
		
		$studentSettingsTestObj->setStudentId($testStudentID);
		$studentSettingsTestObj->setStudyTimeTimeOfDay($testStudyTimeOfDay);
		$studentSettingsTestObj->setStudyTimeForExam($testStudyTimeExam);
		$studentSettingsTestObj->setStudyTimeForQuiz($testStudyTimeQuiz);
		$studentSettingsTestObj->setStudyTimeForProject($testStudyTimeProject);
		$studentSettingsTestObj->setStudyTimeForHomework($testStudyTimeHomework);
		$studentSettingsTestObj->setStudyTimeForDiscussion($testStudyTimeDiscussion);
		$studentSettingsTestObj->setStudyTimeForOther($testStudyTimeOther);
		
		//ok test them accessors and mutators
		//
		$this->assertEquals($studentSettingsTestObj->getStudentId(),$testStudentID);
		$this->assertEquals($studentSettingsTestObj->getStudyTimeTimeOfDay(),$testStudyTimeOfDay);
		$this->assertEquals($studentSettingsTestObj->getStudyTimeForExam(),$testStudyTimeExam);
		$this->assertEquals($studentSettingsTestObj->getStudyTimeForQuiz(),$testStudyTimeQuiz);
		$this->assertEquals($studentSettingsTestObj->getStudyTimeForProject(),$testStudyTimeProject);
		$this->assertEquals($studentSettingsTestObj->getStudyTimeForHomework(),$testStudyTimeHomework);
		$this->assertEquals($studentSettingsTestObj->getStudyTimeForDiscussion(),$testStudyTimeDiscussion);
		$this->assertEquals($studentSettingsTestObj->getStudyTimeForOther(),$testStudyTimeOther);

	}
	
}





?>