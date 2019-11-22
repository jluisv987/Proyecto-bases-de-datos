<?php include('includes/database.php');?>
<?php include('includes/header.php');?>
<?php
    session_start();
    session_destroy();
    header('Location: index.php');
    exit();
 ?>


<?php include('includes/footer.php');?>
