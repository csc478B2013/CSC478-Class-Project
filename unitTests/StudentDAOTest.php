<?php

/***
	Unit tests for the Student DAO class
**/
include_once 'includeUtil.php';
require_once "PHPUnit/Autoload.php";
require_once('Student.php');
require_once('StudentDAO.php');
require_once('DatabaseConnectionFactory.php');
require_once('TruncateOperation.php');



class StudentDAOTest extends PHPUnit_Extensions_Database_TestCase
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
	
	public function testGetStudentByStudentId()
	{
		$studendId = StudentDAO::loadById(1);
		
		$this->assertEquals("Joe", $studendId->getStudentFirstName());
		$this->assertEquals("joe@foo.com", $studendId->getEmail());
		$this->assertEquals("6503870000", $studendId->getPhoneNumber());
		$this->assertEquals("password", $studendId->getHashedPassword());
		$this->assertEquals("1" , $studendId->getStudentId());	
	}
	
	public function testGetStudentByStudentEmail()
	{
		$studendId = StudentDAO::loadByEmail("joe@foo.com");
		
		$this->assertEquals("Joe", $studendId->getStudentFirstName());
		$this->assertEquals("joe@foo.com", $studendId->getEmail());
		$this->assertEquals("6503870000", $studendId->getPhoneNumber());
		$this->assertEquals("password", $studendId->getHashedPassword());
		$this->assertEquals("1" , $studendId->getStudentId());	
	}
	
	public function testLoadAll()
	{
		$studendId = StudentDAO::loadALL();
		
		$this->assertEquals("Ethan", $studendId[1]->getStudentFirstName());
		$this->assertEquals("ethan@foo.com", $studendId[1]->getEmail());
		$this->assertEquals("6503870002", $studendId[1]->getPhoneNumber());
		$this->assertEquals("password", $studendId[1]->getHashedPassword());
		$this->assertEquals("2" , $studendId[1]->getStudentId());
		
		$this->assertEquals("Juniper", $studendId[2]->getStudentFirstName());
		$this->assertEquals("juniper@foo.com", $studendId[2]->getEmail());
		$this->assertEquals("6503870001", $studendId[2]->getPhoneNumber());
		$this->assertEquals("password", $studendId[2]->getHashedPassword());
		$this->assertEquals("3" , $studendId[2]->getStudentId());
	}
	
	public function testUpdateStudent()
	{
		$cryptTestSalt = 'phpIsFun';
		$testHashPassword = crypt('testpass', $cryptTestSalt);
		
		$student 	= StudentDAO::loadById(1);
		
		$student->setStudentFirstName("Howard Phillips");
		$student->setPhoneNumber("3333333333");
		$student->setEmail("hplovecraft@foo.com");
		$student->setHashedPassword($testHashPassword);

		$studentUpdate = StudentDAO::update($student);
		
		$student1 	= StudentDAO::loadById(1);

		$this->assertEquals("Howard Phillips", $student1->getStudentFirstName());
		$this->assertEquals("hplovecraft@foo.com", $student1->getEmail());
		$this->assertEquals("3333333333", $student1->getPhoneNumber());
		$this->assertEquals($testHashPassword, $student1->getHashedPassword());
		$this->assertEquals("1" , $student1->getStudentId());	
	}
	
	public function testAddStudent()
	{
		$cryptTestSalt = 'phpIsFun';
		$testHashPassword = crypt('testpass', $cryptTestSalt);
		
		$student = new Student();
		$student->setStudentFirstName("Howard Phillips");
		$student->setPhoneNumber("3333333333");
		$student->setEmail("hplovecraft@foo.com");
		$student->setHashedPassword($testHashPassword);

		$studentAdded = StudentDAO::addNew($student);
		
		$this->assertEquals("Howard Phillips", $studentAdded->getStudentFirstName());
		$this->assertEquals("hplovecraft@foo.com", $studentAdded->getEmail());
		$this->assertEquals("3333333333", $studentAdded->getPhoneNumber());
		$this->assertEquals($testHashPassword, $studentAdded->getHashedPassword());
		$this->assertEquals("4" , $student->getStudentId());	
	}
	
	public function testDeleteStudent()
	{
		$student 	= StudentDAO::loadById(1);

		$student = StudentDAO::delete($student);
		$studentArray = StudentDAO::loadALL();
		
		$this->assertEquals(2, sizeOf($studentArray));	
	}
	
	public function testDoesEmailExist()
	{
		$studentEmailExists 	= StudentDAO::doesEmailExist("joe@foo.com");
		$studentEmailNotExists 	= StudentDAO::doesEmailExist("leanne@foo.com");
		
		$this->assertEquals(True, $studentEmailExists);	
		$this->assertEquals(False, $studentEmailNotExists);	
	}
	
	public function testDoesPasswordMatch()
	{
		$studentPasswordMatch 		= StudentDAO::isPasswordValid("joe@foo.com","password");
		$studentNotPasswordMatch  	= StudentDAO::isPasswordValid("joe@foo.com","notPasswoed");
		
		$this->assertEquals(True, $studentPasswordMatch);	
		$this->assertEquals(False, $studentNotPasswordMatch);	
	}
	
	
}