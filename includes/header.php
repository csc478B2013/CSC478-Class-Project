<!-- Tab Icon -->
<link rel="shortcut icon" href="/favicon.ico" >

<!-- Include Resource Files -->
<?php include 'functions.php'; ?>

<!-- Set Authentication -->
<?php
	$student_id = 1;
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
                    $studentResult = get_student($link, $student_id);
					$fname = get_student_fname($link, $studentResult);
					
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
					<li><a href="http://www.myuplan.com/#">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

