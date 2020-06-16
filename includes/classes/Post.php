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

            $body_array = preg_split("/\s+/", $body); //split the spaces in the post

            foreach($body_array as $key => $value) {

                if(strpos($value, "www.youtube.com/watch?v=") !== false) {

                    $link = preg_split("!&!", $value);
                    $value = preg_replace("!watch\?v=!", "embed/", $link[0]);
                    $value = "<br><iframe width=\'420\' height=\'315\' src=\'" . $value ."\'></iframe><br>";
                    $body_array[$key] = $value;

                }
            }
            $body = implode(" ", $body_array);
            //current date and time
            $date_added = date("Y-m-d H:i:s");
            //get username
            $added_by = $this->user_obj->getUsername();
            //if user posts on his/her own profile user_to is 'none'
            if ($user_to == $added_by) {
                $user_to = "none";
            }

            //insert post
            $query = mysqli_query($this->conn, "INSERT INTO posts VALUES(NULL, '$body', '$added_by', '$user_to', '$date_added', 'no', 'no', '0')");
            $returned_id = mysqli_insert_id($this->conn);

            //Insert notification
            if($user_to != 'none')  {
                $notification = new Notifications($this->conn, $added_by);
                $notification->insertNotification($returned_id, $user_to, "profile_post");
            }
            //Update post count for user
            $num_posts = $this->user_obj->getNumPosts();
            $num_posts++;
            $update_query = mysqli_query($this->conn, "UPDATE users SET num_posts='$num_posts' WHERE username ='$added_by'");


            //Words to ignore when looking for trending words
            $stopWords = "a able about above according accordingly across actually after afterwards again against ain't 
            all allow allows almost alone along already also although always am among amongst an and another any anybody 
            anyhow anyone anything anyway anyways anywhere apart appear appreciate appropriate are aren't around as a's 
            aside ask asking associated at available away awfully be became because become becomes becoming been before 
            beforehand behind being believe below beside besides best better between beyond both brief but by came can 
            cannot cant can't cause causes certain certainly changes clearly c'mon co com come comes concerning 
            consequently consider  considering contain containing contains corresponding could couldn't course c's 
            currently definitely described  despite did didn't different do does doesn't doing don done don't down 
            downwards during each edu eg eight either  else elsewhere enough entirely especially et etc even ever every 
            everybody everyone everything everywhere ex exactly example except far few fifth first five followed 
            following follows for former formerly forth four from further furthermore get gets getting given gives go 
            goes going gone got gotten greetings had hadn't happens hardly has  hasn't have haven't having he he'd 
            he'll hello help hence her here hereafter hereby herein here's hereupon hers  herself he's hi him himself 
            his hither hopefully how howbeit however how's i i'd ie if ignored i'll i'm immediate in  inasmuch inc 
            indeed indicate indicated indicates inner insofar instead into inward is isn't it it'd it'll its it's 
            itself i've just keep keeps kept know known knows last lately later latter latterly least less lest let 
            let's like liked likely little  look looking looks ltd mainly many may maybe me mean meanwhile merely 
            might more moreover most mostly  much must mustn't my myself name namely nd near nearly necessary need 
            needs neither never nevertheless new  next nine no nobody non none noone nor normally not nothing novel
            now nowhere obviously of off often oh ok  okay old on once one ones only onto or other others otherwise 
            ought our ours ourselves out outside over overall  own particular particularly per perhaps placed please 
            plus possible presumably probably provides que quite qv rather rd re really reasonably regarding regardless 
            regards relatively respectively right s said same saw say saying says second secondly see seeing seem seemed 
            seeming seems seen self selves sensible sent serious seriously  seven several shall shan't she she'd she'll 
            she's should shouldn't since six so some somebody somehow someone  something sometime sometimes somewhat 
            somewhere soon sorry specified specify specifying still sub such sup  sure t take taken tell tends th than 
            thank thanks thanx that thats that's the their theirs them themselves then thence there thereafter thereby 
            therefore therein theres there's thereupon these they they'd they'll they're they've think third this thorough 
            thoroughly those though three through throughout thru thus to together too took toward towards tried tries 
            truly try trying t's twice two un under unfortunately unless unlikely until unto up upon us use used useful 
            uses using usually value various very via viz vs want wants was wasn't way we we'd welcome well we'll went 
            were we're weren't we've what whatever what's when whence whenever when's where whereafter whereas  whereby
            wherein where's whereupon wherever whether which while whither who whoever whole whom who's whose why why's 
            will willing wish with within without wonder won't would wouldn't yes yet you you'd you'll your you're yours 
            yourself yourselves you've zero un una unas unos uno sobre todo también tras otro algún alguno alguna algunos 
            algunas ser es soy eres somos sois estoy esta estamos estais estan como en para atras porque por qué estado 
            estaba ante antes siendo ambos pero por poder puede puedo podemos podeis pueden fui fue fuimos fueron hacer 
            hago hace hacemos haceis hacen cada fin incluso primero desde conseguir consigo consigue consigues conseguimos 
            consiguen ir voy va vamos vais van vaya gueno ha tener tengo tiene tenemos teneis tienen el la lo las los su 
            aqui mio tuyo ellos ellas nos nosotros vosotros vosotras si dentro solo solamente saber sabes sabe sabemos 
            sabeis saben ultimo largo bastante haces  muchos aquellos aquellas sus entonces tiempo verdad verdadero verdadera 
            cierto ciertos cierta ciertas intentar intento intenta intentas intentamos intentais intentan dos bajo arriba 
            encima usar uso usas usa usamos usais usan  emplear empleo empleas emplean ampleamos empleais valor muy era eras eramos
             eran modo bien cual cuando donde mientras quien con entre sin trabajo trabajar  trabajas trabaja trabajamos 
             trabajais trabajan podria podrias podriamos podrian podriais yo aquel";

            $stopWords = preg_split("/[\s,]+/", $stopWords);

            $no_punctuation = preg_replace("\[^a-zA-Z 0-9]+/", "", $body);

            //Checking if Post is not a link
            if(strpos($no_punctuation, "height") === false && strpos($no_punctuation, "width") === false
                && strpos($no_punctuation, "http") === false) {
                    $no_punctuation = preg_split("/[\s,]+/", $no_punctuation);
            }
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
    public function getSinglePost($post_id) {

        $userLoggedIn = $this->user_obj->getUserName();

        $opened_query = mysqli_query($this->conn, "UPDATE notifications SET opened='yes' WHERE user_to='$userLoggedIn' AND link LIKE '%=$post_id'");

        $str = "";
        $data_query = mysqli_query($this->conn, "SELECT * from posts WHERE deleted='no' AND id='$post_id'");

         if(mysqli_num_rows($data_query) > 0) {

            $row=mysqli_fetch_array($data_query);
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
                    return;
                }
                $user_logged_obj = new User($this->conn, $userLoggedIn);
                if($user_logged_obj->isFriend($added_by)) {


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
             }
             else {
                  echo "<p>You cannot see this post because are not friends with this user.</p>";
                  return;
             }
        }
        else {
            echo "<p>No post found. If you clicked a link, it may be broken.</p>";
            return;
        }
        echo $str;
    }
}

?>