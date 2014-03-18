<?php

/***
	Unit tests for the Assignment DAO class
**/
include_once 'includeUtil.php';
require_once "PHPUnit/Autoload.php";
require_once('Assignment.php');
require_once('AssignmentDAO.php');
require_once('Student.php');
require_once('SemesterDAO.php');
require_once('Semester.php');
require_once('SemesterDAO.php');
require_once('Course.php');
require_once('AssignmentDAO.php');
require_once('DatabaseConnectionFactory.php');
require_once('TruncateOperation.php');



class AssignmentDAOTest extends PHPUnit_Extensions_Database_TestCase
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
	
	public function testAssignmentByAssignmentId()
	{
		$assignmentId = AssignmentDAO::loadById(1);
		
		$this->assertEquals("1", $assignmentId->getStudentId());
		$this->assertEquals("1", $assignmentId->getSemesterId());
		$this->assertEquals("1", $assignmentId->getCourseId());
		$this->assertEquals("1", $assignmentId->getAssignmentId());
		$this->assertEquals("exam", $assignmentId->getAssignmentType());
		$this->assertEquals("Midterm", $assignmentId->getName());
		$this->assertEquals("2013-01-01" , $assignmentId->getDueDate());	
		$this->assertEquals("2", $assignmentId->getStudyTime());
		$this->assertEquals("100", $assignmentId->getPointsAllowed());
		$this->assertEquals("98" , $assignmentId->getPointsRecieved());	
	}


	public function testLoadAll()
	{
		$assignmentId = AssignmentDAO::loadALL();
		
		$this->assertEquals("1", $assignmentId[0]->getStudentId());
		$this->assertEquals("1", $assignmentId[0]->getSemesterId());
		$this->assertEquals("1", $assignmentId[0]->getCourseId());
		$this->assertEquals("1", $assignmentId[0]->getAssignmentId());
		$this->assertEquals("exam", $assignmentId[0]->getAssignmentType());
		$this->assertEquals("Midterm", $assignmentId[0]->getName());
		$this->assertEquals("2013-01-01" , $assignmentId[0]->getDueDate());	
		$this->assertEquals("2", $assignmentId[0]->getStudyTime());
		$this->assertEquals("100", $assignmentId[0]->getPointsAllowed());
		$this->assertEquals("98" , $assignmentId[0]->getPointsRecieved());
		
		$this->assertEquals("1", $assignmentId[1]->getStudentId());
		$this->assertEquals("1", $assignmentId[1]->getSemesterId());
		$this->assertEquals("1", $assignmentId[1]->getCourseId());
		$this->assertEquals("2", $assignmentId[1]->getAssignmentId());
		$this->assertEquals("quiz", $assignmentId[1]->getAssignmentType());
		$this->assertEquals("Quiz 2", $assignmentId[1]->getName());
		$this->assertEquals("2014-04-01" , $assignmentId[1]->getDueDate());	
		$this->assertEquals("1", $assignmentId[1]->getStudyTime());
		$this->assertEquals("100", $assignmentId[1]->getPointsAllowed());
		$this->assertEquals("98" , $assignmentId[1]->getPointsRecieved());
	}
	

	public function testUpdateCourse()
	{
		
		$assignment = AssignmentDAO::loadById(1);

		//set up vars for the various properties
		//
		$testStudentID 		= '2';
		$testSemesterID		= '2';
		$testCourseID 		= '2';
		$testAssignmentType = 'quiz';
		$testName 			= 'Software Engineering Capstone Quiz 7';
		$testDueDate 		= '2013-02-02';
		$testStudyTime 		= '4';
		$testPointsAllowed 	= '5';
		$testPointsRecieved	= '5';

		
		//create Course object
		//
		$assignmentTestObj = new Assignment();
		
		$assignment ->setStudentId($testStudentID);
		$assignment ->setSemesterId($testSemesterID);
		$assignment ->setCourseId($testCourseID);
		$assignment ->setAssignmentType($testAssignmentType);
		$assignment ->setName($testName);
		$assignment ->setDueDate($testDueDate);
		$assignment ->setStudyTime($testStudyTime);
		$assignment ->setPointsAllowed($testPointsAllowed);
		$assignment ->setPointsRecieved($testPointsRecieved);
		

		$assignmentUpdate = AssignmentDAO::update($assignment);
		
		$assignment1 	= AssignmentDAO::loadById(1);

		$this->assertEquals("2", $assignment1->getStudentId());
		$this->assertEquals("2", $assignment1->getSemesterId());
		$this->assertEquals("2", $assignment1->getCourseId());
		$this->assertEquals("1", $assignment1->getAssignmentId());
		$this->assertEquals("quiz", $assignment1->getAssignmentType());
		$this->assertEquals("Software Engineering Capstone Quiz 7", $assignment1->getName());
		$this->assertEquals("2013-02-02" , $assignment1->getDueDate());	
		$this->assertEquals("4", $assignment1->getStudyTime());
		$this->assertEquals("5", $assignment1->getPointsAllowed());
		$this->assertEquals("5" , $assignment1->getPointsRecieved());	
	}
	

	public function testAddCourse()
	{		
		//set up vars for the various properties
		//
		$testStudentID 		= '1';
		$testSemesterID		= '1';
		$testCourseID 		= '2';
		$testAssignmentType = 'quiz';
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
		$assignmentTestObj ->setAssignmentType($testAssignmentType);
		$assignmentTestObj ->setName($testName);
		$assignmentTestObj ->setDueDate($testDueDate);
		$assignmentTestObj ->setStudyTime($testStudyTime);
		$assignmentTestObj ->setPointsAllowed($testPointsAllowed);
		$assignmentTestObj ->setPointsRecieved($testPointsRecieved);

		$assignmentAdded = AssignmentDAO::addNew($assignmentTestObj);
		
		$this->assertEquals("1", $assignmentAdded->getStudentId());
		$this->assertEquals("1", $assignmentAdded->getSemesterId());
		$this->assertEquals("2", $assignmentAdded->getCourseId());
		$this->assertEquals("4", $assignmentAdded->getAssignmentId());
		$this->assertEquals("quiz", $assignmentAdded->getAssignmentType());
		$this->assertEquals("Software Engineering Capstone Quiz 7", $assignmentAdded->getName());
		$this->assertEquals("2013-01-01" , $assignmentAdded->getDueDate());	
		$this->assertEquals("4", $assignmentAdded->getStudyTime());
		$this->assertEquals("5", $assignmentAdded->getPointsAllowed());
		$this->assertEquals("5" , $assignmentAdded->getPointsRecieved());	
	}
	

	public function testDeleteCourse()
	{
		$assignment 	= AssignmentDAO::loadById(1);

		$assignment = AssignmentDAO::delete($assignment);
		$assignmentArray = AssignmentDAO::loadALL();
		
		$this->assertEquals(2, sizeOf($assignmentArray));	
	}
	

	public function testLoadAllByStudentId()
	{
		$assignmentId = AssignmentDAO::findAllAssignmentsByStudentId("1");
		
		$this->assertEquals("1", $assignmentId[0]->getStudentId());
		$this->assertEquals("1", $assignmentId[0]->getSemesterId());
		$this->assertEquals("1", $assignmentId[0]->getCourseId());
		$this->assertEquals("1", $assignmentId[0]->getAssignmentId());
		$this->assertEquals("exam", $assignmentId[0]->getAssignmentType());
		$this->assertEquals("Midterm", $assignmentId[0]->getName());
		$this->assertEquals("2013-01-01" , $assignmentId[0]->getDueDate());	
		$this->assertEquals("2", $assignmentId[0]->getStudyTime());
		$this->assertEquals("100", $assignmentId[0]->getPointsAllowed());
		$this->assertEquals("98" , $assignmentId[0]->getPointsRecieved());
		
		$this->assertEquals("1", $assignmentId[1]->getStudentId());
		$this->assertEquals("1", $assignmentId[1]->getSemesterId());
		$this->assertEquals("1", $assignmentId[1]->getCourseId());
		$this->assertEquals("2", $assignmentId[1]->getAssignmentId());
		$this->assertEquals("quiz", $assignmentId[1]->getAssignmentType());
		$this->assertEquals("Quiz 2", $assignmentId[1]->getName());
		$this->assertEquals("2014-04-01" , $assignmentId[1]->getDueDate());	
		$this->assertEquals("1", $assignmentId[1]->getStudyTime());
		$this->assertEquals("100", $assignmentId[1]->getPointsAllowed());
		$this->assertEquals("98" , $assignmentId[1]->getPointsRecieved());
	}
	
	public function testLoadAllBySemesterId()
	{
		$assignmentId = AssignmentDAO::findAllAssignmentsBySemesterId("1");
		
		$this->assertEquals("1", $assignmentId[0]->getStudentId());
		$this->assertEquals("1", $assignmentId[0]->getSemesterId());
		$this->assertEquals("1", $assignmentId[0]->getCourseId());
		$this->assertEquals("1", $assignmentId[0]->getAssignmentId());
		$this->assertEquals("exam", $assignmentId[0]->getAssignmentType());
		$this->assertEquals("Midterm", $assignmentId[0]->getName());
		$this->assertEquals("2013-01-01" , $assignmentId[0]->getDueDate());	
		$this->assertEquals("2", $assignmentId[0]->getStudyTime());
		$this->assertEquals("100", $assignmentId[0]->getPointsAllowed());
		$this->assertEquals("98" , $assignmentId[0]->getPointsRecieved());
		
		$this->assertEquals("1", $assignmentId[1]->getStudentId());
		$this->assertEquals("1", $assignmentId[1]->getSemesterId());
		$this->assertEquals("1", $assignmentId[1]->getCourseId());
		$this->assertEquals("2", $assignmentId[1]->getAssignmentId());
		$this->assertEquals("quiz", $assignmentId[1]->getAssignmentType());
		$this->assertEquals("Quiz 2", $assignmentId[1]->getName());
		$this->assertEquals("2014-04-01" , $assignmentId[1]->getDueDate());	
		$this->assertEquals("1", $assignmentId[1]->getStudyTime());
		$this->assertEquals("100", $assignmentId[1]->getPointsAllowed());
		$this->assertEquals("98" , $assignmentId[1]->getPointsRecieved());
	}
	
	public function testLoadAllByCourseId()
	{
		$assignmentId = AssignmentDAO::findAllAssignmentsByCourseId("1");
		
		$this->assertEquals("1", $assignmentId[0]->getStudentId());
		$this->assertEquals("1", $assignmentId[0]->getSemesterId());
		$this->assertEquals("1", $assignmentId[0]->getCourseId());
		$this->assertEquals("1", $assignmentId[0]->getAssignmentId());
		$this->assertEquals("exam", $assignmentId[0]->getAssignmentType());
		$this->assertEquals("Midterm", $assignmentId[0]->getName());
		$this->assertEquals("2013-01-01" , $assignmentId[0]->getDueDate());	
		$this->assertEquals("2", $assignmentId[0]->getStudyTime());
		$this->assertEquals("100", $assignmentId[0]->getPointsAllowed());
		$this->assertEquals("98" , $assignmentId[0]->getPointsRecieved());
		
		$this->assertEquals("1", $assignmentId[1]->getStudentId());
		$this->assertEquals("1", $assignmentId[1]->getSemesterId());
		$this->assertEquals("1", $assignmentId[1]->getCourseId());
		$this->assertEquals("2", $assignmentId[1]->getAssignmentId());
		$this->assertEquals("quiz", $assignmentId[1]->getAssignmentType());
		$this->assertEquals("Quiz 2", $assignmentId[1]->getName());
		$this->assertEquals("2014-04-01" , $assignmentId[1]->getDueDate());	
		$this->assertEquals("1", $assignmentId[1]->getStudyTime());
		$this->assertEquals("100", $assignmentId[1]->getPointsAllowed());
		$this->assertEquals("98" , $assignmentId[1]->getPointsRecieved());
	}
	
	
	public function testLoadAllByCourseIdAndDate()
	{
		$assignmentId = AssignmentDAO::findAllAssignmentsByTimeFromNow("1",90);
		
		
		$this->assertEquals("1", $assignmentId[0]->getStudentId());
		$this->assertEquals("1", $assignmentId[0]->getSemesterId());
		$this->assertEquals("1", $assignmentId[0]->getCourseId());
		$this->assertEquals("2", $assignmentId[0]->getAssignmentId());
		$this->assertEquals("quiz", $assignmentId[0]->getAssignmentType());
		$this->assertEquals("Quiz 2", $assignmentId[0]->getName());
		$this->assertEquals("2014-04-01" , $assignmentId[0]->getDueDate());	
		$this->assertEquals("1", $assignmentId[0]->getStudyTime());
		$this->assertEquals("100", $assignmentId[0]->getPointsAllowed());
		$this->assertEquals("98" , $assignmentId[0]->getPointsRecieved());
		
		$this->assertEquals("1", $assignmentId[1]->getStudentId());
		$this->assertEquals("1", $assignmentId[1]->getSemesterId());
		$this->assertEquals("1", $assignmentId[1]->getCourseId());
		$this->assertEquals("3", $assignmentId[1]->getAssignmentId());
		$this->assertEquals("exam", $assignmentId[1]->getAssignmentType());
		$this->assertEquals("Midterm", $assignmentId[1]->getName());
		$this->assertEquals("2014-06-01" , $assignmentId[1]->getDueDate());	
		$this->assertEquals("2", $assignmentId[1]->getStudyTime());
		$this->assertEquals("100", $assignmentId[1]->getPointsAllowed());
		$this->assertEquals("98" , $assignmentId[1]->getPointsRecieved());
	}

}