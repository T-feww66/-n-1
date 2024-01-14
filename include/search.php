                <?php 
                    if(isset($_POST['search'])) {
                        $timkiem = $_POST['search_text'];
                    }
                    $sql_search = mysqli_query($con, "SELECT * FROM tbl_product
                    WHERE tbl_product.pro_name LIKE '%$timkiem%' ORDER BY pro_id");
                    $title = $timkiem;
                ?>
     <div id="product" class="content">
            <h3 class="content">Kết quả tìm kiếm cho: <?php echo $title?></h3>
            <div class="pro-container">
                <?php    
                    while($row_product = mysqli_fetch_array($sql_search)) {
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