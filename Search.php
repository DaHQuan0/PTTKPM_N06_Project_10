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
    $stmt = $conn->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    }
}

class searchArt {
    public function searchArt($conn) {
        $results = array();
        $keyword = "";
        if (isset($_GET['btn']) && isset($_GET['noidung'])) {
            $keyword = strtolower($_GET['noidung']);
            $array = explode(' ', $keyword);
            foreach ($array as $value) {
                $stmt = $conn->prepare("SELECT art.image, category.name
                                       FROM art
                                       INNER JOIN category ON art.category_id = category.id
                                       WHERE LOWER(category.name) LIKE ?");
                $searchValue = "%$value%";
                $stmt->bind_param("s", $searchValue);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $results[] = array(
                            'image' => $row['image'],
                            'category_name' => $row['name']
                        );
                    }
                }
            }
        }

        return $results; // Trả về kết quả tìm kiếm
    }
}

// Sử dụng lớp searchArt
$searchArt = new searchArt();
$results = $searchArt->searchArt($conn); // Lưu trữ kết quả tìm kiếm vào biến $results
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <?php
    include 'page/header.php';
    include 'page/sidebar.php';
    ?>

    <div class="results-container">
        <?php
        $uniqueResults = array_unique($results, SORT_REGULAR);
        foreach ($uniqueResults as $result) {
            // echo "<div class='result'>";
            // echo "Image: " . htmlspecialchars($result['image']) . "<br>";
            // echo "Category Name: " . htmlspecialchars($result['category_name']) . "<br>";
            // echo "</div>";
        }
        
        ?>
    </div>
    <div role="list" class="content " >
            <?php
            
                $results = array();
        $keyword = "";
        if (isset($_GET['btn']) && isset($_GET['noidung'])) {
            $keyword = strtolower($_GET['noidung']);
            $array = explode(' ', $keyword);
            foreach ($array as $value) {
                $stmt = $conn->prepare("SELECT art.image, category.name
                                       FROM art
                                       INNER JOIN category ON art.category_id = category.id
                                       WHERE LOWER(category.name) LIKE ?");
                $searchValue = "%$value%";
                $stmt->bind_param("s", $searchValue);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $results[] = array(
                            'image' => $row['image'],
                            'category_name' => $row['name']
                        );
                    }
                }
            }
        }
        $results = array_unique($results, SORT_REGULAR);   
                        if(count($results) != 0){
                        
                        $results = array_reverse($results);
                        // shuffle($results);
                        $x = array();
                        $y = array();
                        $heights = array();
                        $widths = 1528;
                        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        //     // Kiểm tra xem có dữ liệu được gửi từ JavaScript hay không
                        //     if (isset($_POST['width'])) {
                        //         $widths = $_POST['width'];
                        //     }
                        // }
                        // echo($widths);
                        array_push($x,0);
                        $count = round($widths / 256);
                        for($i = 0; $i < $count ; $i++){
                            array_push($y,0);
                        }
                        $width = 252;
                        // $imageURL = array();

                        for ($i = 0; $i < count($results); $i++) {
                            // array_push($imageURL,$results[$i]['image']);
                            // $imageSize = getimagesize($results[$i]['image']);
                            // $height = $width * $imageSize[1] / $imageSize[0];
                            $height = 250;
                            array_push($heights,$height );
                            if($i % $count == ($count-1) && $i != 0){
                                
                                // array_push($y, $y[$i - $count] + $heights[$i-$count]);
                                array_push($x,0);
                            }else{
                                array_push($x,$x[$i] + $width);
                            }
                            array_push($y,$y[$i] + $height);
                        }
                        $checked = array();
                        for($i = 0 ; $i < count($results); $i++){
                            echo 
                            '<div role="listitem" data-grid-item="true" style="position: absolute;
                            display: flex;
                            width: '.$width.'px;
                            height: '.$heights[$i].'px;
                            top:0;
                            left:0;
                            transform: translateX('.$x[$i].'px) translateY('.$y[$i].'px);" href="">
                                <a class="img--border"><img class="image" src="'. $results[$i]['image'] .'" alt="Ảnh"></a>';
                                    
                                
                                
                                
                            echo '</div>';

                            
                            
                            
                            
                        }
                    
                    }else{
                            echo '<h3 style="margin: 30px; color: red;">Không có hình ảnh nào</h3>';
                        }
                        
                    ?>
                    
                    <?php
            
                    
            
            // favourite_show();

            $conn->close();
                ?>
        
        
   
    
        
            </div>
        </div>
    </div>
    <?php
    include 'page/footer.php';
    ?>
</body>

</html>