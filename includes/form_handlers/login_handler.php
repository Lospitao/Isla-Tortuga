<?php  

if(isset($_POST['login_button'])) {

	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //Filter variable (inserted email) and remove all illegal characters from an email address

	$_SESSION['log_email'] = $email; //Store email into session variable 
	
	$password = md5($_POST['log_password']); //Get password

	$check_database_query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");
	$check_login_query = mysqli_num_rows($check_database_query); //returns the number of results which will be 1 or 0

	if($check_login_query ==1) {
		$row = mysqli_fetch_array($check_database_query);
		$username = $row['username'];

		$user_closed_query = mysqli_query ($conn, "SELECT * FROM users WHERE email='$email' AND user_closed='yes'"); 
		if(mysqli_num_rows($user_closed_query)==1) { 
			$reopen_account=mysqli_query($conn, "UPDATE users SET user_closed='no' WHERE email='$email'"); 
		} /*if you find the result and user is closed reopen it*/

		$_SESSION['username'] = $username; /*as long as $_SESSION is not empty, it means the user is logged in*/
		header("Location: index.php"); //It redirects us to index.php if login was successful
		exit();
	}
	else {
		array_push($error_array, "Not gonna happen,son! Get your s**t together and write both email and password correct!<br>");
	}
}


