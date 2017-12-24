<?php
    include("connection.php");
    session_start();

    $user_check = $_SESSION['login_user'];
    unset($_SESSION['logout']);
    
   $ses_sql = mysqli_query($db, "SELECT * FROM user WHERE username = '$user_check'");
   
   $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   $login_id = $row['userID'];
    $firstname = $row['name'];
    $lastname = $row['surname'];
    $datejoined = $row['date_of_registration'];
   $_SESSION["login_id"] = $login_id;
   
   if(!isset($_SESSION['login_user'])){
      header("location: index.php");
   }
?>