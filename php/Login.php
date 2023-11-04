<?php 
    include '../config/connect.php';
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $dbnamelogin = "SELECT id FROM user WHERE username = '$username'";
        $result = $conn->query($dbnamelogin);

        if($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row['id'];

            $dbnamepass = "SELECT id FROM user WHERE username = '$username' AND password = '$password'";
            $passresult = $conn->query($dbnamepass);

            if($passresult && $passresult->num_rows > 0) {
                header("Location:../TrangChu.php?id=$id");
                exit();
            } else {
                $errorMessage = "Mật khẩu không chính xác.";
            }
        } else {
            $errorMessage = "Chưa có tài khoản.";
        }
    }
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../css/Login.css">
</head>
<body>
    <div class="container" style="box-shadow: 0 0 10px rgba(0,0,0,0.6);">

        <div class = "container-h2">
             <h2>Đăng nhập</h2>
        </div>

        <form method="post" action="Login.php">
            <label for="username">Tên người dùng:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required><br>

            <button type="submit">Đăng nhập</button>
        </form>
        <?php
        if (isset($errorMessage)) {
            echo "<p class='error-message'>$errorMessage</p>";
        }
        ?>
        <div class="register-link">
            Chưa có tài khoản? <a href="Signup.php">Đăng ký</a>
        </div>
    </div>
</body>
</html>
