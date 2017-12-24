<?php
    include("session.php");

    if(isset($_POST["unfavoritepost"]))
    {
        $unfavpostid = $_POST["unfavpostid"];
        $query = "DELETE FROM Favorites WHERE u_id = $login_id AND e_id = $unfavpostid";
        $data = mysqli_query($db, $query);
        if($data)
        {
            echo '<div class="alert alert-success" role="alert">You have unfavorited entry with ID '.$unfavpostid.' successfully.</div>';
        }
        else
        {
            echo '<div class="alert alert-danger" role="alert">Entry with ID '.$unfavpostid.' could not be unfavorited.</div>';
        }
    }

?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M:\Bilkent\CS353\Project\Frontend\Favorites</title>
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
                <h1>Favorites </h1></div>
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
                                <th>Action </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "SELECT * FROM Favorites WHERE u_id = $login_id"; 
                            $result = $db->query($query);
                            
                            
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                $favoriteid = $row["e_id"];
                                
                                $query = "SELECT * FROM Post WHERE postID = $favoriteid";
                                $result2 = $db->query($query);
                                while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                                {
                                    $favpostname = $row2["topicname"];
                                    $favpostid = $row2["postID"];
                                    $query3 = "SELECT * FROM Owns NATURAL JOIN User WHERE e_id = $favpostid";
                                    $result3 = $db->query($query3);
                                    $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
                                    $ownername = $row3["username"];
                                    
                                    $query4= "SELECT e_id, sum(rating) as totalrating FROM Rates WHERE e_id = $favpostid GROUP BY e_id";
                                    $result4= $db->query($query4);
                                    $row4= mysqli_fetch_array($result4, MYSQLI_ASSOC);
                                    $postrating = $row4["totalrating"];
                                    
                                    echo "<tr>";
                                    echo '<td><a href="showpost.php?id='.$favpostid.'">'.$favpostname.'</a></td>';
                                    echo "<td>".$ownername."</td>";
                                    echo "<td>".$postrating."</td>";
                                    echo '<form method="post" action=""><td><button class="btn btn-danger" type="submit" name="unfavoritepost">Unfavorite</button><input type="hidden" value="'.$favpostid.'" name="unfavpostid"></form></td>';                                    
                                }
                            }
                        ?>
                            <tr>
                                <td>Explain Blockchain in 3 words</td>
                                <td>cspro </td>
                                <td>55 </td>
                                <td> <a class="btn btn-danger" role="button" href="#">Unfavorite </a></td>
                            </tr>
                            <tr>
                                <td>Future of Cryptocurrencies</td>
                                <td>jack30 </td>
                                <td>43 </td>
                                <td> <a class="btn btn-danger" role="button" href="#">Unfavorite </a></td>
                            </tr>
                            <tr>
                                <td>By 2040, There Will Be No World Without Bitcoin</td>
                                <td>h4x0r </td>
                                <td>55 </td>
                                <td> <a class="btn btn-danger" role="button" href="#">Unfavorite </a></td>
                            </tr>
                            <tr>
                                <td>Bitcoin will hit $10.000 by the end of 2017</td>
                                <td>aug30 </td>
                                <td>11 </td>
                                <td> <a class="btn btn-danger" role="button" href="#">Unfavorite </a></td>
                            </tr>
                            <tr>
                                <td>I've invested more than $100.000 in Bitcoin, AMA!</td>
                                <td>kevin17 </td>
                                <td>378 </td>
                                <td> <a class="btn btn-danger" role="button" href="#">Unfavorite </a></td>
                            </tr>
                            <tr>
                                <td>The Lightning Network</td>
                                <td>cryptoislove </td>
                                <td>389 </td>
                                <td> <a class="btn btn-danger" role="button" href="#">Unfavorite </a></td>
                            </tr>
                            <tr>
                                <td>Most profitable altcoins</td>
                                <td>chocho03 </td>
                                <td>77 </td>
                                <td> <a class="btn btn-danger" role="button" href="#">Unfavorite </a></td>
                            </tr>
                            <tr></tr>
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