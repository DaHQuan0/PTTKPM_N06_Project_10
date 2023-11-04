<?php if($_SESSION['id'] == null){
    $href = "";
}else{
    $href = "?id=";
}
    ?>
<div class="webContent">
        <div id="menu" class="leftMenu translate">
            <div class="btn home">

                <?php echo '<a href="TrangChu.php?id='.$_SESSION['id'].'">';?>
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
                
                <?php if($href == ""){
                    echo '<a href="php/Login.php">';
                }else{
                    echo '<a href="TrangChu.php?id='.$_SESSION['id'].'&favourite">';
                } ?>
                    <span class="material-symbols-outlined">favorite</span>
                    <span class="title">Ảnh yêu thích</span>
                </a>
            </div>
            
            <hr style="margin-top:30px">
            <div class="footer_leftMenu">
            <h3 style="margin-top:15px; font-weight:bold;">Người Thực Hiện</h3>
            <div style="display:flex; color:red;padding: 10px 15px; line-height:1.5;" >
                    <div>
                        <p>Vũ Ngọc Văn</p>
                        <p>Đào Anh Quân</p>
                        <p>Dương Tuấn Phong</p>
                        <p>Ngô Trần Đức Long</p>
                    </div>
                </div>
            </div>
            
            
        </div>
        
        

        <div id="main" class="mainContainer" style="width: 100%;display: block;">
            <div id="bgr-main" style="position: fixed; background-color: grey;width:100%;height:100%;display:none;z-index: 99;"></div>
            <div class="webContent__header ">
                <ul class="list__btn">
                    <a href="TrangChu.php"><li>Tất cả</li></a>
                    <?php
                        include 'config/connect.php';
                        $categorys = array();
                        $sql = "SELECT * FROM category";
                        $category = $conn->query($sql);

                        if($category){
                            while($row = $category->fetch_assoc()){
                                $categorys[] = array(
                                    'name' => $row['name'],
                                    'id' => $row['id'],
                                );
                            }
                        }
                        foreach($categorys as $item){
                            echo '<a href="TrangChu.php?category_id='.$item["id"].'"><li> '.$item['name'].'</li></a>';
                        }
                        ?>
                    <!-- <a href=""><li>Phong cảnh</li></a>
                    <a href=""><li>Chân dung</li></a>
                    <a href=""><li>Thể thao</li></a>
                    <a href=""><li>Sự kiện</li></a>
                    <a href=""><li>Thiên nhiên</li></a>
                    <a href=""><li>Đường phố</li></a>
                    <a href=""><li>Trừu tượng</li></a>
                    <a href=""><li>Sáng tạo </li></a>
                    <a href=""><li>Hoạt hình</li></a> -->
                </ul>
            </div>