<?php

/***
	Unit tests for the Semester DAO class
**/
include_once 'includeUtil.php';
require_once "PHPUnit/Autoload.php";
require_once('Student.php');
require_once('SemesterDAO.php');
require_once('Semester.php');
require_once('SemesterDAO.php');
require_once('Course.php');
require_once('CourseDAO.php');
require_once('DatabaseConnectionFactory.php');
require_once('TruncateOperation.php');



class CourseDAOTest extends PHPUnit_Extensions_Database_TestCase
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
	
	public function testCourseByCourseId()
	{
		$courseId = CourseDAO::loadById(1);
		
		$this->assertEquals("1", $courseId->getStudentId());
		$this->assertEquals("1", $courseId->getSemesterId());
		$this->assertEquals("1", $courseId->getCourseId());
		$this->assertEquals("CSC450", $courseId->getDesignation());
		$this->assertEquals("Software Engineering Capstone", $courseId->getName());
		$this->assertEquals("4" , $courseId->getCredits());	
		$this->assertEquals("4.44", $courseId->getGrade());
	}

	public function testLoadAll()
	{
		$courseId = CourseDAO::loadALL();
		
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
	}
	

	public function testUpdateCourse()
	{
		
		$course = CourseDAO::loadById(1);

		$course->setStudentId("2");
		$course->setSemesterId("2");
		$course->setDesignation("CSC478");
		$course->setName("Introduction to Android Development");
		$course->setCredits("3");
		$course->setGrade("4.45");
		

		$courseUpdate = CourseDAO::update($course);
		
		$course1 	= CourseDAO::loadById(1);

		$this->assertEquals("2", $course1->getStudentId());
		$this->assertEquals("2", $course1->getSemesterId());
		$this->assertEquals("1", $course1->getCourseId());
		$this->assertEquals("CSC478", $course1->getDesignation());
		$this->assertEquals("Introduction to Android Development", $course1->getName());
		$this->assertEquals("3" , $course1->getCredits());	
		$this->assertEquals("4.45", $course1->getGrade());	
	}
	

	public function testAddCourse()
	{		
		$course 	= new Course();

		$course->setStudentId("2");
		$course->setSemesterId("2");
		$course->setDesignation("CSC478");
		$course->setName("Introduction to Android Development");
		$course->setCredits("3");
		$course->setGrade("4.45");

		$courseAdded = CourseDAO::addNew($course);
		
		$this->assertEquals("2", $course->getStudentId());
		$this->assertEquals("2", $course->getSemesterId());
		$this->assertEquals("4", $course->getCourseId());
		$this->assertEquals("CSC478", $course->getDesignation());
		$this->assertEquals("Introduction to Android Development", $course->getName());
		$this->assertEquals("3" , $course->getCredits());	
		$this->assertEquals("4.45", $course->getGrade());	
	}
	

	public function testDeleteCourse()
	{
		$course 	= CourseDAO::loadById(1);

		$course = CourseDAO::delete($course);
		$courseArray = CourseDAO::loadALL();
		
		$this->assertEquals(2, sizeOf($courseArray));	
	}
	
	
	public function testLoadAllByStudentId()
	{
		$courseId = CourseDAO::findAllCoursesByStudentId("1");
		
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
	}
	
	public function testLoadAllBySemesterId()
	{
		$courseId = CourseDAO::findAllCoursesBySemesterId("1");
		
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
	}
}