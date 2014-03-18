<?php
 
/*
	this class is used to hold the student settings information
*/
include_once 'includeUtil.php';
class Student_Settings
{
   	//set up the variables here
	//
	public $student_id;
	public $study_tod;
	public $st_exam;
	public $st_quiz; 
	public $st_project; 
	public $st_homework; 
	public $st_discussion; 
	public $st_other;
	
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
	
	public function setStudyTimeTimeOfDay($passedStudyTimeOfDay)
	{
		$this->study_tod = $passedStudyTimeOfDay;
	}

	public function getStudyTimeTimeOfDay()
	{
	 	return $this->study_tod;
	}
	
	public function setStudyTimeForExam($passedStudyTimeForExam)
	{
		$this->st_exam = $passedStudyTimeForExam;
	}

	public function getStudyTimeForExam()
	{
	 	return $this->st_exam;
	}
	
	public function setStudyTimeForQuiz($passedStudyTimeForQuiz)
	{
		$this->st_quiz = $passedStudyTimeForQuiz;
	}

	public function getStudyTimeForQuiz()
	{
	 	return $this->st_quiz;
	}
	
	public function setStudyTimeForProject($passedStudyTimeForProject)
	{
		$this->st_project = $passedStudyTimeForProject;
	}

	public function getStudyTimeForProject()
	{
	 	return $this->st_project;
	}
	
	public function setStudyTimeForHomework($passedStudyTimeForHomework)
	{
		$this->st_homework = $passedStudyTimeForHomework;
	}

	public function getStudyTimeForHomework()
	{
	 	return $this->st_homework;
	}
	
	public function setStudyTimeForDiscussion($passedStudyTimeForDiscussion)
	{
		$this->st_discussion = $passedStudyTimeForDiscussion;
	}

	public function getStudyTimeForDiscussion()
	{
	 	return $this->st_discussion;
	}
	
	public function setStudyTimeForOther($passedStudyTimeForOther)
	{
		$this->st_other = $passedStudyTimeForOther;
	}

	public function getStudyTimeForOther()
	{
	 	return $this->st_other;
	}
	
}
 
?>