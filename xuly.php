<?php
session_start();

// Kiểm tra xem có tham số id trong URL hay không
if (isset($_GET['id'])) {
    $_SESSION['id'] = $_GET['id'];
} else {
    $_SESSION['id'] = null;
}

// Kết nối đến cơ sở dữ liệu
include 'config/connect.php';

$user = null;

// Lấy thông tin người dùng từ cơ sở dữ liệu (nếu có)
if ($_SESSION['id'] !== null) {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM user WHERE id = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    }
}

<<<<<<< HEAD

// Sử dụng lớp searchArt


=======
>>>>>>> 2745d39f7e8e9f6897c3e46268cd04c2d4cb355b
// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>