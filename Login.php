<?php
session_start();
if (isset($_SESSION['username'])){
    unset($_SESSION['username']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <?php
    if (isset($_POST['dangnhap'])) {
        include('connect.php');

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username) || empty($password)) {
        echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }

    $password = md5($password);

    $query = "SELECT username, password FROM user WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if (!$result || mysqli_num_rows($result) == 0) {
        echo "Tên đăng nhập hoặc mật khẩu không đúng!";
    } else {
        $row = mysqli_fetch_assoc($result);

    if ($password != $row['password']) {
        echo "Mật khẩu không đúng. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }

    $_SESSION['username'] = $username;
    echo "Xin chào <b>".$username."</b>. Bạn đã đăng nhập thành công. <a href=''>Thoát</a>";
    exit;
    }

    $conn->close();
  }
  ?>
  
    <form action="Trangchu.php" class="dangnhap" method="POST">
        Tên đăng nhập: <input type="text" name="username" />
        Mật khẩu: <input type="password" name="password" />
        <input type="submit" class="button" name="dangnhap" value="Đăng nhập" />
        <a href="Signup.php" title="Đăng ký">Đăng ký</a>
    </form>
</body>
</html>