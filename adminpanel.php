<?php
    include("session.php");


    function deleteComment($db, $deletecommentid)
    {
            $commentid = $deletecommentid;
            $pcommentid = $commentid;        
            $sql = "SELECT * FROM comment WHERE commentID = $commentid";
            $result = mysqli_query($db, $sql);
            $countcomment = mysqli_num_rows($result);
            if ( $countcomment == 1 )
            {
                    stepf:
                    // find parent
                    $sql = "SELECT * FROM Subcomments WHERE comment_id = $commentid";
                    $result = mysqli_query($db, $sql);
                    $count = mysqli_num_rows($result);
                    if($count == 0 )
                    {
                        goto donef;
                    }
                    else
                    {
                        // step 2: save its child
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $subcommentid = $row["subcomment_id"];
                        // delete parent row
                        $sql = "DELETE FROM rates WHERE e_id = $commentid";
                        $result = mysqli_query($db, $sql);
                        $sql = "DELETE FROM owns WHERE e_id = $commentid";
                        $result = mysqli_query($db, $sql);
                        $sql = "DELETE FROM Favorites WHERE e_id = $commentid";
                        $result = mysqli_query($db, $sql);
                        $sql = "DELETE FROM Subcomments WHERE comment_id = $commentid";
                        $result = mysqli_query($db, $sql);
                        $sql = "DELETE FROM PostComments WHERE c_id = $commentid";
                        $result = mysqli_query($db, $sql); 
                        $sql = "DELETE FROM Comment WHERE commentID = $commentid";
                        $result = mysqli_query($db, $sql);
                        $sql = "DELETE FROM Entry WHERE entryID = $commentid";
                        $result = mysqli_query($db, $sql);
                        // parent = child
                        $commentid = $subcommentid;
                        // repeat at step 1
                        goto stepf;                        
                    }
                    donef:
                    return;
            }
            else
            {
                return;
            }   
    }

    if(isset($_POST['create_category'])){

        $category = mysqli_real_escape_string($db, $_POST['create_category_name']);

        $query = "INSERT INTO Category (categoryname) VALUES ('$category')";
        $data = mysqli_query ($db,$query)or die(mysqli_error($db));
    }

    if(isset($_POST['create_subcategory'])){

        $subcategory = mysqli_real_escape_string($db, $_POST['create_subcategory_name']);
        $catname = $_POST['parent_category'];
        //echo '<div class="alert alert-success" role="alert">'.$catname.'</div>';

        $query = "SELECT ID FROM Category WHERE categoryname='$catname'";
        $result = $db->query($query);

        $row = $result->fetch_assoc();
        $categoryID = $row["ID"];
              
        $query = "INSERT INTO Subcategory (c_id, subcategoryname) VALUES ($categoryID, '$subcategory')";
        $data = mysqli_query ($db,$query)or die(mysqli_error($db));
    }

    if(isset($_POST['change_subcategory']))
    {
        $parentname = $_POST['change_parent_name'];
        $subcategoryname = $_POST['change_subcategory_name'];
        
        $query = "SELECT * FROM Subcategory WHERE subcategoryname='$subcategoryname'";
        $result = $db->query($query);
        
        $row = $result->fetch_assoc();
        $sub_id = $row['sub_id'];
        
        $query = "SELECT * FROM Category WHERE categoryname='$parentname'";
        $result = $db->query($query);
        
        $row = $result->fetch_assoc();    
        $c_id = $row['ID'];
        
        $query = "UPDATE Subcategory SET c_id = '$c_id' WHERE sub_id = '$sub_id'";
        //$result = $db->query($query);
        $result = mysqli_query($db,$query)or die(mysqli_error($db));
        if ($result)
        {
            echo '<div class="alert alert-success" role="alert">Parent category of '.$sub_id.' is changed to '.$c_id.' successfully. </div>'; 
        }
    }

    if(isset($_POST['ban_user']))
    {
        $bannedid = $_POST['banned_id'];
        $adminid = $_SESSION["login_id"];
        
        $sql = "SELECT * FROM bannedusers WHERE banned_id = '$bannedid'";
        $result = mysqli_query($db,$sql);
        //$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $countban = mysqli_num_rows($result);
        if($countban == 1)
        {
            echo '<div class="alert alert-danger" role="alert">User with ID '.$bannedid.' is already banned.</div>';
        }
        else
        {
            $query = "INSERT INTO bannedusers VALUES ($bannedid, $adminid)";
            $data = mysqli_query ($db,$query);


            if($data)
            {
                echo '<div class="alert alert-success" role="alert">User with ID '.$bannedid.' banned successfully. </div>';
            }
            else
            {
                echo '<div class="alert alert-danger" role="alert">User with ID '.$bannedid.' could not be banned. </div>';
            }           
        }
        

    }

    if(isset($_POST['unban_user']))
    {
        $unbannedid = $_POST['unbanned_id'];
        $adminid = $_SESSION["login_id"];
        
        $sql = "SELECT * FROM bannedusers WHERE banned_id = '$unbannedid'";
        $result = mysqli_query($db,$sql);
        //$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $countban = mysqli_num_rows($result);
        if($countban == 1)
        {
            $sql = "DELETE FROM bannedusers WHERE banned_id = '$unbannedid'";
            $result = mysqli_query($db,$sql);
            //$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

            if($result)
            {
                echo '<div class="alert alert-success" role="alert">User with ID '.$unbannedid.' unbanned successfully. </div>';
            }
            else
            {
                echo '<div class="alert alert-danger" role="alert">User with ID '.$unbannedid.' could not be unbanned. </div>';
            }  
        }
        else
        {
           echo '<div class="alert alert-danger" role="alert">User with ID '.$unbannedid.' is not in banned users list.</div>';
        }
       
    }

    if(isset($_POST['update_bio']))
    {
        $userid = $_POST['user_id'];
        $name = $_POST['user_name'];
        $surname = $_POST['user_surname'];
        $bio = $_POST['user_bio'];
        
        $sql = "SELECT * FROM user WHERE userID = $userid";
        $result = mysqli_query($db, $sql);
        $countuser = mysqli_num_rows($result);
        if($countuser == 1)
        {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $sql = "UPDATE user SET name = '$name', surname = '$surname', profile_info = '$bio' WHERE userID = $userid";
            $result = mysqli_query($db, $sql);
            if($result)
            {
                echo '<div class="alert alert-success" role="alert">Profile info of user with ID '.$userid.' is updated successfully. </div>';
            }
            else
            {
                echo '<div class="alert alert-danger" role="alert">Profile info of user with ID '.$userid.' could not be updated. </div>';
            }
        }
        else
        {
            echo '<div class="alert alert-danger" role="alert">User with ID '.$userid.' could not be found. </div>';
        }
    }

    if(isset($_POST['delete_post']))
    {

        $postid = $_POST['delete_post_id'];
                
        $sql = "SELECT * FROM post WHERE postID = $postid";
        $result = mysqli_query($db, $sql);
        $countpost = mysqli_num_rows($result);
        if ( $countpost == 1 )
        {
            $sql = "DELETE FROM PostCategory WHERE p_id = $postid";
            $result = mysqli_query($db, $sql);

            $sql = "DELETE FROM owns WHERE e_id = $postid";
            $result = mysqli_query($db, $sql);

            $sql = "DELETE FROM rates WHERE e_id = $postid";
            $result = mysqli_query($db, $sql);

            $sql = "SELECT c_id FROM PostComments WHERE p_id = $postid";
            $resultf = mysqli_query($db, $sql);

            while( $rowc = mysqli_fetch_array($resultf, MYSQLI_ASSOC))
            {
                $commentid2 = $rowc["c_id"];
                deleteComment($db, $commentid2);
            }

            $sql = "DELETE FROM PostComments WHERE p_id = $postid";
            $result = mysqli_query($db, $sql);            
            
            $sql = "DELETE FROM Favorites WHERE e_id = $postid";
            $result = mysqli_query($db, $sql);
            
            $sql = "DELETE FROM Post WHERE postID = $postid";
            $result = mysqli_query($db, $sql);
            
            $sql = "DELETE FROM Entry WHERE entryID = $postid";
            $result = mysqli_query($db, $sql);
            
            echo '<div class="alert alert-success" role="alert">Post with ID '.$postid.' is deleted successfully. </div>';
            
        }
        else
        {
            echo '<div class="alert alert-danger" role="alert">Post with ID '.$postid.' does not exist. </div>';
        }
        
    }

    if(isset($_POST['delete_comment']))
    {

            $commentid = $_POST['delete_comment_id'];
            $pcommentid = $commentid;        
            $sql = "SELECT * FROM comment WHERE commentID = $commentid";
            $result = mysqli_query($db, $sql);
            $countcomment = mysqli_num_rows($result);
            if ( $countcomment == 1 )
            {
                    step1:
                    // find parent
                    $sql = "SELECT * FROM Subcomments WHERE comment_id = $commentid";
                    $result = mysqli_query($db, $sql);
                    $count = mysqli_num_rows($result);
                    if($count == 0 )
                    {
                        goto done;
                    }
                    else
                    {
                        // step 2: save its child
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $subcommentid = $row["subcomment_id"];
                        // delete parent row
                        $sql = "DELETE FROM rates WHERE e_id = $commentid";
                        $result = mysqli_query($db, $sql);
                        $sql = "DELETE FROM owns WHERE e_id = $commentid";
                        $result = mysqli_query($db, $sql);
                        $sql = "DELETE FROM Favorites WHERE e_id = $commentid";
                        $result = mysqli_query($db, $sql);
                        $sql = "DELETE FROM Subcomments WHERE comment_id = $commentid";
                        $result = mysqli_query($db, $sql);
                        $sql = "DELETE FROM PostComments WHERE c_id = $commentid";
                        $result = mysqli_query($db, $sql); 
                        $sql = "DELETE FROM Comment WHERE commentID = $commentid";
                        $result = mysqli_query($db, $sql);
                        $sql = "DELETE FROM Entry WHERE entryID = $commentid";
                        $result = mysqli_query($db, $sql);
                        // parent = child
                        $commentid = $subcommentid;
                        // repeat at step 1
                        goto step1;                        
                    }
                    done:
                    echo '<div class="alert alert-success" role="alert">Comment with ID '.$pcommentid.' is deleted successfully. </div>';
            }
                                
                
            else
            {
                echo '<div class="alert alert-danger" role="alert">Comment with ID '.$pcommentid.' does not exist. </div>';
            }        
            
        }

        if(isset($_POST['delete_category'])){


            
        }

        if(isset($_POST['edit_post_button'])){

            $editpostid = $_POST['edit_post_id'];
            $editpostcontent = $_POST['edit_post_content'];
            $editpostsubcategory = $_POST['edit_post_subcategory'];

            $sql = "UPDATE Entry SET content = '$editpostcontent' WHERE entryID = $editpostid";
            $result = mysqli_query($db, $sql);

            $sql = "SELECT * FROM Subcategory WHERE subcategoryname = '$editpostsubcategory'";
            $result = $db->query($sql);
            $row = $result->fetch_assoc(); 
            $parentcatid = $row["c_id"];
            $subcatid = $row["sub_id"];

            $sql = "UPDATE Postcategory SET c_id = $parentcatid, s_id = $subcatid WHERE p_id = $editpostid";
            $result = $db->query($sql);      

            if($result){
                echo '<div class="alert alert-success" role="alert">Post with ID '.$editpostid.' is edited successfully. </div>';
            }

            else
                echo '<div class="alert alert-danger" role="alert">Post with ID '.$editpostid.' does not exist. </div>';

        }

        if(isset($_POST['edit_comment_button'])){

            $editcommentid = $_POST['edit_comment_id'];
            $editcommentcontent = $_POST['edit_comment_content'];

            $sql = "UPDATE Entry SET content = '$editcommentcontent' WHERE entryID = $editcommentid";
            $result = mysqli_query($db, $sql);

            if($result){
                echo '<div class="alert alert-success" role="alert">Comment with ID '.$editcommentid.' is edited successfully. </div>';
            }

            else
                echo '<div class="alert alert-danger" role="alert">Comment with ID '.$editcommentid.' does not exist. </div>';
        }
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
                <h1>Admin Panel</h1></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-warning"><span>Total Posts: 
                            <?php 
                                $query= "SELECT count(postID) as postcount FROM Post";
                                $result = $db->query($query);
                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $postcount = $row["postcount"];
                                echo $postcount;
                            ?></span></li>
                            <li class="list-group-item list-group-item-warning"><span>Total Comments: 
                            <?php 
                                $query= "SELECT count(commentID) as commentcount FROM Comment";
                                $result = $db->query($query);
                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $commentcount = $row["commentcount"];
                                echo $commentcount;
                            ?></span></li>
                            <li class="list-group-item list-group-item-warning"><span>Total Categories: 
                            <?php 
                                $query= "SELECT count(ID) as categorycount FROM Category";
                                $result = $db->query($query);
                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $categorycount = $row["categorycount"];
                                echo $categorycount;
                            ?></span></li>
                            <li class="list-group-item list-group-item-warning"><span>Total SubCategories: 
                            <?php 
                                $query= "SELECT count(sub_id) as subcount FROM Subcategory";
                                $result = $db->query($query);
                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $subcount = $row["subcount"];
                                echo $subcount;
                            ?></span></li>
                            <li class="list-group-item list-group-item-warning"><span>Total Users: 
                            <?php 
                                $query= "SELECT count(userID) as usercount FROM User";
                                $result = $db->query($query);
                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $usercount = $row["usercount"];
                                echo $usercount;
                            ?></span></li>
                            <li class="list-group-item list-group-item-warning"><span>Top Rated User: 
                            <?php 
                                $query= "SELECT username FROM User user1, (SELECT o.u_id, SUM(entryrating) as userrating FROM Owns o,  (SELECT e_id, SUM(rating) as entryrating
                            FROM Rates  GROUP BY e_id) t
         WHERE o.e_id = t.e_id
         GROUP BY o.u_id) t2 
