<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Page Header -->
	<header class="bg-dark" data-load='includes/header.php'></header>
    <header class="bg-white" data-load='includes/menu.html'></header>
	
	
	<!-- PHP Header Scripts -->
	<?php
		// include resource files
		include 'includes/functions.php';
		include 'includes/draw.php';
		
		// set user authentication
		$student_id = 1;
		
		// connect to database
		$link = db_connect();
	?>

	<!-- Load CSS Libraries -->
    <link href="css/metro-bootstrap.css" rel="stylesheet">
    <link href="css/metro-bootstrap-responsive.css" rel="stylesheet">
    <link href="css/iconFont.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
    <link href="js/prettify/prettify.css" rel="stylesheet">
	
	<!-- Load JavaScript Libraries -->
    <script src="js/jquery/jquery.min.js"></script>
    <script src="js/jquery/jquery.widget.min.js"></script>
    <script src="js/jquery/jquery.mousewheel.js"></script>
    <script src="js/prettify/prettify.js"></script>

    <!-- Metro UI CSS JavaScript plugins -->
    <script src="js/load-metro.js"></script>
	
    <!-- Load JavaScript Local Libraries-->
    <script src="js/docs.js"></script>
    
	<title>Test</title>
</head>

<!-- Page Body -->

<body class="metro">
<div class="container">
    <div class="grid">
        <div class="row">
        <?php

			//$test = 4;
			
			for($test = 2; $test < 10; $test++) { 	// cycle through all of the tests
		
				switch($test) {
					case 0: {		// No Test
						echo "<strong>No Test Selected</strong><br>";
						
						echo"<br><br><br>";
						
						break;
					}
					case 1: {		// Insert Test
						echo "<strong>Insert Test</strong><br>";
						
						// Test Insert Data
						Student::insert($link, 'Stephen', 'stephen@gmail.com', '999-888-7777', 'password123');
							Semester::insert($link, 1, 2014, 'Spring', '2014-01-01', '2014-05-25', '1');
								Course::insert($link, 1, 1, 'CSC 1', 'Class 1', 1);
									Assignment::insert($link, 1, 1, 1, 'Exam', 'Exam 1', '2014-01-02', 100);
									Assignment::insert($link, 1, 1, 1, 'Quiz', 'Quiz 1', '2014-01-04', 90);
									Assignment::insert($link, 1, 1, 1, 'Project', 'Project 1', '2014-01-06', 80);
									Assignment::insert($link, 1, 1, 1, 'Homework', 'Homework 1', '2014-01-07', 70);
									Assignment::insert($link, 1, 1, 1, 'Discussion', 'Discussion 1', '2014-01-10', 60);
									Assignment::insert($link, 1, 1, 1, 'Other', 'Other 1', '2014-01-12', 50);
								Course::insert($link, 1, 1, 'CSC 2', 'Class 2', 2);
									Assignment::insert($link, 1, 1, 2, 'Exam', 'Exam 2', '2014-01-02', 100);
									Assignment::insert($link, 1, 1, 2, 'Quiz', 'Quiz 2', '2014-01-04', 90);
									Assignment::insert($link, 1, 1, 2, 'Project', 'Project 2', '2014-01-06', 80);
									Assignment::insert($link, 1, 1, 2, 'Homework', 'Homework 2', '2014-01-07', 70);
									Assignment::insert($link, 1, 1, 2, 'Discussion', 'Discussion 2', '2014-01-10', 60);
									Assignment::insert($link, 1, 1, 2, 'Other', 'Other 2', '2014-01-12', 50);
								Course::insert($link, 1, 1, 'CSC 3', 'Class 3', 3);
									Assignment::insert($link, 1, 1, 3, 'Exam', 'Exam 3', '2014-01-02', 100);
									Assignment::insert($link, 1, 1, 3, 'Quiz', 'Quiz 3', '2014-01-04', 90);
									Assignment::insert($link, 1, 1, 3, 'Project', 'Project 3', '2014-01-06', 80);
									Assignment::insert($link, 1, 1, 3, 'Homework', 'Homework 3', '2014-01-07', 70);
									Assignment::insert($link, 1, 1, 3, 'Discussion', 'Discussion 3', '2014-01-10', 60);
									Assignment::insert($link, 1, 1, 3, 'Other', 'Other 3', '2014-01-12', 50);
								Course::insert($link, 1, 1, 'CSC 4', 'Class 4', 4);
									Assignment::insert($link, 1, 1, 4, 'Exam', 'Exam 4', '2014-01-02', 100);
									Assignment::insert($link, 1, 1, 4, 'Quiz', 'Quiz 4', '2014-01-04', 90);
									Assignment::insert($link, 1, 1, 4, 'Project', 'Project 4', '2014-01-06', 80);
									Assignment::insert($link, 1, 1, 4, 'Homework', 'Homework 4', '2014-01-07', 70);
									Assignment::insert($link, 1, 1, 4, 'Discussion', 'Discussion 4', '2014-01-10', 60);
									Assignment::insert($link, 1, 1, 4, 'Other', 'Other 4', '2014-01-12', 50);

							Semester::insert($link, 1, 2014, 'Fall', '2014-08-01', '2014-12-25', '0');
								Course::insert($link, 1, 2, 'CSC 5', 'Class 5', 1);
									Assignment::insert($link, 1, 2, 5, 'Exam', 'Exam 5', '2014-08-02', 100);
									Assignment::insert($link, 1, 2, 5, 'Quiz', 'Quiz 5', '2014-08-04', 90);
									Assignment::insert($link, 1, 2, 5, 'Project', 'Project 5', '2014-08-06', 80);
									Assignment::insert($link, 1, 2, 5, 'Homework', 'Homework 5', '2014-08-07', 70);
									Assignment::insert($link, 1, 2, 5, 'Discussion', 'Discussion 5', '2014-08-10', 60);
									Assignment::insert($link, 1, 2, 5, 'Other', 'Other 5', '2014-08-12', 50);
								Course::insert($link, 1, 2, 'CSC 6', 'Class 6', 2);
									Assignment::insert($link, 1, 2, 6, 'Exam', 'Exam 6', '2014-08-02', 100);
									Assignment::insert($link, 1, 2, 6, 'Quiz', 'Quiz 6', '2014-08-04', 90);
									Assignment::insert($link, 1, 2, 2, 'Project', 'Project 6', '2014-08-06', 80);
									Assignment::insert($link, 1, 2, 2, 'Homework', 'Homework 6', '2014-08-07', 70);
									Assignment::insert($link, 1, 2, 2, 'Discussion', 'Discussion 6', '2014-08-10', 60);
									Assignment::insert($link, 1, 2, 2, 'Other', 'Other 6', '2014-08-12', 50);
								Course::insert($link, 1, 2, 'CSC 7', 'Class 7', 3);
									Assignment::insert($link, 1, 2, 7, 'Exam', 'Exam 7', '2014-08-02', 100);
									Assignment::insert($link, 1, 2, 7, 'Quiz', 'Quiz 7', '2014-08-04', 90);
									Assignment::insert($link, 1, 2, 7, 'Project', 'Project 7', '2014-08-06', 80);
									Assignment::insert($link, 1, 2, 7, 'Homework', 'Homework 7', '2014-08-07', 70);
									Assignment::insert($link, 1, 2, 7, 'Discussion', 'Discussion 7', '2014-08-10', 60);
									Assignment::insert($link, 1, 2, 7, 'Other', 'Other 7', '2014-08-12', 50);
								Course::insert($link, 1, 2, 'CSC 8', 'Class 8', 4);
									Assignment::insert($link, 1, 2, 8, 'Exam', 'Exam 8', '2014-08-02', 100);
									Assignment::insert($link, 1, 2, 8, 'Quiz', 'Quiz 8', '2014-08-04', 90);
									Assignment::insert($link, 1, 2, 8, 'Project', 'Project 8', '2014-08-06', 80);
									Assignment::insert($link, 1, 2, 8, 'Homework', 'Homework 8', '2014-08-07', 70);
									Assignment::insert($link, 1, 2, 8, 'Discussion', 'Discussion 8', '2014-08-10', 60);
									Assignment::insert($link, 1, 2, 8, 'Other', 'Other 8', '2014-08-12', 50);
						
						Student::insert($link, 'Joe', 'joe@gmail.com', '111-222-3333', '123password');
							Semester::insert($link, 2, 2014, 'Spring', '2014-01-01', '2014-05-25', '1');
								Course::insert($link, 2, 3, 'CSC 9', 'Class 9', 1);
									Assignment::insert($link, 2, 3, 9, 'Exam', 'Exam 9', '2014-01-02', 100);
									Assignment::insert($link, 2, 3, 9, 'Quiz', 'Quiz 9', '2014-01-04', 90);
									Assignment::insert($link, 2, 3, 9, 'Project', 'Project 9', '2014-01-06', 80);
									Assignment::insert($link, 2, 3, 9, 'Homework', 'Homework 9', '2014-01-07', 70);
									Assignment::insert($link, 2, 3, 9, 'Discussion', 'Discussion 9', '2014-01-10', 60);
									Assignment::insert($link, 2, 3, 9, 'Other', 'Other 9', '2014-01-12', 50);
								Course::insert($link, 2, 3, 'CSC 10', 'Class 10', 2);
									Assignment::insert($link, 2, 3, 10, 'Exam', 'Exam 10', '2014-01-02', 100);
									Assignment::insert($link, 2, 3, 10, 'Quiz', 'Quiz 10', '2014-01-04', 90);
									Assignment::insert($link, 2, 3, 10, 'Project', 'Project 10', '2014-01-06', 80);
									Assignment::insert($link, 2, 3, 10, 'Homework', 'Homework 10', '2014-01-07', 70);
									Assignment::insert($link, 2, 3, 10, 'Discussion', 'Discussion 10', '2014-01-10', 60);
									Assignment::insert($link, 2, 3, 10, 'Other', 'Other 10', '2014-01-12', 50);
								Course::insert($link, 2, 3, 'CSC 11', 'Class 11', 3);
									Assignment::insert($link, 2, 3, 11, 'Exam', 'Exam 11', '2014-01-02', 100);
									Assignment::insert($link, 2, 3, 11, 'Quiz', 'Quiz 11', '2014-01-04', 90);
									Assignment::insert($link, 2, 3, 11, 'Project', 'Project 11', '2014-01-06', 80);
									Assignment::insert($link, 2, 3, 11, 'Homework', 'Homework 11', '2014-01-07', 70);
									Assignment::insert($link, 2, 3, 11, 'Discussion', 'Discussion 11', '2014-01-10', 60);
									Assignment::insert($link, 2, 3, 11, 'Other', 'Other 11', '2014-01-12', 50);
								Course::insert($link, 2, 3, 'CSC 12', 'Class 12', 4);
									Assignment::insert($link, 2, 3, 12, 'Exam', 'Exam 12', '2014-01-02', 100);
									Assignment::insert($link, 2, 3, 12, 'Quiz', 'Quiz 12', '2014-01-04', 90);
									Assignment::insert($link, 2, 3, 12, 'Project', 'Project 12', '2014-01-06', 80);
									Assignment::insert($link, 2, 3, 12, 'Homework', 'Homework 12', '2014-01-07', 70);
									Assignment::insert($link, 2, 3, 12, 'Discussion', 'Discussion 12', '2014-01-10', 60);
									Assignment::insert($link, 2, 3, 12, 'Other', 'Other 12', '2014-01-12', 50);

							Semester::insert($link, 2, 2014, 'Fall', '2014-08-01', '2014-12-25', '0');
								Course::insert($link, 2, 4, 'CSC 13', 'Class 13', 1);
									Assignment::insert($link, 1, 2, 13, 'Exam', 'Exam 13', '2014-08-02', 100);
									Assignment::insert($link, 2, 4, 13, 'Quiz', 'Quiz 13', '2014-08-04', 90);
									Assignment::insert($link, 2, 4, 13, 'Project', 'Project 13', '2014-08-06', 80);
									Assignment::insert($link, 2, 4, 13, 'Homework', 'Homework 13', '2014-08-07', 70);
									Assignment::insert($link, 2, 4, 13, 'Discussion', 'Discussion 13', '2014-08-10', 60);
									Assignment::insert($link, 2, 4, 13, 'Other', 'Other 13', '2014-08-12', 50);
								Course::insert($link, 2, 4, 'CSC 14', 'Class 14', 2);
									Assignment::insert($link, 2, 4, 14, 'Exam', 'Exam 14', '2014-08-02', 100);
									Assignment::insert($link, 2, 4, 14, 'Quiz', 'Quiz 14', '2014-08-04', 90);
									Assignment::insert($link, 2, 4, 14, 'Project', 'Project 14', '2014-08-06', 80);
									Assignment::insert($link, 2, 4, 14, 'Homework', 'Homework 14', '2014-08-07', 70);
									Assignment::insert($link, 2, 4, 14, 'Discussion', 'Discussion 14', '2014-08-10', 60);
									Assignment::insert($link, 2, 4, 14, 'Other', 'Other 14', '2014-08-12', 50);
								Course::insert($link, 2, 4, 'CSC 15', 'Class 15', 3);
									Assignment::insert($link, 2, 4, 15, 'Exam', 'Exam 15', '2014-08-02', 100);
									Assignment::insert($link, 2, 4, 15, 'Quiz', 'Quiz 15', '2014-08-04', 90);
									Assignment::insert($link, 2, 4, 15, 'Project', 'Project 15', '2014-08-06', 80);
									Assignment::insert($link, 2, 4, 15, 'Homework', 'Homework 15', '2014-08-07', 70);
									Assignment::insert($link, 2, 4, 15, 'Discussion', 'Discussion 15', '2014-08-10', 60);
									Assignment::insert($link, 2, 4, 15, 'Other', 'Other 15', '2014-08-12', 50);
								Course::insert($link, 2, 4, 'CSC 16', 'Class 16', 4);
									Assignment::insert($link, 2, 4, 16, 'Exam', 'Exam 16', '2014-08-02', 100);
									Assignment::insert($link, 2, 4, 16, 'Quiz', 'Quiz 16', '2014-08-04', 90);
									Assignment::insert($link, 2, 4, 16, 'Project', 'Project 16', '2014-08-06', 80);
									Assignment::insert($link, 2, 4, 16, 'Homework', 'Homework 16', '2014-08-07', 70);
									Assignment::insert($link, 2, 4, 16, 'Discussion', 'Discussion 16', '2014-08-10', 60);
									Assignment::insert($link, 2, 4, 16, 'Other', 'Other 16', '2014-08-12', 50);
						
						Student::insert($link, 'Mike', 'mike@gmail.com', '444-555-6666', 'pword');
						Student::insert($link, 'Christy', 'christy@gmail.com', '777-888-9999', '123abc');
						Student::insert($link, 'Luis', 'luis@gmail.com', '123-456-7890', '123456789');
						
						echo"<br><br><br>";
						
						break;
					}
					case 2: {		// Select Test
						echo "<strong>Select Test</strong><br>";
						
						// Check that records were deleted
						$student 	= Student::select($link, 2);
						$semester 	= Semester::select($link, 2);
						$course 	= Course::select($link, 2);
						$assignment	= Assignment::select($link, 2);
						
						// output retrieved data
						echo "	<table class='table'>
								<thead>
									<th class='span1 text-left'>Item 1</th>
									<th class='span2 text-left'>Item 2</th>
									<th class='span2 text-left'>Item 3</th>
									<th class='span2 text-left'>Item 4</th>
									<th class='span2 text-left'>Item 5</th>
									<th class='span1 text-left'>Item 6</th>
								</thead>";
						echo "	<tbody>";	
						echo "	<tr>
									<td class='span1'>$student->student_id</td>  
									<td class='span2'>$student->fname</td>
									<td class='span2'>$student->email</td>
									<td class='span2'>$student->phone</td>
									<td class='span2'>$student->password</td>
									<td class='span1'>||||||||||||||||</td>
								</tr>";
							
						echo "	<tr>
									<td class='span1'>$semester->semester_id</td>
									<td class='span2'>$semester->year</td>
									<td class='span2'>$semester->term</td>
									<td class='span2'>$semester->start_date</td>
									<td class='span2'>$semester->end_date</td>
									<td class='span1'>$semester->isCurrent</td>
								</tr>";
								
						echo "	<tr>
									<td class='span1'>$course->course_id</td>
									<td class='span2'>$course->designation</td>
									<td class='span2'>$course->name</td>
									<td class='span2'>$course->grade</td>
									<td class='span2'>||||||||||||||||</td>
									<td class='span1'>||||||||||||||||</td>
								</tr>";
								
						echo "	<tr>
									<td class='span1'>$assignment->assignment_id</td>
									<td class='span2'>$assignment->assignment_type</td>
									<td class='span2'>$assignment->name</td>
									<td class='span2'>$assignment->due_date</td>
									<td class='span2'>$assignment->points_allowed</td>
									<td class='span1'>$assignment->points_received</td>
								</tr>";
						echo "	</tbody>";
						echo "	</table>";
						
						echo"<br><br><br>";
						
						break;
					}
					case 3: { 		// Update Test
						echo "<strong>Update Test</strong><br>";
						
						// Test Update Data
						Student::update($link, 2, 'update1', 'update1@gmail.com', '111-111-1111', 'update1pass');
						Semester::update($link, 2, 2015, 'Summer', '2015-06-01', '2015-07-25', '0');
						Course::update($link, 2, 'CSC Update', 'update 1 class', 99);
						Assignment::update($link, 2, 'Other', 'update other assignment', '2015-06-03', 999, 900);
						
						// Check that records were deleted
						$student 	= Student::select($link, 2);
						$semester 	= Semester::select($link, 2);
						$course 	= Course::select($link, 2);
						$assignment	= Assignment::select($link, 2);
						
						// output retrieved data
						echo "	<table class='table'>
								<thead>
									<th class='span1 text-left'>Item 1</th>
									<th class='span2 text-left'>Item 2</th>
									<th class='span2 text-left'>Item 3</th>
									<th class='span2 text-left'>Item 4</th>
									<th class='span2 text-left'>Item 5</th>
									<th class='span1 text-left'>Item 6</th>
								</thead>";
						echo "	<tbody>";	
						echo "	<tr>
									<td class='span1'>$student->student_id</td>  
									<td class='span2'>$student->fname</td>
									<td class='span2'>$student->email</td>
									<td class='span2'>$student->phone</td>
									<td class='span2'>$student->password</td>
									<td class='span1'>||||||||||||||||</td>
								</tr>";
							
						echo "	<tr>
									<td class='span1'>$semester->semester_id</td>
									<td class='span2'>$semester->year</td>
									<td class='span2'>$semester->term</td>
									<td class='span2'>$semester->start_date</td>
									<td class='span2'>$semester->end_date</td>
									<td class='span1'>$semester->isCurrent</td>
								</tr>";
								
						echo "	<tr>
									<td class='span1'>$course->course_id</td>
									<td class='span2'>$course->designation</td>
									<td class='span2'>$course->name</td>
									<td class='span2'>$course->grade</td>
									<td class='span2'>||||||||||||||||</td>
									<td class='span1'>||||||||||||||||</td>
								</tr>";
								
						echo "	<tr>
									<td class='span1'>$assignment->assignment_id</td>
									<td class='span2'>$assignment->assignment_type</td>
									<td class='span2'>$assignment->name</td>
									<td class='span2'>$assignment->due_date</td>
									<td class='span2'>$assignment->points_allowed</td>
									<td class='span1'>$assignment->points_received</td>
								</tr>";
						echo "	</tbody>";
						echo "	</table>";
						
						echo"<br><br><br>";
						
						break;
					}
					case 4: {		// Compute Grades
						echo "<strong>Compute Grades Test</strong><br>";
						
						$GRADEtest1 = compute_gpa($link, 1); echo "GRADEtest1: $GRADEtest1<br>";
						$GRADEtest2 = compute_gpa($link, 2); echo "GRADEtest2: $GRADEtest2<br>";
						$GRADEtest3 = compute_gpa($link, 3); echo "GRADEtest3: $GRADEtest3<br>";
						$GRADEtest4 = compute_gpa($link, 4); echo "GRADEtest4: $GRADEtest4<br>";
						
						echo"<br><br><br>";
						
						break;
					}
					case 5: {		// Compute GPA
						echo "<strong>Compute GPA Test</strong><br>";
						
						$GPAtest1 = compute_gpa($link, 1); echo "GPAtest1: $GPAtest1<br>";
						$GPAtest2 = compute_gpa($link, 2); echo "GPAtest2: $GPAtest2<br>";
						$GPAtest3 = compute_gpa($link, 3); echo "GPAtest3: $GPAtest3<br>";
						$GPAtest4 = compute_gpa($link, 4); echo "GPAtest4: $GPAtest4<br>";
						
						echo"<br><br><br>";
						
						break;
					}					
					case 11: {		// Delete Test
						echo "<strong>Delete Test</strong><br>";
						// Test Delete Data
						Student::delete($link, 3);
						Semester::delete($link, 3);
						Course::delete($link, 3);
						Assignment::delete($link, 3);
						
						// Check that records were deleted
						Student::select($link, 3);
						Semester::select($link, 3);
						Course::select($link, 3);
						Assignment::select($link, 3);

						echo"<br><br><br>";
						
						break;
					}
					default: {		// Invalid Test
						echo "<strong>Invalid Test Selected</strong><br>";
						echo"<br><br><br>";
						break;
					}
				}
			}

            
        ?>
        </div>
    </div>
</div>

</body>


<!-- Page Footer -->
<footer>

    <?php
        // include footer files
        include 'includes/footer.html';

        // close database
        mysql_close($link);
    ?>

</footer>    
        
</html>