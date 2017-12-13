<?php
    include("session.php");
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M:\Bilkent\CS353\Project\Frontend\Posts</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
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
                    <li class="active" role="presentation"><a href="posts.php">Posts </a></li>
                    <li role="presentation"><a href="#">Categories </a></li>
                    <li role="presentation"><a href="#">Users </a></li>
                    <li role="presentation"></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">  
                    <?php   
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
                <h1>Most Recent Posts</h1></div>
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
                                <th>Post Title</th>
                                <th>Author </th>
                                <th>Rating </th>
                                <th>Comments </th>
                                <th>Category </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>The Financial Case for Open Source Softwares</td>
                                <td>cspro </td>
                                <td>35 </td>
                                <td>7 </td>
                                <td>Fintech </td>
                            </tr>
                            <tr>
                                <td>Is an algorithm just a mathmetical formula?</td>
                                <td>jack30 </td>
                                <td>4 </td>
                                <td>0 </td>
                                <td>Algorithms </td>
                            </tr>
                            <tr>
                                <td>Future of mobile applications</td>
                                <td>h4x0r </td>
                                <td>55 </td>
                                <td>21 </td>
                                <td>Mobile Dev</td>
                            </tr>
                            <tr>
                                <td>CS Jokes</td>
                                <td>aug30 </td>
                                <td>728 </td>
                                <td>403 </td>
                                <td>Humor </td>
                            </tr>
                            <tr>
                                <td>I'm a CS professor at Caltech, AMA!</td>
                                <td>kevin17 </td>
                                <td>1282 </td>
                                <td>1409 </td>
                                <td>Education </td>
                            </tr>
                            <tr>
                                <td>The Lightning Network</td>
                                <td>cryptoislove </td>
                                <td>389 </td>
                                <td>59 </td>
                                <td>Blockchain </td>
                            </tr>
                            <tr>
                                <td>Future of Moore's Law</td>
                                <td>chocho03 </td>
                                <td>14 </td>
                                <td>4 </td>
                                <td>General </td>
                            </tr>
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-2"><a class="btn btn-success" role="button" href="#">New Post</a></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>New Post</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <label>Post Title </label>
                        <input type="text">
                    </li>
                    <li class="list-group-item">
                        <label>Select Category</label>
                        <select>
                            <optgroup label="This is a group">
                                <option value="12" selected="">Blockchain</option>
                                <option value="13">This is item 2</option>
                                <option value="14">This is item 3</option>
                            </optgroup>
                        </select>
                    </li>
                    <li class="list-group-item">
                        <label>Select Subcategory</label>
                        <select>
                            <optgroup label="This is a group">
                                <option value="13">This is item 2</option>
                                <option value="12" selected="">Altcoins</option>
                                <option value="14">This is item 3</option>
                            </optgroup>
                        </select>
                    </li>
                    <li class="list-group-item">
                        <textarea class="input-lg">Put your post here</textarea>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-success" type="button">Submit </button>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>