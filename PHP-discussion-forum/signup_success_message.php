<?php 
    session_start(); 
    $username = $_SESSION["username"];  
    $email = $_SESSION["email"]; 
    //print_r($_SESSION);
?>

<?php include('inc/header.php'); ?>

<div class="container pt-3 my-3 border bg-light" style="margin-top:70px"> 
    <span><h4> Thanks <?php echo $username; ?>. You have successfully signed up. 
            Go to the <a href="index.php">Home page</a> to start posting. </h4></span>  
</div>
 
<?php include('inc/footer.php'); ?>
