<?php
session_start();

$max_attempts = 5;
$lockout_time = 15;
$redirect_ip = 'http://123.456.789.101'; // 특정 IP 주소

// 로그인 상태 확인
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo '<div class="error-message">You must be logged in to access this page.</div>';
    exit;
}

if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0;
    $_SESSION['last_attempt_time'] = time();
}
if (!isset($_SESSION['last_attempt_time'])) {
    $_SESSION['last_attempt_time'] = time();
}

if (time() - $_SESSION['last_attempt_time'] > $lockout_time) {
    $_SESSION['attempts'] = 0;
    $_SESSION['last_attempt_time'] = time();
}

if ($_SESSION['attempts'] >= $max_attempts) {
    echo '<div class="error-message">Too many failed attempts. Try again after 15s.<br>Remaining time: ' . ($lockout_time - (time() - $_SESSION['last_attempt_time'])) . ' seconds.</div>';
    exit;
}

if(isset($_POST['code'])) {
    $code = $_POST['code'];
    
    if($code === '5649') {
        echo '<script>alert("success");</script>';
        $_SESSION['attempts'] = 0; // 성공 시 시도 횟수 초기화
        //header("Location: $redirect_ip");
        //exit; // 헤더 후 종료
    } else {
        $_SESSION['attempts'] += 1;
        $_SESSION['last_attempt_time'] = time();
        echo '<div class="error-message">Incorrect code. Attempts: ' . $_SESSION['attempts'] . '</div>';
    }
}
?>

<style>
    body {
        background-color: black;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        font-family: Arial, sans-serif;
    }
    .error-message {
        background-color: black;
        color: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        border: 1px solid white;
    }
</style>
