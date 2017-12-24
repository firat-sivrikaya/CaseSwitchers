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
    $avatarloc = $row["avatarloc"];

    if(isset($_POST["sendmessage"]))
    {
        if($userid != $login_id)
        {
            header("location: readmessage.php?id=$userid");
        }
        else
        {
            echo '<div class="alert alert-danger" role="alert">You cannot send message to yourself.</div>';
        }
    }
    
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
                </button><a class="navbar-brand navbar-link" href="index.php">CaseSwitchers </a></div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li role="presentation"><a href="index.php">Home </a></li>
                    <li role="presentation"><a href="posts.php">Posts </a></li>
                    <li role="presentation"><a href="categories.php">Categories </a></li>
                    <li role="presentation"><a href="users.php">Users </a></li>
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
                    <div class="col-md-6 col-md-offset-3"><img class="img-circle img-responsive" src="assets/img/<?php echo $avatarloc; ?>" width="200" height="200"></div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                    <form method="post" action="">
                    <?php
                        if ( $login_id != $userid)
                        {
                            echo '<button class="btn btn-success btn-sm" type="submit" name="sendmessage">Message</button>';
                        }
                    ?>
                    </form>
                    </div>
                    <?php
                        if ( $login_id == $userid )
                        {
                            echo '<div class="col-sm-3">
                                    <a class="btn btn-primary btn-sm" type="button" href="profilesettings.php">Settings</a>
                                </div>
                                <div class="col-sm-3">
                                    <a class="btn btn-info btn-sm" type="button" href="inbox.php">Inbox</a>
                                </div>
                                <div class="col-sm-3">
                                    <a class="btn btn-info btn-sm" type="button" href="favorites.php">Favorites</a>
                                </div>';
                        }
                    ?>
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
                            <li class="list-group-item list-group-item-warning"><span>Rating: 
                                <?php
                                    $query2 = "SELECT * FROM Owns WHERE u_id = '$userid'";
                                    $result2 = $db->query($query2);
                                    $totalrating = 0;
                                    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                                        $entryid = $row2["e_id"];
                                        $query3 = "SELECT e_id, sum(rating) as entryrating FROM Rates WHERE e_id = '$entryid' GROUP BY e_id";
                                        $result3 = $db->query($query3);
                                        $row3 = $result3->fetch_assoc();
                                        $entryrating = $row3["entryrating"];
                                        $totalrating = $totalrating + (int)$entryrating;
                                    }
                                    echo $totalrating;
                                ?></span></li>
                            <li class="list-group-item list-group-item-warning"><span>Total Posts: 
                            <?php 
                                $query = "SELECT u_id, count(e_id) as postcount FROM Owns, Post WHERE e_id = postID AND u_id = $userid GROUP BY u_id";
                                $result = $db->query($query);
                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $postcount = $row["postcount"];
                                echo $postcount;   
                            ?></span></li>
                            <li class="list-group-item list-group-item-warning"><span>Total Comments: 
                            <?php 
                                $query = "SELECT u_id, count(e_id) as commentcount FROM Owns, Comment WHERE e_id = commentID AND u_id = $userid GROUP BY u_id";
                                $result = $db->query($query);
                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $commentcount = $row["commentcount"];
                                echo $commentcount;   
                            ?></span></li>
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
                        <?php
                            $query = "SELECT * FROM Owns, Entry, Post WHERE u_id = $userid AND e_id = entryID AND postID = entryID ORDER BY creationdate DESC LIMIT 3";
                            $result = $db->query($query);
                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                            {
                                $topicname = $row["topicname"];
                                $entryid = $row["e_id"];
                                echo '<tr><td><a href="showpost.php?id='.$entryid.'">'.$topicname.'</a></td></tr>';
                            }
                            
                        ?>
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
                            
                        <?php
                            $query = "SELECT * FROM Owns, Entry, Comment WHERE u_id = $userid AND e_id = entryID AND commentID = entryID ORDER BY creationdate DESC LIMIT 3";
                            $result = $db->query($query);
                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                            {
                                $commentcontent = $row["content"];
                                $commentid = $row["e_id"];
                                $subcommentid = $row["e_id"];
                                findparent:
                                $query2 = "SELECT * FROM PostComments WHERE c_id = $commentid";
                                $result2 = $db->query($query2);
                                if( mysqli_num_rows($result2)==0 )
                                {
                                    $query3 = "SELECT * FROM SubComments WHERE subcomment_id = $commentid";
                                    $result3 = $db->query($query3);
                                    if(mysqli_num_rows($result3) == 0)
                                    {
                                        goto done;
                                    }
                                    else
                                    {
                                        $row = mysqli_fetch_array($result3, MYSQLI_ASSOC);
                                        $commentid = $row["comment_id"];
                                        goto findparent;                                       
                                    }

                                }
                                done:
                                $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                                $linkedpost = $row2["p_id"];
                                echo '<tr><td><a href="showpost.php?id='.$linkedpost.'#'.$subcommentid.'">'.$commentcontent.'</a></td></tr>';
                            }
                            
                        ?>
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