<?php

include("includes/header.php");

if(isset($_GET['q'])) {
    $query = $_GET['q'];
}
else{
    $query = "";
}
if(isset($_GET['type'])) {
    $type = $_GET['type'];
}
else{
    $type = "name";
}
?>
<div class="main_column column" id="main_column">
    <?php
        if($query == "")
            echo "You must enter something in the search box";


        else {


            //If query contains an underscore, assume user is searching for usernames
            if($type == "username")
                $usersReturnedQuery = mysqli_query($conn, "SELECT * FROM users WHERE username LIKE '$query%' AND user_closed='no' LIMIT 8");

            else {
                    $names = explode(" ", $query);

                    //If there are three words, skip middle name
                    if(count($names) == 3)
                        $usersReturnedQuery = mysqli_query($conn, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' AND last_name LIKE '$names[2]%') AND user_closed='no'");

                    //If there are two words, assume they are first and last names respectively
                    else if(count($names) == 2)
                        $usersReturnedQuery = mysqli_query($conn, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' AND last_name LIKE '$names[1]%') AND user_closed='no'");

                    //If query has one word only, search first names or last names
                    else
                        $usersReturnedQuery = mysqli_query($conn, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' OR last_name LIKE '$names[0]%') AND user_closed='no'");
            }

        }
    ?>
</div>
