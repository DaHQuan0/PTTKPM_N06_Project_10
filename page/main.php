<div role="list" class="content " >
            <?php
            function sortLastNElements($arr, $n) {
                $length = count($arr);
                
                // Cắt n phần tử cuối mảng
                $lastNElements = array_slice($arr, -$n);
                
                // Sắp xếp tăng dần mảng con
                sort($lastNElements);
                
                // Kết hợp mảng con đã sắp xếp với phần còn lại của mảng
                $sortedArr = array_merge(array_slice($arr, 0, $length - $n), $lastNElements);
                
                return $sortedArr;
            }
                include 'config/connect.php';
                        $results = array();
                        $sql = "SELECT * FROM art";
                        if(isset($_GET['category_id'])){
                            $category_id =$_GET['category_id'];
                            $sql = "SELECT * FROM art WHERE category_id =$category_id";
                        }
                        if(isset($_GET['favourite']) && isset($_GET['id']) ){
                            $id = $_GET['id'];
                            $sql = "SELECT * FROM favourite WHERE user_id =$id";
    // echo $sql;
                        $result = $conn->query($sql);

                        if($result){
                            while($row = $result->fetch_assoc()){
                                $results_img[] = array(
                                    'image_id' => $row['image_id'],
                                );
                            }
                        }
                        $results = array();
                        for($i = 0; $i < count($results_img); $i++){
                            $id_img = $results_img[$i]['image_id'];
                            $sql = "SELECT * FROM art WHERE id =$id_img";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $item = [];
                                $item['image'] = $row['image'];
                                $item['id'] = $row['id'];
                                array_push($results,$item);
                            }
                        }
                        }
                        // echo $sql;
                        if(!isset($_GET['favourite'])){
                            $result = $conn->query($sql);

                        if($result){
                            while($row = $result->fetch_assoc()){
                                $results[] = array(
                                    'image' => $row['image'],
                                    'id' => $row['id'],
                                );
                            }
                        }
                        }
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
                            $imageSize = getimagesize($results[$i]['image']);
                            $height = $width * $imageSize[1] / $imageSize[0];
                            // $height = 250;
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
                                if(!isset($_GET['favourite'])){
                                    echo '<button style="color:white;" onclick="favourite('.$i.','.$_SESSION['id'].','.$results[$i]['id'].')" id="favourite__btn_'.$i.'" class="favourite__btn">
                                    <span class="material-symbols-outlined">favorite</span>
                                    <span id="heart" class="heart"></span>
                                </button>';
                                }
                                
                                
                            echo '</div>';

                            
                            $session_id = $_SESSION['id'];
                            $id_img = $results[$i]['id'];
                            $sql_favourite = "SELECT * FROM favourite";
                            $result_favourite = $conn->query($sql_favourite);
                            if ($result_favourite->num_rows > 0) {
                                while($row = $result_favourite->fetch_assoc()){
                                    if($row['image_id'] === $id_img && $row['user_id'] === $session_id){
                                        echo '<script>document.getElementById("favourite__btn_'.$i.'").style.color = "red";</script>';
                                        
                                        array_push($checked,$id_img);
                                    }
                                }
                                
                            }
                            
                            
                        }
                    
                    }else{
                            echo '<h3 style="margin: 30px; color: red;">Không có hình ảnh nào</h3>';
                        }
                        
                    ?>
                    
                    <?php
            if(isset($_GET['i'])){
                
                echo '<script>console.log("insert ok");</script>';
                $i_post = $_GET['i'];
                $id = $_GET['id_image'];
                // $id_img = $results[$i_post]['id'];
                $session_id = $_GET['id'];
                if($session_id == null){
                    header("Location: php/Login.php");
                }else{
                    if(!in_array($id,$checked)){

                        // echo '<script>document.getElementById("favourite__btn_'.$i_post.'").style.color = "red";</script>';
                        $sql_insert = "INSERT INTO favourite(checked,user_id,image_id) VALUES (1,$session_id,$id)";
                    }else{

                        $sql_insert = "DELETE FROM favourite WHERE user_id = $session_id and image_id = $id";
                    }
                    $conn->query($sql_insert);
                }
                    
            }
            // favourite_show();

            $conn->close();
                ?>
        
        
   
    
        
            </div>
        </div>
    </div>

<script>
    var cnt_btn = <?php echo count($results);?>;
        var check_btn = [];
        for(var i = 0 ; i < cnt_btn ; i++){
            check_btn.push(false);
        }
        
        
        

            
    
</script>
<script src="js/favourite.js"></script>
    
