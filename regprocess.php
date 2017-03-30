<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Registration</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
        <script src="js/jquery.min.js" type="text/javascript"></script>
    </head>
<body>
    <div class="container">
    <?php 
require_once 'dbcon.php';
$fullname=$_GET['fullname'];
$username=$_GET['user'];
$password=$_GET['pass'];

if($fullname=='' || $username=='' || $password==''){
    ?>
    <div class="alert alert-danger" style="margin-top:40px;">
    <span style="font-family:cursive;font-weight:bold;">Blank username and password submitted..</span>
    </div>
    
    
<?php } else{
    $query="INSERT INTO logins(fullname,username,password) values('$fullname','$username','$password')";
    mysqli_query($con,$query) or die("Couldn't register!!");
    ?>
    <div class="alert alert-success"  style="margin-top:40px;">
        <span class="glyphicon glyphicon-info-sign"></span>&nbsp;You are successfully registered!. <br> Use your username and password to login to <a href="index.php" >Digital Notice Board</a>
    </div>
    <?php
    mysqli_close($con);
    exit;
}

?>
</div>
    </body>
</html>
