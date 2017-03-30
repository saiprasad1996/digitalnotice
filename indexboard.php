<?php
include( 'dbcon.php');
$query = mysqli_query($con, "SELECT * FROM posts");
session_start(); //error_reporting(0);  
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Digital Notice Board</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/customsytyle.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/sticky-footer.css" />
        <link rel="stylesheet" href="css/Animate.css" type="text/css" />
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <style>
            .left-scroll{
                padding:5px;
                height: 800px;
                width: 50%;
                float:left;

            }


            .right-scroll{
                padding:5px;
                float:right;
                width:50%;
                height:800px;
            }
        </style>
    </head>
    <body>
        
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="index.php" class="navbar-brand">Digital Notice Board</a>
                </div>
                
            </div>
            <?php
            if (!isset($_SESSION['username_current'])) {
                echo "<script> $('#loginprocess').hide(); </script>";
            }
            ?>
        </nav>


        <div class="left-scroll" >
            <marquee direction="up" height="800px">

                <div class="well-cust">
                    <?php
                    if (mysqli_num_rows($query) == 0) {
                        echo '<div class="container"><p>Oops!! Seems like there aren\'t any posts here  </p></div>';
                    }

                    while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h2 class="panel-title"><?php echo $row['heading']; ?></h2>
                                <cite>&nbsp; &nbsp; -Posted by <?php echo $row['owner']; ?> on <?php echo $row['date']; ?></cite>
                            </div>
                            <div class="panel-body">
                                <blockquote>
                                    <?php echo $row['content']; ?>
                                </blockquote>
                            </div>
                            <?php if (isset($_SESSION['username_current']) && ($_SESSION['fullname'] == $row['owner'])) { ?>
                                <div class="panel-footer">
                                    <?php
                                    //Logic for deleting 
                                    if (isset($_POST['delete_id'])) {
                                        $del_id = $_POST['delete_id'];
                                        $query_delete = "DELETE FROM posts WHERE slno='$del_id'";
                                        $result = mysqli_query($con, $query_delete) or die("Error executing delete query");
                                        if (mysqli_affected_rows($con) == 1) {
                                            echo "<script>window.location.href='studentwall.php'</script>";
                                        } else {
                                            echo 'Error';
                                        }
                                    }
                                    //logic for editing the post 
                                    if (isset($_POST['edit_id'])) {
                                        $del_id = $_POST['edit_id'];
                                        $content_update = $_POST['editMessage'];
                                        $query_delete = "UPDATE posts set content='$content_update' WHERE slno='$del_id'";
                                        $result = mysqli_query($con, $query_delete) or die("Error executing delete query");
                                        if (mysqli_affected_rows($con) == 1) {
                                            echo "<script>window.location.href='studentwall.php'</script>";
                                        } else {
                                            echo 'Error';
                                        }
                                    }
                                    ?>


                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>


            </marquee>
        </div>
        <div class="right-scroll">
            <div class="well-cust">
                <?php
                $query_latest = "SELECT * FROM posts ORDER BY slno DESC LIMIT 5 ";
                $result = mysqli_query($con, $query_latest);
                if (mysqli_num_rows($result) == 0) {
                    echo '<div class="container"><p>Oops!! Seems like there aren\'t any posts here  </p></div>';
                }

                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h2 class="panel-title"><?php echo $row['heading']; ?></h2>
                            <cite>&nbsp; &nbsp; -Posted by <?php echo $row['owner']; ?> on <?php echo $row['date']; ?></cite>
                        </div>
                        <div class="panel-body">
                            <blockquote>
                                <?php echo $row['content']; ?>
                            </blockquote>
                        </div>
                        <?php if (isset($_SESSION['username_current']) && ($_SESSION['fullname'] == $row['owner'])) { ?>
                            <div class="panel-footer">
                                <?php
                                //Logic for deleting 
                                if (isset($_POST['delete_id'])) {
                                    $del_id = $_POST['delete_id'];
                                    $query_delete = "DELETE FROM posts WHERE slno='$del_id'";
                                    $result = mysqli_query($con, $query_delete) or die("Error executing delete query");
                                    if (mysqli_affected_rows($con) == 1) {
                                        echo "<script>window.location.href='studentwall.php'</script>";
                                    } else {
                                        echo 'Error';
                                    }
                                }
                                //logic for editing the post 
                                if (isset($_POST['edit_id'])) {
                                    $del_id = $_POST['edit_id'];
                                    $content_update = $_POST['editMessage'];
                                    $query_delete = "UPDATE posts set content='$content_update' WHERE slno='$del_id'";
                                    $result = mysqli_query($con, $query_delete) or die("Error executing delete query");
                                    if (mysqli_affected_rows($con) == 1) {
                                        echo "<script>window.location.href='studentwall.php'</script>";
                                    } else {
                                        echo 'Error';
                                    }
                                }
                                ?>


                            </div>
                        <?php } ?>
                    </div>
                <?php
                }
                mysqli_close($con);
                ?>
            </div>


        </div>


    </body>

</html>
