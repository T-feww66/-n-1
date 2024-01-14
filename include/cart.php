<?php 
    session_start();
?>
<?php 
            
            if(isset($_POST['morecart'])) {
                $tensp = $_POST['pro_name'];
                $sp_id = $_POST['pro_id'];
                $gia = $_POST['pro_price'];
                $hinhanh = $_POST['pro_img'];
                $soluong = $_POST['soluong'];

                $slq_lay_giohang = mysqli_query($con, "SELECT * FROM tbl_cart WHERE pro_id = '$sp_id'
                ORDER BY cart_id DESC");
                $count = mysqli_num_rows($slq_lay_giohang);
                if($count > 0) {
                    $row_product_cart = mysqli_fetch_array($slq_lay_giohang);
                    $soluong = $row_product_cart['soluong'] + 1;
                    $slq_cart = "UPDATE tbl_cart SET soluong = '$soluong' WHERE pro_id = '$sp_id'";
                }else{
                    $user_id = $_SESSION['user_id'];
                    $soluong = $_POST['soluong'];
                    $slq_cart = "INSERT INTO tbl_cart(pro_name, pro_id, user_id, pro_price, pro_img, soluong)
                    VALUES ('$tensp','$sp_id','$user_id','$gia','$hinhanh','$soluong')";
                }
                $inset_cart = mysqli_query($con, $slq_cart);
                // header('Location: sanpham.php?quanly=chitietsp&id=' .$sp_id);

                // if($inset_cart==0) {
                //     header('Location: sanpham.php?quanly=chitietsp&id=' .$sp_id);
                // }
                
            }elseif(isset($_POST['capnhat'])) {
                        for($i=0; $i<count($_POST['product_id']); $i++) {
                            $sanpham_id = $_POST['product_id'][$i];
                            $soluongsp = $_POST['soluong'][$i];
                            if($soluongsp<=0) {
                                $sql_delete = mysqli_query($con, "DELETE FROM tbl_cart WHERE pro_id = '$sanpham_id'");
                            }else {
                                $sql_update = mysqli_query($con, "UPDATE tbl_cart SET soluong = '$soluongsp' WHERE pro_id = '$sanpham_id'");
                            }
                        }                    
            }elseif(isset($_GET['xoa'])) {
                $id = $_GET['xoa'];
                $sql_delete = mysqli_query($con, "DELETE FROM tbl_cart WHERE cart_id = '$id'");
            }elseif(isset($_POST['thanhtoan'])) {
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $add = $_POST['address'];
                $note = $_POST['note'];
                $giaohang = $_POST['giaohang'];
                $user_id = $_SESSION['user_id'];
                $slq_customer = mysqli_query($con, "INSERT INTO tbl_customer(user_id, name, phone, email, address, note, giaohang)
                VALUES ('$user_id','$name','$phone','$email','$add', '$note', '$giaohang')");
                if($slq_customer) {
                    $sql_cus = mysqli_query($con, "SELECT * FROM tbl_customer ORDER BY cus_id DESC LIMIT 1");
                    $mahang = rand(0, 99999);
                    $row_cus = mysqli_fetch_array($sql_cus);
                    $cus_id = $row_cus['cus_id'];
                    for($i=0; $i<count($_POST['product_id_cart']); $i++) {
                        $pro_id_cart = $_POST['product_id_cart'][$i];
                        $soluong_cart = $_POST['soluong_cart'][$i];
                        $sql_order = mysqli_query($con, "INSERT INTO tbl_order(pro_id, mahang, cus_id, soluong)
                        VALUES ('$pro_id_cart','$mahang','$cus_id','$soluong_cart')");
                        $sql_giaodich = mysqli_query($con, "INSERT INTO tbl_giaodich(pro_id, magiaodich,cus_id, soluong)
                        VALUES ('$pro_id_cart','$mahang', '$cus_id' ,'$soluong_cart')");
                        $sql_delete = mysqli_query($con, "DELETE FROM tbl_cart WHERE pro_id = '$pro_id_cart'");
                        // $sql_product_update = "UPDATE tbl_product SET pro_quantity = pro_quantity-'$soluong_cart' WHERE pro_id = '$pro_id_cart'";
                    }
                }
                
            }
        ?>
        
        <?php 
            $slq_giohang = mysqli_query($con, "SELECT * FROM tbl_cart, tbl_user
            WHERE tbl_user.user_id = tbl_cart.user_id ORDER BY cart_id DESC");
        ?>
        <div class="cart-page content">
            <h3>Mua hàng</h3>
            <form action="" method="post">
            <table class="tbl">
                <thead>
                <tr>
                    <th>Thứ tự</th>
                    <th>Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Giá tổng</th>
                    <th>Xoá sản phẩm</th>
                </tr>
                </thead>

                <tbody>
                <?php 
                    $total = 0;
                    $i = 0;
                    while($row_giohang = mysqli_fetch_array($slq_giohang)){
                    $subtotal = $row_giohang['pro_price'] * $row_giohang['soluong'];
                    $i++;
                    $total += $subtotal;
                ?>
                <tr>
                    <td><p><?php echo $i?></p></td>
                    <td>
                        <div class="cart-product">
                            <img src="../assets/images/<?php echo $row_giohang['pro_img']?>" alt="" />
                        </div>
                    </td>
                    <td><input type="number" name="soluong[]" value="<?php echo $row_giohang['soluong']?>" /></td>
                    <td><h5><?php echo $row_giohang['pro_name']?></h5></td>
                    <td><span class="money"><?php echo $row_giohang['pro_price']?></span></td>
                    <td><span class="money"><?php echo $subtotal?></span></td>
                    <td><a href="?quanly=giohang&xoa=<?php echo $row_giohang['cart_id']?>" class="delete">Xoá</a></td>
                    <td><input type="hidden" name="product_id[]" value="<?php echo $row_giohang['pro_id']?>"/></td>
                </tr>
                <?php 
                    }
                ?>
                <tr>
                    <td colspan="7">Thành Tiền:  <?php echo $total?> VND</td>
                </tr>
                <tr>
                    <td colspan="7"><input type="submit" value="Cập Nhật" name="capnhat" class="button"></td>
                </tr>
                </tbody>
            </table>
            </form>
            
                        <!-- dia chi giao hang -->
            <form action="" method="post" class="address">
                <h3 class="mt-20">Thêm địa chỉ giao hàng</h3>
                    <div class="content">
                    <div class="add-content">
                        <input type="text" value="" name="name" placeholder="Họ và tên" class="input" required>
                    </div>
                    <div class="add-content">
                        <input type="text" value="" name="phone" placeholder="Số điện thoại" class="input" required>
                    </div>
                    <div class="add-content">
                        <input type="email" value="" name="email" placeholder="Email" class="input" required>
                    </div>
                    <div class="add-content">
                        <input type="text" value="" name="address" placeholder="Địa chỉ" class="input" required>
                    </div>
                    <div class="add_content">
                        <textarea style="resize: none" value="" name="note" class="input" required placeholder="Ghi chú" ></textarea>
                    </div>
                    <select name="giaohang" class="input" required>
                        <option value="">Hình thức thanh toán</option>
                        <option value="1">Thanh toán khi nhận hàng</option>
                        <option value="0">Thanh toán bằng ATM</option>
                    </select>
                    <div class="add-content">
                        <?php 
                            $sql_select_giohang = mysqli_query($con, "SELECT * FROM tbl_cart ORDER BY cart_id DESC");
                            while($row_cart = mysqli_fetch_array($sql_select_giohang)) {
                        ?>
                        <td><input type="hidden" name="soluong_cart[]" value="<?php echo $row_cart['soluong']?>" /></td>
                        <td><input type="hidden" name="product_id_cart[]" value="<?php echo $row_cart['pro_id']?>"/></td>
                        <?php 
                            }
                        ?> 
                        <input type="submit" class="button" name="thanhtoan" value="Thanh toán"></input>
                    </div>
                    </div>
            </form>
        </div>