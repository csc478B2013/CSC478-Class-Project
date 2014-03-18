<?php
 
/*
	this class is used to hold the semester information
*/
include_once 'includeUtil.php';
class Semester
{
   	//set up the variables here
	//
	public $student_id;
	public $semester_id;
	public $year;
	public $term;
	public $start_date;
	public $end_date;
	public $semester_GPA;
	public $isCurrent;
	
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
	
	public function setYear($passedYear)
	{
		$this->year = $passedYear;
	}

	public function getYear()
	{
	 	return $this->year;
	}
	
	public function setTerm($passedTerm)
	{
		$this->term = $passedTerm;
	}

	public function getTerm()
	{
	 	return $this->term;
	}
	
	public function setStartDate($passedStartDate)
	{
		$this->start_date = $passedStartDate;
	}

	public function getStartDate()
	{
	 	return $this->start_date;
	}
	
	public function setEndDate($passedEndDate)
	{
		$this->end_date = $passedEndDate;
	}

	public function getEndDate()
	{
	 	return $this->end_date;
	}
	
	public function setSemesterGPA($passedSemesterGPA)
	{
		$this->semester_GPA = $passedSemesterGPA;
	}

	public function getSemesterGPA()
	{
	 	return $this->semester_GPA;
	}
	
	public function setIsCurrent($passedIsCurrent)
	{
		$this->isCurrent = $passedIsCurrent;
	}

	public function getIsCurrent()
	{
	 	return $this->isCurrent;
	}
	
}
 
?>