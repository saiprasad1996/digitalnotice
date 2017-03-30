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
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

		</head>

    <body >

<div class="container">
        <!--Navigation Bar-->
        <nav class="navbar navbar-default ">

            <div class="container">
                <div class="navbar-header">
                    <a href="index.php" class="navbar-brand">Digital Notice Board </a>
                </div>
                <div>
                    <ul class="nav navbar-nav ">
                        <li><a class="active" href="index.php">Home</a>
                        </li>

                    </ul>
                </div>
            </div>

        </nav>
    </div>
        <!--Navigation Bar ends-->
        <!--page Content-->
		<div class="container">
			<div class="well-cust form">
				<form role="form" class="form-horizontal" action="regprocess.php" method="GET">
				<!--Name-->
				<div class="form-group">

				<label class="col-sm-2 control-label">Full Name</label>
				<div class="col-sm-10">
				<input class="form-control" name="fullname" required placeholder="Your Full name" id="focusedInput" type="text" >
				</div>
				</div>
				
				<!--Designation-->
				<div class="form-group">

				<label class="col-sm-2 control-label">Designation</label>
				<div class="col-sm-10">
				<input class="form-control" id="focusedInput" required name="designation" placeholder="Your designation" type="text" >
				</div>
				</div>
				<!--Department-->
				<div class="form-group">

				<label class="col-sm-2 control-label">Department</label>
				<div class="col-sm-10">
				<input class="form-control" id="focusedInput" required name="department" placeholder="Your Department" type="text" >
				</div>
				</div>
				<!--username-->
				<div class="form-group">

				<label class="col-sm-2 control-label">Username</label>
				<div class="col-sm-10">
				<input class="form-control" id="focusedInput" required name="user" placeholder="Your college Mail-id" type="text" >
				</div>
				</div>
                    <!--password-->
				<div class="form-group">

				<label class="col-sm-2 control-label">Password</label>
				<div class="col-sm-10">
				<input class="form-control" id="focusedInput" required name="pass" placeholder="Choose your password" type="password" >
				</div>
				</div>


					<button class="btn btn-primary" type="submit">Submit</button>
				</form>
			</div>
		</div>
