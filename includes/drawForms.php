<?php
	
	
// Labels
	function drawLabel_Title($name) {
		echo "	<p class='subheader' style='margin-top: 25px'>$name</p>";
		echo "	<legend style='margin: 10px 0px 10px 0px'></legend>";
	}
	
	function drawLabel_st() {
		echo "	<tr><td class='span7'>";
		echo "		<label>How many hours do you typically need for each type of assignment?</label>";
		echo "	</td></tr>";
	}
	
	
// Text Input
	function drawText($label, $name, $placeholder) {
		echo "	<td class='span2'>";
		echo "		<label>$label:</label>";
		echo "	</td>";
		echo "	<td class='span5'>";
		echo "		<div class='input-control text' data-role='input-control'>";
		echo "			<input type='text' name='$name' placeholder='$placeholder'>";
		echo "			<button class='btn-clear' tabindex='-1' type='button'></button>";
		echo "		</div>";
		echo "	</td>";	
	}

	function drawText_Password($label, $name, $placeholder) {
		echo " 	<td class='span2'>";
		echo "		<label>$label:</label>";
		echo "	</td>";	
		echo " 	<td class='span5'>";	
		echo " 		<div class='input-control password' data-role='input-control'>";	
		echo " 			<input type='password' name='$name' placeholder='$placeholder'>";	
		echo " 			<button class='btn-reveal' tabindex='-1' type='button'></button>";	
		echo " 		</div>";	
		echo " 	</td>";	
	}
	
	function drawText_ST($label, $name, $placeholder) {
		echo " 	<td class='span2'>";
		echo "		<label>$label:</label>";
		echo "	</td>";	
		echo " 	<td class='span2'>";	
		echo " 		<div class='input-control text' data-role='input-control'>";	
		echo " 			<input type='text' name='$name' placeholder='$placeholder'>";	
		echo " 			<button class='btn-clear' tabindex='-1' type='button'></button>";	
		echo " 		</div>";	
		echo " 	</td>";
	}
	
	function drawTextValue($label, $name, $value) {
		echo "	<td class='span2'>";
		echo "		<label>$label:</label>";
		echo "	</td>";
		echo "	<td class='span5'>";
		echo "		<div class='input-control text' data-role='input-control'>";
		echo "			<input type='text' name='$name' value='$value'>";
		echo "			<button class='btn-clear' tabindex='-1' type='button'></button>";
		echo "		</div>";
		echo "	</td>";	
	}
	
	function drawTextValue_Password($label, $name, $value) {
		echo " 	<td class='span2'>";
		echo "		<label>$label:</label>";
		echo "	</td>";	
		echo " 	<td class='span5'>";	
		echo " 		<div class='input-control password' data-role='input-control'>";	
		echo " 			<input type='password' name='$name' value='$value'>";	
		echo " 			<button class='btn-reveal' tabindex='-1' type='button'></button>";	
		echo " 		</div>";	
		echo " 	</td>";	
	} 
	
	function drawText_ST_Value($label, $name, $value) {
		echo " 	<td class='span2'>";
		echo "		<label>$label:</label>";
		echo "	</td>";	
		echo " 	<td class='span2'>";	
		echo " 		<div class='input-control text' data-role='input-control'>";	
		echo " 			<input type='text' name='$name' value='$value'>";	
		echo " 			<button class='btn-clear' tabindex='-1' type='button'></button>";	
		echo " 		</div>";	
		echo " 	</td>";
	}
	
	
