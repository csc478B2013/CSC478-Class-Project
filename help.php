<?php
	// include files
	include 'includes/auth.php';
	include 'includes/functions.php';
	include 'includes/drawTables.php';
	include 'includes/drawForms.php';
		
	// authenticate user
	$userLogged = authenticateUserCookieLogged();

	// connect to database
	$link = db_connect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Page Header -->
	<?php
		if ($userLogged) {
			echo "<header class='bg-dark' data-load='includes/header.php'></header>";
			echo "<header class='bg-white' data-load='includes/menu.html'></header>";
		} 
		else {
			echo "<header class='bg-dark' data-load='includes/public_header.php'></header>";
		}
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
    
	<title> Help </title>
</head>

<!-- Page Body -->
<body class="metro">
<div class="container">
    <div class="grid">
        <div class="row">
		
			<h2>Introduction:</h2>
			<p>Welcome to www.myuplan.com, which is a site that is dedicated to making your life as an online student easier and more productive. As an online student you are required to keep track of a dizzying array of information from which class project is due when to when do I need to start studying for that exam. MyUPlan can help with this since it organizes your classes and your course work in one location and lets you know when things are due. Also MyUPlan can keep track of your current grades as well as a running history of your time as an online student. With these tools you can make sure that you have all the organization you need to be a better student.</p>
