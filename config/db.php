<?php
//allows us to use headers
ob_start();

//set sessions
if(!isset($_SESSION)) {
	session_start();
}

if (!function_exists('pdo_connect_mysql')) {
function pdo_connect_mysql() {
	$hostname = "####";
	$username = "####";
	$password = "####";
	$dbname = "####";
    try {
    	return new PDO('mysql:host=' . $hostname . ';dbname=' . $dbname . ';charset=utf8', $username , $password);
    } catch (PDOException $exception) {
    	exit('Database flop!');
    }
}
}