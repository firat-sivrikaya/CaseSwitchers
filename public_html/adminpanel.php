<?php
    include("session.php");
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M:\Bilkent\CS353\Project\Frontend\AdminPanel</title>
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
                <h1>Admin Panel</h1></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-warning"><span>Total Posts: 12903</span></li>
                            <li class="list-group-item list-group-item-warning"><span>Total Comments: 45940</span></li>
                            <li class="list-group-item list-group-item-warning"><span>Total Categories: 23</span></li>
                            <li class="list-group-item list-group-item-warning"><span>Total SubCategories: 53</span></li>
                            <li class="list-group-item list-group-item-warning"><span>Total Users: 65038</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Edit Post</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>Post ID</label>
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
                            <li class="list-group-item">
                                <button class="btn btn-success" type="button">Submit </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Delete Post</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>Post ID</label>
                                <input type="text">
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="button">Submit </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Edit Comment</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>Comment ID</label>
                                <input type="text">
                            </li>
                            <li class="list-group-item">
                                <textarea class="input-lg">Put your comment here</textarea>
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="button">Submit </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Delete Comment</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>Comment ID</label>
                                <input type="text">
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="button">Submit </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Ban User</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>User ID</label>
                                <input type="text">
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="button">Submit </button>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <h4>Unban User</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>User ID</label>
                                <input type="text">
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="button">Submit </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Create Category</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>Category Name</label>
                                <input type="text">
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="button">Submit </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Delete Category</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>Category ID</label>
                                <input type="text">
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="button">Submit </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Create Subcategory</h4>
                        <ul class="list-group">
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
                                <label>Subcategory Name</label>
                                <input type="text">
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="button">Submit </button>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <h4>Change Subcategory Parent</h4>
                        <ul class="list-group">
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
                                <label>Subcategory ID</label>
                                <input type="text">
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="button">Submit </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Update User Bio</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>User ID</label>
                                <input type="text">
                            </li>
                            <li class="list-group-item">
                                <label>Name </label>
                                <input type="text">
                            </li>
                            <li class="list-group-item">
                                <label>Surname </label>
                                <input type="text">
                            </li>
                            <li class="list-group-item">
                                <textarea class="input-lg">Put user bio here</textarea>
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="button">Submit </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>