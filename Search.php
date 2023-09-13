<!-- <?php
session_start();

// Kiểm tra xem có tham số id trong URL hay không
if (isset($_GET['id'])) {
    $_SESSION['id'] = $_GET['id'];
} else {
    $_SESSION['id'] = null;
}

// Kết nối đến cơ sở dữ liệu
include 'connect.php';

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

$keyword = "";
$artResults = array();

if(isset($_POST['btn'])) {
    $keyword = $_POST['noidung'];

    $sql = "SELECT * FROM art WHERE (image LIKE '%$keyword%' OR category LIKE '%$keyword%')";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $artResults[] = $row;
        }
    }
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="css/Trangchu.css">
    
    <title>ShareImage</title>
</head>
<body>
    
    <header>
    <div class="container">
            <div class="start" style="height: 45px;">
                <button class="toolbar" style="position: relative;width: 45px;height: 45px; border: none; background-color: transparent;">
                    <span style="display: block; font-size: 35px;align-items: center;" class="material-symbols-outlined">menu</span>
                </button>
                <a href="Trangchu.php" class="logo">
                    <img src="images/logo.png" alt="" width="25%">
                </a>
            </div>
            <div class="center" style="padding-left: 25%; padding-right: 25%; padding-top: 15px; border-radius: 15px;">
                <form action="Search.php" method="post" style="display: flex;">
                    <input type="search" name="noidung" autocomplete="off" placeholder="Nhập nội dung tìm kiếm" style="width: 550px;border-radius: 15px; outline: none;padding-left: 15px;">
                    <button class="search-button" type="submit" name="btn" style="width: 40px;border-radius: 15px;background-color: white;">
                        <span class="material-symbols-outlined">search</span>
                    </button>
                </form>
            </div>
            <div class="end" style="height: 45px;">
                <a href="<?php echo isset($_SESSION['id']) ? 'Profile.php?id=' . $_SESSION['id'] : 'Login.php'; ?>" class="user">
                    <img src="<?php echo $user !== null ? $user['user_image'] : 'img/images.png'; ?>" alt="" class="user-img">
                </a>
            </div>
        </div>
        
    </header>
    <section class="popular container" id="popular" style="margin-top: 80px;">
        <div class="heading">
            <h2 class="heading-title">Kết quả tìm kiếm cho "<?php echo $keyword; ?>"</h2>
        </div>
        <div class="art-list">
            <?php if (!empty($artResults)) {
                foreach ($artResults as $art) { ?>
                    <div class="art-item">
                        <img src="<?php echo $art['image']; ?>" alt="Art Image">
                        <h3 class="art-title"><?php echo $art['title']; ?></h3>
                        <p class="art-category"><?php echo $art['category']; ?></p>
                    </div>
                <?php }
            } else { ?>
                <p class="no-results">Không tìm thấy kết quả phù hợp.</p>
            <?php } ?>
        </div>
    </section>
</body>
</html> -->