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
require_once('DatabaseConnectionFactory.php');
require_once('TruncateOperation.php');



class SemesterDAOTest extends PHPUnit_Extensions_Database_TestCase
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
	
	public function testGetSemesterBySemesterId()
	{
		$semesterId = SemesterDAO::loadById(1);
		
		$this->assertEquals("1", $semesterId->getStudentId());
		$this->assertEquals("1", $semesterId->getSemesterId());
		$this->assertEquals("2014", $semesterId->getYear());
		$this->assertEquals("Spring", $semesterId->getTerm());
		$this->assertEquals("2014-01-01", $semesterId->getStartDate());
		$this->assertEquals("2014-01-04" , $semesterId->getEndDate());	
		$this->assertEquals("4.440", $semesterId->getSemesterGPA());
		$this->assertEquals("1" , $semesterId->getIsCurrent());
	}
	
	public function testLoadAll()
	{
		$semesterId = SemesterDAO::loadALL();
		
		$this->assertEquals("1", $semesterId[0]->getStudentId());
		$this->assertEquals("1", $semesterId[0]->getSemesterId());
		$this->assertEquals("2014", $semesterId[0]->getYear());
		$this->assertEquals("Spring", $semesterId[0]->getTerm());
		$this->assertEquals("2014-01-01", $semesterId[0]->getStartDate());
		$this->assertEquals("2014-01-04" , $semesterId[0]->getEndDate());	
		$this->assertEquals("4.440", $semesterId[0]->getSemesterGPA());
		$this->assertEquals("1" , $semesterId[0]->getIsCurrent());
		
		$this->assertEquals("1", $semesterId[1]->getStudentId());
		$this->assertEquals("2", $semesterId[1]->getSemesterId());
		$this->assertEquals("2013", $semesterId[1]->getYear());
		$this->assertEquals("Summer", $semesterId[1]->getTerm());
		$this->assertEquals("2013-01-01", $semesterId[1]->getStartDate());
		$this->assertEquals("2013-01-04" , $semesterId[1]->getEndDate());	
		$this->assertEquals("4.440", $semesterId[1]->getSemesterGPA());
		$this->assertEquals("0" , $semesterId[1]->getIsCurrent());
	}
	

	public function testUpdateSemester()
	{
		
		$semester 	= SemesterDAO::loadById(1);

		$semester->setStudentId("2");
		$semester->setYear("2012");
		$semester->setTerm("Fall");
		$semester->setStartDate("2013-01-01");
		$semester->setEndDate("2013-04-01");
		$semester->setSemesterGPA("4.000");
		$semester->setIsCurrent("0");

		$semesterUpdate = SemesterDAO::update($semester);
		
		$semester1 	= SemesterDAO::loadById(1);

		$this->assertEquals("2", $semester1->getStudentId());
		$this->assertEquals("1", $semester1->getSemesterId());
		$this->assertEquals("2012", $semester1->getYear());
		$this->assertEquals("Fall", $semester1->getTerm());
		$this->assertEquals("2013-01-01", $semester1->getStartDate());
		$this->assertEquals("2013-04-01" , $semester1->getEndDate());	
		$this->assertEquals("4.000", $semester1->getSemesterGPA());
		$this->assertEquals("0" , $semester1->getIsCurrent());	
	}
	

	public function testAddSemester()
	{		
		$semester 	= new Semester();

		$semester->setStudentId("2");
		$semester->setYear("2012");
		$semester->setTerm("Fall");
		$semester->setStartDate("2013-01-01");
		$semester->setEndDate("2013-04-01");
		$semester->setSemesterGPA("4.000");
		$semester->setIsCurrent("0");

		$semesterAdded = SemesterDAO::addNew($semester);
		
		$this->assertEquals("2", $semesterAdded->getStudentId());
		$this->assertEquals("4", $semesterAdded->getSemesterId());
		$this->assertEquals("2012", $semesterAdded->getYear());
		$this->assertEquals("Fall", $semesterAdded->getTerm());
		$this->assertEquals("2013-01-01", $semesterAdded->getStartDate());
		$this->assertEquals("2013-04-01" , $semesterAdded->getEndDate());	
		$this->assertEquals("4.000", $semesterAdded->getSemesterGPA());
		$this->assertEquals("0" , $semesterAdded->getIsCurrent());	
	}
	
	public function testDeleteSemester()
	{
		$semester 	= SemesterDAO::loadById(1);

		$semester = SemesterDAO::delete($semester);
		$semesterArray = SemesterDAO::loadALL();
		
		$this->assertEquals(2, sizeOf($semesterArray));	
	}
	
	public function testLoadAllByStudentEmail()
	{
		$semesterId = SemesterDAO::findAllSemestersByStudentEmail("joe@foo.com");
		
		$this->assertEquals("1", $semesterId[0]->getStudentId());
		$this->assertEquals("1", $semesterId[0]->getSemesterId());
		$this->assertEquals("2014", $semesterId[0]->getYear());
		$this->assertEquals("Spring", $semesterId[0]->getTerm());
		$this->assertEquals("2014-01-01", $semesterId[0]->getStartDate());
		$this->assertEquals("2014-01-04" , $semesterId[0]->getEndDate());	
		$this->assertEquals("4.440", $semesterId[0]->getSemesterGPA());
		$this->assertEquals("1" , $semesterId[0]->getIsCurrent());
		
		$this->assertEquals("1", $semesterId[1]->getStudentId());
		$this->assertEquals("2", $semesterId[1]->getSemesterId());
		$this->assertEquals("2013", $semesterId[1]->getYear());
		$this->assertEquals("Summer", $semesterId[1]->getTerm());
		$this->assertEquals("2013-01-01", $semesterId[1]->getStartDate());
		$this->assertEquals("2013-01-04" , $semesterId[1]->getEndDate());	
		$this->assertEquals("4.440", $semesterId[1]->getSemesterGPA());
		$this->assertEquals("0" , $semesterId[1]->getIsCurrent());
	}
	
	public function testLoadAllByStudentId()
	{
		$semesterId = SemesterDAO::findAllSemestersByStudentId("1");
		
		$this->assertEquals("1", $semesterId[0]->getStudentId());
		$this->assertEquals("1", $semesterId[0]->getSemesterId());
		$this->assertEquals("2014", $semesterId[0]->getYear());
		$this->assertEquals("Spring", $semesterId[0]->getTerm());
		$this->assertEquals("2014-01-01", $semesterId[0]->getStartDate());
		$this->assertEquals("2014-01-04" , $semesterId[0]->getEndDate());	
		$this->assertEquals("4.440", $semesterId[0]->getSemesterGPA());
		$this->assertEquals("1" , $semesterId[0]->getIsCurrent());
		
		$this->assertEquals("1", $semesterId[1]->getStudentId());
		$this->assertEquals("2", $semesterId[1]->getSemesterId());
		$this->assertEquals("2013", $semesterId[1]->getYear());
		$this->assertEquals("Summer", $semesterId[1]->getTerm());
		$this->assertEquals("2013-01-01", $semesterId[1]->getStartDate());
		$this->assertEquals("2013-01-04" , $semesterId[1]->getEndDate());	
		$this->assertEquals("4.440", $semesterId[1]->getSemesterGPA());
		$this->assertEquals("0" , $semesterId[1]->getIsCurrent());
	}
	
	public function testLoadCurrentSemesterByStudentId()
	{
		$semesterId = SemesterDAO::loadCurrentSemesterByStudentId("1");
		
		$this->assertEquals("1", $semesterId->getStudentId());
		$this->assertEquals("1", $semesterId->getSemesterId());
		$this->assertEquals("2014", $semesterId->getYear());
		$this->assertEquals("Spring", $semesterId->getTerm());
		$this->assertEquals("2014-01-01", $semesterId->getStartDate());
		$this->assertEquals("2014-01-04" , $semesterId->getEndDate());	
		$this->assertEquals("4.440", $semesterId->getSemesterGPA());
		$this->assertEquals("1" , $semesterId->getIsCurrent());
	}
	
	public function testLoadCurrentSemesterByEmail()
	{
		$semesterId = SemesterDAO::loadCurrentSemesterByStudentEmail("joe@foo.com");
		
		$this->assertEquals("1", $semesterId->getStudentId());
		$this->assertEquals("1", $semesterId->getSemesterId());
		$this->assertEquals("2014", $semesterId->getYear());
		$this->assertEquals("Spring", $semesterId->getTerm());
		$this->assertEquals("2014-01-01", $semesterId->getStartDate());
		$this->assertEquals("2014-01-04" , $semesterId->getEndDate());	
		$this->assertEquals("4.440", $semesterId->getSemesterGPA());
		$this->assertEquals("1" , $semesterId->getIsCurrent());
	}
}