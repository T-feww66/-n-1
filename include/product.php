        <div class="content banner">
            <div class="ba-content">
                <h2>Áo Thun</h2>
                <p>Vãi cotton hai chiều hình in sắc nét. <br>
                    TFeww thương hiệu của sự tinh tế.</p>
            </div>
            <img src="../assets/images/4-img.webp" alt="" />
        </div>

<!----------------------- Product --------------------->
        <?php 
            $sql_cate_product = mysqli_query($con, "SELECT * FROM tbl_category ORDER BY category_id DESC");
            while($row_cate_product = mysqli_fetch_array($sql_cate_product)){
                $category_id = $row_cate_product['category_id'];
        ?>
        <div id="product" class="content">
            <h3 class="pro-title"><?php echo $row_cate_product["category_name"]?><h3>
            <div class="pro-container">
                <?php 
                    $sql_product = mysqli_query($con, "SELECT * FROM tbl_product ORDER BY pro_id DESC");
                    while($row_product = mysqli_fetch_array($sql_product)) { 
                        if($row_product['category_id'] == $category_id) {
                ?>
                <div class="pro-item">
                    <a href="?quanly=chitietsp&id=<?php echo $row_product['pro_id']?>">
                        <img src="../assets/images/<?php echo $row_product['pro_img']?>" alt="" />
                    </a>
                    <div class="pro-des">
                        <h3><?php echo $row_product['pro_name']?></h3>
                        <div class="pro_bootom">
                            <span class="money"><?php echo number_format($row_product['pro_price']). 'VND' ?></span>
                        </div>
                        <form action="?quanly=giohang" method="post" class="cart-item">
                                <input type="hidden" name="pro_name" value="<?php echo $row_product['pro_name']?>">
                                <input type="hidden" name="pro_id" value="<?php echo $row_product['pro_id']?>">
                                <input type="hidden" name="pro_price" value="<?php echo $row_product['pro_price']?>">
                                <input type="hidden" name="pro_img" value="<?php echo $row_product['pro_img']?>">
                                <input type="hidden" name="soluong" value="1">
                                <input type="hidden" name="morecart" value="themgiohang">
                                <button><i class="bx bxs-cart-alt icon"></i></button>
                            </form>
                    </div>
                </div>
                <?php 
                        }
                    }        
                ?>
            </div>
        </div>
        <?php 
              }
            ?>