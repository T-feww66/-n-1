        <div class="content slider">
            <!-- list -->
                <div class="list">
                    <?php
                    $sql_slider = mysqli_query($con,"SELECT * FROM tbl_slider ORDER BY slider_id");
                    while($row_slider = mysqli_fetch_array($sql_slider)) {
                    ?>
                    <div class="slider-item">
                        <img src="../assets/images/<?php echo $row_slider['slider_img']?>" alt="" />
                        <div class="content">
                            <a href="./sanpham.php" class="button">Tới Ngay</a>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            <!-- button -->
            <div class="buttons">
                <button id="prev"><</button>
                <button id="next">></button>
            </div>
            <!-- dots -->
            <ul class="dots">
                <li class="active"></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>