// Select Input
	function drawSelect_Semester($link, $student_id) {
		echo "	<td class='span2'>";
		echo "		<label>Semester:</label>";
		echo"	</td>";
		echo "	<td class='span5'>";
		echo "		<div id='semesterlist' class='input-control select'>";
		echo "		<select name='semester_id'>";

						//get all student semesters
						$result = selectSemester_Student($link, $student_id);
						
						// fill in the rows for each semester
						while($row = mysql_fetch_array($result)){
							// set variables
							$semester_id  		= $row['semester_id'];
							$year       		= $row['year'];  
							$term   			= $row['term']; 
							
							// create option row
							echo "<option value=$semester_id>$term, $year</option>";
						}
						
		echo "		</select>";
		echo "		</div>";
		echo "	</td>";		
	}
	
	function drawSelect_Course($link, $semester_id) {
		echo "	<td class='span2'>";
		echo "		<label>Course:</label>";
		echo"	</td>";
		echo "	<td class='span5'>";
		echo "		<div id='courselist' class='input-control select'>";
		echo "		<select name='course_id'>";

						//get all student semesters
						$result = selectCourse_Semester($link, $semester_id);
						//echo "<option value=''></option>";
						while($row = mysql_fetch_array($result)){
							// set variables
							$course_id  		= $row['course_id'];
							$designation       	= $row['designation'];  
							$name   			= $row['name']; 
							
							// create option row
							echo "<option value=$semester_id>$designation, $name</option>";
						}
						
		echo "		</select>";
		echo "		</div>";
		echo "	</td>";		
	
	}
	
	function drawSelect_Year() {
		echo "	<td class='span2'>";
		echo "		<label>Year:</label>";
		echo "	</td>";
		echo "	<td class='span5'>";
		echo "		<div class='input-control select' data-role='input-control'>";
		echo "			<select name='year'>";
		echo "				<option>".date(Y)."</option>";
		echo "				<option>".(date(Y)+1)."</option>";
		echo "				<option>".(date(Y)+2)."</option>";
		echo "			</select>";
		echo "		</div>";
		echo "	</td>";
	}
	
	function drawSelect_Term() {
		echo "	<td class='span2'>";
		echo "		<label>Term:</label>";
		echo "	</td>";
		echo "	<td class='span5'>";
		echo "		<div class='input-control select' data-role='input-control'>";
		echo "			<select name='term'>";
		echo "				<option>Spring</option>";
		echo "				<option>Summer</option>";
		echo "				<option>Fall</option>";
		echo "			</select>";
		echo "		</div>";
		echo "	</td>";
	}
	
	function drawSelect_AssignmentType() {
		echo "	<td class='span2'>";
		echo "		<label>Assignment Type:</label>";
		echo "	</td>";
		echo "	<td class='span5'>";
		echo "		<div class='input-control select'>";
		echo "			<select name='assignment_type'>";
		echo "				<option>Exam</option>";
		echo "				<option>Quiz</option>";
		echo "				<option>Project</option>";
		echo "				<option>Homework</option>";
		echo "				<option>Discussion</option>";
		echo "				<option>Other</option>";
		echo "			</select>";
		echo "		</div>";
		echo "	</td>";
	}

	function drawSelect_TOD() {
		echo "	<tr><td class='span7'>";
		echo "		<label>What time during the day do you prefer to study?</label>";
		echo "	</td></tr>";
		echo "	<tr><td class='span7'>";
		echo "		<div class='input-control select'>";
		echo "			<select name='study_tod'>";
		echo "				<option>Morning</option>";
		echo "				<option>Afternoon</option>";
		echo "				<option>Evening</option>";
		echo "			</select>";
		echo "		</div>";
		echo "	</td></tr>";
	}
	
	function drawSelect_TOD_Value($value) {
		echo "	<tr><td class='span7'>";
		echo "		<label>What time during the day do you prefer to study?</label>";
		echo "	</td></tr>";
		echo "	<tr><td class='span7'>";
		echo "		<div class='input-control select'>";
		echo "			<select name='study_tod' value='$value'>";
		
		switch ($value) {
			case "Morning":
				echo "		<option selected='selected'>Morning</option>";
				echo "		<option>Afternoon</option>";
				echo "		<option>Evening</option>";
				break;
			case "Afternoon":
				echo "		<option>Morning</option>";
				echo "		<option selected='selected'>Afternoon</option>";
				echo "		<option>Evening</option>";
				break;
			case "Evening":
				echo "		<option>Morning</option>";
				echo "		<option>Afternoon</option>";
				echo "		<option selected='selected'>Evening</option>";
				break;
			}

		echo "			</select>";
		echo "		</div>";
		echo "	</td></tr>";
	}
	
	
