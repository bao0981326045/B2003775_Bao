<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbanhang";
//$id = $_SESSION['id'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {    
    die("Connection failed: " . $conn->connect_error);
    }




$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Kiểm tra mật khẩu cũ
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if (md5($old_password) === $user['password']) {
        if ($new_password === $confirm_password) {
            if ($old_password !== $new_password) {
                // Cập nhật mật khẩu mới
                $hashed_password = md5($new_password);
                $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
                $update_stmt->bind_param("si", $hashed_password, $user_id);
                
                if ($update_stmt->execute()) {
                    $success = "Mật khẩu đã được cập nhật thành công!";
                } else {
                    $error = "Có lỗi xảy ra khi cập nhật mật khẩu.";
                }
                $update_stmt->close();
            } else {
                $error = "Mật khẩu mới không được giống mật khẩu cũ.";
            }
        } else {
            $error = "Mật khẩu mới và xác nhận mật khẩu không khớp.";
        }
    } else {
        $error = "Mật khẩu cũ không chính xác.";
    }
    $stmt->close();
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Đổi mật khẩu</title>
</head>
<body>
    <h2>Đổi mật khẩu</h2>
    <?php
    if ($error) echo "<p style='color: red;'>$error</p>";
    if ($success) echo "<p style='color: green;'>$success</p>";
    ?>
    <form action="sua_mk.php" method="post">
        Mật khẩu cũ: <input type="password" name="old_password" required><br>
        Mật khẩu mới: <input type="password" name="new_password" required><br>
        Nhập lại mật khẩu mới: <input type="password" name="confirm_password" required><br>
        <input type="submit" value="Đổi mật khẩu">
    </form>
</body>
</html>