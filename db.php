<?php
$hostname = '127.0.0.1';
$servername = 'root';
$password = '';
$dbname = 'register';

$conn = mysqli_connect($hostname, $servername, $password, $dbname);

if (!$conn) {
    die("connection failed: " . mysqli_connect_error());
}
