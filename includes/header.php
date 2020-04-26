<?php
require_once 'config/config.php';
if (isset($_SESSION['username'])) {
	$userLoggedIn=$_SESSION['username'];
}
else {
	header("Location: register.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Tortuga Island</title>
	<!---Javascript--->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<!--CSS-->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/header-stylesheet.css">
</head>
<body>

	<div class="top_bar">
		<div class="logo">
			<a href="index.php">Tortuga Island</a>
		</div>
	</div>