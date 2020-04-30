<?php
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");

if(isset($_POST['post'])) {
	$post = new Post($conn, $userLoggedIn);
	$post->submitPost($_POST['post_text'], 'none');
	header("Location:index.php"); //when it submits the post it refreshes the page
}
?>
	<div class="user_details column">
		<a href="$userLoggedIn"> <img src="<?php echo $user['profile_pic'];?>"></a>
		<div class="user_details_left_right">
		<a href="<?php echo $userLoggedIn; ?>">
			<?php 
		echo $user['first_name']." ".$user['last_name'];
		?>
		</a>
		<br>
		<?php 
		echo "Posts: ". $user['num_posts']."<br>";
		echo "Likes: ". $user['num_likes'];
		?>
	
		</div>
	</div>
	<div class="main_column column">
		<form class="post_form" action="index.php" method="POST">
			<textarea name="post_text" id="post_text" placeholder="Say what u rascal?"></textarea>
			<input type="submit" name="post" id="post_button" value="Post">
			
		</form>
		
		<div class="posts_area"></div>
		<img id="#loading" src="assets/images/icons/loading.gif">

	</div>

	<script>
		var userLoggedIn = '<?php echo $userLoggedIn; ?>'
		
		$(document).ready(function() {

			$('#loading').show();
			// Original ajax request for loading first posts
			var ajaxReq = $.ajax({
				url:"includes/handlers/ajax_load_posts.php",
				type: "POST", 
				data: "page="+ page + "&userLoggedIn=" + userLoggedIn,
				cache: false,

				success: function(response) {
					$('.post_area').find('.nextPage').remove(); //Removes current .nextpage
					$('.post_area').find('.noMorePosts').remove(); // Removes current .nextpage
					$('#loading').hide();
					$('.posts_area').append(response);
				}
			});

			$(window).scroll(function() {
				var height = $('.posts_area').height(); //Div containing posts height will determine the height of posts showed
				var scroll_top = $(this).scrollTop();
				var page = $('.posts_area').find('.nextPage').val();
				var noMorePosts = $('posts_area').find('.noMorePosts').val();

				if((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') 
					$('#loading')
			});

		});
	</script>

	</div>
</body>
</html>