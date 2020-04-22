<?php // login.php
ob_start(); //Turns on output buffering
session_start();

$timezone =date_default_timezone_set("Europe/Madrid");
$conn=mysqli_connect("localhost", "lospy", "capoupascap", "social");

if(mysqli_connect_errno())
{
	echo "Failed to connect:" . mysqli_connect_errno();
}

?>