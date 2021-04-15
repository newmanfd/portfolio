<?php 
    if(isset($_POST["submit"])) {
        session_start(); 
        $_SESSION["username"] = htmlspecialchars($_POST["username"]);
        $_SESSION["email"] = htmlspecialchars($_POST["email"]);
        $_SESSION["password"] = htmlspecialchars($_POST["password"]);
    }
?>
 
<?php include('inc/header.php'); ?>

<?php
    require('config/db.php'); // creates connection to the mysql server

    // define variables
    $username = $email = $password = $password_confirm = "";
    $username_err = $email_err = $password_err = $password_confirm_err = "";
    $a = array();
     
    // processing form data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // validate the username (check that username doesn't coincide with another in the table)
        if (empty($_POST["username"])) {
            $username_err = "Please choose a username";
        }  else {
            // prepare a select statement
            $query = "SELECT id FROM users WHERE username = ? ";

            if($stmt = mysqli_prepare($conn, $query)) {
                // bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                // set parameters
                $param_username = check_input($_POST["username"]);

                // attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)) {
                    // store the result
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 1) {
                        $username_err = "The username you have entered is taken.";
                    } else {
                        $username = check_input($_POST["username"]);
                        array_push($a, $username);
                    }
                } else {
                    echo "Something seems to have gone wrong. Please try again later.";
                }
                // close the statement
                mysqli_stmt_close($stmt);
            }
        }
        
        if (empty($_POST["email"])) {
            $email_err = "Please provide an email address";
        } else {
            $email = check_input($_POST["email"]);
            array_push($a, $email);
        }

        if (empty($_POST["password"])) {
            $password_err = "Please provide a password";
        } else {
            $password = check_input($_POST["password"]);
            array_push($a, $password);
        }

        if ($_POST["password_confirm"] != $password) {
            $password_confirm_err = "The passwords you provided don't match";
        } else {
            $password_confirm = check_input($_POST["password_confirm"]);
            array_push($a, $password_confirm);
        }
        
        $a_key_count = count($a);
        // ----if no errors AND username doesn't coincide with another in the table
        if ($a_key_count == 4) {
            // send user inputs into data table "users"
            // create the query
            $query2 = "INSERT INTO users (username, email, password)
                    VALUES (?, '$email', ?)";

            // if this is successful then redirect to success page
            if ($stmt = mysqli_prepare($conn, $query2)) {
                // bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
                // set parameters and create a password hash
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT); 

                // attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)) {
                    // close the connection
                    mysqli_close($conn);
                    // welcome message with link to home so you can start posting
                    header("location:signup_success_message.php");
                    exit(); // needed after header().
                } else {
                    echo 'Error: ' . mysqli_error($conn); // tells you the specific error
                }  
            }
            // Close statement
            mysqli_stmt_close($stmt);
        } 
    }
    
    function check_input($data) {
        $data = trim($data); // Strip unnecessary characters (extra space, tab, newline)
        $data = stripslashes($data); // Remove backslashes (\)
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<div class="container pt-3"> <!-- .pt-3 means "add a top padding of 16px"-->
    <h2>Sign Up, to be able to post</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<div class="form-group">
				<label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username;?>">
                <span class="text-danger"><strong> <?php echo $username_err; ?> </strong></span>
            </div>
            <div class="form-group">
				<label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email;?>">
                <span class="text-danger"><strong> <?php echo $email_err; ?> </strong></span>
			</div>
			<div class="form-group">
				<label>Choose a Password</label>
                <input type="text" name="password" class="form-control" value="<?php echo $password;?>">
                <span class="text-danger"><strong> <?php echo $password_err;?> </strong></span>
            </div>
            <div class="form-group">
				<label>Re-type Password</label>
                <input type="text" name="password_confirm" class="form-control" value="<?php echo $password_confirm;?>">
                <span class="text-danger"><strong> <?php echo $password_confirm_err;?> </strong></span>
			</div>
			<input type="hidden" name="update_id" value="">
			<input type="submit" name="submit" value="Sign Up" class="btn btn-primary">
	</form>
</div>

<?php include('inc/footer.php'); ?>

