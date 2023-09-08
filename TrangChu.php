<?php
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

    <div class="webContent">
        <div class="leftMenu">
            <div class="btn home">
                <a href="">
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
                <a href="">
                    <span class="material-symbols-outlined">favorite</span>
                    <span class="title">Ảnh yêu thích</span>
                </a>
            </div>
            <div class="btn home">
                <a href="">
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
                <a href="">
                    <span class="material-symbols-outlined">favorite</span>
                    <span class="title">Ảnh yêu thích</span>
                </a>
            </div>
            <div class="btn home">
                <a href="">
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
                <a href="">
                    <span class="material-symbols-outlined">favorite</span>
                    <span class="title">Ảnh yêu thích</span>
                </a>
            </div>
            <div class="btn home">
                <a href="">
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
                <a href="">
                    <span class="material-symbols-outlined">favorite</span>
                    <span class="title">Ảnh yêu thích</span>
                </a>
            </div>
            
            
        </div>
        
        <div class="webContent__header">
            <ul class="list__btn">
                <a href=""><li>Tất cả</li></a>
                <a href=""><li>Phong cảnh</li></a>
                <a href=""><li>Chân dung</li></a>
                <a href=""><li>Thể thao</li></a>
                <a href=""><li>Sự kiện</li></a>
                <a href=""><li>Thiên nhiên</li></a>
                <a href=""><li>Đường phố</li></a>
                <a href=""><li>Trừu tượng</li></a>
                <a href=""><li>Sáng tạo </li></a>
                <a href=""><li>Hoạt hình</li></a>
            </ul>
        </div>

        <div class="mainContainer" style="width: 100%;display: block;">
            <div class="content" >

                <a class="mainContainer__img " href="">
                    <div class="img--border"><img class="image" src="./images/Minion-Crazy-icon.jpg" alt="Ảnh">                    </div>
                    
                    <button class="favourite__btn">
                        <span class="material-symbols-outlined">favorite</span>
                        <span class="heart"></span>
                    </button>

                </a>
                
                <a class="mainContainer__img2" href=""><div class="img--border"><img class="image" src="./images/images (1).jfif" alt="Ảnh"></div>
                
                    <button class="favourite__btn">
                        <span class="material-symbols-outlined">
                                
                            favorite
                        </span>
                        <span class="heart"></span>
                    </button>
                </a>
                
                <a class="mainContainer__img3" href=""><div class="img--border"><img class="image" src="./images/image2 .jfif" alt="Ảnh"></div>
                    <button class="favourite__btn">
                        <span class="material-symbols-outlined">
                                
                            favorite
                        </span>
                        <span class="heart"></span>
                    </button></a>
                <a class="mainContainer__img4" href=""><div class="img--border"><img class="image" src="./images/Minion-Crazy-icon.jpg" alt="Ảnh"></div>
                <button class="favourite__btn">
                        <span class="material-symbols-outlined">   
                            favorite
                        </span>
                        <span class="heart"></span>
                    </button>
                </a>

                <a class="mainContainer__img5" href=""><div class="img--border"><img class="image" src="./images/images (1).jfif" alt="Ảnh"></div>
                <button class="favourite__btn">
                        <span class="material-symbols-outlined">   
                            favorite
                        </span>
                        <span class="heart"></span>
                    </button>
                </a>

                <a class="mainContainer__img6" href=""><div class="img--border"><img class="image" src="./images/image2 .jfif" alt="Ảnh"></div>
                <button class="favourite__btn">
                        <span class="material-symbols-outlined">   
                            favorite
                        </span>
                        <span class="heart"></span>
                    </button>
                </a>

            </div>
        </div>
    </div>
</body>
</html>