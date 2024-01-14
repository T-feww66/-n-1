        <div class="content buy-product">
            <h1>Mua sản phẩm</h1>
            <?php 
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                }else {
                    $id = '';
                }
                $pro_chitiet = mysqli_query($con, "SELECT * FROM tbl_product where pro_id='$id'");
                    while($row_chitiet = mysqli_fetch_array($pro_chitiet)) {
            ?>
            <section id="product-buy">
                <div class="product-main">
                    <img
                        src="../assets/images/<?php echo $row_chitiet['pro_img']?>"
                        alt=""
                        id="img-main"
                    />
                </div>
                <div class="buypro-content">
                    <h3><?php echo $row_chitiet['pro_name']?></h3>
                    <div class="money"><?php echo number_format($row_chitiet['pro_price']). 'VND'?></div>
                    <p>Số Lượng: <?php echo $row_chitiet['pro_quantity']?></p>
                    <form action="?quanly=giohang" method="post" class="cart-item">
                        <input type="hidden" name="pro_name" value="<?php echo $row_chitiet['pro_name']?>">
                        <input type="hidden" name="pro_id" value="<?php echo $row_chitiet['pro_id']?>">
                        <input type="hidden" name="pro_price" value="<?php echo $row_chitiet['pro_price']?>">
                        <input type="hidden" name="pro_img" value="<?php echo $row_chitiet['pro_img']?>">
                        <input type="hidden" name="soluong" value="1">
                        <input type="submit" class="button mt-20" name="morecart" value="Thêm giỏ hàng">
                    <!-- <button class="button"><i class="bx bxs-cart-alt icon"></i></button> -->
                    </form>
                    <p class="mt-20"><?php echo $row_chitiet['pro_des']?></p>
                </div>
            </section>
            <?php
                }
            ?>
        </div>
        <div id="product" class="content">
            <h3 class="pro-title">SẢN PHẨM LIÊN QUAN<h3>
            <div class="pro-container">
                <?php 
                    if(isset($_GET['id'])) {
                        $id = $_GET['id'];
                    }else {
                        $id = '';
                    }
                    $sql_lay_product = mysqli_query($con, "SELECT * FROM tbl_product, tbl_category
                    WHERE tbl_product.category_id = tbl_category.category_id");
                    while($row_product = mysqli_fetch_array($sql_lay_product)) {
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
                ?>
            </div>
        </div>

            <!--  -->