<?php 
    if (isset($_SESSION['id'])) {
        header("location: dashboard.php");
    }
    else {
        header("location: login.php");
    }
?>