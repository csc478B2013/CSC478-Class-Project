<?php
 
/*
	this class is used to hold the student information
*/
include_once 'includeUtil.php';
class Student
{
   	//set up the variables here
	//
	public $student_id;
	public $fname;
	public $email;
	public $phone;
	public $password;
	public $date_created;
	
	
	public function __construct()  
	{  
	}

	
	//set up the accessors and mutators
	//
	public function setStudentFirstName($passedStudentFirstName)
	{
		$this->fname = $passedStudentFirstName;
	}

	public function getStudentFirstName()
	{
	 	return $this->fname;
	}
	
	public function setHashedPassword($passedHashedPassword)
	{
		$this->password = $passedHashedPassword;
	}

	public function getHashedPassword()
	{
	 	return $this->password;
	}
	
	public function setEmail($passedEmail)
	{
		$this->email = $passedEmail;
	}

	public function getEmail()
	{
	 	return $this->email;
	}
	
	public function setPhoneNumber($passedPhoneNumber)
	{
		$this->phone = $passedPhoneNumber;
	}

	public function getPhoneNumber()
	{
	 	return $this->phone;
	}
	
	public function setStudentId($passedStudentId)
	{
		$this->student_id = $passedStudentId;
	}

	public function getStudentId()
	{
	 	return $this->student_id;
	}
	
}
 
?>