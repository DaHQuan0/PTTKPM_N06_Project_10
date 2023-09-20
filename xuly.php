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
