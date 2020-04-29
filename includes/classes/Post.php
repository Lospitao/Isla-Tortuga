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

		$body= str_replace('\r\n', '\n', $body); // we look for a carriage return followed by a line break ('\r\n') which is what happens when we press enter in the textarea and replacing it by a newline
		$body=nl2br($body);//function which replaces newlines with line breaks (<br>)

		$check_empty = preg_replace('/\s+/','', $body); //Delete all spaces in $body to prevent empty posts in the following if

		if($check_empty != "") {


			//current date and time
			$date_added = date("Y-m-d H:i:s");
			//get username
			$added_by = $this->user_obj->getUsername(); //We are calling this funtion which is in User class thanks to $user_obj being an instance of $User
			//if user posts on his/her own profile user_to is 'none'
			if ($user_to==$added_by) {
				$user_to = "none";
			}
			//insert post
			$query = mysqli_query($this->conn, "INSERT INTO posts VALUES(NULL, '$body', '$added_by', '$user_to', '$date_added', 'no', 'no', '0')");
			$returned_id = mysqli_insert_id($this->conn);

			//Insert notification

			//Update post count for user
			$num_posts = $this->user_obj->getNumPosts();
			$num_posts++;
			$update_query = mysqli_query($this->conn, "UPDATE users SET num_posts='$num_posts' WHERE username ='$added_by'");
		}
	}
}
?>