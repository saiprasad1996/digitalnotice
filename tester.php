<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Modals</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </head>
    <body>

        <div class="container">

            <h3>Modal Demo</h3>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginWindow">Login Window</button>

            <div class="modal fade" id="loginWindow">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times; </button>
                            <div class="modal-title">
                                
                            <h3>Login</h3>
                            </div>
                        </div>
                        <div class="modal-body">
                            <form role="form">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="password">
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary ">Login</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>