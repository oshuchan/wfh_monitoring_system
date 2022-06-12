<?php 
// $sql = "update user set  status = '0' WHERE id = '".$_SESSION['rainbow_uid']."'";

// $r = $conn->query($sql);

unset($_SESSION['id']);
unset($_SESSION['username']);
unset($_SESSION['email']);
unset($_SESSION['firstname']);
unset($_SESSION['lastname']);
unset($_SESSION['department_name']);
unset($_SESSION['designation_name']);
echo '<script type="text/javascript">window.location="login.php"; </script>';

?>