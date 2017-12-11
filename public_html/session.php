<?php
   include("connection.php");
   session_start();
   
   $user_check = $_SESSION['user'];
   
   $ses_sql = mysqli_query($dbc, "SELECT * FROM User WHERE username = '$user_check'");
   
   $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
   
   $login_session = $row['sname'];
   
   if(!isset($_SESSION['user'])){
      header("location: signup.php");
   }
?>