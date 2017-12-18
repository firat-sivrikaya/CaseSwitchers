<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M:\Bilkent\CS353\Project\Frontend\ProfileSettings</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button><a class="navbar-brand navbar-link" href="#">CaseSwitchers </a></div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li role="presentation"><a href="#">Home </a></li>
                    <li role="presentation"><a href="#">Posts </a></li>
                    <li role="presentation"><a href="#">Categories </a></li>
                    <li role="presentation"><a href="#">Users </a></li>
                    <li role="presentation"></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="active" role="presentation"><a href="#">Profile </a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Profile Settings</h1></div>
        </div>
    </div>
    <div class="container">
        <div class="row hidden-sm">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3"><img class="img-circle img-responsive" src="assets/img/M:\Bilkent\CS353\Project\Frontend\profilepage\elon-must.jpg" width="200" height="200"></div>
                </div>
                <div class="row">
                    <div class="col-sm-5 col-sm-offset-3">
                        <button class="btn btn-primary btn-sm" type="button">Upload Picture</button>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <form>
                    <div class="form-group">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="control-label">Name </label>
                                        <input class="form-control" type="text">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label">Surname </label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <label class="control-label">New Password</label>
                                <input class="form-control" type="password">
                            </li>
                            <li class="list-group-item">
                                <label class="control-label">Retype New Password</label>
                                <input class="form-control" type="password">
                            </li>
                            <li class="list-group-item">
                                <label class="control-label">Current Password</label>
                                <input class="form-control" type="password" required="">
                            </li>
                            <li class="list-group-item">
                                <label class="control-label">Bio </label>
                                <textarea class="form-control"></textarea>
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-primary" type="button">Save Changes</button>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>