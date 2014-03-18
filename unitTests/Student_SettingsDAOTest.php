<?php

/***
	Unit tests for the Student Settings DAO class
**/
include_once 'includeUtil.php';
require_once "PHPUnit/Autoload.php";
require_once('Student_Settings.php');
require_once('Student_SettingsDAO.php');
require_once('DatabaseConnectionFactory.php');
require_once('TruncateOperation.php');



class Student_SettingsDAOTest extends PHPUnit_Extensions_Database_TestCase
{
	public function getSetUpOperation()
	    {
	        $cascadeTruncates = true; // If you want cascading truncates, false otherwise. If unsure choose false.

	        return new \PHPUnit_Extensions_Database_Operation_Composite(array(
	            new TruncateOperation($cascadeTruncates),
	            \PHPUnit_Extensions_Database_Operation_Factory::INSERT()
	        ));
	    }
	
	public function getConnection() 
	{		
	  	$db = DatabaseConnectionFactory::getDatabaseConnectionFactoryInstance()->getDataBaseConnection();
		return $this->createDefaultDBConnection($db, 'myuplan');
	}

	public function getDataSet() 
	{
	    return $this->createXMLDataSet(dirname(__FILE__)."/dataSets/StudentTableDataSet.xml");
	}
	
	public function testGetStudentSettingsByStudentId()
	{
		$studentSettingsId = Student_SettingsDAO::loadById(1);
		
		$this->assertEquals("1", $studentSettingsId->getStudentId());
		$this->assertEquals("Morning", $studentSettingsId->getStudyTimeTimeOfDay());
		$this->assertEquals("01", $studentSettingsId->getStudyTimeForExam());
		$this->assertEquals("03", $studentSettingsId->getStudyTimeForQuiz());
		$this->assertEquals("04", $studentSettingsId->getStudyTimeForProject());
		$this->assertEquals("01" , $studentSettingsId->getStudyTimeForHomework());	
		$this->assertEquals("03" , $studentSettingsId->getStudyTimeForDiscussion());	
		$this->assertEquals("04" , $studentSettingsId->getStudyTimeForOther());	
		
	}
	
	
	public function testLoadAll()
	{
		$studentSettingsId = Student_SettingsDAO::loadALL();
		
		$this->assertEquals("1", $studentSettingsId[0]->getStudentId());
		$this->assertEquals("Morning", $studentSettingsId[0]->getStudyTimeTimeOfDay());
		$this->assertEquals("01", $studentSettingsId[0]->getStudyTimeForExam());
		$this->assertEquals("03", $studentSettingsId[0]->getStudyTimeForQuiz());
		$this->assertEquals("04", $studentSettingsId[0]->getStudyTimeForProject());
		$this->assertEquals("01" , $studentSettingsId[0]->getStudyTimeForHomework());	
		$this->assertEquals("03" , $studentSettingsId[0]->getStudyTimeForDiscussion());	
		$this->assertEquals("04" , $studentSettingsId[0]->getStudyTimeForOther());
		
		$this->assertEquals("2", $studentSettingsId[1]->getStudentId());
		$this->assertEquals("Afternoon", $studentSettingsId[1]->getStudyTimeTimeOfDay());
		$this->assertEquals("05", $studentSettingsId[1]->getStudyTimeForExam());
		$this->assertEquals("05", $studentSettingsId[1]->getStudyTimeForQuiz());
		$this->assertEquals("05", $studentSettingsId[1]->getStudyTimeForProject());
		$this->assertEquals("05" , $studentSettingsId[1]->getStudyTimeForHomework());	
		$this->assertEquals("05" , $studentSettingsId[1]->getStudyTimeForDiscussion());	
		$this->assertEquals("05" , $studentSettingsId[1]->getStudyTimeForOther());
	}
	
	public function testUpdateStudentSettings()
	{

		$studentSettings 	= Student_SettingsDAO::loadById(1);
		
		//set up vars for the various properties
		//
		$testStudentID 				= '1';
		$testStudyTimeOfDay			= 'Afternoon';
		$testStudyTimeExam 			= '05';
		$testStudyTimeQuiz 			= '05';
		$testStudyTimeProject 		= '05';
		$testStudyTimeHomework 		= '05';
		$testStudyTimeDiscussion 	= '05';
		$testStudyTimeOther			= '05';
		
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

		$studentSettingsUpdate = Student_SettingsDAO::update($studentSettingsTestObj);
		
		$studentSettings1 	= Student_SettingsDAO::loadById(1);

		$this->assertEquals($studentSettings1->getStudentId(),$testStudentID);
		$this->assertEquals($studentSettings1->getStudyTimeTimeOfDay(),$testStudyTimeOfDay);
		$this->assertEquals($studentSettings1->getStudyTimeForExam(),$testStudyTimeExam);
		$this->assertEquals($studentSettings1->getStudyTimeForQuiz(),$testStudyTimeQuiz);
		$this->assertEquals($studentSettings1->getStudyTimeForProject(),$testStudyTimeProject);
		$this->assertEquals($studentSettings1->getStudyTimeForHomework(),$testStudyTimeHomework);
		$this->assertEquals($studentSettings1->getStudyTimeForDiscussion(),$testStudyTimeDiscussion);
		$this->assertEquals($studentSettings1->getStudyTimeForOther(),$testStudyTimeOther);
	}
	
	
	public function testAddStudent()
	{
		//set up vars for the various properties
		//
		$testStudentID 				= '4';
		$testStudyTimeOfDay			= 'Afternoon';
		$testStudyTimeExam 			= '05';
		$testStudyTimeQuiz 			= '05';
		$testStudyTimeProject 		= '05';
		$testStudyTimeHomework 		= '05';
		$testStudyTimeDiscussion 	= '05';
		$testStudyTimeOther			= '05';
		
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

		$studentSettings1 = Student_SettingsDAO::addNew($studentSettingsTestObj);
		
		$this->assertEquals($studentSettings1->getStudentId(),$testStudentID);
		$this->assertEquals($studentSettings1->getStudyTimeTimeOfDay(),$testStudyTimeOfDay);
		$this->assertEquals($studentSettings1->getStudyTimeForExam(),$testStudyTimeExam);
		$this->assertEquals($studentSettings1->getStudyTimeForQuiz(),$testStudyTimeQuiz);
		$this->assertEquals($studentSettings1->getStudyTimeForProject(),$testStudyTimeProject);
		$this->assertEquals($studentSettings1->getStudyTimeForHomework(),$testStudyTimeHomework);
		$this->assertEquals($studentSettings1->getStudyTimeForDiscussion(),$testStudyTimeDiscussion);
		$this->assertEquals($studentSettings1->getStudyTimeForOther(),$testStudyTimeOther);	
	}
	

	public function testDeleteStudent()
	{
		$studentSettings 	= Student_SettingsDAO::loadById(1);

		$studentSettings = Student_SettingsDAO::delete($studentSettings);
		$studentSettingsArray = Student_SettingsDAO::loadALL();
		
		$this->assertEquals(2, sizeOf($studentSettingsArray));	
	}
	
	
	
}