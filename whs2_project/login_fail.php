<!DOCTYPE html>
<html>
<head>
    <title>File Not Found</title>
    <style>
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 100px;
        }
    </style>
</head>
<body>
    <h1>File Not Found</h1>
    <p>Page parameter is empty!</p>
</body>
</html>

<?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $allowed_files = ['config.php', 'login_check.php', 'admin_login.html']; // 허용된 파일 목록
        if(in_array($page, $allowed_files)) {
            $file_content = htmlspecialchars(file_get_contents($page));
            echo "<div style='text-align: left;'><pre>{$file_content}</pre></div>";
        } else {
            header("Location: file_not_found.php"); 
            exit();
        }
    } 
?>