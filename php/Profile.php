<?php
session_start();

// Include the database connection
include '../config/connect.php';

// Check if user_id exists in the session
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
} else {
    // Redirect to the login page
    header("Location: Login.php");
    exit();
}

// Fetch user information from the database
$sql = "SELECT * FROM user WHERE id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    // Redirect to the login page
    header("Location: Login.php");
    exit();
}

// Process the update request
if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST["password"];
    $user_image = isset($_POST['user_image']) ? $_POST['user_image'] : '';

    // Update user information in the database
    $sql = "UPDATE user SET username = ?, email = ?, password = ?, user_image = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $username, $email, $password, $user_image, $user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Update successful, update the user variable
        $user['username'] = $username;
        $user['email'] = $email;
        $user['password'] = $password;
        $user['user_image'] = $user_image;
    }
    $stmt->close();
}

// Process the logout request
if (isset($_POST['logout'])) {
    // Clear all session variables
    session_unset();
    // Destroy the session
    session_destroy();
    // Redirect to the login page
    header("Location: Login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="../css/Profile.css">
    <title>Profile</title>
</head>

<body>
<?php if($_SESSION['id'] == null){
    $href = "";
}else{
    $href = "?id=";
}

    include '../page/header.php';
    ?>
<div class="webContent">
        <div id="menu" class="leftMenu translate">
            <div class="btn home">

                <?php echo '<a href="../TrangChu.php?id='.$_SESSION['id'].'">';?>
                    <span class="material-symbols-outlined">house</span>
                    <span class="title">Trang chủ</span>
                </a>
            </div>
            <div class="btn album">
                <a href="">
                    <span class="material-symbols-outlined">photo_album</span>
                    <span class="title">Album</span>
                </a>
            </div>
            <div class="btn favourite">
                
                <?php if($href == ""){
                    echo '<a href="Login.php">';
                }else{
                    echo '<a href="../TrangChu.php?id='.$_SESSION['id'].'&favourite">';
                } ?>
                    <span class="material-symbols-outlined">favorite</span>
                    <span class="title">Ảnh yêu thích</span>
                </a>
            </div>
            
            <hr style="margin-top:30px">
            <div class="footer_leftMenu">
            <h3 style="margin-top:15px; font-weight:bold;">Người Thực Hiện</h3>
            <div style="display:flex; color:red;padding: 10px 15px; line-height:1.5;" >
                    <div>
                        <p>Vũ Ngọc Văn</p>
                        <p>Đào Anh Quân</p>
                        <p>Dương Tuấn Phong</p>
                        <p>Ngô Trần Đức Long</p>
                    </div>
                </div>
            </div>
            
            
        </div>
        
        

        <div id="main" class="mainContainer" style="width: 100%;display: block;">
            <div id="bgr-main" style="position: fixed; background-color: grey;width:100%;height:100%;display:none;z-index: 99;"></div>
            

    <section class="container2">
        <?php if ($user === null) : ?>
        <?php else : ?>
            <h1>Thông tin cá nhân</h1>
            <div class="user-info">
                <img src="<?php echo isset($user['user_image']) ? $user['user_image'] : 'img/images.png'; ?>" alt="Avatar">
                <div class="info">
                </div>
            </div>

            <h2>Cập nhật thông tin</h2>
            <form method="POST" action="">
                <div>
                    <label for="username">Tên tài khoản:</label>
                    <input type="text" name="username" id="username" class="infor-input" value="<?php echo htmlspecialchars($user['username']); ?>">
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="infor-input" style="width:100%; padding: 10px; border: 1px solid #ccc; boder-radius: 4px;" value="<?php echo htmlspecialchars($user['password']); ?>">
                </div>
                <div>
                    <label for="user_image">Đường dẫn ảnh đại diện:</label>
                    <input type="text" name="user_image" id="user_image" class="infor-input" value="<?php echo htmlspecialchars($user['user_image']); ?>">
                </div>
                <div class="button-row">
                    <button type="submit" name="update" class="update-button">Cập nhật</button>
                    <button type="submit" name="logout" class="logout-button">Đăng xuất</button>
                </div>
            </form>
        <?php endif; ?>
    </section>

</body>

</html>

<?php
$conn->close();
?>