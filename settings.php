<?php
include'dbcon.php';
session_start();
$userdetails = array();

if (!isset($_SESSION['username_current'])) {
    session_destroy();
    echo "<script>window.location.href='studentwall.php'</script>";
} else {
    $username = $_SESSION['username_current'];
    $query_user_info = "SELECT fullname,username,designation,department,password FROM logins WHERE username='$username'";
    $result = mysqli_query($con, $query_user_info) or die(mysqli_error($con));
    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_array($result)) {

            $userdetails['designation'] = $row['designation'];
            $userdetails['department'] = $row['department'];
            $userdetails['fullname'] = $row['fullname'];
            $userdetails['password'] = $row['password'];
        }
    } else {
        session_destroy();
        echo "<script>window.location.href='studentwall.php'</script>";
    }
}
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Settings| Digital Notice Board </title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/customsytyle.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/sticky-footer.css" />
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <style>
            .name{
                font-size: 25px;
                font-weight: bold;
                font-family: fantasy;
               
            }
            .value{
                font-size: 20px;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <!--Navigation bar starts-->
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="#" class="navbar-brand">Digital Notice Board</a>
                </div>
                <div>
                    <ul class="nav navbar-nav">
                        <li><a href="studentwall.php">Home</a>
                        </li>

                        <li id="loginprocess" class="dropdown">
                            <a class="dropdown-toggle active" data-toggle="dropdown" href="#">
                                <?php echo $_SESSION['username_current']; ?><span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="logout.php">Logout</a>
                                </li>
                                <li><a href="#">Settings</a>
                                </li>
                            </ul>

                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--Navigation ends-->

        <div class="container jumbotron-cust" style="max-width:640px;">
            <table style="margin-bottom: 10px;">
                <tr>
                    <td class="name">Name</td>
                    <td class="value"><?php echo $userdetails['fullname']; ?></td>
                </tr>
                <tr>
                    <td class="name">Username</td>
                    <td class="value"><?php echo $username; ?></td>
                </tr>
                <tr>
                    <td class="name">Designation</td>
                    <td class="value"><?php echo $userdetails['designation']; ?></td>
                </tr>
                <tr>
                    <td class="name">Department</td>
                    <td class="value"><?php echo $userdetails['department']; ?></td>
                </tr>
            </table>

            <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <input type="text" name="passchange_user" value="<?php echo $username; ?>" hidden />
                    <input type="password" class="form-control" name="oldpass" placeholder="Old Password" /><br/>
                    <input type="password" class="form-control" name="newpass" placeholder="New Password" /><br/>
                    <input type="password" class="form-control" name="newpass_conf" placeholder="Confirm new Password" /><br/>
                    <input type="submit"  class="btn btn-primary" name="submit" value="Change password" />
                    <input type="reset" class="btn btn-warning" value="Reset"/>
                </div>
            </form>
        </div>
        <div class="container" style="margin-top: 20px;">
            <?php
            if (isset($_POST['passchange_user'])) {
                $username = $_POST['passchange_user'];
                $old_password = $_POST['oldpass'];
                $newpassword = $_POST['newpass'];
                if ($_POST['newpass'] == $_POST['newpass_conf']) {
                    $query_user_info = "UPDATE logins SET password='$newpassword' WHERE username='$username' AND password='$old_password'";
                    $result = mysqli_query($con, $query_user_info) or die(mysqli_error('<div class="alert alert-danger" role="alert">
                            <a href="#" class="alert-link">Sorry Some wierd happend.. Password not changed! Try again!</a>
                          </div>'));
                    if($result){
                        echo "<div class='alert alert-success' role='alert'>
                                    <a href='#' class='alert-link'>Your password for $username changed successfully</a>
                               </div>";
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">
                            <a href="#" class="alert-link">Your new password doesnot match! Try again!</a>
                          </div>';
                }
            }
            ?>
        </div>
    </body>
</html>
