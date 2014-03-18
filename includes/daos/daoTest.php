<?php

ini_set('include_path',ini_get('include_path').':/Users/joejones/iPhoneDev/p4workspace/ThinkFit/CSC478/includes/models:/Users/joejones/iPhoneDev/p4workspace/ThinkFit/CSC478/includes/daos:'); 

include_once 'StudentDAO.php';
include_once 'Student.php';



$cryptTestSalt = 'phpIsFun';
$testHashPassword = crypt('testpass', $cryptTestSalt);

$studentDAO = new StudentDAO();
$studentObj;

$studentObj = $studentDAO->loadAll();

$student = new Student();
$student->setStudentFirstName("Howard Phillips");
$student->setPhoneNumber("3333333333");
$student->setEmail("hplovecraft@joejonesdesign.com");
$student->setHashedPassword($testHashPassword);

$studentAdded = StudentDAO::addNew($student);

try
{
	//ok now here we go with the transaction
	//
	echo "Trying";
	$databaseConnection->beginTransaction();
	$result = $databaseConnection->exec($sqlStatement);
	$passedStudent->setStudentId($databaseConnection->lastInsertId());
	echo "Passed Student Id".$passedStudent->getStudentId();
	$databaseConnection->commit();
}
catch(PDOException $e)
{
	$databaseConnection->rollback();
	sprintf(self::$ErrorPDOException,$e->getMessage());
}


//echo $studentAdded->getEmail();

?>