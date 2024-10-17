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

$sql = "DELETE FROM major WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "Xóa ngành học thành công";
    header('Location: major_index.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>