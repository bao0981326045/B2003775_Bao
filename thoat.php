<?php
session_start();
// Xóa các giá tr  trong session
unset($_SESSION['user']);
unset($_SESSION['fullname']);
unset($_SESSION['id']);
// Xóa session
session_destroy();
// chuyen huong ve trang dang nhap
header('Location: login.php');
?>