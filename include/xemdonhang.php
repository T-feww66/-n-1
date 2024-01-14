<div class="content">
    <h3 class="pro-title">Đơn hàng của <?php echo $_SESSION['name']?></h3>
    <!-- Hoá đơn của đơn hàng -->
    <?php
                if(isset($_GET['quanly']) == 'xemdonhang') {
                    $mahangkh = $_GET['mahang'];
            ?>
            <h4>Hoá đơn của đơn hàng</h4>
            <div>
                <form action="" method="post">
                    <table class="tbl table-reponsive table-bordered table-triped">
                            <tr>
                                <th>Thứ Tự</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Tổng tiền</th>
                                <th>Ngày đặt hàng</th>
                            </tr>
                        <?php 
                            $sql_chitiet = mysqli_query($con,"SELECT * FROM tbl_order, tbl_product, tbl_customer
                            WHERE tbl_product.pro_id = tbl_order.pro_id AND
                            tbl_order.cus_id = tbl_customer.cus_id AND tbl_order.mahang = '$mahangkh'
                            ORDER BY tbl_order.order_id DESC");
                            $total = 0;
                            $i = 0;
                            while($row_chitiet = mysqli_fetch_array($sql_chitiet)) {
                                $subtotal = $row_chitiet['pro_price'] * $row_chitiet['soluong'];
                                $total += $subtotal;
                                $i++;
                        ?>  
                            <tbody>
                                <tr>
                                    <td><?php echo $i?></td>
                                    <td><?php echo $row_chitiet['pro_name']?></td>
                                    <td><?php echo $row_chitiet['soluong']?></td>
                                    <td><?php echo $subtotal?> VND</td>
                                    <td><?php echo $row_chitiet['order_ngaydathang']?></td>
                                    <input type="hidden" name="mahang_xuly" value="<?php echo $row_chitiet['mahang']?>">
                                </tr>
                                <?php 
                                    }
                                ?>
                                <tr>
                                    <td colspan="7">Thành Tiền:  <?php echo $total?> VND</td>
                                </tr>
                            </tbody>
                    </table>
                </form><br>
            </div>
            <?php
                }
            ?>
</div>