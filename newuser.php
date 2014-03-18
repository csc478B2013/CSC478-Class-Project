<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Page Header -->
	<header class="bg-dark" data-load='includes/header.html'></header>
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
    
	<title> New User </title>
</head>

<!-- Page Body -->
<body class="metro">
	<div class="grid span10 offset1">
		<div class="row span8">
			<form>
			<fieldset>
				<legend>New User Setup</legend>
				<table>

					<!-- Get First Name -->
					<tr>
						<td class="span2"><label>First Name:</label></td>
						<td class="span5">
							<div class="input-control text" data-role="input-control">
								<input type="text" placeholder="ex. John">
								<button class="btn-clear" tabindex="-1" type="button"></button>
							</div>
						</td>
					</tr>
					
					<!-- Get Email -->
					<tr>
						<td class="span2"><label>Email:</label></td>
						<td class="span5">
							<div class="input-control text" data-role="input-control">
								<input type="email" placeholder="ex. john@gmail.com">
								<button class="btn-clear" tabindex="-1" type="button"></button>
							</div>
						</td>
					</tr>
					
					<!-- Get Phone Number -->
					<tr>
						<td class="span2"><label>Phone Number:</label></td>
						<td class="span5">
							<div class="input-control text" data-role="input-control">
								<input type="tel" placeholder="ex. (888)123-4567">
								<button class="btn-clear" tabindex="-1" type="button"></button>
							</div>
						</td>
					</tr>
					
					<!-- Get Password -->
					<tr>
						<td class="span2"><label>Password:</label></td>
						<td class="span5">
							<div class="input-control password" data-role="input-control">
								<input type="password" placeholder="yourpasswordthatnobodywillguess" autofocus="">
								<button class="btn-reveal" tabindex="-1" type="button"></button>
							</div>
						</td>
					</tr>
					
					<!-- Force Gap Between Input and Buttons -->
					<tr>
						<td class="span10"><div style="margin-top: 20px"></div></td>
					</tr>
					
					<!-- Submission Control Buttons -->
					<tr>
						<td class="span2"><input type="submit" class="span2" value="Next"></td>
						<td class="span2"><input type="reset" class="span2" value="Reset Form"></td>
					</tr>
				</table>
			</fieldset>
			</form>
		</div>
	</div>
 
</body>  
 
<!-- Page Footer -->
<footer>

</footer>

</html>