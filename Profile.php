<?php
session_start();

// Include the database connection
include 'connect.php';

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
    $user_image = isset($_POST['user_image']) ? $_POST['user_image'] : '';

    // Update user information in the database
    $sql = "UPDATE user SET username = ?, email = ?, user_image = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $username, $email, $user_image, $user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Update successful, update the user variable
        $user['username'] = $username;
        $user['email'] = $email;
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
    <title>Profile</title>
</head>

<body>

    <section class="container">
        <?php if ($user === null) : ?>
            <h1>Vui lòng đăng nhập trước</h1>
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

    <script src="js/main.js"></script>
    <script src="dropdown.js"></script>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>