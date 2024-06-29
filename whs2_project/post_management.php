<?php
include 'post_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $post_id = $_POST['post_id'];
    $sql = "DELETE FROM board WHERE idx=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $stmt->close();
}

$sql = "SELECT idx, subject, name FROM board";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Post Management</title>
    <style>
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid white;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #333;
        }
        input[type="submit"] {
            background-color: #444;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #666;
        }
        h1 {
            text-align: center;
        }
    </style>
    <script>
        function confirmDelete() {
            return confirm('게시물을 삭제하시겠습니까?');
        }
    </script>
</head>
<body>
    <h1>Post Management</h1>
    <table>
        <tr>
            <th>Writer</th>
            <th>Title</th>
            <th>Delete</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['subject'] . "</td>";
                echo "<td>";
                echo "<form method='POST' action='' onsubmit='return confirmDelete()'>";
                echo "<input type='hidden' name='post_id' value='" . $row['idx'] . "'>";
                echo "<input type='submit' name='delete' value='delete'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>There is no post.</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
