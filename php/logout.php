<?php
      //unset session and destroy session
      session_start();
      session_unset();
      session_destroy();
      header("Location: ../index.php");
?>