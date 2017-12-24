<?php
    include("session.php");
    date_default_timezone_set('Europe/Istanbul');
    $time = time();
    $atime = date('Y-m-d H:i:s',$time);
    if(isset($_POST['selected_category']))
    {
        $selectedcategory = mysqli_real_escape_string($db, $_POST['selected_category']);
        $query = "SELECT * FROM Category WHERE categoryname = '$selectedcategory'";
        $result = $db->query($query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $selectedcatid = $row["ID"];
    }
    if(isset($_POST['submit_post'])){
        $postTitle = mysqli_real_escape_string($db, $_POST['post_title']);
        $category = mysqli_real_escape_string($db, $_POST['selected_category']);
        $subCategory = mysqli_real_escape_string($db, $_POST['selected_subcategory']);
        $postContent = mysqli_real_escape_string($db, $_POST['post_content']);
        $query = "INSERT INTO Entry (creationdate, content) VALUES ('$atime', '$postContent')";
        $data = mysqli_query ($db,$query)or die(mysqli_error($db));
        $query = "SELECT entryID FROM Entry WHERE creationdate = '$atime' AND content = '$postContent'"; 
        $result = $db->query($query);
        while($row = $result->fetch_assoc()){
            $entryID = $row["entryID"]; 
        }
        $query = "SELECT userID FROM User WHERE username = '$login_session'"; 
        $result = $db->query($query);
        while($row = $result->fetch_assoc()){
            $userID = $row["userID"]; 
        }
        $query = "INSERT INTO Post VALUES ($entryID, '$postTitle')";
        $data = mysqli_query ($db,$query)or die(mysqli_error($db));
        
        $query = "INSERT INTO Owns VALUES ($entryID, $userID)";
        $data = mysqli_query ($db,$query)or die(mysqli_error($db));
        $query = "SELECT ID, categoryname FROM Category WHERE categoryname = '$category'"; 
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        $categoryID = $row["ID"]; 
        $categoryname = $row['categoryname'];
        $query = "SELECT sub_id, subcategoryname FROM subcategory WHERE subcategoryname = '$subCategory'"; 
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        $subcategoryID = $row["sub_id"];
        $subcategoryname = $row["subcategoryname"];
        
        if(!$row)
        {
            // Check if subcategory belongs to category. Act accordingly.
            echo '<div class="alert alert-danger" role="alert">Subcategory '.$subcategoryname.' does not belong to '.$categoryname.'. Please choose the correct category. </div>'; 
        }
        $query = "INSERT INTO PostCategory VALUES ($entryID, $categoryID, $subcategoryID)";
        $data = mysqli_query ($db,$query)or die(mysqli_error($db));
        
        if ($data)
        {
            echo '<div class="alert alert-success" role="alert">Your post has been submitted!</div>'; 
        }
    }
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
                </button><a class="navbar-brand navbar-link" href="index.php">CaseSwitchers </a></div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li role="presentation"><a href="index.php">Home </a></li>
                    <li class="active" role="presentation"><a href="posts.php">Posts </a></li>
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
                <h1>Most Recent Posts</h1></div>
        </div>
        <div class="row">
            <div class="col-sm-3 col-sm-offset-9">
                <div class="row">
                <form method="post" action="">
                    <div class="col-sm-8 col-sm-pull-1">
                        <input type="search" name="Search" placeholder="Search">
                    </div>
                    <div class="col-sm-4">
                        <button class="btn btn-default btn-sm" type="Submit">Search </button>
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
                                <th>Post Title</th>
                                <th>Author </th>
                                <th>Rating </th>
                                <th>Comments </th>
                                <th>Category </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(isset($_POST['Search'])){
                                $pattern = $_POST['Search'];
                                $query = "SELECT * FROM Post, Entry WHERE (postID = entryID AND topicname LIKE '%$pattern%') ORDER BY creationdate DESC"; 
                                $result = $db->query($query);
                                            
                                if(strlen($pattern) != 0){             
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        $postid = $row["postID"];
                                        $posttitle = $row["topicname"];
                                        //Select owner ID from postID
                                        $query2 = "SELECT * FROM Owns WHERE e_id = '$postid'";
                                        $result2 = $db->query($query2);
                                        $row = $result2->fetch_assoc();
                                        $postownerid = $row["u_id"];
                                        
                                        //Select username from owner ID
                                        $query3 = "SELECT * FROM User WHERE userID = '$postownerid'";
                                        $result3 = $db->query($query3);
                                        $row = $result3->fetch_assoc();
                                        $postownername = $row['username'];
                                        
                                        //Select category id from postID
                                        $query4 = "SELECT * FROM Postcategory WHERE p_id = '$postid'";
                                        $result4 = $db->query($query4);
                                        $row = $result4->fetch_assoc();
                                        $postcategoryid = $row['c_id'];
                                        
                                        //Select category name from category ID
                                        $query5 = "SELECT * FROM Category WHERE ID='$postcategoryid'";
                                        $result5 = $db->query($query5);
                                        $row = $result5->fetch_assoc();
                                        $postcategoryname = $row['categoryname'];
                                        
                                        //Select rating from rates
                                        //todo
                                        //Select owner ID from postID
                                        
                                        $query6 = "SELECT e_id, sum(rating) as entryrating FROM Rates WHERE e_id = '$postid' GROUP BY e_id";
                                        $result6 = $db->query($query6);
                                        $row6 = $result6->fetch_assoc();
                                        $entryrating = $row6["entryrating"];
                                        
                                        // Get comment count
                                        $query2 = "SELECT count(c_id) as commentcount FROM PostComments WHERE p_id = $postid GROUP BY p_id";
                                        $result2 = $db->query($query2);
                                        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                                        $commentcount = $row2["commentcount"];
                                        
                                        
                                        //Select rating from rates
                                        //todo
                                        
                                        //Select comments from comments
                                        //todo
                                        
                                        //Select comments from comments
                                        //todo
                                       
                                        echo "<tr>";
                                        echo '<td><a href="showpost.php?id='.$postid.'">'.$posttitle.'</a></td>';
                                        echo '<td><a href="profile.php?id='.$postownerid.'">'.$postownername.'</a></td>';
                                        echo "<td>".$entryrating."</td>";
                                        echo '<td>'.$commentcount.'</td>';
                                        echo '<td><a href="categoryposts.php?id='.$postcategoryid.'">'.$postcategoryname.'</a></td>';
                                        echo "</tr>";
                                    }
                                }
                                    else
                                        header("location: posts.php");
                            }
                            else{
                                $query = "SELECT * FROM Post, Entry WHERE postID = entryID ORDER BY creationdate DESC"; 
                                $result = $db->query($query);
                                                         
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    $postid = $row["postID"];
                                    $posttitle = $row["topicname"];
                                    //Select owner ID from postID
                                    $query2 = "SELECT * FROM Owns WHERE e_id = '$postid'";
                                    $result2 = $db->query($query2);
                                    $row = $result2->fetch_assoc();
                                    $postownerid = $row["u_id"];
                                    
                                    //Select username from owner ID
                                    $query3 = "SELECT * FROM User WHERE userID = '$postownerid'";
                                    $result3 = $db->query($query3);
                                    $row = $result3->fetch_assoc();
                                    $postownername = $row['username'];
                                    
                                    //Select category id from postID
                                    $query4 = "SELECT * FROM Postcategory WHERE p_id = '$postid'";
                                    $result4 = $db->query($query4);
                                    $row = $result4->fetch_assoc();
                                    $postcategoryid = $row['c_id'];
                                    
                                    //Select category name from category ID
                                    $query5 = "SELECT * FROM Category WHERE ID='$postcategoryid'";
                                    $result5 = $db->query($query5);
                                    $row = $result5->fetch_assoc();
                                    $postcategoryname = $row['categoryname'];
                                    
                                    //Select rating from rates
                                    //todo
                                    //Select owner ID from postID
                                    
                                    $query6 = "SELECT e_id, sum(rating) as entryrating FROM Rates WHERE e_id = '$postid' GROUP BY e_id";
                                    $result6 = $db->query($query6);
                                    $row6 = $result6->fetch_assoc();
                                    $entryrating = $row6["entryrating"];
                                    
                                    // Get comment count
                                    $query2 = "SELECT count(c_id) as commentcount FROM PostComments WHERE p_id = $postid GROUP BY p_id";
                                    $result2 = $db->query($query2);
                                    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                                    $commentcount = $row2["commentcount"];
                                    
                                    
                                    //Select rating from rates
                                    //todo
                                    
                                    //Select comments from comments
                                    //todo
                                    
                                    //Select comments from comments
                                    //todo
                                   
                                    echo "<tr>";
                                    echo '<td><a href="showpost.php?id='.$postid.'">'.$posttitle.'</a></td>';
                                    echo '<td><a href="profile.php?id='.$postownerid.'">'.$postownername.'</a></td>';
                                    echo "<td>".$entryrating."</td>";
                                    echo '<td>'.$commentcount.'</td>';
                                    echo '<td><a href="categoryposts.php?id='.$postcategoryid.'">'.$postcategoryname.'</a></td>';
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
    <!---<div class="container">
        <div class="row">
            <div class="col-sm-2"><a class="btn btn-success" role="button" href="#">New Post</a></div>
        </div>
    </div>-->
    <div class="container">
    <form method="post" action="">
        <div class="row">
            <div class="col-md-12">
                <h4>New Post</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <label>Post Title </label>
                        <input name="post_title" type="text">
                    </li>
                    <li class="list-group-item">
                        <label>Select Category</label>
                        <select name="selected_category" id="select_subcategory" onchange='this.form.submit()'>
                            <optgroup label="Categories">
                                <option style="color: black">Select a category</option>
                                <?php
                                    $query = "SELECT categoryname FROM Category";
                                    $result = $db->query($query);
                                    while($row = $result->fetch_assoc()){
                                        $name = $row['categoryname'];
                                        echo '<option name='.$name.' value='.$name.' style="color: black" ';
                                        if(isset($_POST['selected_category']) && $_POST['selected_category'] == $name) 
                                            echo 'selected= "selected"';
                                        echo ">$name</option>";
                                    }
                                    $parent_category = $name;
                                ?>
                            </optgroup>
                        </select>
                    </li>
                    <li class="list-group-item">
                        <label>Select Subcategory</label>
                            <select name="selected_subcategory">
                                <optgroup label="Subcategories">
                                    <?php
                                        $query = "SELECT subcategoryname FROM Subcategory WHERE c_id = $selectedcatid";
                                        $result = $db->query($query);
                                        while($row = $result->fetch_assoc()){
                                            $name = $row['subcategoryname'];
                                            echo '<option value='.$name.' style="color: black">'.$name.'</option>';
                                        }
                                    ?>
                                </optgroup>
                            </select>
                    </li>
                    <li class="list-group-item">
                        <textarea class="input-lg" name="post_content">Put your post here</textarea>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-success" name="submit_post" type="submit">Submit </button></form>
            </div>
        </div>
    </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>