// Select Input (Special Case)

	function drawSelect_DynamicCourse($link, $student_id) {
		
		// Select Semester
		echo"	<tr><td class='span2'>";
		echo"		<label>Semester:</label></td>";
		echo"	<td class='span5'>";
		echo"		<div class='input-control select'>";
		echo"			<select name='semester_id' onchange='showCourses(this.value)'>";
							$semesters = selectSemester_Student($link, $student_id);
							echo "<option value=''></option>";
							while($row = mysql_fetch_array($semesters)){
								// set variables
								$semester_id  		= $row['semester_id'];
								$year       		= $row['year'];  
								$term   			= $row['term']; 

								echo "<option value=$semester_id onselect=getOption_Semester()>$year, $term</option>";
							}
		echo"			</select>";
		echo"		</div>";
		echo"	</td></tr>";
		
		// Dynamic Course Selection (course list updates from semester selection)
		echo"<tr>";
		echo"	<td class='span2'><label>Course:</label></td>";	
		echo"	<td class='span5'>";
		echo"		<div id='courselist' class='input-control select'>";
		echo "			<select>";
		echo "				<option value=''></option>";									
		echo "			</select>";
		echo"		</div>";
		echo"	</td>";
		echo"</tr>";
	}

	function drawSelect_DynamicAssignment($link, $student_id) {
		
		// Select Semester
		echo"	<tr><td class='span2'>";
		echo"		<label>Semester:</label></td>";
		echo"	<td class='span5'>";
		echo"		<div class='input-control select'>";
		echo"			<select name='semester_id' onchange='showCourses(this.value)'>";
							$semesters = selectSemester_Student($link, $student_id);
							echo "<option value=''></option>";
							while($row = mysql_fetch_array($semesters)){
								// set variables
								$semester_id  		= $row['semester_id'];
								$year       		= $row['year'];  
								$term   			= $row['term']; 

								echo "<option value=$semester_id onselect=getOption_Semester()>$year, $term</option>";
							}
		echo"			</select>";
		echo"		</div>";
		echo"	</td></tr>";
		
		// Dynamic Course Selection (course list updates from semester selection)
		echo"<tr>";
		echo"	<td class='span2'><label>Course:</label></td>";	
		echo"	<td class='span5'>";
		echo"		<div id='courselist' class='input-control select'>";
		echo "			<select>";
		echo "				<option value=''></option>";									
		echo "			</select>";
		echo"		</div>";
		echo"	</td>";
		echo"</tr>";
		
		// Dynamic Assignment Selection (course list updates from semester selection)
		echo"<tr>";
		echo"	<td class='span2'><label>Assignment:</label></td>";	
		echo"	<td class='span5'>";
		echo"		<div id='assignmentlist' class='input-control select'>";
		echo "			<select>";
		echo "				<option value=''></option>";									
		echo "			</select>";
		echo"		</div>";
		echo"	</td>";
		echo"</tr>";
	}
	
	
// Other
	function drawOther_Gap() {
		echo "<td class='span10'><div style='margin-top: 20px'></div></td>";
	}
	
	function drawOther_Divider() {
		echo "<td class='span10'><div style='margin-top: 10px'><legend></legend></div></td>";
	}
	
	function drawOther_Datepicker($label, $name) {
		echo" 	<td class='span2'>";
		echo"		<label>$label:</label>";
		echo"	</td>";
		echo"	<td class='span5'>";
		echo"		<div class='input-control text' 
						data-role='datepicker' 
						data-week-start='1'
						data-format='yyyy/mm/dd'
						data-position='bottom'>";
		echo"			<input type='text' name='$name'>";
		echo"		</div>";
		echo"	</td>";
	}
	
	
// Buttons
	function drawButton_Submit($value) {
		echo "<td class='span2'><input type='submit' class='primary span2' value='$value' name='myFormSubmitted'></td>";
	}
	
	function drawButton_Remove() {
		echo "<td class='span2'><input type='submit' class='span2 danger' value='Remove' name='myFormSubmitted'></td>";
	}
	
	function drawButton_Reset() {
		echo "<td class='span2'><input type='reset' class='span2 inverse' value='Clear'></td>";
	}
	
	function drawButton_Link($URL, $value) {
		echo "<td class='span2'><button class='span2 offset1 info'><a href='$URL'>$value</a></button></td>";
	}
	
	
?>
