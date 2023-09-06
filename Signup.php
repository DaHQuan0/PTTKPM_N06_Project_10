<!DOCTYPE html>
<html lang="en">
<head>
    <title>Đăng ký</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="css/Signup.css"/>
</head>
<body>

    <div class="container">
        <h2>Đăng ký</h2>
        <?php
        if (!empty($errorMessage)) {
            echo "<p class='error-message'>$errorMessage</p>";
        }
        if (!empty($successMessage)) {
            echo "<p class='success-message'>$successMessage</p>";
        }
        ?>
        <form method="post" action="Signup.php">
            <label for="username">Tên người dùng:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="email">Gmail:</label>
            <input type="email" id="email" name="email" placeholder="Nhập địa chỉ email của bạn" required><br>

            <button type="submit">Đăng ký</button>
        </form>
    </div>

</body>
</html>

<?php
header('Content-Type: text/html; charset=utf-8');
// Kết nối cơ sở dữ liệu
include('connect.php');

$errors = array(); // Initialize an empty array to store validation errors

// Dùng isset để kiểm tra Form
if(isset($_POST['dangky'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);

    if (empty($username)) {
      array_push($errors, "Username is required"); 
    }
    if (empty($email)) {
      array_push($errors, "Email is required"); 
    }
    if (empty($password)) {
      array_push($errors, "Password is required"); 
    }

    // Kiểm tra username hoặc email có bị trùng hay không
    $dbname = "SELECT * FROM user WHERE username = '$username' OR email = '$email'";

    // Thực thi câu truy vấn
    $result = mysqli_query($conn, $dbname);

    // Nếu kết quả trả về lớn hơn 0 thì nghĩa là username hoặc email đã tồn tại trong CSDL
    if (mysqli_num_rows($result) > 0) {
        echo '<script language="javascript">alert("Bị trùng tên hoặc chưa nhập tên!"); window.location="Login.php";</script>';

        // Dừng chương trình
        die();
    } else {
        $dbname = "INSERT INTO user (username, password, email) VALUES ('$username','$password','$email')";

        if (mysqli_query($conn, $dbname)) {
            echo '<script language="javascript">alert("Đăng ký thành công!"); window.location="Login.php";</script>';
            
            echo "Tên đăng nhập: ".$_POST['username']."<br/>";
            echo "Mật khẩu: ".$_POST['password']."<br/>";
            echo "Email đăng nhập: ".$_POST['email']."<br/>";
        } else {
            echo '<script language="javascript">alert("Có lỗi trong quá trình xử lý"); window.location="Login.php";</script>';
        }
    }
}
?>