WHERE user1.userID = t2.u_id AND t2.userrating = (SELECT MAX(userrating) FROM (SELECT o.u_id, SUM(entryrating) as userrating
FROM Owns o, (SELECT e_id, SUM(rating) as entryrating
                  FROM Rates GROUP BY e_id) t
WHERE o.e_id = t.e_id
GROUP BY o.u_id) t2, User U)";
                                $result = $db->query($query);
                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $topuser = $row["username"];
                                echo $topuser;
                            ?></span></li>
                            <li class="list-group-item list-group-item-warning"><span>Most Populated Category: 
                            <?php 
                                $query= "SELECT COUNT(*), c.categoryname FROM Category c, Postcategory pc WHERE pc.c_id = c.ID GROUP BY c.categoryname ORDER BY COUNT(*) DESC LIMIT 1";
                                $result = $db->query($query);
                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $usercount = $row["categoryname"];
                                echo $usercount;
                            ?></span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Edit Post</h4>
                        <ul class="list-group">
                            <form action="" method="post">
                            <li class="list-group-item">
                                <label>Post ID</label>
                                <input type="text" name="edit_post_id">
                            </li>
                            <li class="list-group-item">
                                <label>Select Subcategory</label>
                                <select name="edit_post_subcategory" >
                                    <optgroup label="This is a group">
                                    <?php
                                        $query = "SELECT subcategoryname FROM Subcategory";
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
                                <textarea class="input-lg" name="edit_post_content">Put your post here</textarea>
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="submit" name="edit_post_button">Submit </button>
                            </li>
                            </form>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="post">
                        <h4>Delete Post</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>Post ID</label>
                                <input type="text" name="delete_post_id">
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="submit" name="delete_post">Submit </button>
                            </li>
                        </ul>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <form action="" method="post">
                        <h4>Edit Comment</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>Comment ID</label>
                                <input type="text" name="edit_comment_id">
                            </li>
                            <li class="list-group-item">
                                <textarea class="input-lg" name="edit_comment_content">Put your comment here</textarea>
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="submit" name="edit_comment_button">Submit </button>
                            </li>
                        </ul>
                    </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <form action="" method="post">
                        <h4>Delete Comment</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>Comment ID</label>
                                <input type="text" name="delete_comment_id">
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="submit" name="delete_comment">Submit </button>
                            </li>
                        </ul>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Ban User</h4>
                        <form method="post" action="">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>User ID</label>
                                <input name="banned_id" type="text">
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="submit" name="ban_user">Submit </button>
                            </li>
                        </ul>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <h4>Unban User</h4>
                        <form method="post" action="">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>User ID</label>
                                <input type="text" name="unbanned_id">
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" name="unban_user" type="submit">Submit </button>
                            </li>
                        </ul>
                        </form>
                    </div>
                </div>
                <div class="row">
                <form method="post" action="">
                    <div class="col-md-12">
                        <h4>Create Category</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>Category Name</label>
                                <input type="text" name="create_category_name">
                            </li>
                            <li class="list-group-item">
                                <button name="create_category" class="btn btn-success" type="submit">Submit </button>
                            </li>
                        </ul>
                    </div>
                </form>
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
                    <form method="post" action="">
                        <h4>Create Subcategory</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>Select Category</label>
                                <select name="parent_category">
                                    <optgroup label="This is a group">
                                        <?php
                                            $query = "SELECT categoryname FROM Category";
                                            $result = $db->query($query);
                                            while($row = $result->fetch_assoc()){
                                                $name = $row['categoryname'];
                                                echo '<option name='.$name.' value='.$name.' style="color: black">'.$name.'</option>';
                                            }
                                            $parent_category = $name;
                                        ?>
                                    </optgroup>
                                </select>
                            </li>
                            <li class="list-group-item">
                                <label>Subcategory Name</label>
                                <input type="text" name="create_subcategory_name">
                            </li>
                            <li class="list-group-item">
                                <button name="create_subcategory" class="btn btn-success" type="submit">Submit </button>
                            </li>
                        </ul>
                    </form>
                    </div>
                    <div class="col-md-12">
                    <form method="post" action="">
                        <h4>Change Subcategory Parent</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>Select Category</label>
                                <select name="change_parent_name">
                                    <optgroup label="This is a group">
                                        <?php
                                            $query = "SELECT categoryname FROM Category";
                                            $result = $db->query($query);
                                            while($row = $result->fetch_assoc()){
                                                $name = $row['categoryname'];
                                                echo '<option value='.$name.' style="color: black">'.$name.'</option>';
                                            }
                                        ?>
                                    </optgroup>
                                </select>
                            </li>
                            <li class="list-group-item">
                                <label>Select Subcategory</label>
                                <select name="change_subcategory_name">
                                    <optgroup label="This is a group">
                                        <?php
                                            $query = "SELECT subcategoryname FROM Subcategory";
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
                                <button name="change_subcategory" class="btn btn-success" type="submit">Submit </button>
                            </li>
                        </ul>
                    </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Update User Bio</h4>
                        <form action="" method="post">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>User ID</label>
                                <input type="text" name="user_id">
                            </li>
                            <li class="list-group-item">
                                <label>Name </label>
                                <input type="text" name="user_name">
                            </li>
                            <li class="list-group-item">
                                <label>Surname </label>
                                <input type="text" name="user_surname">
                            </li>
                            <li class="list-group-item">
                                <textarea class="input-lg" name="user_bio">Put user bio here</textarea>
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="submit" name="update_bio">Submit </button>
                            </li>
                        </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>