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
                <form method="get" action="Trangchu.php?noidung=timkiem&btn=" style="display: flex;">
                    <input type="search" name="noidung" autocomplete="off" placeholder="Nhập nội dung tìm kiếm" style="width: 550px;border-radius: 15px; outline: none;padding-left: 15px;">
                    <button class="search-button" type="submit" name="btn" style="width: 40px;border-radius: 15px;background-color: white;">
                        <span class="material-symbols-outlined">search</span>
                    </button>
                </form>
            </div>
            <div class="end" style="height: 45px;">
                <a href="<?php echo isset($_SESSION['id']) ? 'php/Profile.php?id=' . $_SESSION['id'] : 'php/Login.php'; ?>" class="user">
                    <img src="<?php echo $user !== null ? $user['user_image'] : 'img/images.png'; ?>" alt="Ảnh đại diện" class="user-img">
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
    </div>    