<?php
    include("connection.php");
    session_start();
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $myusername = mysqli_real_escape_string($db,$_POST['username']);
        $mypassword = mysqli_real_escape_string($db,$_POST['password']);
        
        $sql = "SELECT * FROM user WHERE username = '$myusername' and password = '$mypassword'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        $userid = $row["userID"];
        
        $sql = "SELECT * FROM admin WHERE adminID = '$userid'";
        $result = mysqli_query($db,$sql);
        $isadmin = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count2 = mysqli_num_rows($result);
        
        
        if($count == 1) {
            $_SESSION['myusername']= "$myusername";
            $_SESSION['login_user'] = $myusername;
            
            if($count2 == 1)
            {
                $_SESSION['admin'] = $isadmin;
                header("location: adminpanel.php");
            }
            else
            {
                header("location: posts.php");
            }         
        }
        else {
            echo '<div class="alert alert-danger" role="alert">Username or password is wrong.</div>';
      }
    }

?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M:\Bilkent\CS353\Project\Frontend\Login</title>
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
                    <li role="presentation"><a href="#">Posts </a></li>
                    <li role="presentation"><a href="#">Categories </a></li>
                    <li role="presentation"><a href="#">Users </a></li>
                    <li role="presentation"></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li role="presentation"><a href="#">Profile </a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Login </h1>
                <div class="login-card">
                    <form class="form-signin" method="post" action=""><span class="reauth-email"> </span>
                        <input class="form-control" type="text" required="" placeholder="Username" autofocus="" id="inputUsername" name="username">
                        <input class="form-control" type="password" required="" placeholder="Password" id="inputPassword" name="password">
                        <button class="btn btn-primary btn-block btn-lg btn-signin" type="submit" name="login">Log in</button>
                        <a class="btn btn-primary btn-block btn-lg btn-signin" role="button" href="signup.php">Sign Up</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>