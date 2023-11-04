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

class searchArt {
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
    <link rel="stylesheet" href="css/trangchu.css">
</head>
<body>
    <?php 
        include 'page/header.php';
        include 'page/sidebar.php';
    ?>

    <div class="results-container">
        <?php 
            $uniqueResults = array_unique($results, SORT_REGULAR);
            foreach($uniqueResults as $result){
                echo "<div class='result'>";
                echo "Image: " . $result['image'] . "<br>";
                echo "Category: " . $result['category'] . "<br>";
                echo "</div>";
            }
        ?>
    </div>

    <?php 
        include 'page/footer.php';
    ?>
</body>
</html>