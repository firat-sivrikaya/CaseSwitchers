<!DOCTYPE html>
<html>
<?php
    include("session.php");
    $postid = mysqli_real_escape_string($db,$_GET['id']);
    
    
    if(isset($_POST["upvotepost"]))
    {
        $entryid = $_POST["upvotepostid"];
        $query = "SELECT * FROM Rates WHERE e_id = $entryid AND u_id = $login_id";
        $result = $db->query($query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if($count == 0)
        {
            $query = "INSERT INTO Rates VALUES ($entryid, $login_id, 1)";
            $data = mysqli_query($db,$query);
            
            if($data)
            {
                echo '<div class="alert alert-success" role="alert">You upvoted the entry with ID '.$entryid.'.</div>';
            }
        }
        else
        {
            $query = "SELECT * FROM Rates WHERE e_id = $entryid AND u_id = $login_id AND rating = 1";
            $result = $db->query($query);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $count2 = mysqli_num_rows($result);
            if($count2 == 1)
            {
                $query = "DELETE FROM Rates WHERE e_id = $entryid AND u_id = $login_id";
                $data = mysqli_query($db,$query);
                if($data)
                {
                    echo '<div class="alert alert-warning" role="alert">You reverted your upvote for the entry with ID '.$entryid.'.</div>';
                }
                else
                {
                    echo '<div class="alert alert-danger" role="alert">Could not revert the upvote for the entry with ID '.$entryid.'.</div>';
                }
                
            }
            else
            {
                echo '<div class="alert alert-danger" role="alert">You have already downvoted the entry.</div>';
            }   
        }
    }
    
    if(isset($_POST["downvotepost"]))
    {
        $entryid = $_POST["downvotepostid"];
        $query = "SELECT * FROM Rates WHERE e_id = $entryid AND u_id = $login_id";
        $result = $db->query($query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if($count == 0)
        {
            $query = "INSERT INTO Rates VALUES ($entryid, $login_id, -1)";
            $data = mysqli_query($db,$query);
            
            if($data)
            {
                echo '<div class="alert alert-success" role="alert">You downvoted the entry with ID '.$entryid.'.</div>';
            }
        }
        else
        {
            $query = "SELECT * FROM Rates WHERE e_id = $entryid AND u_id = $login_id AND rating = -1";
            $result = $db->query($query);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $count2 = mysqli_num_rows($result);
            if($count2 == 1)
            {
                $query = "DELETE FROM Rates WHERE e_id = $entryid AND u_id = $login_id";
                $data = mysqli_query($db,$query);
                if($data)
                {
                    echo '<div class="alert alert-warning" role="alert">You reverted your downvote for the entry with ID '.$entryid.'.</div>';
                }
                else
                {
                    echo '<div class="alert alert-danger" role="alert">Could not revert the downvote for the entry with ID '.$entryid.'.</div>';
                }
                
            }
            else
            {
                echo '<div class="alert alert-danger" role="alert">You have already upvoted the entry.</div>';
            }   
        }
    }
    if(isset($_POST["favoritepost"]))
    {
        $favoritepostid = $_POST["favoritepostid"];
        
        $query = "SELECT * FROM Favorites WHERE e_id = $favoritepostid AND u_id = $login_id";
        $result = $db->query($query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if($count == 1)
        {
            echo '<div class="alert alert-danger" role="alert">You have already favorited this entry.</div>';
        }
        else
        {
            $query = "INSERT INTO Favorites VALUES('$favoritepostid', '$login_id')";
            $data = mysqli_query($db, $query);
            if($data)
            {
                echo '<div class="alert alert-success" role="alert">You have added post with ID'.$favoritepostid.' to your favorites.</div>';
            }
            else
            {
                echo '<div class="alert alert-danger" role="alert">Post with ID'.$favoritepostid.' could not be added to your favorites.</div>';
            }            
        }

    }
    
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M:\Bilkent\CS353\Project\Frontend\individualpost</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <script>
        function changeComment(entryid)
        {
            var submitComment = document.getElementsByName("submitcomment")[0];
            submitComment.setAttribute("id", entryid);
            document.getElementsByName("submitcommentcontainer")[0].style.display = "block";
        }
    </script>
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
                <h4>
                <?php
                    $query = "SELECT * FROM Post WHERE PostID = $postid";
                    $result = $db->query($query);
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $posttitle = $row["topicname"];
                    echo $posttitle;
                ?></h4></div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <p class="lead">
                <?php
                    $query = "SELECT * FROM Entry WHERE EntryID = $postid";
                    $result = $db->query($query);
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $entrycontent = $row["content"];
                    echo $entrycontent;
                ?></p>
            </div>
            <div class="col-md-3">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-info"><span>User: 
                    <?php
                        $query = "SELECT * FROM Owns NATURAL JOIN User WHERE e_id = $postid";
                        $result = $db->query($query);
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $postownername = $row["username"];
                        echo $postownername;
                    ?></span></li>
                    <li class="list-group-item list-group-item-info"><span>Rating: 
                    <?php
                        $query6 = "SELECT e_id, sum(rating) as entryrating FROM Rates WHERE e_id = '$postid' GROUP BY e_id";
                        $result6 = $db->query($query6);
                        $row6 = $result6->fetch_assoc();
                        $entryrating = $row6["entryrating"];
                        echo $entryrating;
                    ?></span></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="">
                <button class="btn btn-success active" type="button" name="replypost" onmousedown="changeComment(<?php echo $postid;?>)">Reply </button>
                <input value="<?php echo $postid;?>" type="hidden" name="replypostid">
                <button class="btn btn-primary active" type="submit" name="upvotepost">Upvote </button>
                <input value="<?php echo $postid;?>" type="hidden" name="upvotepostid">
                <button class="btn btn-danger active" type="submit" name="downvotepost">Downvote </button>
                <input value="<?php echo $postid;?>" type="hidden" name="downvotepostid">
                <button class="btn btn-info active" type="submit" name="favoritepost">Add to Favorites</button>
                <input value="<?php echo $postid;?>" type="hidden" name="favoritepostid">
                
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4><em>Comments </em></h4></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <blockquote>
                    <p>End of Banking</p>
                    <footer>george44 | Rating: 37</footer>
                </blockquote>
                <button class="btn btn-success active" type="button">Reply </button>
                <button class="btn btn-primary active" type="button">Upvote </button>
                <button class="btn btn-danger active" type="button">Downvote </button>
                <button class="btn btn-info active" type="button">Add to Favorites</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-11 col-md-offset-1 col-xs-11 col-xs-offset-1">
                <blockquote>
                    <p>Do you really think that a virtual currency will bring the end of a solid economical system?</p>
                    <footer>adamsmith | Rating: 4</footer>
                </blockquote>
                <button class="btn btn-success active" type="button">Reply </button>
                <button class="btn btn-primary active" type="button">Upvote </button>
                <button class="btn btn-danger active" type="button">Downvote </button>
                <button class="btn btn-info active" type="button">Add to Favorites</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-2">
                <blockquote>
                    <p>I believe, by heart.</p>
                    <footer>george44 | Rating: 11</footer>
                </blockquote>
                <button class="btn btn-success active" type="button">Reply </button>
                <button class="btn btn-primary active" type="button">Upvote </button>
                <button class="btn btn-danger active" type="button">Downvote </button>
                <button class="btn btn-info active" type="button">Add to Favorites</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <blockquote>
                    <p>A Big Bubble</p>
                    <footer>jonas_cs | Rating: 8</footer>
                </blockquote>
                <button class="btn btn-success active" type="button">Reply</button>
                <button class="btn btn-primary active" type="button">Upvote </button>
                <button class="btn btn-danger active" type="button">Downvote </button>
                <button class="btn btn-info active" type="button">Add to Favorites</button>
            </div>
        </div>
    </div>
    <div class="container" type="hidden" style="display: none" name="submitcommentcontainer">
        <div class="row">
            <div class="col-md-12">
                <h4>New Comment</h4>
                <textarea class="input-lg">Put your comment here</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-success" type="submit" name="submitcomment" id="-1">Submit </button>
            </div>
        </div>
    </div>
    </form>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>