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
            <div class="start">
                    <button class="toolbar">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                <a href="Trangchu.php" class="logo">
                    <img src="images/logo.png" alt="" width="25%">
                </a>
            </div>
            <div class="center">
                <form action="Search.php" method="post" style="display: flex;">
                    <input type="text" name="noidung" autocomplete="off" placeholder="Nhập nội dung tìm kiếm">
                    <button class="search-button" type="submit" name="btn">
                        <span class="material-symbols-outlined">search</span>
                    </button>
                </form>
            </div>
            <div class="end">
                <button class="avatar">
                    <img src="" alt="Hình ảnh đại diện" height="32" width="32">
                </button>
            </div>
        </div>
        
    </header>
</body>
</html>