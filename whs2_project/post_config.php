<?php
$servername = "52.78.159.201";
$username = "admin";
$password = "admin";
$dbname = "WHITESPIDER";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