<br/><br/>
			<h2>Setting Up Your Account</h2>
			<p>When you first arrive at www.myuplan.com you will be guided through a series of steps to help set up your account. The sign up process has been designed to be quick and easy for you and provide the service with the information that it needs to help you with your studies. So let's dive into the steps to set up an account with MyUPlan.</p><br/><br/>

			<p><strong>Step 1:</strong>  Click on the button labeled "Create Account" on www.myuplan.com site.</p>
			<img src="images/help/initScreenOfSite.gif"><br/><br/><br/><br/>

			<p><strong>Step 2:</strong>  Now you are taken to the New User Setup page where you will fill in details that allow you to log in to the site and to personalize your experience with MyUPlan.</p>
			<img src="images/help/newUserSetup.gif"><br/><br/>
			
			<p><strong>What do the Fields Mean?</strong></p>
			<ol>
			<li>First Name:  This is your first name and helps the service to personalize messages to you.</li>
			<li>Email: This is your log in identifier and allows us to get in touch with you.</li>
			<li>Phone Number: This is your phone number where you would like us to send texts to.</li>
			<li>Password: This is your password that allows you access to your information so please make it tough to guess and keep it well hidden.</li>
			</ol><br/><br/>
			

			<p><strong>Step 3:</strong>  Once you are done filling out the information on the New User Setup page click the Add button to be taken to the next screen.</p><br/><br/>

			<p><strong>Step 4:</strong>  You are now on the screen that will allow you to enter in your preferences for study, from what time of day you like to study to how many hours you want to study (by default) on each type of assignment.</p>
			<img src="images/help/studentSettingsSetup.gif"><br/><br/>

			<p><strong>What do the Fields Mean?</strong></p>
			<ol>
			<li>What time during the day do you prefer to study?:  This is the time of day that you like to study, be it morning, afternoon, etc.</li>
			<li>Exam: This is how many hours you want to devote to the study of an exam.</li>
			<li>Quiz: This is how many hours you want to devote to the study of a quiz.</li>
			<li>Project: This is how many hours you want to devote to working on a project.</li>
			<li>Homework: This is how many hours you want to devote to working on homework.</li>
			<li>Discussion: This is how many hours you want to devote to working on a discussion thread or question.</li>
			<li>Other: This is how many hours you want to devote to working on something outside our categories.</li>
			</ol><br/><br/>

			<p><strong>Step 5:</strong>  Once you are done filling out the information on the New User Questionnaire page click the Create button to be taken to the next screen.</p><br/><br/>

			<p><strong>Step 6:</strong>  This is where you start setting up your initial semester, course and assignments but first we will start with the setting up of the semester on this page.</p>
			<img src="images/help/addSemester.gif"><br/><br/>
			<p><strong>What do the Fields Mean?</strong></p> 
			<ol>
			<li>Year:  What year does this semester take place in?</li>
			<li>Term: Which term does the semester fall?</li>
			</ol><br/><br/>

			<p><strong>Step 7:</strong>  Once you are done filling out the information on the Add Semester page click the Add button to be taken to the next screen.</p><br/><br/>

			<p><strong>Step 8:</strong>  You have just added your semester so now lets add some courses to that semester.</p>
			<img src="images/help/addCourse.gif"><br/><br/>
			<p><strong>What do the Fields Mean?</strong></p> 
			<ol>
			<li>Semester:  Which semester is this course for?</li>
			<li>Designation: What is the course designation?</li>
			<li>Name: This is the name of the course, for example ‘Software Engineering Capstone".</li>
			<li>Credits: How many credits is this course worth in a numeric value.</li>
			</ol>
			
			<p><strong>What do the Buttons Mean?</strong></p>	
			<ol>
			<li>Add:  Adds the course to the semester.</li>
			<li>Clear: Clears out current values in fields.</li>
			<li>Add Assignment: After adding a course or two you may want to start adding assignments to each of your newly created classes.</li>
			</ol><br/><br/>

			<p><strong>Step 9:</strong>   When you are done adding your courses, and then click the Add Assignment button to start adding assignments to your various courses.</p><br/><br/>

			<p><strong>Step 10:</strong>   On this page you will begin adding your assignments to your classes. Keep pressing the Add button on this page to add all of the assignments for your various classes.</p>
			<img src="images/help/addAssignment.gif"><br/><br/>
			<p><strong>What do the Fields Mean?</strong></p> 
			<ol>
			<li>Semester:  Which semester is this assignment for?</li>
			<li>Course: What is the course for this assignment?</li>
			<li>Assignment Type: What kind of assignment is this, exam, homework, etc?</li>
			<li>Assignment Name: What is the name for this assignment?</li>
			<li>Due Date: When is this assignment due?</li>
			<li>Points Possible: How many points is this assignment worth?</li>
			</ol>

			<p><strong>What do the Buttons Mean?</strong></p>
			<ol>
			<li>Add:  Adds the assignment to the course.</li>
			<li>Clear: Clears out current values in fields.</li>
			<li>Add Course: Allows you to go back and add a course.</li>
			</ol><br/><br/>

			<p><strong>Step 11:</strong>   When you are done adding all of your assignments click on the Dashboard menu item and from there you are taken to the Dashboard of MyUPlan where you can see all of your current classes. Now congratulate yourself since you have just finished setting up your account with MyUPlan.</p><br/><br/>

			<h2>Using MyUPlan</h2>
			<p><strong>Logging In</strong></p>
			<p>To log in click either the log in button at the upper right of the home page or log in with the form on the home page of MyUPlan.</p>
			<img src="images/help/initScreenOfSite.gif"><br/><br/><br/><br/>

			<p><strong>Logging Out</strong></p>
			<p>Logging out is as simple as clicking the gear icon on the upper right of the top navigation bar and choosing Log Out.</p>
