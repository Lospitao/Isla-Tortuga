<?php
include("../../config/config.php");
include("../../includes/classes/User.php");

$query = $_POST['query'];
$userLoggedIn = $_POST['userLoggedIn'];

$names = explode(" ", $query);

//if query contains an underscore, assume user is searching for usernames
if(strpos($query, '_') !== false)
    $usersReturnedQuery = mysqli_query($conn, "SELECT * FROM users WHERE username LIKE '$query%' AND user_closed='no' LIMIT 8");
//if there are two words, assume they are first and last name respectively
else if(count($names) == 2)
    $usersReturnedQuery = mysqli_query($conn, "SELECT * FROM users WHERE (first_name LIKE '$names[0]½' AND last_name LIKE '$names[1]½')  AND user_closed='no' LIMIT 8");
//if query has one word only, search first names or last names
else
    $usersReturnedQuery = mysqli_query($conn, "SELECT * FROM users WHERE (first_name LIKE '$names[0]½' AND last_name LIKE '$names[0]½')  AND user_closed='no' LIMIT 8");
?>