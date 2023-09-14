<?php
    include '../config/connect.php';

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    if (preg_match('/[^\w\s]/', $username) || preg_match('/\s/', $username)) {
        $errorMessage = "Tên người dùng không được có ký tự đặc biệt hoặc khoảng trắng!";
    } else {
        $checkUserQuery = "SELECT id FROM user WHERE username = '$username'";
        $checkUserResult = $conn->query($checkUserQuery);
    
        if($checkUserResult && $checkUserResult->num_rows > 0) {
            $errorMessage = "Tên người dùng đã tồn tại.";
        } else {
            $insertUserQuery = "INSERT INTO user (username, password, email) VALUES ('$username', '$password', '$email')";
            $insertUserResult = $conn->query($insertUserQuery);
    
            if($insertUserResult) {
                $successMessage = "Đăng ký thành công. Vui lòng đăng nhập.";
            } else {
                $errorMessage = "Đã xảy ra lỗi trong quá trình đăng ký.";
            }
        }

    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Đăng ký</title>
    <link rel="stylesheet" href="../css/Signup.css">
</head>
<body>
    <div class="container" style="box-shadow: 0 0 10px rgba(0,0,0,0.6);">
        <div class="container-h2">
            <h2>Đăng ký</h2>
        </div>

        <form method="post" action="Signup.php">
            <label for="username">Tên người dùng:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <button type="submit">Đăng ký</button>
        </form>

        <?php
        if (isset($errorMessage)) {
            echo "<p class='error-message'>$errorMessage</p>";
        }

        if (isset($successMessage)) {
            echo "<p class='success-message'>$successMessage</p>";
        }
        ?>

        <div class="register-link">
            Đã có tài khoản? <a href="Login.php">Đăng nhập</a>
        </div>
    </div>
</body>
</html>