<br/><br/>
			<h2>Dashboard In Detail</h2>
			<p>The dashboard page is the first page that you are taken to when you log in and it is possibly the most important page for you. From here you can see upcoming assignments and view current grades for all of your current classes. The dashboard also serves as a jumping off point to the various sections of the MyUPlan service. The Tasks column shows what assignments are upcoming and each entry shows the name of the assignment, its point's value, its due date and the course it belongs to. The second column, Current Grades, shows the current grades you are receiving in each course as well as your GPA for the semester.</p>
			<img src="images/help/dashBoard_data.gif"><br/><br/><br/><br/>

			<h2>View Menu In Detail</h2>
			<p>Under the View menu option there are two entries, Current Semester and History. The Current Semester shows you a list of your current courses, which can be further broken out into the assignments for that course. The History link shows you your history broken out by semester, which can be broken, out by course and further by assignment for a course.</p><br/><br/>

			<p><strong>Current Semester In Detail</strong></p>
			<p>Under the View menu is the Current Semester page where you can view all of your courses for that semester as well as all of the assignments for each course. The window below shows the initial state of the Current Semester page, which shows your current GPA, and a list of courses.</p> 
			<img src="images/help/currentSemesterInit.gif"><br/><br/>
			<p>Clicking on one of the courses will reveal a list of assignments for that course.</p>
			<img src="images/help/currentSemesterExpanded.gif"><br/><br/><br/><br/>
			
			<h2>History In Detail</h2>
			<p>Under the View menu is the History page, which shows all of your semesters, courses and assignments. The courses are grouped under the semesters they were in and the assignments are grouped under the courses they are for. Below is the History page when you have clicked on one of the semesters, which shows the GPA for that semester as well as the courses taken during that semester.</p>
			<img src="images/help/historyMain.gif"><br/><br/><br/><br/>
			<p>This next image shows what happens when you click on one of the classes. Which shows the grade you have received in the course as well as a breakdown of all of the assignments and grades for that course.</p>
			<img src="images/help/historyClass.gif"><br/><br/><br/><br/>

			<h2>View Create in Detail</h2>
			<p><strong>Creating Your Optimal Plan for a Course</strong></p>
			<p>On this screen you pick your semester and course and then the grade that you want in the class. Make sure that all of your assignments are loaded into MyUPlan so that we can accurately give you advice on what grades you will need to get in each assignment. </p>
			<img src="images/help/optimalPlan.gif"><br/><br/>
		<p><strong>What do the Fields Mean?</strong></p> 
			<ol>
			<li>Semester:  Which semester is this plan for?</li>
			<li>Course: What is the course for this plan?</li>
			<li>Desired Grade: What grade do you want in this class?</li>
			</ol>
			<br/><br/>
			<h2>Modify Menu In Detail</h2>
			<p>Under the Modify menu option there are three initial listings of Semester, Course and Assignment. These three selections allow you to be able to go into each type and either add a new entry, delete an entry or in the case of Assignments update a score. This is where you can create a new semester at the beginning of a new semester and where they can add courses and assignments as you see fit.</p><br/><br/>

			<h3>Modify Semester In Detail</h3>
			<p>Under the Semester listing in the Modify menu you can either add or delete a semester.</p>
<br/>
			<p><strong>Adding a Semester</strong></p>
			<p>This process is straightforward and easy.</p>
			<img src="images/help/addSemester.gif"><br/><br/>
		<p><strong>What do the Fields Mean?</strong></p> 
			<ol>
			<li>Year:  What year does this semester take place in?</li>
			<li>Term: Which term does the semester fall?</li>
			</ol>
<br/><br/>
			<p><strong>Deleting a Semester</strong></p>
			<p>This is a one-click delete and will delete all courses and assignments associated with this semester so be careful. Choose the semester you which to delete from the drop down menu.</p>
			<img src="images/help/removeSemester.gif"><br/><br/><br/><br/>
			
			
			<h3>Modify a Course In Detail</h3>
			<p>Under the Course listing in the Modify menu you can either add or delete a course.</p>
