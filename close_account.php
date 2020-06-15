<?php
include("includes/header.php");

if(isset($_POST['cancel'])) {
    header("Location: settings.php");
}
if(isset($_POST['close_account'])) {
    $close_query = mysqli_query($conn, "UPDATE users SET user_closed='yes' WHERE username='$userLoggedIn'");
    session_destroy();
    header("Location: register.php");
}
?>
<div class="main_column column" id="close_account_form">
    <h4>Close Account</h4>
    Are you sure you want to close your account?<br><br>
    Closing your account will hide your profile nad all your activity form other users.<br><br>
    You can re-open your account at any time bu simply logging in.<br><br>
    <form action="close_account.php" method="POST">
        <input type="submit" name="close_account" id="final_close_account" value="Yes! Close it!" class="success">
        <input type="submit" name="cancel" id="cancel_close_account" value="No way!" class="warning">
    </form>
</div>

