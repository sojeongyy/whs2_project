<!DOCTYPE html>
<html>
<head>
    <title>파일을 찾을 수 없습니다</title>
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
    <h1>Cannot Find File</h1>
    <p>"page" parameter is empty!</p>
</body>
</html>

<?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $disallowed_files = ['code4.php']; // 접근을 차단할 파일 목록

        if (in_array($page, $disallowed_files)) {
            echo "<script>alert('ERROR: Cannot open this file');</script>";
        } else {
            
            include $page;
        }
    } 
?>