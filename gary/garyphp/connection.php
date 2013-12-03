<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'gary';
$conn = new mysqli($host, $username, $password, $dbname);

if(mysqli_connect_errno()){
	exit('Connect failed: ' . mysqli_connect_error();
}

?>

