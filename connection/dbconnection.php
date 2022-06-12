<?php
//error_reporting(0);
	ob_start();
	session_start();
	
// DEFINE("BASE_URL","http://cipetbhopal.com/");
date_default_timezone_set('Asia/Manila'); 
$conn = mysqli_connect('localhost','root','', 'wfh_monitoring')or die(mysqli_error());
?>