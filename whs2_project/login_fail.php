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
    <h1>파일을 찾을 수 없습니다</h1>
    <p>페이지 파라미터가 비어 있습니다!</p>
</body>
</html>

<?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $disallowed_files = ['code4.php']; // 접근을 차단할 파일 목록

        if (in_array($page, $disallowed_files)) {
            header("Location: file_not_found.php"); 
            exit();
        } else {
            // 파일 확장자가 .php인 경우에만 php://filter/convert.base64-encode/resource= 자동 추가
            if (pathinfo($page, PATHINFO_EXTENSION) == 'php') {
                $page = 'php://filter/convert.base64-encode/resource=' . $page;
            }
            include $page;
        }
    } 
?>