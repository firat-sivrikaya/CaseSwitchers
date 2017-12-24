<?php
    include("session.php");


?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M:\Bilkent\CS353\Project\Frontend\Users</title>
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
                    <li class="active" role="presentation"><a href="users.php">Users </a></li>
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
                <h1>Users </h1></div>
        </div>
        <div class="row">
            <div class="col-sm-3 col-sm-offset-9">
                <div class="row">
                <form method="post" action="">
                    <div class="col-sm-8 col-sm-pull-1">
                        <input type="search" name="Search" placeholder="Search">
                    </div>
                    <div class="col-sm-4">
                        <button class="btn btn-default btn-sm" type="submit">Search </button>
                    </div>
                </form>
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
                                <th>Username </th>
                                <th>Rating </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php

                            if(isset($_POST['Search'])){

                                $pattern = $_POST['Search'];
                                $query = "SELECT * FROM User WHERE username LIKE '%$pattern%'";
                                $result = $db->query($query);
                            
                                if(strlen($pattern) != 0){
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        $username = $row["username"];
                                        $userid = $row["userID"];
                                        
                                        
                                        //Select owner ID from postID
                                        $query2 = "SELECT * FROM Owns WHERE u_id = '$userid'";
                                        $result2 = $db->query($query2);
                                        $totalrating = 0;
                                        while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                                            $entryid = $row2["e_id"];
                                            $query3 = "SELECT e_id, sum(rating) as entryrating FROM Rates WHERE e_id = '$entryid'";
                                            $result3 = $db->query($query3);
                                            $row3 = $result3->fetch_assoc();
                                            $entryrating = $row3["entryrating"];
                                            $totalrating = $totalrating + (int)$entryrating;
                                        }
                                        
                                        //Select rating from rates
                                        //todo
                                        
                                        //Select comments from comments
                                        //todo
                                       
                                        echo "<tr>";
                                        echo '<td><a href="profile.php?id='.$userid.'">'.$username.'</a></td>';
                                        echo "<td>".$totalrating."</td>";
                                        echo "</tr>";

                                    }
                                }

                                else
                                    header("location: users.php");
                            }

                            else{
                                $query = "SELECT * FROM User"; 
                                $result = $db->query($query);
                                
                                
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    $username = $row["username"];
                                    $userid = $row["userID"];
                                    
                                    
                                    //Select owner ID from postID
                                    $query2 = "SELECT * FROM Owns WHERE u_id = '$userid'";
                                    $result2 = $db->query($query2);
                                    $totalrating = 0;
                                    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                                        $entryid = $row2["e_id"];
                                        $query3 = "SELECT e_id, sum(rating) as entryrating FROM Rates WHERE e_id = '$entryid'";
                                        $result3 = $db->query($query3);
                                        $row3 = $result3->fetch_assoc();
                                        $entryrating = $row3["entryrating"];
                                        $totalrating = $totalrating + (int)$entryrating;
                                    }
                                    
                                    //Select rating from rates
                                    //todo
                                    
                                    //Select comments from comments
                                    //todo
                                   
                                    echo "<tr>";
                                    echo '<td><a href="profile.php?id='.$userid.'">'.$username.'</a></td>';
                                    echo "<td>".$totalrating."</td>";
                                    echo "</tr>";

                            }
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