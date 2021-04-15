<?php 
	session_start(); 
	if($_SESSION) {  
		$username = $_SESSION["username"];  
	}
?>

<?php include('inc/header.php'); ?>

<?php print_r($_SESSION); ?>

<!-- Greeting user box -->
<div class="container p-3 my-3 text-right" style="margin-bottom:30px">
	<div> 
		<?php if(empty($username)) { 
			echo '<h6> Hello Guest. </h6> <a href="signup.php" class="btn bg-info text-white">Sign Up</a>';
			} else {
				echo '<h6> Hello ' . $username .'. </h6> 
					<form action="logout_success_message.php">
						<input type="submit" id="logout" value="Log Out" name="logout" class="btn bg-info text-white">
					</form>';
			} 
		?>   
	</div> 
</div>

<?php 
    require('config/db.php');
    
    // get ID 
    $id = mysqli_real_escape_string($conn, $_GET['id']); 

    // create the query
	$query = 'SELECT * FROM posts WHERE id='.$id; 

	// get the result
	$result = mysqli_query($conn, $query); // $conn is from db.php

    // fetch the data
    $post = mysqli_fetch_assoc($result); 
    //var_dump($posts);

	// free the result from memory
	mysqli_free_result($result);

	// finally close the connection
	mysqli_close($conn);
?>

<!-- Posts' section -->
<div class="container">
    <div class="p-3 my-3 border bg-light"> <!-- p-3, my-3 =padding and margin. i.e. x= left&right margins, y= top&bottom margins -->
        <h3><?php echo $post['title']; ?></h3> 
        <small style="color:#808080"><b>Created by <?php echo $post['author']; ?>
            on <?php echo $post['created_at']; ?></b></small> 
        <p><?php echo $post['body']; ?></p>
	</div>
</div>

<!-- Comment section -->
<div class="container">
	<div class="p-3 my-3 border bg-light">
		<h5 style="margin-bottom:15px">Comments:</h5>
		
		<?php
			require('config/db.php');
			
			// fetch the particular posts' comments
			$result2 = mysqli_query($conn, "SELECT * FROM comments 
													WHERE comment_id='$id'
													ORDER BY created_at DESC"); // =the current comment's id
			 
			while ($row = mysqli_fetch_object($result2)) { 
				echo "<div class='comment'>
						<small style='color:#808080'> <b> By: $row->author on $row->created_at </b> </small>
						<p> $row->body </p>
					</div>";
			}  
			 
			mysqli_free_result($result2); // free result from memory
			mysqli_close($conn);
		?>

		<?php if(!isset($username)) {
			echo '<form action="login_or_signup_message.php">
					<input type="submit" id="signup" value="Log In or Sign Up to comment" name="signup" class="btn btn-info">
				 </form>';
			} else {
				echo '<form method="POST" action="insert_comment.php">
						<textarea name="comment"
								  placeholder="Write a comment..." 
								  class="form-control" rows="5" columns="150"></textarea>
						<input type="hidden" name="comment_id" value="'.$id.'" > <!-- the comment inherits the post id -->
						<input type="submit" name="submit" id="submit" value="Post Comment" class="btn btn-success" style="margin-top:5px">
					  </form>'; 
			}
		?> 
	</div>
</div>

<?php include('inc/footer.php'); ?>