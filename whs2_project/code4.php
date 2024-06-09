<?php
session_start();

$max_attempts = 5;
$lockout_time = 180; // 3분

// 로그인 상태 확인
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo 'You must be logged in to access this page.';
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
    echo 'Too many failed attempts. Try again after 3 min.';
    echo '<br>';
    echo 'remaining time: ' . ($lockout_time - (time() - $_SESSION['last_attempt_time'])) . ' seconds.';
    exit;
}

if(isset($_POST['code'])) {
    $code = $_POST['code'];
    
    if($code === 'whs2') {
        echo '<script>alert("success");</script>';
        $_SESSION['attempts'] = 0; // 성공 시 시도 횟수 초기화
    } else {
        $_SESSION['attempts'] += 1;
        $_SESSION['last_attempt_time'] = time();
        echo 'Incorrect code. Attempts: ' . $_SESSION['attempts'];
    }
}
?>