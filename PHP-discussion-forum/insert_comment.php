<?php 
	session_start(); 
	if($_SESSION) {  
        $username = $_SESSION["username"]; 
    }
?>

<?php // if Post Reply btn clicked (POST request method), send post into mysql data table
    require('config/db.php'); // open mysql connection

    $comment = mysqli_real_escape_string($conn, $_POST["comment"]);
    $comment_id = mysqli_real_escape_string($conn, $_POST["comment_id"]); 
                
    $query = "INSERT INTO comments (comment_id, author, body) 
                VALUES ('$comment_id', '$username', '$comment')"; 

    // run if statement through the mysqli_query. 
    // If this is successful then redirect to a thanks page
    if (mysqli_query($conn, $query)) {  
        header("location:comment_success_message.php");
        exit();
    } else {
        echo 'Error: ' . mysqli_error($conn); // tells you the specific error
    }

    // finally close the connection
    mysqli_close($conn);  
?>