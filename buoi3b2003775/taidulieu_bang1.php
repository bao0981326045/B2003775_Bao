<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlsv";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Câu lệnh SQL được cập nhật để kết nối với bảng major
$sql = "SELECT students.id, students.name, students.email, students.date_of_birth, major.id AS major_id, major.name_major 
        FROM students 
        LEFT JOIN major ON students.major_id = major.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
</head>
<body>
    <h2>Danh sách sinh viên</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Ngày sinh</th>
            <th>Mã chuyên ngành</th>
            <th>Tên chuyên ngành</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["date_of_birth"] . "</td>";
                echo "<td>" . $row["major_id"] . "</td>";
                echo "<td>" . $row["name_major"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Không có dữ liệu</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>