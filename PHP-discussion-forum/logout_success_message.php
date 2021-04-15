<?php
	session_start(); 
	session_unset(); 
	session_destroy();
?>

<?php include('inc/header.php'); ?>

<div class="container pt-3 my-3 border bg-light" style="margin-top:70px"> 
    <span><h4> <?php echo "You have sucessfully Logged Out. Go back to the ";?> <a href="index.php">Home page!</a> </h4></span>  
</div>

<?php  print_r($_SESSION); ?>

<?php include('inc/footer.php'); ?>