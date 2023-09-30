<?php
session_start();

// Kiểm tra xem có tham số id trong URL hay không
if (isset($_GET['id'])) {
    $_SESSION['id'] = $_GET['id'];
} else {
    $_SESSION['id'] = null;
}

// Kết nối đến cơ sở dữ liệu
include 'config/connect.php';

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


class Art {
    public function searchArt($conn) {
        $results = array();
        $keyword = "";
        if(isset($_GET['btn'])){
            $keyword = $_GET['noidung'];
            $keyword = strtolower($keyword);
            $array = explode(' ', $keyword);
            foreach($array as $value){
                $sql = "SELECT * FROM art WHERE LOWER(image) LIKE '%$value%' OR LOWER(category) LIKE '%$value%'";
                $result = $conn->query($sql);

                if($result){
                    while($row = $result->fetch_assoc()){
                        $results[] = array(
                            'image' => $row['image'],
                            'category' => $row['category']
                        );
                    }
                }
            }
        }

        $uniqueResults = array_unique($results, SORT_REGULAR);
        foreach($uniqueResults as $result){
            echo "Image: " . $result['image'] . "<br>";
            echo "Category: " . $result['category'] . "<br>";
            echo "<br>";
        }
    }
}

// Sử dụng lớp Art
$art = new Art();
$art->searchArt($conn);




// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>
<script>
    var jsArray = <?php echo $jsonArr; ?>;
    for(item of jsArray) {

    }

</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="css/Trangchu.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(window).on('resize', function() {
                var classWidth = $('.content').width();
                console.log(classWidth);
                $.ajax({
                    url: 'TrangChu.php',
                    type: 'POST',
                    data: {width: classWidth},
                    success: function(response) {
                        console.log(response); // Kết quả xử lý từ tập tin PHP
                    }
                });
            });
        });

        let check = true;  
        // var rect = element.getBoundingClientRect();
        function favourite(){

            // for(let i = 0 ; i < )
            let favourite__btn = document.getElementsByClassName("favourite__btn");
            for(let i = 0 ; i < favourite__btn.length ; i++){
                favourite__btn[i].addEventListener("click", function() {
                    favourite__btn[i].style.cssText = ".favourite__btn{ color: red;}.heart, .heart::before, .heart::after{    background-color: red;}";
                });
            }
        }
        function click_btn_menu(){
            let main = document.getElementById("main");
            let menu = document.getElementById("menu");
            let translate = document.getElementsByClassName("translate");
            if(check == true){
                check = false;
                menu.style.transform = "translateX(-256px)";
                main.style.setProperty('--margin-left','0px')
                for(let i = 0 ; i < translate.length;i++){
                    translate[i].style.animationDuration = "0.5s";
                    translate[i].style.animationName = "example";
                }                
            }
            else if(check== false){
                check = true;
                menu.style.transform = "translateX(0)";
                main.style.setProperty('--margin-left','256px')

                for(let i = 0 ; i < translate.length;i++){
                    translate[i].style.animationDuration = "1s";
                    translate[i].style.animationName = "example1";
                    
                }
            }

        }

    </script>
    <title>ShareImage</title>
</head>
<body>

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
                <form method="get" action="Trangchu.php?noidung=timkiem&btn=" style="display: flex;">
                    <input type="search" name="noidung" autocomplete="off" placeholder="Nhập nội dung tìm kiếm" style="width: 550px;border-radius: 15px; outline: none;padding-left: 15px;">
                    <button class="search-button" type="submit" name="btn" style="width: 40px;border-radius: 15px;background-color: white;">
                        <span class="material-symbols-outlined">search</span>
                    </button>
                </form>
            </div>
            <div class="end" style="height: 45px;">
                <a href="<?php echo isset($_SESSION['id']) ? 'php/Profile.php?id=' . $_SESSION['id'] : 'php/Login.php'; ?>" class="user">
                    <img src="<?php echo $user !== null ? $user['user_image'] : 'img/images.png'; ?>" alt="" class="user-img">
                </a>
            </div>
        </div>
        
    </header>

    <div class="webContent">
        <div id="menu" class="leftMenu translate">
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
        
        
        
        <div id="main" class="mainContainer" style="width: 100%;display: block;">
            <div class="webContent__header translate">
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
            <div role="list" class="content translate" >
            <?php
                include 'config/connect.php';
                        $results = array();
                        $sql = "SELECT * FROM art";
                        $result = $conn->query($sql);

                        if($result){
                            while($row = $result->fetch_assoc()){
                                $results[] = array(
                                    'image' => $row['image'],
                                );
                            }
                        }
                        $results = array_reverse($results);
                        $x = array();
                        $y = array();
                        $heights = array();
                        $widths = 900;
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            // Kiểm tra xem có dữ liệu được gửi từ JavaScript hay không
                            if (isset($_POST['width'])) {
                                $widths = $_POST['width'];
                            }
                        }
                        echo($widths);
                        array_push($x,0);
                        $count = round($widths / 256);
                        for($i = 0; $i < $count ; $i++){
                            array_push($y,0);
                        }
                        for ($i = 0; $i < count($results); $i++) {
                            $imageURL = $results[$i]['image'];
                            $imageSize = getimagesize($imageURL);
                            $width = 252;
                            
                            $height = $width * $imageSize[1] / $imageSize[0];
                            array_push($heights,$height );
                            echo 
                            '<a role="listitem" data-grid-item="true" style="position: absolute;
                            display: flex;
                            width: '.$width.'px;
                            height: '.$height.'px;
                            top:0;
                            left:0;
                            transform: translateX('.$x[$i].'px) translateY('.$y[$i].'px);" href="">
                                <div class="img--border"><img class="image" src="'. $imageURL .'" alt="Ảnh"></div>
                                
                                <button onclick="favourite()" id="favourite__btn" class="favourite__btn">
                                    <span class="material-symbols-outlined">favorite</span>
                                    <span id="heart" class="heart"></span>
                                </button>

                            </a>';
                            
                            if($i % $count == ($count-1) && $i != 0){
                                
                                // array_push($y, $y[$i - $count] + $heights[$i-$count]);
                                array_push($x,0);
                            }else{
                                array_push($x,$x[$i] + $width);
                            }
                            array_push($y,$height);
                        }
                        $conn->close();
                    ?>
                
<!--                 
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
                </a> -->

            </div>
            
        </div>
    
        
    </div>
</body>

</html>