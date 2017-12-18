<?php
    include("session.php");

    $userid = mysqli_real_escape_string($db,$_GET['id']);
    $sql = "SELECT * FROM user WHERE userID = '$userid'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    $userid = $row['userID'];
    $username = $row['username'];
    $name = $row['name'];
    $surname = $row['surname'];
    $profileinfo = $row['profile_info'];
    $dateofregistration = $row['date_of_registration'];
    $userlevel = $row['userlevel'];
    
?>
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
                    <li role="presentation"><a href="index.php">Home </a></li>
                    <li role="presentation"><a href="posts.php">Posts </a></li>
                    <li role="presentation"><a href="#">Categories </a></li>
                    <li role="presentation"><a href="#">Users </a></li>
                    <li role="presentation"></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php   
                        if(isset($_SESSION['admin']))
                        {
                            echo '<li role="presentation"><a href="adminpanel.php">Admin Panel </a></li>';
                        }
                        if(isset($_SESSION['login_user']))
                        {
                            echo '<li role="presentation"><a href="profile.php?id='.$login_id.'">Profile </a></li>';
                            echo '<li role="presentation"><a href="logout.php">Logout </a></li>';
                        }
                    ?>
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
                            <li class="list-group-item list-group-item-warning"><span><strong>Username:</strong> 
                            <?php
                                echo $username;
                            ?></span></li>
                            <li class="list-group-item list-group-item-warning"><span><strong>Name: </strong><?php
                                echo $name;
                            ?></span></li>
                            <li class="list-group-item list-group-item-warning"><span><strong>Surname: </strong><?php
                                echo $surname;
                            ?></span></li>
                            <li class="list-group-item list-group-item-warning"><span><strong>Date Joined: </strong><?php
                                echo $dateofregistration;
                            ?></span></li>
                            <li class="list-group-item list-group-item-warning"><span><strong>Bio: </strong> <?php
                                echo $profileinfo;
                            ?></span></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-warning"><span>Rating: 5094</span></li>
                            <li class="list-group-item list-group-item-warning"><span>Total Posts: 2</span></li>
                            <li class="list-group-item list-group-item-warning"><span>Total Comments: 83</span></li>
                            <li class="list-group-item list-group-item-warning"><span class="bg-info">User Level: <?php
                                echo $userlevel;
                            ?></span></li>
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