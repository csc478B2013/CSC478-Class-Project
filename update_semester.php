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
    <script src="js/github.info.js"></script>

	<title> Update Semester </title>
</head>

<!-- Page Body -->
<body class="metro">

	<div class="grid span10 offset1">
		<div class="row span8">
			<form>
			<fieldset>
			<legend>Select Semester</legend>
				<table>
				
					<!-- Select Semester -->
					<tr>
						<td class="span2"><label>Semester:</label></td>
						<td class="span5">
							<div class="input-control select">
								<select>
									<option>Summer 2014</option>	<!-- select current semester by default -->
									<option>Spring 2014</option>
								</select>
							</div>
						</td>
					</tr>
					
				</table>   
			</fieldset>
			</form>
		</div>
		
		<div class="row span8">
			<form>
			<fieldset>
			<legend>Update Semester</legend>
				<table>

					<!-- Select Year -->
					<tr>
						<td class="span2"><label>Year:</label></td>
						<td class="span5">
							<div class="input-control select">
								<select>									<!-- Select Current Year by Default -->
									<option>2012</option>
									<option>2013</option>
									<option>2014</option>
									<option>2015!</option>
								</select>
							</div>
						</td>
					</tr>
					
					<!-- Select Term -->
					<tr>
						<td class="span2"><label>Term:</label></td>
						<td class="span5">
							<div class="input-control select">
								<select>
									<option>Spring</option>
									<option>Summer</option>
									<option>Fall</option>
								</select>
							</div>
						</td>
					</tr>
					
					<!-- Select Start Date -->
					<tr>
						<td class="span2"><label>Start Date:</label></td>
						<td class="span5">
							<div class="input-control text" data-role="datepicker" data-week-start="1">
								<input type="text">
								<button class="btn-date"></button>
							</div>
						</td>
					</tr>					
						
					<!-- Select End Date -->
					<tr>
						<td class="span2"><label>End Date:</label></td>
						<td class="span5">
							<div class="input-control text" data-role="datepicker" data-week-start="1">
								<input type="text">
								<button class="btn-date"></button>
							</div>
						</td>
					</tr>
					
					<!-- Force Gap Between Input and Buttons -->
					<tr>
						<td class="span10"><div style="margin-top: 20px"></div></td>
					</tr>
					
					<!-- Submission Control Buttons -->
					<tr>
						<td class="span2"><input type="submit" class="span2" value="Add"></td>
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