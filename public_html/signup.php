 <?php

include("connection.php");
session_start();


if(isset($_POST['register']))
{
  if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['repassword'])) 
  {
    if(($_POST['password']) != ($_POST['repassword'])){
      echo '<div class="alert alert-success" role="alert">Password fields do not match.</div>';
    }

    else{
      $query = mysqli_query($db,"SELECT * FROM user WHERE username = '$_POST[username]'") or die(mysqli_error());

      if(!$row = mysqli_fetch_array($query, MYSQLI_ASSOC) or die(mysqli_error())){
          $userName = $_POST['username'];
          $email = $_POST['email'];
          $password =  $_POST['password'];
          $passwordRepeat = $_POST['repassword'];
          $query = "INSERT INTO User (username,password,email) VALUES ('$userName', '$password', '$email')";
          $data = mysqli_query ($db,$query)or die(mysqli_error());
          if($data)
          {
            echo '<div class="alert alert-success" role="alert">You registered successfully. Please log in with your details.</div>';
            $_SESSION['user'] = $userName;
          }
      }

      else{
        echo '<div class="alert alert-success" role="alert">Username is already taken.</div>';
      }   

    }

  }
}
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M:\Bilkent\CS353\Project\Frontend\SignUp</title>
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
                    <li role="presentation"><a href="#">Home </a></li>
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
                <h1 class="text-center">Sign Up</h1>
                <form class="bootstrap-form-with-validation" method="post" action="">
                    <div class="form-group has-success has-feedback">
                        <label class="control-label" for="text-input">Username </label>
                        <input class="form-control" type="text" name="username" id="text-input"><span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span></div>
                    <div class="form-group has-success has-feedback">
                        <label class="control-label" for="text-input">Email </label>
                        <input class="form-control" type="text" name="email" id="text-input"><span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span></div>
                    <div class="form-group has-warning has-feedback">
                        <label class="control-label" for="password-input">Enter Password</label>
                        <input class="form-control" type="password" name="password" id="password-input">
                        <label class="control-label" for="password-input">Re-enter Password</label>
                        <input class="form-control" type="password" name="repassword" id="password-input"><span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span></div>
                    <div class="form-group has-warning">
                        <p class="form-static-control">You can set your other profile details after registration.</p>
                    </div>
                    <div class="form-group has-warning">
                        <button name="register" class="btn btn-primary" type="submit">Register </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>