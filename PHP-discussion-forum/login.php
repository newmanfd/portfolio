<?php include('inc/header.php'); ?>

<?php
    require('config/db.php'); // creates connection to the mysql server
    
    $username = $password = "";
    $username_err = $password_err = "";

    //$a = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["username"])) {
            $username_err = "Please provide your username";
        } else {
            $username = check_input($_POST["username"]); 
        }

        if (empty($_POST["password"])) {
            $password_err = "Please provide your password";
        } else {
            $password = check_input($_POST['password']);
        }

        // validate the username and password entered
        if(empty($username_err) && empty($password_err)) {
            // prepare a select statement
            $query = "SELECT id, username, password FROM users WHERE username = ? ";

            if($stmt = mysqli_prepare($conn, $query)) {
                // bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                // set parameters
                $param_username = $username;
            
                // attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)) {
                    // store result
                    mysqli_stmt_store_result($stmt);

                    // check if username exists and if it does then verify the password
                    if(mysqli_stmt_num_rows($stmt) == 1) {
                        // bind result variables
                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

                        if(mysqli_stmt_fetch($stmt)) {
                            if(password_verify($password, $hashed_password)) {
                                session_start(); // PHP sessions carry information across multiple PHP pages. 
                                $_SESSION["username"] = $username;
                                // takes you to home page and the username appears below the nav bar
                                header("location:index.php");
                                exit(); // needed after header().
                            } else {
                                // Display an error message if password is not valid
                                $password_err = "The password you entered is not valid.";
                            } 
                        }
                    } else {
                        // Display an error message if username doesn't exist
                        $username_err = "No account found with this username.";   
                    }
                } else {
                    // if attempt to execute the prepared statement fails
                    echo "Something seems to have gone wrong. Please try again later.";
                }
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        // close connection
        mysqli_close($conn);
    }
    
    function check_input($data) {
        $data = trim($data); // Strip unnecessary characters (extra space, tab, newline)
        $data = stripslashes($data); // Remove backslashes (\)
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<div class="container pt-3"> <!-- .pt-3 means "add a top padding of 16px"-->
    <h2>Login</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<div class="form-group">
				<label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username;?>">
                <span class="text-danger"><strong> <?php echo $username_err;?> </strong></span>
			</div>
			<div class="form-group">
				<label>Password</label>
                <input type="text" name="password" class="form-control" value="<?php echo $password;?>">
                <span class="text-danger"><strong> <?php echo $password_err;?> </strong></span>
			</div>
			<input type="hidden" name="update_id" value="">
			<input type="submit" name="submit" value="Login" class="btn btn-primary">
	</form>
</div>

<?php include('inc/footer.php'); ?>

