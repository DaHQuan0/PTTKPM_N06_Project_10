<html>
    <link rel="stylesheet" href="../css/home.css">
    <script src="../js/Trangchu.js"></script>
</html>
<header>
    <div class="container">
            <div class="start" style="height: 45px;">
                <button onclick="click_btn_menu()" class="toolbar" >
                    <span style="display: block; font-size: 30px;align-items: center;" class="material-symbols-outlined">menu</span>
                </button>
                <a href="Trangchu.php" class="logo">
                    <img src="images/logo.png" alt="" width="25%">
                </a>
            </div>
            <div class="center" style="padding-left: 25%; padding-right: 25%; padding-top: 15px; border-radius: 15px;">
                <form method="get" action="<?php echo isset($_SESSION['id']) ? 'Search.php?noidung=&id=' . $_SESSION['id'] : 'Search.php?noidung='; ?>" style="display: flex;">
                    <input type="search" name="noidung" autocomplete="off" placeholder="Nhập nội dung tìm kiếm" style="width: 550px;border-radius: 15px; outline: none;padding-left: 15px;">
                    <button class="search-button" type="submit" name="btn" style="width: 40px;border-radius: 15px;background-color: white;">
                        <span class="material-symbols-outlined">search</span>
                    </button>
                </form>
            </div>
            <div class="end" style="height: 45px;">
                <a href="<?php echo isset($_SESSION['id']) ? 'php/Profile.php?id=' . $_SESSION['id'] : 'php/Login.php'; ?>" class="user">
                    <img src="<?php if($user !== null && $user['user_image']!==""){
                        echo $user['user_image'];
                    }else if($user !== null && $user['user_image'] == ""){
                        echo 'https://tse4.mm.bing.net/th?id=OIP.G0HA5LsrcmuTvN5KB_qmRwHaHa&pid=Api&P=0&h=180';
                    }else
                        echo 'https://tse3.explicit.bing.net/th?id=OIP.3IsXMskZyheEWqtE3Dr7JwHaGe&pid=Api&P=0&h=180'; 
                     ?>" alt="Ảnh đại diện" class="user-img">
                </a>
            </div>
        </div>

    </header>
    

    