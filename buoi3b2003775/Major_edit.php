<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlsv";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM major WHERE id = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin ngành học</title>
</head>
<body>
    <h1>cập nhật chuyên ngành</h1>
    <form action="major_edit_save.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        
        <label for="name_major">Tên ngành:</label>
        <input type="text" id="name_major" name="name_major" value="<?php echo $row['name_major']; ?>" required><br><br>
        
        <input type="submit" value="Cập nhật">
    </form>
    <br>
</body>
</html>

<?php
$conn->close();
?>