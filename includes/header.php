<?php
require 'config/config.php';

if (isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($conn, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
}
else {
	header("Location: register.php");
}
?>

<html>
<head>
	<title>Welcome to Tortuga Island</title>
	<!---Javascript--->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
	</script>
	<!--CSS-->
	<script src="https://kit.fontawesome.com/5a4a71c487.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>
<body>

	<div class="top_bar">
		<div class="logo">
			<a href="index.php">Tortuga Island</a>
		</div>
		<nav>
			<a href="<?php echo $userLoggedIn; ?>" >
                <?php echo $user['first_name'];?>
            </a>
			<a href="index.php">
				<i class="fas fa-home fa-lg"></i>
			</a>

			<a href="#">
				<i class="far fa-envelope fa-lg"></i>
			</a>

			<a href="#">
				<i class="fas fa-bell fa-lg"></i>
			</a>

			<a href="#">
				<i class="fas fa-users fa-lg"></i>
			</a>

			<a href="#">
				<i class="fas fa-cog fa-lg"></i>
			</a>
			<a href="includes/handlers/logout.php">
				<i class="fas fa-sign-out-alt fa-lg"></i>
			</a>
		</nav>
	</div>
	<div class="wrapper">

	
