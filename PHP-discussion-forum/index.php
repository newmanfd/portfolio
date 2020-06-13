<?php 
	session_start(); 
	if($_SESSION) {  
    	$username = $_SESSION["username"];  
     }
?>

<?php include('inc/header.php'); ?>

<?php print_r($_SESSION); ?>

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

	// create the query
	$query = 'SELECT * FROM posts ORDER BY created_at DESC';  

	// get the result
	$result = mysqli_query($conn, $query); // $conn is from db.php

	// fetch the data
	// pass in the result and the type of data format we want which is an associative array i.e. ['name' => 'Marios']
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC); 
	//var_dump($posts);

	// free the result from memory
	mysqli_free_result($result);

	// finally close the connection
	mysqli_close($conn);
?>

<div class="container">
	<?php foreach($posts as $post) : ?>
		<div class="p-3 my-3 border bg-light"> <!-- p-3, my-3 =padding and margin. i.e. x= left&right margins, y= top&bottom margins -->
			<h3><?php echo $post['title']; ?></h3> <!-- it's an associative array so you can access the posts like this-->
			<small>Created by <?php echo $post['author']; ?>
				on <?php echo $post['created_at']; ?></small> 
			<p><?php 
					// show the first 100 chars of the post
					$full_text = $post['body'];
					$short_text = substr($full_text, 0, 100); echo $short_text .'...'; 
				?>  
			</p>
			<a class="btn btn-primary" href="post.php?id=<?php echo $post['id'];?>"> Read More</a> <!-- ?id sends a parameter, the id -->
		</div>
	<?php endforeach; ?>
</div>

<?php include('inc/footer.php'); ?>
