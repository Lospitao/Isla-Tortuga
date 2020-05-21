<?php
class User {
	private $user;
	private $conn;

	public function __construct($conn, $user) {
		$this->conn = $conn;
		$user_details_query= mysqli_query($conn, "SELECT * FROM users WHERE username='$user'");
		$this->user = mysqli_fetch_array($user_details_query);
	} //this function retrieves all data using username we got from email and password as a reference to fetch the rest of the data
	
	public function getUsername () {
		return $this->user['username'];

	}
	public function getNumPosts() {
		$username = $this->user['username'];
		$query = mysqli_query($this->conn, "SELECT num_posts FROM users WHERE username='$username'");
		$row = mysqli_fetch_array($query);
		return $row['num_posts'];
	}

	public function getFirstAndLastName() {
		$username = $this->user['username'];
		$query = mysqli_query($this->conn, "SELECT first_name, last_name FROM users WHERE username='$username'");
		$row= mysqli_fetch_array($query);
		return $row['first_name'] ." ". $row['last_name'];
	}

    public function getProfilePic() {
        $username = $this->user['username'];
        $query = mysqli_query($this->conn, "SELECT profile_pic FROM users WHERE username='$username'");
        $row= mysqli_fetch_array($query);
        return $row['profile_pic'];
    }
	public function isClosed() {
		$username = $this->user['username'];
		$query = mysqli_query($this->conn, "SELECT user_closed FROM users WHERE username='$username'");
		$row = mysqli_fetch_array($query);

		if($row['user_closed'] == 'yes')
			return true;
		else {
		    return false;
		}

	}
	public function isFriend($username_to_check) {
	    $usernameComma = ",". $username_to_check. ",";
	    if((strstr($this->user['friend_array'], $usernameComma) || $username_to_check == $this->user['username'])) {
	        return true;
        }
	    else {
	        return false;
	    }
    }
    public function didReceiveRequest ($user_from) {
        $user_to = $this->user['username'];
        $check_request_query = mysqli_query($this->conn, "SELECT * FROM friend_requests WHERE user_to='$user_to' AND user_from='$user_from'");
        if (mysqli_num_rows($check_request_query) > 0) {
            return true;
        } else return false;
    }
	public function didSendRequest ($user_to) {
	    $user_from = $this->user['username'];
        $check_request_query = mysqli_query($this->conn, "SELECT * FROM friend_requests WHERE user_to='$user_to' AND user_from='$user_from'");
        if(mysqli_num_rows($check_request_query) > 0) {
           return true;
        }
        else return false;
	}
	public function removeFriend($user_to_remove) {
	    $logged_in_user = $this->user['username'];
	    $query = mysqli_query($this->conn, "SELECT friend_array FROM users WHERE username='$user_to_remove'");
	    $row=mysqli_fetch_array($query);
	    $friend_array_username = $row['friend-array'];

	    $new_friend_array = str_replace($user_to_remove . ",", "", $this->user['friend_array']);
	    $remove_friend = mysqli_query($this->conn, "UPDATE users SET friend_array='$new_friend_array' WHERE username='$logged_in_user'");

        $new_friend_array = str_replace($this->user['useraname'] . ",", "", $friend_array_username);
        $remove_friend = mysqli_query($this->conn, "UPDATE users SET friend_array='$new_friend_array' WHERE username='$user_to_remove'");
    }
    public function sendRequest($user_to) {
        $user_from = $this->user['username'];
        $query = mysqli_query($this->conn, "INSERT INTO friend_requests VALUES(NULL, '$user_to', '$user_from')");
    }

}

