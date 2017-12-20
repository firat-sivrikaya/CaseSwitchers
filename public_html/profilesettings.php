<?php
    include("session.php");
    $uploaddir = getcwd().'/assets/img/';
    if(isset($_POST['savechanges']))
    {
        $currentpass = $_POST["currentpass"];
        $query = "SELECT * FROM User WHERE userID = $login_id";
        $result = $db->query($query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $userpass = $row["password"];
        $oldfirstname = $row["name"];
        $oldsurname = $row["surname"];
        $oldbio = $row["profile_info"];
        if ( $currentpass == $userpass )
        {
            $firstname = $_POST["firstname"];
            $surname = $_POST["surname"];
            $password = $_POST["pass"];
            $retypepassword = $_POST["retypepass"];
            $userbio = $_POST["userbio"];
            
            
            
            if ( $firstname != $oldfirstname )
            {
                $query = "UPDATE User SET name = '$firstname' WHERE userID = $login_id";
                $result = mysqli_query($db, $query);
                if($result)
                {
                    echo '<div class="alert alert-success" role="alert">First name updated successfully. </div>';
                }
                else
                {
                    echo '<div class="alert alert-danger" role="alert">Updating first name failed.</div>';
                }
            }
            if( $surname != $oldsurname )
            {
                $query = "UPDATE User SET surname = '$surname' WHERE userID = $login_id";
                $result = mysqli_query($db, $query);
                if($result)
                {
                    echo '<div class="alert alert-success" role="alert">Surname updated successfully. </div>';
                }
                else
                {
                    echo '<div class="alert alert-danger" role="alert">Updating surname failed.</div>';
                }                
            }
            if( $userbio != $oldbio )
            {
                $query = "UPDATE User SET profile_info = '$userbio' WHERE userID = $login_id";
                $result = mysqli_query($db, $query);
                if($result)
                {
                    echo '<div class="alert alert-success" role="alert">User bio updated successfully. </div>';
                }
                else
                {
                    echo '<div class="alert alert-danger" role="alert">Updating user bio failed.</div>';
                }
            }
            if( strlen($password) != 0 && strlen($retypepassword) != 0 )
            {
                if ( $password == $retypepassword )
                {
                    $query = "UPDATE User SET password = '$password' WHERE userID = $login_id";
                    $result = mysqli_query($db, $query);
                    if($result)
                    {
                        echo '<div class="alert alert-success" role="alert">Password updated successfully. </div>';
                    }
                    else
                    {
                        echo '<div class="alert alert-danger" role="alert">Updating password failed.</div>';
                    }                    
                }
                else
                {
                    echo '<div class="alert alert-danger" role="alert">Passwords do not match. Make sure you retype your new password correctly. </div>';
                }
            }
        }
        else
        {
            echo '<div class="alert alert-danger" role="alert">Current password entered does not match with the records. </div>';
        }
    }
    if(isset($_POST["uploadphoto"]))
    {
        $name       = $_FILES['userphoto']['name']; 
        $ext = pathinfo($_FILES['userphoto']['name'], PATHINFO_EXTENSION);
        $uploadfile = $uploaddir . $login_id . '.' . $ext;
        $filename = $login_id . '.' . $ext;
        $query = "UPDATE User SET avatarloc = '$filename' WHERE userID = $login_id";
        $result = mysqli_query($db, $query);
        
        if (move_uploaded_file($_FILES['userphoto']['tmp_name'], $uploadfile)) {
            echo '<div class="alert alert-success" role="alert">Profile photo uploaded successfully. </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error on uploading profile photo. </div>';
        }
    }
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M:\Bilkent\CS353\Project\Frontend\ProfileSettings</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <script>
        window.onload = function() {
        var files = document.querySelectorAll("input[type=file]");
        files[0].addEventListener("change", function(e) {
            if(this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) { document.getElementById("preview").setAttribute("src", e.target.result); }
                reader.readAsDataURL(this.files[0]);
            }
        });
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
                <h1>Profile Settings</h1></div>
        </div>
    </div>
    <div class="container">
        <div class="row hidden-sm">
            
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3"><img id="preview" class="img-circle img-responsive" src="assets/img/<?php 
                            $query = "SELECT avatarloc FROM user WHERE userID = $login_id";
                            $result = $db->query($query);
                            $row = mysqli_fetch_array($result);
                            echo $row["avatarloc"];
                        ?>" width="200" height="200"></div>
                </div>
                <div class="row">
                    <div class="col-sm-5 col-sm-offset-3">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input class="btn btn-primary btn-sm" type="file" name="userphoto" id="userphoto" accept="image/*">
                            <button class="btn btn-success btn-sm" type="submit" name="uploadphoto">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
            <form method="post" action="">
                <div class="form-group">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label">Name </label>
                                    <input class="form-control" type="text" name="firstname" value="<?php 
                                        $query = "SELECT name FROM User WHERE userID = $login_id";
                                        $result = $db->query($query);
                                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                        echo $row["name"];
                                    ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label">Surname </label>
                                    <input class="form-control" type="text" name="surname" value="<?php 
                                        $query = "SELECT surname FROM User WHERE userID = $login_id";
                                        $result = $db->query($query);
                                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                        echo $row["surname"];
                                    ?>">
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <label class="control-label">New Password</label>
                            <input class="form-control" type="password" name="pass">
                        </li>
                        <li class="list-group-item">
                            <label class="control-label">Retype New Password</label>
                            <input class="form-control" type="password" name="retypepass">
                        </li>
                        <li class="list-group-item">
                            <label class="control-label">Current Password</label>
                            <input class="form-control" type="password" required="" name="currentpass">
                        </li>
                        <li class="list-group-item">
                            <label class="control-label">Bio </label>
                            <textarea class="form-control" name="userbio"><?php 
                                        $query = "SELECT profile_info FROM User WHERE userID = $login_id";
                                        $result = $db->query($query);
                                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                        echo $row["profile_info"];
                                    ?></textarea>
                        </li>
                        <li class="list-group-item">
                            <button class="btn btn-primary" type="submit" name="savechanges">Save Changes</button>
                        </li>
                    </ul>
                </div>
            </form>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>