<?php

/**
	Unit tests for the JSONformatter Class
**/
include_once 'includeUtil.php';
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
require_once('JSONFormatter.php');
require_once('TruncateOperation.php');
require_once('Controller.php');

class JSONFormatterUnitTest extends PHPUnit_Extensions_Database_TestCase
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
	
	
	/**
		Simple test dashboardClassesFormatter
	**/
	public function testDashboardClassesFormatter()
	{
		//set up vars
		//
		$testJSONBlob = '"aaData": [ "{
									"course": "CSC450",
									"name": "Software Engineering Capstone",
									"grade": "4.44"
								}{
									"course": "CSC460",
									"name": "Introduction to iPhone Development",
									"grade": "4.44"
								}" ]
			}';
		$courseId = CourseDAO::findAllCoursesBySemesterId("1");
		
		$jsonReturned =  JSONFormatter::dashboardClassesFormatter($courseId);
		
		//echo $jsonReturned;
		
		$this->assertEquals("1", $courseId[0]->getStudentId());
		$this->assertEquals("1", $courseId[0]->getSemesterId());
		$this->assertEquals("1", $courseId[0]->getCourseId());
		$this->assertEquals("CSC450", $courseId[0]->getDesignation());
		$this->assertEquals("Software Engineering Capstone", $courseId[0]->getName());
		$this->assertEquals("4" , $courseId[0]->getCredits());	
		$this->assertEquals("4.44", $courseId[0]->getGrade());
		
		$this->assertEquals("1", $courseId[1]->getStudentId());
		$this->assertEquals("1", $courseId[1]->getSemesterId());
		$this->assertEquals("2", $courseId[1]->getCourseId());
		$this->assertEquals("CSC460", $courseId[1]->getDesignation());
		$this->assertEquals("Introduction to iPhone Development", $courseId[1]->getName());
		$this->assertEquals("4" , $courseId[1]->getCredits());	
		$this->assertEquals("4.44", $courseId[1]->getGrade());
		
		$this->assertNotNull($jsonReturned);
		
	}
	
	
}





?>