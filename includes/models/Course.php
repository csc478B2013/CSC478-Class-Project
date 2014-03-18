<?php
 
/*
	this class is used to hold the course information
*/
include_once 'includeUtil.php';
class Course
{
   	//set up the variables here
	//
	public $student_id;
	public $semester_id;
	public $course_id;
	public $designation;
	public $name;
	public $credits;
	public $grade;
	
	public function __construct()  
	{  
	}

	
	//set up the accessors and mutators
	//
	public function setStudentId($passedStudentId)
	{
		$this->student_id = $passedStudentId;
	}

	public function getStudentId()
	{
	 	return $this->student_id;
	}
	
	public function setSemesterId($passedSemesterId)
	{
		$this->semester_id = $passedSemesterId;
	}

	public function getSemesterId()
	{
	 	return $this->semester_id;
	}
	
	public function setCourseId($passedCourseId)
	{
		$this->course_id = $passedCourseId;
	}

	public function getCourseId()
	{
	 	return $this->course_id;
	}
	
	public function setDesignation($passedDesignation)
	{
		$this->designation = $passedDesignation;
	}

	public function getDesignation()
	{
	 	return $this->designation;
	}
	
	public function setName($passedName)
	{
		$this->name = $passedName;
	}

	public function getName()
	{
	 	return $this->name;
	}
	
	public function setCredits($passedCredits)
	{
		$this->credits = $passedCredits;
	}

	public function getCredits()
	{
	 	return $this->credits;
	}
	
	public function setGrade($passedGrade)
	{
		$this->grade = $passedGrade;
	}

	public function getGrade()
	{
	 	return $this->grade;
	}
	
}
 
?>