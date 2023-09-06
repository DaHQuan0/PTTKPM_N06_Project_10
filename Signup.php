<!DOCTYPE html>
<html>
    <head>
        <title>Đăng ký</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/Signup.css"/>
    </head>
<body>

<div class="container">
    <form method="post" action="Login.php" class="form">

        <h2>Đăng ký</h2>

        <label for="username">Tên người dùng:</label> 
        <input type="text" name="username" value="" required>

        <label for="password">Mật khẩu:</label>
        <input type="text" name="password" value="" required/>

        <label for="email">Gmail:</label> 
        <input type="email" name="email" value="" required/>


        <input type="submit" name="dangky" value="Đăng Ký"/>
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