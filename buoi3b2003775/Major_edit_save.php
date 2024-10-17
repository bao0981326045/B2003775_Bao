<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlsv";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST["id"];
$name_major = $_POST["name_major"];

$sql = "UPDATE major SET name_major = '$name_major' WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "Cập nhật thông tin ngành học thành công";
    header('Location: major_index.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>