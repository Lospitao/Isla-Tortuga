<?php
class Post {
    private $user_obj;
    private $conn;

    public function __construct($conn, $user) {
        $this->conn = $conn;
        $this->user_obj = new User ($conn, $user); //within the class we create a new instance of the object $user
    } //this function retrieves all data using username we got from email and password as a reference to fetch the rest of the data
    public function submitPost($body, $user_to) {
        $body = strip_tags($body); //removes html tags
        $body = mysqli_real_escape_string($this->conn, $body); // escapes single quotes as in "I'm"
        $check_empty = preg_replace('/\s+/','', $body); //Delete all spaces in $body to prevent empty posts in the following if

        if($check_empty != "") {


            //current date and time
            $date_added = date("Y-m-d H:i:s");
            //get username
            $added_by = $this->user_obj->getUsername(); //We are calling this function which is in User class thanks to $user_obj being an instance of $User
            //if user posts on his/her own profile user_to is 'none'
            if ($user_to == $added_by) {
                $user_to = "none";
            }

            //insert post
            $query = mysqli_query($this->conn, "INSERT INTO posts VALUES(NULL, '$body', '$added_by', '$user_to', '$date_added', 'no', 'no', '0')");
            $returned_id = mysqli_insert_id($this->conn);

            //Insert notification
            if($user_to != 'none') {
                $notification = new Notifications($this->conn, $userLoggedIn);
                $notification->insertNotification($returned_id, $user_to, "profile_post");
            }
            //Update post count for user
            $num_posts = $this->user_obj->getNumPosts();
            $num_posts++;
            $update_query = mysqli_query($this->conn, "UPDATE users SET num_posts='$num_posts' WHERE username ='$added_by'");
        }
    }
    public function loadPostsFriends($data, $limit) {

        $page = $data['page'];
        $userLoggedIn = $this->user_obj->getUserName();

        if($page == 1)
            $start = 0;
        else
            $start = ($page - 1) * $limit;

        $str = ""; // string to return
        $data_query = mysqli_query($this->conn, "SELECT * from posts WHERE deleted='no' ORDER BY id DESC");
        //we'll use a while loop so that posts keep showing so long as they are not deleted
        if(mysqli_num_rows($data_query) > 0 ) {

            $num_iterations = 0; //Number of results checked (not necesarily posted)
            $count = 1; //Count how many results we've loaded

            while ($row=mysqli_fetch_array($data_query)) {
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];

                //prepare user_to string so it can be included even if the post was  not posted to a user (inside of there feed)

                if($row['user_to'] == "none") {
                    $user_to = ""; //we include this in the output whether it was posted in someone else's feed
                }
                else {
                    $user_to_obj = new User($this->conn, $row['user_to']); //new user with the 'user_to' as the username
                    $user_to_name = $user_to_obj->getFirstAndLastName();
                    $user_to = "to <a href='" . $row['user_to'] ."'>" . $user_to_name . "</a>";
                }

                //check if user who posted, has their account closed
                $added_by_obj = new User($this->conn, $added_by);
                if($added_by_obj->isClosed()) {
                    continue;
                }
                $user_logged_obj = new User($this->conn, $userLoggedIn);
                if($user_logged_obj->isFriend($added_by)) {

                    if($num_iterations++ < $start)
                        continue;

                    //Once 10 posts have been loaded, break
                    if($count > $limit) {
                        break;
                    }
                    else {
                        $count++;
                    }

                    if($userLoggedIn == $added_by)
                        $delete_button = "<button class='delete_button btn-danger' id='post$id'>X</button>";
                    else
                        $delete_button = "";

                    $user_details_query = mysqli_query($this->conn, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");
                    $user_row = mysqli_fetch_array($user_details_query);
                    $first_name=$user_row['first_name'];
                    $last_name=$user_row['last_name'];
                    $profile_pic=$user_row['profile_pic'];

                    ?>
                    <script>
                        function toggle<?php echo $id; ?>() {
                            var target = $(event.target); //when the link is clicked
                            if (!target.is("a")) { //if the target is NOT an "a" link
                                //show comments
                                var element = document.getElementById("toggleComment<?php echo $id; ?>");

                                if(element.style.display == "block")
                                    elment.style.display = "none";
                                else
                                    element.style.display = "block";
                            }

                        }
                    </script>
                    <?php
                    $comments_check = mysqli_query($this->conn, "SELECT * FROM comments WHERE post_id='$id'");
                    $comments_check_num = mysqli_num_rows($comments_check);

                    //Timeframe
                    $date_time_now = date("Y-m-d H:i:s");
                    $start_date = new Datetime($date_time);//Datetime() class comes with PHP. This is time of post
                    $end_date = new Datetime($date_time_now); // current time
                    $interval = $start_date->diff($end_date); //difference between two dates
                    if($interval->y >= 1) { //in case it was posted more than a year ago
                        if($interval == 1)
                            $time_message = $interval->y . " year ago"; //this would produce "1 year ago"
                        else
                            $time_message = $interval->y . " years ago"; // more than one years
                    }
                    else if ($interval-> m >= 1) {
                        if($interval->d == 0) {
                            $days = " ago";
                        }
                        else if($interval->d == 1) {
                            $days = $interval->d . "day ago";
                        }
                        else  {
                            $days = $interval->d . "days ago";
                        }

                        if($interval->m ==1) {
                            $time_message = $interval->m . " month" . $days;
                        }
                        else {
                            $time_message = $interval->m . " months" . $days;
                        }
                    }
                    else if($interval->d >= 1) {
                        if($interval->d == 1) {
                            $time_message = "Yesterday";
                        }
                        else  {
                            $time_message = $interval->d . "days ago";
                        }
                    }
                    else if ($interval-> h >= 1) {
                        if($interval->h == 1) {
                            $time_message = $interval->h . "hour ago";
                        }
                        else {
                            $time_message = $interval->h . "hours ago";
                        }
                    }
                    else if ($interval-> i >= 1) {
                        if($interval->i == 1) {
                            $time_message = $interval->i . "minute ago";
                        }
                        else {
                            $time_message = $interval->i . "minutes ago";
                        }
                    }
                    else {
                        if($interval->s <= 30) {
                            $time_message = "Just now";
                        }
                        else {
                            $time_message = $interval->s . "seconds ago";
                        }
                    }

                    $str .= "<div class='status_post' onClick='javascript:toggle$id()'>
                                    <div class='post_profile_pic'>
                                        <img src='$profile_pic' width='50'>
                                    </div>
    
                                    <div class='posted_by' style='color:#ACACAC;'>
                                <a href='$added_by'> $first_name $last_name </a> $user_to &nbsp;&nbsp;&nbsp;&nbsp;$time_message
                                    $delete_button;
                                    </div>
                                    <div id='post_body'>
                                        $body
                                        <br>
                                        <br>
                                        <br>
                            </div>
                        <div class='newsfeedPostOptions'>
                        Comments($comments_check_num)&nbsp&nbsp&nbsp&nbsp;
                    <iframe src='like.php?post_id=$id' scrolling='no'></iframe>	
                        </div>
                        </div>
                        <div class='post_comment' id='toggleComment$id' style='display:none;'>
							<iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
						</div>
						<hr>";
                }
                ?>
                <script>

                    $(document).ready(function() {

                        $('#post<?php echo $id; ?>').on('click', function() {
                           bootbox.confirm("Are you sure you want to delete this post?", function(result) {

                               $.post("includes/form_handlers/delete_post.php?post_id=<?php echo $id; ?>", {result:result});

                               if(result)
                                   location.reload();

                           });
                        });
                    });

                </script>

                <?php


            } //End while loop

            if($count > $limit)
                $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
							<input type='hidden' class='noMorePosts' value='false'>";
            else
                $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: center;'> No more posts to show! </p>";
        }

        echo $str;
    }
    public function loadProfilePosts($data, $limit) {

        $page = $data['page'];
        $profileUsername = $data['profileUsername'];
        $userLoggedIn = $this->user_obj->getUserName();

        if($page == 1)
            $start = 0;
        else
            $start = ($page - 1) * $limit;

        $str = ""; // string to return
        $data_query = mysqli_query($this->conn, "SELECT * from posts WHERE deleted='no' AND ((added_by='$profileUsername' AND user_to='none') OR user_to='$profileUsername') ORDER BY id DESC");
        //we'll use a while loop so that posts keep showing so long as they are not deleted
        if(mysqli_num_rows($data_query) > 0 ) {

            $num_iterations = 0; //Number of results checked (not necesarily posted)
            $count = 1; //Count how many results we've loaded

            while ($row=mysqli_fetch_array($data_query)) {
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];


                    if($num_iterations++ < $start)
                        continue;

                    //Once 10 posts have been loaded, break
                    if($count > $limit) {
                        break;
                    }
                    else {
                        $count++;
                    }

                    if($userLoggedIn == $added_by)
                        $delete_button = "<button class='delete_button btn-danger' id='post$id'>X</button>";
                    else
                        $delete_button = "";

                    $user_details_query = mysqli_query($this->conn, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");
                    $user_row = mysqli_fetch_array($user_details_query);
                    $first_name=$user_row['first_name'];
                    $last_name=$user_row['last_name'];
                    $profile_pic=$user_row['profile_pic'];

                    ?>
                    <script>
                        function toggle<?php echo $id; ?>() {
                            var target = $(event.target); //when the link is clicked
                            if (!target.is("a")) { //if the target is NOT an "a" link
                                //show comments
                                var element = document.getElementById("toggleComment<?php echo $id; ?>");

                                if(element.style.display == "block")
                                    elment.style.display = "none";
                                else
                                    element.style.display = "block";
                            }

                        }
                    </script>
                    <?php
                    $comments_check = mysqli_query($this->conn, "SELECT * FROM comments WHERE post_id='$id'");
                    $comments_check_num = mysqli_num_rows($comments_check);

                    //Timeframe
                    $date_time_now = date("Y-m-d H:i:s");
                    $start_date = new Datetime($date_time);//Datetime() class comes with PHP. This is time of post
                    $end_date = new Datetime($date_time_now); // current time
                    $interval = $start_date->diff($end_date); //difference between two dates
                    if($interval->y >= 1) { //in case it was posted more than a year ago
                        if($interval == 1)
                            $time_message = $interval->y . " year ago"; //this would produce "1 year ago"
                        else
                            $time_message = $interval->y . " years ago"; // more than one years
                    }
                    else if ($interval-> m >= 1) {
                        if($interval->d == 0) {
                            $days = " ago";
                        }
                        else if($interval->d == 1) {
                            $days = $interval->d . "day ago";
                        }
                        else  {
                            $days = $interval->d . "days ago";
                        }

                        if($interval->m ==1) {
                            $time_message = $interval->m . " month" . $days;
                        }
                        else {
                            $time_message = $interval->m . " months" . $days;
                        }
                    }
                    else if($interval->d >= 1) {
                        if($interval->d == 1) {
                            $time_message = "Yesterday";
                        }
                        else  {
                            $time_message = $interval->d . "days ago";
                        }
                    }
                    else if ($interval-> h >= 1) {
                        if($interval->h == 1) {
                            $time_message = $interval->h . "hour ago";
                        }
                        else {
                            $time_message = $interval->h . "hours ago";
                        }
                    }
                    else if ($interval-> i >= 1) {
                        if($interval->i == 1) {
                            $time_message = $interval->i . "minute ago";
                        }
                        else {
                            $time_message = $interval->i . "minutes ago";
                        }
                    }
                    else {
                        if($interval->s <= 30) {
                            $time_message = "Just now";
                        }
                        else {
                            $time_message = $interval->s . "seconds ago";
                        }
                    }

                    $str .= "<div class='status_post' onClick='javascript:toggle$id()'>
                                    <div class='post_profile_pic'>
                                        <img src='$profile_pic' width='50'>
                                    </div>
    
                                    <div class='posted_by' style='color:#ACACAC;'>
                                <a href='$added_by'> $first_name $last_name </a>  &nbsp;&nbsp;&nbsp;&nbsp;$time_message
                                    $delete_button;
                                    </div>
                                    <div id='post_body'>
                                        $body
                                        <br>
                                        <br>
                                        <br>
                            </div>
                        <div class='newsfeedPostOptions'>
                        Comments($comments_check_num)&nbsp&nbsp&nbsp&nbsp;
                    <iframe src='like.php?post_id=$id' scrolling='no'></iframe>	
                        </div>
                        </div>
                        <div class='post_comment' id='toggleComment$id' style='display:none;'>
							<iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
						</div>
						<hr>";

                ?>
                <script>

                    $(document).ready(function() {

                        $('#post<?php echo $id; ?>').on('click', function() {
                            bootbox.confirm("Are you sure you want to delete this post?", function(result) {

                                $.post("includes/form_handlers/delete_post.php?post_id=<?php echo $id; ?>", {result:result});

                                if(result)
                                    location.reload();

                            });
                        });
                    });

                </script>

                <?php


            } //End while loop

            if($count > $limit)
                $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
							<input type='hidden' class='noMorePosts' value='false'>";
            else
                $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: center;'> No more posts to show! </p>";
        }

        echo $str;
    }

}

