/*
	This is the json formating object that formats models into the correct style of json needed by a page
*/
<?php
include_once 'includeUtil.php';
require_once('Assignment.php');
require_once('Student.php');
require_once('Semester.php');
require_once('Course.php');

class JSONFormatter
{
	private static $JSONWrapper = '{
		"aaData": [ "%s" ]
	}
		';
	
	/*
		this is the function that is used to format the json for the course on the dashboard page
	*/
	public static function dashboardClassesFormatter($passedGroupOfCourse)
	{
		//set up internal string vars here
		//
		$JSONFragment = '{
							"course": "%s",
							"name": "%s",
							"grade": "%s"
						}';
		
		$count = 0;
		
		//ok do work here
		//
		$finalJSONBlob = "";
			
		foreach ($passedGroupOfCourse as $key => $value)
		{
			if($count > 0)
			{
				$finalJSONBlob .= ',';
			}
			
			$finalJSONBlob .= sprintf($JSONFragment, $value->getDesignation(), $value->getName(), $value->getGrade());
			$count++;
		}
			
		return sprintf(self::$JSONWrapper, $finalJSONBlob);

	}



}



?>