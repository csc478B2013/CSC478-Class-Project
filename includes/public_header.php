<!-- Tab Icon -->
<link rel="shortcut icon" href="../favicon.ico" >


<!-- Turn on PHP Output Buffering -->
<?php ob_start(); ?>
<!-- Navigation Bar -->
<div class="navigation-bar dark">
    <div class="navigation-bar-content">
        <!-- Add homepage with icon to navigation bar -->
        <a href="http://www.myuplan.com/" class="element"><span class="icon-laptop"></span> &nbsp; MyUPlan</a>

<!--TEMP--><!-- Add homepage with icon to navigation bar -->
        <a href="_test.php" class="element"> Test Page</a>
<!--TEMP--> 

        <!-- Enable pull menu for smaller screens -->
        <a class="element1 pull-menu" href="#"></a>
        <ul class="element-menu place-right">
			<li>
				<a href="#" class="element" id="windowLogin"><span class="icon-user"></span> &nbsp; Login &nbsp; </a>
			</li>
            <li>
                <!-- Divider -->
                <span class="element-divider place-right"></span>
            </li>
            <li>
                <!-- Add settings options to navigation bar -->
                <a class="dropdown-toggle" href="#"><span class="icon-cog"></span></a>
                <ul class="dropdown-menu dark place-right" data-role="dropdown">
                    <li><a href="http://www.myuplan.com/contact">Contact</a></li>
                    <li><a href="http://www.myuplan.com/help">Help</a></li>
                </ul>
            </li>
        </ul>
		
		<script>
		$(function(){
			$("#windowLogin").on('click', function(){
				$.Dialog({
					overlay: true,
					shadow: true,
					flat: true,
					draggable: true,
					title: 'Flat window',
					content: '',
					padding: 10,
					onShow: function(_dialog){
						var content = 
						'<form class="user-input" action="index.php" method="post" >' +
							'<label>Email</label>' +
							'<div class="input-control text"><input type="text" name="login"><button class="btn-clear"></button></div>' +
								'<label>Password</label>'+
								'<div class="input-control password"><input type="password" name="password"><button class="btn-reveal"></button></div>' +
								'<div class="form-actions">' +
								'<label></label>'+
								'<button class="button primary" type="submit" name="loginForm">Login to</button>&nbsp;'+
								'<button class="button warning" type="button" onclick="$.Dialog.close()">Cancel</button> '+
								'<button class="button info offset1"><a href="http://www.myuplan.com/newuser.php">Create Account</a></button></a>&nbsp;'+
							'</div>'+
						'</form>';

						$.Dialog.title("Student login");
						$.Dialog.content(content);
					}
				});
			});
		})
	</script>

    </div>
</div>
