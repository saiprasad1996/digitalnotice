<!DOCTYPE html>
<?php
include( 'dbcon.php');
$query = mysqli_query($con, "SELECT * FROM posts");
session_start(); //error_reporting(0);  
?>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Digital Notice Board</title>
        <meta charset="utf-8">
        <!--<meta http-equiv="refresh" content="30">-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/customsytyle.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/sticky-footer.css" />
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </head>

    <body style="background-image:url('css/back2.jpg');">


        <!--Navigation Bar-->

        <nav class="navbar navbar-inverse navbar-static-top">

            <div class="container">
                <div class="navbar-header">
                    <a href="index.php" class="navbar-brand">Digital Notice Board</a>
                </div>
                <div>
                    <ul class="nav navbar-nav ">
                        <li><a class="active" href="#">Home</a>
                        </li>


                        <li id="loginprocess" class="dropdown">
                            <a class="dropdown-toggle active" data-toggle="dropdown" href="#">
                                <?php echo $_SESSION['username_current'] ?><span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="logout.php">Logout</a>
                                </li>
                                <li><a href="settings.php">Settings</a>
                                </li>
                            </ul>

                        </li>

                    </ul>
                </div>
            </div>
            <?php
            if (!isset($_SESSION['username_current'])) {
                echo "<script> $('#loginprocess').hide(); </script>";
            }
            ?>
        </nav>

        <!--Navigation Bar ends-->
        <!--page Content-->
        <div class="container">
            <div class="jumbotron">
                <h1>Welcome to Digital Notice Board</h1>

            </div>
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-9">


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
                                        <!--Deletion and editing UI-->
                                        
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                                <input type="text" name="delete_id" value="<?php echo $row['slno'];
                                $_COOKIE["delid"] = $row['slno']; ?>" hidden/>
                                                <button type="button" class="btn btn-danger" id="delete_post" name="delete" data-toggle="modal" data-target="#deleteWindow" value="Delete post">&times;&nbsp;Delete</button> &nbsp;&nbsp;
                                            </form>
                                            <br/>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?> " method="POST">
                                                <input type="text" name="edit_id" value="<?php echo $row['slno'];
                                $_COOKIE['edit_id'] = $row['slno'];
                                $_COOKIE['edit_content'] = $row['content']; ?>" hidden/>
                                                <button type="button" class="btn btn-success" id="edit_post" data-toggle="modal" data-target="#editWindow" name="edit"><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit Post</button>
                                            </form>
                                        
                                    </div>
    <?php } ?>
                            </div>
<?php } ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 well-cust">
                    <h2>About</h2>
                    <p>&Tab;Digital Notice board is a technology providing a versatile platform to communicate day to day information
                        in the form of notice and memos in a much quicker and safer manner as it prevents physical access to these information 
                        and it is an initiative to save papers.
                    </p>

                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 " style="float:right;">
                    <?php
                    if (isset($_SESSION['username_current'])) {
                        echo '<button id="insertButton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#newPost"><span class="glyphicon glyphicon-plus"></span> &nbsp;New Notice</button>';
                    }
                    ?>
                    <br/>
                    <br/>
                    <?php
                    if (!isset($_SESSION['username_current'])) {
                        echo '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#loginWindow"><span class="glyphicon glyphicon-user">&nbsp;<span  style="font-family:cursive; font-weight:bold;">Login</span></button>';
                    }
                    ?>
                    <br/>
                    <br/>

                    <!--Modal Window for New Post-->
                    <div class="modal fade" id="newPost">
                        <div class="modal-dialog modal-open">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times; </button>
                                    <div class="modal-title">

                                        <h3>New Post</h3>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <form role="form" action="post.php" method="post">
                                        <div class="form-group">
                                            <input name="posttitle" type="text" class="form-control" placeholder="Post Title" required>
                                        </div>
                                        <div class="form-group">

                                            <input name="username" type="text" class="form-control" placeholder="Your name" value="<?php isset($_SESSION['fullname']) ? print($_SESSION['fullname']) : print('error'); ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <textarea type="text" name="postcontent" rows="8" cols="40" class="form-control" placeholder="Write you post Content here." required></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-primary" value="Post" />
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

                <!--End of New post Modal-->

                <!--Modal Window for Deletion confirmation-->
                <div class="modal fade" id="deleteWindow">
                    <div class="modal-dialog modal-open">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times; </button>
                                <div class="modal-title">

                                    <h3>Are you sure you want to delete the post ?</h3>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="modal-footer">
                                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST'>
                                        <input type="text" id="delete_container" name="delete_id" value="<?php echo $_COOKIE['delid'];
                    unset($_COOKIE['delid']) ?>" hidden/>
                                        <input type="submit" class="btn btn-danger" value="Yes" />  
                                        <input type="button" class="btn btn-warning" data-dismiss="modal" value="No" /> 
                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>



                <!--End of Deletion confirmation Modal-->



                <!--Login Modal-->

                <div class="modal fade" id="loginWindow">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times; </button>
                                <div class="modal-title" style="font-family:cursive;">

                                    <h3>Login</h3>
                                </div>
                            </div>
                            <div class="modal-body">
                                <form role="form" action="login.php" method="POST">
                                    <div class="form-group">
                                        <input type="text" name="username_login" class="form-control" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password_login" class="form-control" placeholder="password">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary ">Login</button>

                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>

                <!--End of Login Modal-->


                <!--Edit Modal-->

                <div class="modal fade" id="editWindow">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times; </button>
                                <div class="modal-title" style="font-family:cursive;">

                                    <h3>Edit your Post</h3>
                                </div>
                            </div>
                            <div class="modal-body">
                                <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
                                    <input type="text" name="edit_id" value="<?php echo $_COOKIE['edit_id']; ?>" hidden />
                                    <div class="form-group">
                                        <textarea type="text" name="editMessage" class="form-control">
<?php echo $_COOKIE['edit_content']; ?>
                                        </textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-default "><i class="glyphicon glyphicon-edit" ></i> Edit</button>
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">&times;&nbsp; Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>


                <!--End of Edit Modal--> 


            </div>
        </div>
    </div>
    <!--Page Content Ends-->
    <div>
        <footer class="footer">
            <div class="text-muted" id="center">
                <p>Copyright &copy 2017 <a href="http://saiprasad.tk">SAI PRASAD</a> &amp; JN.
                    <br/>All rights reserved</p>
            </div>
        </footer>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#delete_post").on("click", function () {
                document.cookie = "id=" + cookieValue;
            });
            $("#edit_post").on("click", function () {

            });
        });
    </script>
</body>

</html>