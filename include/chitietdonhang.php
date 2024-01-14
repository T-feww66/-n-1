        <div class="content">
            <h3 class="pro-title">Đơn hàng của <?php echo $_SESSION['name']?><h3>

            
            <!-- xem đơn hàng -->
            <div class="col-md-12">
                <p>Liệt kê lịch sữ đặt hàng</p>
                <table class="tbl table-reponsive table-bordered table-triped">
                    <tr>
                        <th>Thứ Tự</th>
                        <th>Mã giao dịch</th>
                        <th>Tên sản phẩm</th>
                        <th>Tình trạng đơn hàng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Hoá đơn đơn hàng</th>
                    </tr>
                <?php 
                    if(isset($_GET['khachhang'])) {
                        $user_id = $_GET['khachhang'];
                    }else {
                        $user_id = '';
                    }
                    $sql_select_order = mysqli_query($con, "SELECT * FROM tbl_order, tbl_customer, tbl_product
                    WHERE tbl_order.cus_id = tbl_customer.cus_id AND
                            tbl_order.pro_id = tbl_product.pro_id AND
                            tbl_customer.user_id = $user_id 
                            GROUP BY tbl_order.mahang
                            ORDER BY tbl_order.order_id DESC");
                    $i = 0;
                    while($row_select_order = mysqli_fetch_array($sql_select_order)) {
                        $i++;
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $row_select_order['mahang']?></td>
                            <td><?php echo $row_select_order['pro_name']?></td>
                            <td>
                                <?php 
                                    if($row_select_order['order_status'] == 1) {
                                        echo "Đã xử lý";
                                    }else {
                                        echo  "Chưa xử lý";
                                    }
                                ?>
                            </td>
                            <td><?php echo $row_select_order['order_ngaydathang']?></td>
                            <td><a href="?quanly=hoadon&mahang=<?php echo $row_select_order['mahang']?>">Xen hoá đơn</a></td>
                        </tr>
                    </tbody>
                <?php 
                        }
                        ?>
                </table>
            </div>
            
            
        </div>