<br/>
			<p><strong>Adding a Course</strong></p>
			<p>It is easy and quick to add a new course to MyUPlan.</p>
			<img src="images/help/addCourse.gif"><br/><br/>
			<p><strong>What do the Fields Mean?</strong></p> 
			<ol>
			<li>Semester:  Which semester is this course for?</li>
			<li>Designation: What is the course designation?</li>
			<li>Name: This is the name of the course, for example ‘Software Engineering Capstone".</li>
			<li>Credits: How many credits is this course worth in a numeric value.</li>
			</ol>
			
			<p><strong>What do the Buttons Mean?</strong></p>
			<ol>
			<li>Add:  Adds the course to the semester.</li>
			<li>Clear: Clears out current values in fields.</li>
			<li>Add Assignment: After adding a course or two you may want to start adding assignments to each of your newly created classes.</li>
				</ol><br/><br/>

			<p><strong>Deleting a Course</strong></p>
			<p>Deleting a course will remove that course and all of the assignments associated with that course so be very careful in deleting a course. Choose the semester the course is in then chose the course you wish to delete.</p>
			<img src="images/help/removeCourse.gif"><br/><br/><br/><br/>
			
			<h3>Modify an Assignment In Detail</h3>
			<p>Under the Assignment listing in the Modify menu you can either add or delete an assignment or update the score on that assignment.</p><br/>

			<p><strong>Adding an Assignment</strong></p>
			<p>Adding a new assignment is a snap with MyUPlan.</p>
			<img src="images/help/addAssignment.gif"><br/><br/>
			<p><strong>What do the Fields Mean?</strong></p> 
			<ol>
			<li>Semester:  Which semester is this assignment for?</li>
			<li>Course: What is the course for this assignment?</li>
			<li>Assignment Type: What kind of assignment is this, exam, homework, etc?</li>
			<li>Assignment Name: What is the name for this assignment?</li>
			<li>Due Date: When is this assignment due?</li>
			<li>Points Possible: How many points is this assignment worth?</li>
				</ol>
			
			<p><strong>What do the Buttons Mean?</strong></p>
			<ol>
			<li>Add:  Adds the assignment to the course.</li>
			<li>Clear: Clears out current values in fields.</li>
			<li>Add Course: Allows you to go back and add a course.</li>
			</ol><br/><br/>
			
			
			<p><strong>Deleting an Assignment</strong></p>
			<p>Deleting an assignment will remove that assignment from MyUPlan. To delete Choose the semester and the course that the assignment is in then chose the assignment you wish to delete.</p>
			<img src="images/help/removeAssignment.gif"><br/><br/><br/><br/>
			<p><strong>Updating the score on an Assignment</strong></p>
			<p>To update the score on an assignment you just select the semester and the course the assignment is in from the drop down lists and then select the assignment. Once this is done enter the score you received for that assignment.</p>
			<img src="images/help/updateAssignmentScore.gif"><br/><br/><br/><br/>

			<h2>Updating Your Account Information</h2>
			<p>To update your account information, make sure that you are logged in, click the gear icon in the upper right corner of MyUPlan and click the Account link. When you click the Account link you are taken to the Update Student Settings page and from here you can update your account.</p><br/><br/>

			<p><strong>Update User Settings</strong></p>
			<img src="images/help/updateStudentSettings.gif"><br/><br/>
			<p><strong>What do the Fields Mean?</strong></p> 
			<ol>
			<li>First Name:  This is your first name and helps the service to personalize messages to you.</li>
			<li>Email: This is your log in identifier and allows us to get in touch with you.</li>
			<li>Phone Number: This is your phone number where you would like us to send texts to.</li>
			<li>Password: This is your password that allows you access to your information so please make it tough to guess and keep it well hidden.</li>
			<li>What time during the day do you prefer to study?:  This is the time of day that you like to study, be it morning, afternoon, etc.</li>
			<li>Exam: This is how many hours you want to devote to the study of an exam.</li>
			<li>Quiz: This is how many hours you want to devote to the study of a quiz.</li>
			<li>Project: This is how many hours you want to devote to working on a project.</li>
			<li>Homework: This is how many hours you want to devote to working on homework.</li>
			<li>Discussion: This is how many hours you want to devote to working on a discussion thread or question.</li>
			<li>Other: This is how many hours you want to devote to working on something outside our categories.</li>
			</ol>
<br/><br/>
			
			
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