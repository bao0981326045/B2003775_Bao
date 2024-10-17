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

// Lấy danh sách chuyên ngành
$sql_major = "SELECT * FROM major";
$result_major = $conn->query($sql_major);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sinh viên mới</title>
</head>
<body>
    <h2>Thêm sinh viên mới</h2>
    <form action="thuchien_them.php" method="post">
        <label for="name">Tên:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="date_of_birth">Ngày sinh:</label>
        <input type="date" id="date_of_birth" name="date_of_birth" required><br><br>

        <label for="major_id">Chuyên ngành:</label>
        <select id="major_id" name="major_id" required>
            <option value="">Chọn chuyên ngành</option>
            <?php
            if ($result_major->num_rows > 0) {
                while($row_major = $result_major->fetch_assoc()) {
                    echo "<option value='" . $row_major["id"] . "'>" . $row_major["name_major"] . "</option>";
                }
            }
            ?>
        </select><br><br>

        <input type="submit" value="Thêm sinh viên">
    </form>
    <br>
    <a href="taidulieu_bang1.php">Quay lại danh sách sinh viên</a>
</body>
</html>

<?php
$conn->close();
?>