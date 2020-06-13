<?php include('inc/header.php'); ?>

<?php 
    $name_err = $email_err = $message_err = "";
    $name = $email = $message = "";

    $a = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["name"])) {
            $name_err = "Please fill in your name";
        } else {
            $name = check_input($_POST["name"]);
            array_push($a, $name);
        }

        if (empty($_POST["email"])) {
            $email_err = "Please fill in your email address";
        } else {
            $email = check_input($_POST["email"]);
            array_push($a, $email);
        }

        if (empty($_POST["message"])) {
            $message_err = "Please write your message";
        } else {
            $message = check_input($_POST["message"]); 
            array_push($a, $message);
        }

        $a_key_count = count($a);
        if ($a_key_count == 3) {
            // email details
            $to_email = 'marios.nowak@gmail.com'; // i.e. support@abc.com
            $subject = 'Contact Message from ' . $name;
            $message_body = ' <h2>Contact Message</h2>
                    <h4>Name:</h4><p>' . $name .' </p>
                    <h4>Email:</h4><p>' . $email .' </p>
                    <h4>Message:</h4><p>' . $message .'</p> ';
 
            // email headers. Always set content-type when sending HTML email
            $headers = 'MIME-Version: 1.0' . "/r/n";
            $headers .= 'Content-Type: text/html; charset=UTF-8' . "/r/n";  

            // additional headers
            $headers .= 'From: '. $name .'<'. $email .'>'. "/r/n";

            mail($to_email, $subject, $message_body, $headers);

            // redirect to thanks page
            header("location:thanks_contact_message.php");
            exit();
        }
    }

    function check_input($data) {
        $data = trim($data); // Strip unnecessary characters (extra space, tab, newline)
        $data = stripslashes($data); // Remove backslashes (\)
        $data = htmlspecialchars($data);
        return $data;
    }
?>

    <div class="container pt-3"> 
        <h2>Contact</h2>

		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<div class="form-group">
				<label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name;?>"> <!-- "value=php echo $name" keeps value in the form after unsuccessful sending of form-->
                <span class="text-danger"><strong> <?php echo $name_err;?> </strong></span>
			</div>
			<div class="form-group">
				<label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email;?>">
                <span class="text-danger"><strong> <?php echo $email_err;?> </strong></span>
            </div>
            <div class="form-group">
				<label>Your message</label>
                <textarea name="message" class="form-control"
                                        rows="5" columns="150"><?php echo $message;?></textarea>
                <span class="text-danger"><strong> <?php echo $message_err;?> </strong></span>
			</div>
			<input type="hidden" name="update_id" value="">
			<input type="submit" name="submit" value="Send" class="btn btn-primary">
		</form>
    </div>

<?php include('inc/footer.php'); ?>

