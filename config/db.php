<?php
//allows us to use headers
ob_start();

//set sessions
if(!isset($_SESSION)) {
	session_start();
}

$hostname = "####"
$username = "####";
$password = "####";
$dbname = "####";

$conn = mysqli_connect($hostname, $username, $password, $dbname) or die("Database flop");

?>