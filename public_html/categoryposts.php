<?php
    include("session.php");

    $categoryid = mysqli_real_escape_string($db,$_GET['id']);
    $query = "SELECT * FROM Category WHERE ID = $categoryid";
    $result = $db->query($query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $categoryname = $row["categoryname"];
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category:<?php echo $categoryname; ?> - CaseSwitchers</title>
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
                <h1>Category: <em><?php echo $categoryname; ?></em></h1></div>
        </div>
        <div class="row">
            <div class="col-sm-3 col-sm-offset-9">
                <div class="row">
                    <div class="col-sm-8 col-sm-pull-1">
                        <input type="search" name="Search" value="Search" disabled="">
                    </div>
                    <div class="col-sm-4">
                        <button class="btn btn-default btn-sm" type="button">Search </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Entry</th>
                                <th>Author </th>
                                <th>Rating </th>
                                <th>Comments </th>
                                <th>Subcategory </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Retrieve the posts with the matching category
                                $query = "SELECT * FROM PostCategory, Entry WHERE c_id = $categoryid and p_id = entryID ORDER BY creationdate DESC";
                                $result = $db->query($query);
                                while( $rowloop = mysqli_fetch_array($result, MYSQLI_ASSOC))
                                {
                                    $postid = $rowloop["p_id"];
                                    $subid = $rowloop["s_id"];
                                    
                                    // Retrieve subcategoryname name
                                    $query = "SELECT * FROM Subcategory WHERE sub_id = $subid";
                                    $result2 = $db->query($query);
                                    $row = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                                    $subcategoryname = $row["subcategoryname"]; 
                                    
                                    // Retrieve post title
                                    $query = "SELECT * FROM Post WHERE postID = $postid";
                                    $result3 = $db->query($query);
                                    $row = mysqli_fetch_array($result3, MYSQLI_ASSOC);
                                    $posttitle = $row["topicname"];

                                    // Retrieve post owner
                                    $query = "SELECT * FROM Owns, User WHERE e_id = $postid AND u_id = userID";
                                    $result4 = $db->query($query);
                                    $row = mysqli_fetch_array($result4, MYSQLI_ASSOC);
                                    $ownername = $row["username"];
                                    $ownerid = $row["u_id"];

                                    // Calculate post rating
                                    $query6 = "SELECT e_id, sum(rating) as entryrating FROM Rates WHERE e_id = '$postid' GROUP BY e_id";
                                    $result6 = $db->query($query6);
                                    $row6 = $result6->fetch_assoc();
                                    $entryrating = $row6["entryrating"];

                                    // Get post comment count
                                    $query2 = "SELECT count(c_id) as commentcount FROM PostComments WHERE p_id = $postid GROUP BY p_id";
                                    $result2 = $db->query($query2);
                                    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                                    $commentcount = $row2["commentcount"];
                                    
                                    echo '<tr>
                                            <td><a href="showpost.php?id='.$postid.'">'.$posttitle.'</a></td>
                                            <td><a href="profile.php?id='.$ownerid.'">'.$ownername.'</a></td>
                                            <td>'.$entryrating.'</td>
                                            <td>'.$commentcount.'</td>
                                            <td>'.$subcategoryname.'</td>
                                            </tr>';
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