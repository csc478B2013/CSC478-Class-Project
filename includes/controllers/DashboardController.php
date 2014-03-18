/*
	This is the controller for the dashboard object
*/
<?php
include_once 'includeUtil.php'; 
require_once('Controller.php');
require_once('Assignment.php');
require_once('AssignmentDAO.php');
require_once('Student.php');
require_once('SemesterDAO.php');
require_once('Semester.php');
require_once('SemesterDAO.php');
require_once('Course.php');
require_once('AssignmentDAO.php');

class DashboardController extends Controller
{
	
	
	/*
		Set up courses that are upcoming
	*/
	public function getCourseListForTimeSpan($passedCourseId, $passedDateOffset)
	{
		//get array of assignments based on time span
		//
		$courseArray = AssignmentDAO::findAllAssignmentsByTimeFromNow($passedCourseId,$passedDateOffset);
		
		//sort the array
		//
		
		
		//format course list
		//
	}

}

?>