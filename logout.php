<?php
   session_start();
   
   if(session_destroy()) {
      session_start();
      $_SESSION['logout'] = " ";
      header("Location: index.php");
   }
?>