<?php
if(isset($_SESSION['id'])){
    header("location: dashboard.php");
    // echo '<script type="text/javascript">window.location="dashboard.php"; </script>';
}
?>