<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M:\Bilkent\CS353\Project\Frontend\ProfilePage</title>
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
                <h1>Profile </h1></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3"><img class="img-circle img-responsive" src="assets/img/M:\Bilkent\CS353\Project\Frontend\profilepage\elon-must.jpg" width="200" height="200"></div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <button class="btn btn-success btn-sm" type="button">Message </button>
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-primary btn-sm" type="button">Settings </button>
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-info btn-sm" type="button">Inbox </button>
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-info btn-sm" type="button">Favorites </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-warning"><span><strong>Username:</strong> FutureIsNow</span></li>
                            <li class="list-group-item list-group-item-warning"><span><strong>Name: </strong>Elon</span></li>
                            <li class="list-group-item list-group-item-warning"><span><strong>Surname: </strong>Musk</span></li>
                            <li class="list-group-item list-group-item-warning"><span><strong>Date Joined: </strong>15.11.2017 07:49 PM</span></li>
                            <li class="list-group-item list-group-item-warning"><span><strong>Bio: </strong>Founded PayPal, SpaceX, Tesla Motors and recently, The Boring Company. Now busy with constructing a hyperloop between Los Angeles and San Francisco.</span></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-warning"><span>Rating: 5094</span></li>
                            <li class="list-group-item list-group-item-warning"><span>Total Posts: 2</span></li>
                            <li class="list-group-item list-group-item-warning"><span>Total Comments: 83</span></li>
                            <li class="list-group-item list-group-item-warning"><span class="bg-info">User Level: Codemeister</span></li>
                            <li class="list-group-item list-group-item-warning"><span><strong>Bio: </strong>Founded PayPal, SpaceX, Tesla Motors and recently, The Boring Company. Now busy with constructing a hyperloop between Los Angeles and San Francisco.</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Most Recent 3 Posts</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Hello Caseswitchers, I am Elon Musk. AMA!</td>
                            </tr>
                            <tr>
                                <td>The Boring Company</td>
                            </tr>
                            <tr>
                                <td><em>- NOT FOUND - </em></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Most Recent 3 Comments</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>I agree with your opinion about this topic, however...</td>
                            </tr>
                            <tr>
                                <td>Nice! </td>
                            </tr>
                            <tr>
                                <td>Could you clarify your argument a little bit more please?</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>