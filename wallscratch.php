<!DOCTYPE html>
<html>
<?php include('dbcon.php');
 $query=  mysqli_query($con, "SELECT * FROM posts");?>
<head>
    <meta charset="UTF-8">
    <title>Student Wall</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/customsytyle.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
	<div id="wrapper">
		<div id="sidebar-wrapper">
			<ul class="sidebar-nav">
                            <li><a  href="#" ><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;Techno Wall</a></li>
				<li><a  href="#"><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Gupshup</a></li>
				<li><a  href="#"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;News</a></li>	
                        </ul>
                </div>
		<!--Page content-->
		<div id="page-content-wrapper">
		
		<!--page Content-->
    <div class="container-fluid">
	<button class="btn btn-default" id="menu-toggle"><span class="glyphicon glyphicon-th-list"></span></button><br/><br/>
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-9">

                <div class="well-cust">
                    <?php while ($row=mysqli_fetch_array($query)) { ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h2 class="panel-title"><?php echo $row['heading']; ?></h2>
                            <cite>&nbsp; &nbsp; -Posted by <?php echo $row['owner']; ?> on <?php echo $row['date']; ?></cite>
                        </div>
                        <div class="panel-body">
                            <blockquote>
                                <?php echo $row[ 'content']; ?>
                            </blockquote>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 well-cust">
                <h2>About</h2>
                <p>Student wall micro blogging.</p>
            </div>
            <div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newPost"><span class="glyphicon glyphicon-plus"></span> &nbsp;New Post</button>
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
                                <form role="form">
                                    <div class="form-group">
                                        <input name="posttitle" type="text" class="form-control" placeholder="Post Title">
                                    </div>
                                    <div class="form-group">
                                        <input name="username" type="text" class="form-control" placeholder="Your name">
                                    </div>
                                    <div class="form-group">
                                        <textarea type="text" name="postcontent" rows="8" cols="40" class="form-control" placeholder="Write you post Content here."></textarea>
                                    </div>
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary ">Post</button>

                            </div>
                        </div>
                    </div>

                </div>

                <!--End of New post Modal-->

            </div>
        </div>
    </div>
	<!--Page Content Ends-->
		
		<script>
		$("#menu-toggle").click(function(e){
                    e.preventDefault();
                    $("#wrapper").toggleClass("menuDisplayed");
		});
		</script>
		
		</div>
	</div>
</body>
</html>