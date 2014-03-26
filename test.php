<?php
	// include files
	include 'includes/auth.php';
	include 'includes/functions.php';
	include 'includes/drawTables.php';
	include 'includes/drawForms.php';
	include 'includes/testFunctions.php';
		
	// connect to database
	$link = db_connect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Page Header -->
	<header class="bg-dark" data-load='includes/public_header.php'></header>
    <header class="bg-white" data-load='includes/menu.html'></header>

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
    
	<title>Unit Test Page</title>
</head>

<!-- Page Body -->

<body class="metro">
<div class="container">
    <div class="grid">
        <div class="row">
        <div class="span10 offset1">
			<form action="test.php" method="post">
			<fieldset>
				<legend>Unit Test Selections</legend>
				<table>

					<!-- Select Year -->
					<tr><?php drawSelect_Test(); ?></tr>
					
					<!-- Force Gap Between Input and Buttons -->
					<tr><?php drawOther_Gap(); ?></tr>
					
					<!-- Submission Control Buttons -->
					<tr><?php drawButton_SelectTest(); ?></tr> 

				</table>   
			</fieldset>
			</form>
		</div>
		</div>
		
			<!-- This section is handles the output of the test selected -->
			<?php
				if(isset($_POST['myFormSubmitted'])) {
					
					// local variables
					$test    		= $_POST['test'];
					
					// perform selected test
					switch($test) {
                        case 0:
                            echo "No Test Selected";
                            break;
                        
						case 1:
							testInsert($link);			// Insert Test
							testSelect($link);			// Select Test After Inserts
							break;
							
						case 2:
							testSelect($link);			// Select Test
							break;
							
						case 3;
							testUpdate_Scores($link);	// Update Test
							testSelect($link);			// Select Test After Updates
							break;						
							
						case 11:
							testDelete($link);			// Delete Database Content
							testSelect($link);			// Select Test After Delet All
							break;
					}
					
					// perform all tests
					if ($test == 100) {
						testInsert($link);			// Insert Test
						testSelect($link);			// Select Test After Tests
						testUpdate_Scores($link);	// Update Test
						testSelect($link);			// Select Test After Updates
						testDelete($link);			// Delete Database Content
						testSelect($link);			// Select Test After Delete All
					}
				}
				
			?>
		
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