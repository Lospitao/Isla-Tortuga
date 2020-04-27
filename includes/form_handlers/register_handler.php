<?php
/*Declare variables to prevent errors*/
$fname="";
$lname="";
$email="";
$email2="";
$password="";
$password2="";
$date="";
$error_array=array();

if (isset($_POST['register_button'])) {
	/*Registration form values*/
	/*First Name*/
	$fname=strip_tags($_POST['reg_fname']); /*remove html tags*/
	$fname=str_replace(' ', '', $fname); /*remove spaces in*/
	$fname=ucfirst(strtolower($fname));/*convert to lower case and capitalice first letter*/
	$_SESSION['reg_fname']=$fname;/*Stores first name into session variable*/
	/*Last Name*/
	$lname=strip_tags($_POST['reg_lname']);
	$lname=str_replace(' ','', $lname); 
	$lname=ucfirst(strtolower($lname));
	$_SESSION['reg_lname']=$lname;
	/*email*/
	$email=strip_tags($_POST['reg_email']);
	$email=str_replace(' ', '', $email); 
	$email=ucfirst(strtolower($email));
	$_SESSION['reg_email']=$email;
	/*email2*/
	$email2=strip_tags($_POST['reg_email2']);
	$email2=str_replace(' ', '', $email2); 
	$email2=ucfirst(strtolower($email2));
	$_SESSION['reg_email2']=$email2;
	/*password*/
	$password=strip_tags($_POST['reg_password']);
	$password2=strip_tags($_POST['reg_password2']);
	/*date*/
	$date=date("Y-m-d");

	if ($email==$email2) {
		/*check here if emails are in a valid format*/
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$email = filter_var($email, FILTER_VALIDATE_EMAIL);
		/*check if email has already been used*/
			$email_check=mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");
		/*count the numner of rows returned*/
			$num_rows=mysqli_num_rows($email_check);
			if ($num_rows>0) {
				array_push($error_array, "Not creative enough child, think of a different email.<br>");

			}
		}
		else{
		array_push($error_array, "Are you single-handed? That format offends God himself. 
		Check it you freshwater sailor.<br>" );
		}
	}
	else {
		array_push($error_array, "Blimey son, emails don't match, 
		for Christ sake, check'em!<br>");
	}
	if (strlen($fname)>25 || strlen($fname) < 2) {
		array_push($error_array, "Avast ye!That name o'yours is longer that this ship Jacob's ladder,
		or shorter than a lassie's lil' thingie. Try again Bucko! This time bewteen 2 and 25
		characters.<br>");
	}
	if (strlen($lname)>25 || strlen($lname) < 2) {
		array_push($error_array,"Avast ye!That last name o'yours is longer that this ship Jacob's ladder,
		or shorter than a lassie's lil' thingie. Try again Bucko! This time bewteen 2 and 25
		characters.<br>");
	}
	if ($password != $password2) {
		array_push($error_array, "U reckles Landlubber! What did you think we requested you to confirm password for?
		Make them equal or sure as I am the master pirate I will maroon the sh** out of you!<br>");
	}
	else {
		if(preg_match('/[^A-Za-z0-9]/', $password)) {
			array_push($error_array, "So we have an Old Salt'n here, huh? Password must only 
			contain latin alphabet letters or numbers. Suck it!<br>");
		}
	}
	if (strlen($password)>30 || strlen($password) < 5) {
		array_push($error_array, "Your damn watchword must be between 5 and 30 characters!<br>");
	}
	if(empty($error_array)) {
		$password=md5($password); /*md5 to encrypt password before sending it to database*/
		/*generate $username*/
		$username=strtolower($fname."_".$lname);
		$check_username_query=mysqli_query($conn, "SELECT username FROM users WHERE username='$username'");
		$i=0;
		/*if username exists add numeber to username*/
		while (mysqli_num_rows($check_username_query) !=0) {
			$i++;
			$username=$username."_".$i;
			$check_username_query=mysqli_query($conn, "SELECT username FROM users WHERE username='$username'");
		}
		/*Profile picture assignment*/
		$rand = rand(1,2); /*random number between 1 and 4*/
		
		if ($rand==1) 
			$profile_pic="assets/images/profile_pics/default/blaman.png";
		else if 
			($rand==2) $profile_pic="assets/images/profile_pics/default/blaboy.png";
		

		$query=mysqli_query($conn, "INSERT INTO users VALUES (NULL,'$fname', '$lname', '$username', '$email', '$password', '$date', '$profile_pic','0', '0', 'no', ',')");
		array_push($error_array,"<span style='color:#14c800'>You're all set! Go ahead and login!</span><br>");
		/*Clear session variables*/
		$_SESSION['reg_fname']="";
		$_SESSION['reg_lname']="";
		$_SESSION['reg_email']="";
		$_SESSION['reg_email2']="";
	}
}
