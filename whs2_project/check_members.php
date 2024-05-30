<!DOCTYPE html>
<html>
<head>
    <title>admin_members</title>
    <style>
        body {
            background-color: black;
        }
        table {
            border-collapse: collapse;
            width: 30%; /* 테이블 너비를 70%로 설정 */
            margin: auto; /* 테이블을 중앙에 배치 */
        }
        th, td {
            border: 1px solid white;
            padding: 8px;
            text-align: center;
            color: white;
        }
    </style>
    <script>
        function confirmDelete() {
            return confirm('이 회원을 삭제하시겠습니까?');
        }
    </script>
</head>
<body>
    <h1 style="color: white; text-align: center;">Usernames</h1>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Assuming you are using PHP and MySQL
                $conn = mysqli_connect("localhost", "root", "0325", "members");
                if ($conn) {
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_username'])) {
                        $delete_username = $_POST['delete_username'];
                        $delete_query = "DELETE FROM member_table WHERE username = ?";
                        $stmt = mysqli_prepare($conn, $delete_query);
                        mysqli_stmt_bind_param($stmt, "s", $delete_username);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                    }

                    $query = "SELECT username FROM member_table";
                    $result = mysqli_query($conn, $query);

                    // Fetch and display each row of data
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['username']) . "</td>
                                <td>
                                    <form method='POST' onsubmit='return confirmDelete();'>
                                        <input type='hidden' name='delete_username' value='" . htmlspecialchars($row['username']) . "' />
                                        <button type='submit' style='color: black;'>Delete</button>
                                    </form>
                                </td>
                              </tr>";
                    }

                    mysqli_close($conn);
                } else {
                    echo "<tr><td colspan='2'>Failed to connect to the database.</td></tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>
