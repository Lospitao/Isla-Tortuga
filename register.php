<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';


?>
<!DOCTY
PE html>
<html>
<head>

		<title>Welcome to Tortuga Island!</title>
		<link rel="stylesheet" type="text/css" href="assets/css/reg-stylesheet.css">
		
</head> 
<body>
	<div class="wrapper">
		<div class = "login_box">
			<div class="login_header">
			<h1>Tortuga Island</h1>
			Log in or sign up below!
			</div>
			<form action="register.php" method="POST">
			
				
				<input type="email" name="log_email" placeholder="Email Address" value="<?php 
						if (isset($_SESSION['log_email'])) {
							echo $_SESSION['log_email'];
						}
						?>" required>
				<br>
				<input type="password" name="log_password" placeholder="Password">
				<br>
				<input type="submit" name="login_button" value="Get on board son!">
				<br>
				<?php if(in_array("Not gonna happen,son! Get your s**t together and write both email and password correct!<br>", $error_array)) echo "Not gonna happen,son! Get your s**t together and write both email and password correct!<br>";
				?>
					
				 
			</form>

			<form action="register.php" method="post">
			
					
				<input type="text" class="form-control" name="reg_fname" placeholder="First Name" 
				value="<?php 
						if (isset($_SESSION['reg_fname'])) {
							echo $_SESSION['reg_fname'];
						}
						?>"
				required>
				<br>
				<?php 
				if(in_array("Avast ye!That name o'yours is longer that this ship Jacob's ladder,
				or shorter than a lassie's lil' thingie. Try again Bucko! This time bewteen 2 and 25
				characters.<br>", $error_array))
					echo "Avast ye!That name o'yours is longer that this ship Jacob's ladder,
				or shorter than a lassie's lil' thingie. Try again Bucko! This time bewteen 2 and 25
				characters.<br>";
				?>
				<input type="text" class="form-control" name="reg_lname" placeholder="Last Name" 
				value="<?php 
						if (isset($_SESSION['reg_lname'])) {
							echo $_SESSION['reg_lname'];
						}
						?>"
				required>
				<br>
				<?php 
				if(in_array("Avast ye!That last name o'yours is longer that this ship Jacob's ladder,
				or shorter than a lassie's lil' thingie. Try again Bucko! This time bewteen 2 and 25
				characters.<br>", $error_array))
					echo "Avast ye!That last name o'yours is longer that this ship Jacob's ladder,
				or shorter than a lassie's lil' thingie. Try again Bucko! This time bewteen 2 and 25
				characters.<br>";
				?>

				<input type="email" class="form-control" name="reg_email" placeholder="Email" 
				value="<?php 
						if (isset($_SESSION['reg_email'])) {
							echo $_SESSION['reg_email'];
						}
						?>"
				required>
				<br>	 
				<input type="email" class="form-control" name="reg_email2" placeholder="Confirm Email" 
				value="<?php 
						if (isset($_SESSION['reg_email2'])) {
							echo $_SESSION['reg_email2'];
						}
						?>"
				required>
				<br>
				<?php 
				if(in_array("Not creative enough child, think of a different email.<br>",$error_array))
					echo "Not creative enough child, think of a different email.<br>";		 
				else if(in_array("Are you single-handed? That format offends God himself. 
				Check it you freshwater sailor.<br>",$error_array))
					echo "Are you single-handed? That format offends God himself. 
				Check it you freshwater sailor.<br>";
				else if(in_array("Blimey son, emails don't match, 
				for Christ sake, check'em!<br>",$error_array))
					echo "Blimey son, emails don't match, 
				for Christ sake, check'em!<br>";
				?>
				<input type="password" class="form-control" name="reg_password" placeholder="Password" required>
				<br>
				<input type="password" class="form-control" name="reg_password2" placeholder="Confirm Pasword" required>
				<br>
				<?php 
				if(in_array("U reckles Landlubber! What did you think we requested you to confirm password for?
				Make them equal or sure as I am the master pirate I will maroon the sh** out of you!<br>", $error_array))
					echo "U reckles Landlubber! What did you think we requested you to confirm password for?
				Make them equal or sure as I am the master pirate I will maroon the sh** out of you!<br>";
				else if(in_array("So we have an Old Salt'n here, huh? Password must only 
					contain latin alphabet letters or numbers. Suck it!<br>", $error_array))
					echo "So we have an Old Salt'n here, huh? Password must only 
					contain latin alphabet letters or numbers. Suck it!<br>";
				else if(in_array("Your damn watchword must be between 5 and 30 characters!<br>", $error_array))
					echo "Your damn watchword must be between 5 and 30 characters!<br>";
				?>
				<input type="submit" name="register_button" value="Join us, you little rascal">
				<br>
				<?php 
				if(in_array("<span style='color:#14c800'>You're all set! Go ahead and login!</span><br>", $error_array)) echo "<span style='color:#14c800'>You're all set! Go ahead and login!</span><br>";
				?>
				
				
				
			</form>
		</div>
	<div>
</body>
</html>
	