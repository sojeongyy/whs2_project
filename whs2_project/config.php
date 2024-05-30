<?php
$servername = "localhost"; 
$username = "root"; 
$password = "0325"; 
$dbname = "admin_db";

// 데이터베이스 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, 'utf8');

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); 
}

?>