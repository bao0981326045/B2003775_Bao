<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlsv";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM major";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách chuyên ngành</title>
</head>
<body>
    <h1>Danh sách chuyên ngành</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tên ngành</th>
            <th>Chức năng</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name_major"] . "</td>";
                echo "<td>
                    <a href='major_edit.php?id=" . $row["id"] . "'>Sửa</a> | 
                    <a href='major_xoa.php?id=" . $row["id"] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa?\")'>Xóa</a>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Không có dữ liệu</td></tr>";
        }
        ?>
    </table>
    <a href="major_add.php">Thêm chuyên ngành</a>
</body>
</html>

<?php
$conn->close();
?>