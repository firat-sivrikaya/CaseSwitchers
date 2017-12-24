<?php
    include("session.php");

?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M:\Bilkent\CS353\Project\Frontend\Categories</title>
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
                    <li class="active" role="presentation"><a href="categories.php">Categories </a></li>
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
                <h1>Categories </h1></div>
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
                                <th>Category Name</th>
                                <th>Post Count</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "SELECT * FROM Category"; 
                            $result = $db->query($query);
                            
                            
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                $categoryID = $row["ID"];
                                $categoryname = $row["categoryname"];
                                //Select owner ID from postID
                                $query2 = "SELECT c_id, count(p_id) as postcount FROM PostCategory WHERE c_id = '$categoryID' GROUP BY c_id";
                                $result2 = $db->query($query2);
                                $row = $result2->fetch_assoc();
                                $postcount = $row["postcount"];
                                
                                
                                //Select rating from rates
                                //todo
                                
                                //Select comments from comments
                                //todo
                               
                                echo "<tr>";
                                echo '<td><a href="categoryposts.php?id='.$categoryID.'">'.$categoryname.'</a></td>';
                                echo "<td>".$postcount."</td>";
                                echo "</tr>";
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