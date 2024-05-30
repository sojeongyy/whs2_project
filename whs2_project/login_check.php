<?php

session_start(); 

include "./config.php"; 

$username = $_POST['username']; 
$userpw = $_POST['userpw']; 

// Prepared statement 사용
$q = "SELECT * FROM admin_login WHERE username = ? AND userpw = ?";

if ($stmt = mysqli_prepare($conn, $q)) {
    // 파라미터를 바인딩
    mysqli_stmt_bind_param($stmt, "ss", $username, $userpw);
    
    // 실행
    mysqli_stmt_execute($stmt);
    
    // 결과를 저장
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }

    $row = mysqli_fetch_array($result); 

    if($row != null) { 
        $_SESSION['admin'] = $username;
        echo "<script>alert('Login successful!');location.replace('admin_page.html');</script>";
        exit(); 
    } else {
        echo "<script>alert('Invalid username or password!');window.location.href='login_fail.php';</script>";
        exit();
    }

    // Prepared statement 닫기
    mysqli_stmt_close($stmt);
} else {
    die('Query preparation failed: ' . mysqli_error($conn));
}

// 데이터베이스 연결 닫기
mysqli_close($conn);

?>