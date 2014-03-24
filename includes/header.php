<!-- Tab Icon -->
<link rel="shortcut icon" href="/favicon.ico" >


<!-- PHP Header Scripts -->
	<?php
		// include resource files
		include 'functions.php';
		include 'drawTables.php';
		include 'drawForms.php';
		
		// set the student id
		$student_id = $_COOKIE["UserIdent"];
		
		// connect to database
		$link = db_connect();
	?>
	
<!-- Navigation Bar -->
<div class="navigation-bar dark">
    <div class="navigation-bar-content">
        <!-- Add homepage with icon to navigation bar -->
        <a href="http://www.myuplan.com/" class="element">
		<span class="icon-laptop"></span> &nbsp; MyUPlan</a> 
 
        <!-- Enable pull menu for smaller screens -->
        <a class="element1 pull-menu" href="#"></a>
        <ul class="element-menu place-right">
            <li>
                <!-- Add identifier to navigation bar -->
				<?php
					// get information from database
                    $student = Student::select($link, $student_id);
					$fname = $student->fname;
					
					// output name to header
					echo "<a href='http://www.myuplan.com/dashboard.php' class='element'><span class='icon-user'></span> &nbsp;".$fname."&nbsp; </a>";
				?>
				
            </li>
            <li>
                <!-- Divider -->
                <span class="element-divider place-right"></span>
            </li>
            <li>
                <!-- Add settings options to navigation bar -->
                <a class="dropdown-toggle" href="#"><span class="icon-cog"></span></a>
                <ul class="dropdown-menu dark place-right" data-role="dropdown">
                    <li><a href="account.php">Account</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="help.php">Help</a></li>
					<li class="divider"></li>
					<li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

