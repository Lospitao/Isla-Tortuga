<?php
if(isset($_POST['update_details'])) {
    $first_name= $_POST['first_name'];
    $last_name= $_POST['last_name'];
    $email= $_POST['email'];

    $email_check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $row = mysqli_fetch_array($email_check);
    $matched_user = $row['username'];

    if($matched_user == "" || $matched_user == $userLoggedIn) {
        $message = "Details Upldated!<br><br>";

        $query = mysqli_query($conn, "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email' WHERE username='$userLoggedIn'");
    }
    else
        $message = "That email is already in use!<br><br>";
}
else
    $message = "";

if(isset($_POST['update_password']) ) {
    if($POST['new_password'] == $POST['new_password_2']) {
        $password= $POST['new_password'];
    }
    else
        echo "No such cheat! Confirm your password properly son.";

}


?>