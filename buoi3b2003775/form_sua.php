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

// Lấy thông tin sinh viên cần sửa
$id = $_GET['id'];
$sql = "SELECT * FROM students WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Lấy danh sách chuyên ngành
$sql_major = "SELECT * FROM major";
$result_major = $conn->query($sql_major);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin sinh viên</title>
</head>
<body>
    <h2>Sửa thông tin sinh viên</h2>
    <form action="thuchien_sua.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label for="name">Tên:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>

        <label for="date_of_birth">Ngày sinh:</label>
        <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo $row['date_of_birth']; ?>" required><br><br>

        <label for="major_id">Chuyên ngành:</label>
        <select id="major_id" name="major_id" required>
            <option value="">Chọn chuyên ngành</option>
            <?php
            if ($result_major->num_rows > 0) {
                while($row_major = $result_major->fetch_assoc()) {
                    $selected = ($row_major["id"] == $row["major_id"]) ? "selected" : "";
                    echo "<option value='" . $row_major["id"] . "' $selected>" . $row_major["name_major"] . "</option>";
                }
            }
            ?>
        </select><br><br>

        <input type="submit" value="Cập nhật sinh viên">
    </form>
    <br>
    <a href="taidulieu_bang1.php">Quay lại danh sách sinh viên</a>
</body>
</html>

<?php
$conn->close();
?>