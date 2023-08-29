<?php 
    include "connect.php";
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
            <div class="start" style="padding-left: 15px;">
                <button class="toolbar" style="border: none; background-color: white;">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <a href="Trangchu.php" class="logo">
                    <img src="images/logo.png" alt="" width="25%">
                </a>
            </div>
            <div class="center" style="padding-left: 25%; padding-right: 25%; padding-top: 25px; border-radius: 15px;">
                <form action="Search.php" method="post" style="display: flex;">
                    <input type="search" name="noidung" autocomplete="off" placeholder="Nhập nội dung tìm kiếm" style="width: 550px;border-radius: 15px; outline: none;">
                    <button class="search-button" type="submit" name="btn" style="border-radius: 15px;background-color: white;">
                        <span class="material-symbols-outlined">search</span>
                    </button>
                </form>
            </div>
            <div class="end">
                <button class="avatar" style="height: 40px; width: 40px; border: none; background-color: white; padding-left: 25px;">
                    <img src="" alt="Hình ảnh đại diện" style="border-radius: 25px;">
                </button>
            </div>
        </div>
        
    </header>
</body>
</html>