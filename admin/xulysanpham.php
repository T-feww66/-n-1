<?php
    include_once('../db/connect.php');
?>

<?php 
    if(isset($_POST['themsanpham'])) {
        $tensanpham = $_POST['tensanpham'];
        $hinhanh = $_FILES['hinhanh']['name'];
        $tmp_hinhanh = $_FILES['hinhanh']['tmp_name'];
        $soluong = $_POST['soluong'];
        $giasanpham = $_POST['giasanpham'];
        $mota = $_POST['mota'];
        $danhmuc = $_POST['danhmuc'];
        // bienluahinhanh
        $path = '../uploads/';
        $sql_insert_product = mysqli_query($con, 
        "INSERT INTO tbl_product(pro_name, pro_img, pro_quantity, pro_price, pro_des, category_id) 
                VALUES('$tensanpham','$hinhanh','$soluong','$giasanpham','$mota','$danhmuc')");
        // luu file upload
        move_uploaded_file($tmp_hinhanh, $path.$hinhanh);
    }elseif(isset($_POST['capnhatsp'])) {
        $tensanpham = $_POST['tensanpham'];
        $hinhanh = $_FILES['hinhanh']['name'];
        $tmp_hinhanh = $_FILES['hinhanh']['tmp_name'];
        $soluong = $_POST['soluong'];
        $giasanpham = $_POST['giasanpham'];
        $mota = $_POST['mota'];
        $danhmuc = $_POST['danhmuc'];
        $id = $_POST['id_danhmuc'];
        // bienluahinhanh
        $path = '../uploads/';
        if($hinhanh =='') {
            $sql_update_img = "UPDATE tbl_product SET
                    pro_name = '$tensanpham',
                    -- pro_img = '$hinhanh',
                    pro_quantity = '$soluong',
                    pro_price = '$giasanpham',
                    pro_des= '$mota',
                    category_id = '$danhmuc'
                    WHERE pro_id = '$id'";
        }else {
            move_uploaded_file($tmp_hinhanh, $path.$hinhanh);
            $sql_update_img = "UPDATE tbl_product SET
                    pro_name = '$tensanpham',
                    pro_img = '$hinhanh',
                    pro_quantity = '$soluong',
                    pro_price = '$giasanpham',
                    pro_des= '$mota',
                    category_id = '$danhmuc'
                    WHERE pro_id = '$id'";
        }
        mysqli_query($con, $sql_update_img);
    }
    if(isset($_GET['xoa'])) {
        $id = $_GET['xoa'];
        $sql_delete_product = mysqli_query($con,"DELETE FROM tbl_product WHERE pro_id = '$id'");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Thống kê<span class="sr-only"></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="xulydonhang.php">Đơn hàng <span class="sr-only"></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="xulydanhmuc.php">Danh mục</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="xulysanpham.php">Sản phẩm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="xulykhachhang.php">Khách hàng</a>
            </li>
            </ul>
        </div>
    </nav>
    <br>
    <div class="container">
        <div class="row">
            <?php
                if(isset($_GET['quanly']) == 'capnhat') {
                    $id_update = $_GET['capnhat_id'];
                    $sql_update_product = mysqli_query($con,"SELECT * FROM tbl_product where pro_id = '$id_update'");
                    $row_update_product = mysqli_fetch_array($sql_update_product);
                    $category_id_product = $row_update_product['category_id'];
            ?>
            <div class="col-md-4">
                <h4>Cập nhật sản phẩm</h4>
                <form action="" method="post" enctype= multipart/form-data>
                    <label for="">Tên sản phẩm</label>
                    <input type="text" name="tensanpham" class="form-control" value="<?php echo $row_update_product['pro_name']?>"><br>
                    <input type="hidden" name="id_danhmuc" class="form-control" value="<?php echo $row_update_product['pro_id']?>"><br>
                    <label for="">Hình ảnh</label>
                    <input type="file" name="hinhanh" class="form-control"><br>
                    <img src="../uploads/<?php echo $row_update_product['pro_img']?>" width="80px" height="80px" alt=""><br>
                    <label for="">Số lượng</label>
                    <input type="text" name="soluong" class="form-control" value="<?php echo $row_update_product['pro_quantity']?>"><br>
                    <label for="">Giá</label>
                    <input type="text" name="giasanpham" class="form-control" value="<?php echo $row_update_product['pro_price']?>"><br>
                    <label for="">Mô tả</label>
                    <textarea name="mota" class="form-control"><?php echo $row_update_product['pro_des']?></textarea><br>
                    <?php 
                        $select_category = mysqli_query($con, "SELECT * FROM tbl_category ORDER BY category_id DESC");
                    ?>
                    <select name="danhmuc" class="form-control">
                        <option value="0">------Chọn Danh Mục--------</option>
                    <?php 
                        while($row_category = mysqli_fetch_array($select_category)) {
                            if($category_id_product == $row_category['category_id']) {
                    ?>
                        <option selected value="<?php echo $row_category['category_id']?>"><?php echo $row_category['category_name']?></option>
                    <?php 
                            }else {
                    ?>
                        <option value="<?php echo $row_category['category_id']?>"><?php echo $row_category['category_name']?></option>
                    <?php 
                            }
                        }
                    ?>
                    </select><br>
                    <input type="submit" name="capnhatsp" value="Cập nhật sản phẩm" style="background-color: aquamarine;" class="btn">
                </form>
            </div>
            <?php
                }else {
            ?>
            <div class="col-md-4">
                <h4>Thêm sản phẩm</h4>
                <form action="" method="post" enctype= multipart/form-data>
                    <label for="">Tên sản phẩm</label>
                    <input type="text" name="tensanpham" class="form-control" placeholder="Tên sản phẩm"><br>
                    <label for="">Hình ảnh</label>
                    <input type="file" name="hinhanh" class="form-control"><br>
                    <label for="">Số lượng</label>
                    <input type="text" name="soluong" class="form-control" placeholder="Số lượng"><br>
                    <label for="">Giá</label>
                    <input type="text" name="giasanpham" class="form-control" placeholder="Giá sản phẩm"><br>
                    <label for="">Mô tả</label>
                    <textarea name="mota" class="form-control"></textarea><br>
                    <?php 
                        $select_category = mysqli_query($con, "SELECT * FROM tbl_category ORDER BY category_id DESC");
                    ?>
                    <select name="danhmuc" class="form-control">
                        <option value="0">------Chọn Danh Mục--------</option>
                    <?php 
                        while($row_category = mysqli_fetch_array($select_category)) {
                    ?>
                        <option value="<?php echo $row_category['category_id']?>"><?php echo $row_category['category_name']?></option>
                    <?php 
                        }
                    ?>
                    </select><br>
                    
                    <input type="submit" name="themsanpham" value="Thêm sản phẩm" style="background-color: aquamarine;" class="btn">
                </form>
            </div>
            <?php 
                }
            ?>
            
            <div class="col-md-8">
                <h4>Liệt kê sản phẩm</h4>
                <?php 
                    $sql_select_product = mysqli_query($con, "SELECT * FROM tbl_product, tbl_category
                     WHERE tbl_product.category_id = tbl_category.category_id
                     ORDER BY tbl_product.pro_id DESC");
                ?>
                <table class="table table-reponsive table-bordered table-triped">
                    <tr>
                        <th>Thứ Tự</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <!-- <th>Mô Tả</th> -->
                        <th>Danh mục</th>
                        <th>Số lượng</th>
                        <th>Giá sản phẩm</th>
                        <th>Quản lí</th>
                    </tr>
                <?php
                    $i = 0;
                    while($row_select_product = mysqli_fetch_array($sql_select_product)) {
                        $i++;
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $row_select_product['pro_name']?></td>
                            <td><img src="../uploads/<?php echo $row_select_product['pro_img']?>" 
                            style="widht: 80px; height: 80px;" alt=""></td>
                            <td><?php echo $row_select_product['category_name']?></td>
                            <td><?php echo $row_select_product['pro_quantity']?></td>
                            <td><?php echo $row_select_product['pro_price']?></td>
                            <td><a href="?xoa=<?php echo $row_select_product['pro_id']?>">Xoá</a> || 
                                <a href="?quanly=capnhat&capnhat_id=<?php echo $row_select_product['pro_id']?>">Cập Nhật</a></td>
                        </tr>
                    </tbody>
                <?php 
                    }
                ?>
                </table>
                
            </div>
        </div>
    </div>
</body>
</html>