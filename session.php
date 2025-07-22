<?php
    session_start();

  

    if (!isset($_SESSION['staffno'])) {
        header("Location: login.php");
        exit;
    }

      $staffno = $_SESSION['staffno'];

      $user_name = $_SESSION['username'];
    

?>
