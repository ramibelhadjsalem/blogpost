<?php 
	// connect to the database
	require_once "../includes/database.php" ;

	

	if (isset($_POST['liked'])) {
		$postid = $_POST['postid'];
		$result = mysqli_query($link, "SELECT * FROM publication WHERE id=$postid");
		$row = mysqli_fetch_array($result);
		

		mysqli_query($link, "INSERT INTO likes (id_user, id_pub) VALUES (6, $postid)");
		

		
		exit();
	}
	if (isset($_POST['unliked'])) {
		$postid = $_POST['postid'];
		$result = mysqli_query($link, "SELECT * FROM publication WHERE id=$postid");
		$row = mysqli_fetch_array($result);
		

		mysqli_query($link, "DELETE FROM likes WHERE id_pub=$postid AND id_user=6");
		
		
		exit();
	}

	// Retrieve posts from the database
	$posts = mysqli_query($link, "SELECT * FROM publication");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="UTF-8">
	<title>Like and unlike system</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>

<body>
	<!-- display posts gotten from the database  -->
		<?php while ($row = mysqli_fetch_array($posts)) { ?>

			<div class="post">
				<?php echo $row['description']; ?>

				<div style="padding: 2px; margin-top: 5px;">
				<?php 
					// determine if user has already liked this post
					$results = mysqli_query($link, "SELECT * FROM likes WHERE id_user=6 AND id_pub=".$row['id']."");

					if (mysqli_num_rows($results) == 1 ): ?>
						<!-- user already likes post -->
						<span class="unlike fa fa-thumbs-up" data-id="<?php echo $row['id']; ?>"></span> 
						<span class="like hide fa fa-thumbs-o-up" data-id="<?php echo $row['id']; ?>"></span> 
					<?php else: ?>
						<!-- user has not yet liked post -->
						<span class="like fa fa-thumbs-o-up" data-id="<?php echo $row['id']; ?>"></span> 
						<span class="unlike hide fa fa-thumbs-up" data-id="<?php echo $row['id']; ?>"></span> 
					<?php endif ?>

					<span class="likes_count"><?php echo mysqli_num_rows(mysqli_query($link, "SELECT * FROM likes WHERE id_pub=".$row['id'])); ?> likes</span>
				</div>
			</div>

		<?php } ?>


<!-- Add Jquery to page -->

<script>
	$(document).ready(function(){
		// when the user clicks on like
		$('.like').on('click', function(){
			var postid = $(this).data('id');
			    $post = $(this);

			$.ajax({
				url: 'index.php',
				type: 'post',
				data: {
					'liked': 1,
					'postid': postid
				},
				success: function(response){
					$post.parent().find('span.likes_count').text(response + " likes");
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
				}
			});
		});

		// when the user clicks on unlike
		$('.unlike').on('click', function(){
			var postid = $(this).data('id');
		    $post = $(this);

			$.ajax({
				url: 'index.php',
				type: 'post',
				data: {
					'unliked': 1,
					'postid': postid
				},
				success: function(response){
					$post.parent().find('span.likes_count').text(response + " likes");
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
				}
			});
		});
	});
</script>
</body>
</html>