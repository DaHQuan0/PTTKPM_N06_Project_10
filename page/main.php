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
                        }
                        // echo $sql;
                        $result = $conn->query($sql);

                        if($result){
                            while($row = $result->fetch_assoc()){
                                $results[] = array(
                                    'image' => $row['image'],
                                );
                            }
                        }
                        if(count($results) != 0){

                        shuffle($results);
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
                        
                        for($i = 0 ; $i < count($results); $i++){
                            echo 
                            '<div role="listitem" data-grid-item="true" style="position: absolute;
                            display: flex;
                            width: '.$width.'px;
                            height: '.$heights[$i].'px;
                            top:0;
                            left:0;
                            transform: translateX('.$x[$i].'px) translateY('.$y[$i].'px);" href="">
                                <a class="img--border"><img class="image" src="'. $results[$i]['image'] .'" alt="Ảnh"></a>
                                
                                <button onclick="favourite('.$i.')" id="favourite__btn_'.$i.'" class="favourite__btn">
                                    <span class="material-symbols-outlined">favorite</span>
                                    <span id="heart" class="heart"></span>
                                </button>

                            </div>';
                        }}else{
                            echo '<h3 style="margin: 30px; color: red;">Không có hình ảnh nào</h3>';
                        }
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
        
        function favourite(i){
            let favourite__btn = document.getElementById("favourite__btn_"+i);
            if(check_btn[i] == false){
                favourite__btn.style.color = "red";
                check_btn[i] = true;
            }else{
                favourite__btn.style.color = "white";
                check_btn[i] = false;
            }
        // for(let i = 0 ; i < )
        

        }
</script>