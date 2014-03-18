<?php
 
/*
	this class is used to hold the assignment information
*/
include_once 'includeUtil.php';
class Assignment
{
   	//set up the variables here
	//
	public $student_id;
	public $semester_id;
	public $course_id;
	public $assignment_id;
	public $assignment_type;
	public $name;
	public $due_date;
	public $studytime;
	public $points_allowed;
	public $points_recieved;
	
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
	
	public function setAssignmentId($passedAssignmentId)
	{
		$this->assignment_id = $passedAssignmentId;
	}

	public function getAssignmentId()
	{
	 	return $this->assignment_id;
	}
	
	public function setAssignmentType($passedAssignmentType)
	{
		$this->assignment_type = $passedAssignmentType;
	}

	public function getAssignmentType()
	{
	 	return $this->assignment_type;
	}
	
	public function setName($passedName)
	{
		$this->name = $passedName;
	}

	public function getName()
	{
	 	return $this->name;
	}
	
	public function setDueDate($passedDueDate)
	{
		$this->due_date = $passedDueDate;
	}

	public function getDueDate()
	{
	 	return $this->due_date;
	}
	
	public function setStudyTime($passedStudyTime)
	{
		$this->studytime = $passedStudyTime;
	}

	public function getStudyTime()
	{
	 	return $this->studytime;
	}
	
	public function setPointsAllowed($passedPointsAllowed)
	{
		$this->points_allowed = $passedPointsAllowed;
	}

	public function getPointsAllowed()
	{
	 	return $this->points_allowed;
	}
	
	public function setPointsRecieved($passedPointsRecieved)
	{
		$this->points_recieved = $passedPointsRecieved;
	}

	public function getPointsRecieved()
	{
	 	return $this->points_recieved;
	}
	
	
}
 
?>