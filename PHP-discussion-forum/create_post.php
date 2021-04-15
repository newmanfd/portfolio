<?php 
	session_start(); 
	if($_SESSION) {  
        $username = $_SESSION["username"];  
     }
?>

<?php include('inc/header.php'); ?>
 
<?php 
    $title_err = $post_err = "";
    $title = $post = "";
     
    $a = array();
    require('config/db.php'); // creates the connection to the mysql server that will be needed soon
     
    if ($_SERVER["REQUEST_METHOD"] == "POST") { 

        if (empty($_POST["title"])) {
            $title_err = "Please write a title for your post";
        } else {
            $title = mysqli_real_escape_string($conn, $_POST["title"]); 
            array_push($a, $title);
        }

        if (empty($_POST["post_text"])) {
            $post_err = "Please write your post";
        } else {
            $post = mysqli_real_escape_string($conn, $_POST["post_text"]); 
            array_push($a, $post);
        }

        $a_key_count = count($a);
        if ($a_key_count == 2) {
 
            // send the post to the posts data table
    
            // create the query
            $query = "INSERT INTO posts (title, body, author) 
                    VALUES ('$title', '$post', '$username')"; 

            // If this is successful then redirect to a thanks page
            if (mysqli_query($conn, $query)) {  
                header("location:post_success_message.php");
                exit();
            } else {
                echo 'Error: ' . mysqli_error($conn); 
            }

            // finally close the connection
            mysqli_close($conn);  
        }
    }
?>

<div class="container p-3 my-3 text-right" style="margin-bottom:30px">
	<div> 
		<?php if($username) { 
            echo '<h6> Hello ' . $username .'. </h6> 
                <form action="logout_success_message.php">
                    <input type="submit" id="logout" value="Log Out" name="logout" class="btn bg-info text-white">
                </form>';
			} else {
                header("Location:login_or_signup_message.php");
                exit();
            }
		?>   
	</div> 
</div>

<div class="container pt-3"  > 
    <h2>Create a Post</h2>
    
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label>Title of your Post</label>
            <input type="text" name="title" class="form-control" value="<?php echo $title;?>"> <!-- "value=php echo $name" keeps value in the form after unsuccessful sending of form-->
            <span class="text-danger"><strong> <?php echo $title_err;?> </strong></span>
        </div>
        <div class="form-group">
            <label>Your post</label>
            <textarea name="post_text" 
                    class="form-control" rows="11" columns="150"><?php echo $post;?></textarea>
            <span class="text-danger"><strong> <?php echo $post_err;?> </strong></span>
        </div>
        <input type="hidden" name="update_id" value="">
        <input type="submit" name="submit" value="Post" class="btn btn-primary">
    </form>
</div>

<?php include('inc/footer.php'); ?>