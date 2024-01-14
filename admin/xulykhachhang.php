<?php
    include_once('../db/connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng</title>
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
            <!--  -->
            <div class="col-md-15">
                <h4>Liệt kê danh sách khách hàng</h4>
                <table class="table table-reponsive table-bordered table-triped">
                    <tr>
                        <th>Thứ Tự</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Ngày mua</th>
                        <th>Quản lý</th>
                    </tr>
                <?php 
                    $sql_select_cus = mysqli_query($con, "SELECT * FROM tbl_customer, tbl_giaodich
                     WHERE tbl_customer.cus_id=tbl_giaodich.cus_id GROUP BY tbl_giaodich.magiaodich ORDER BY tbl_customer.cus_id DESC");
                    $i = 0;
                    while($row_select_cus = mysqli_fetch_array($sql_select_cus)) {
                        $i++;
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $row_select_cus['name']?></td>
                            <td><?php echo $row_select_cus['phone']?></td>
                            <td><?php echo $row_select_cus['email']?></td>
                            <td><?php echo $row_select_cus['address']?></td>
                            <td><?php echo $row_select_cus['ngaythang']?></td>
                            <td><a href="?quanly=xemgiaodich&khachhang=<?php echo $row_select_cus['magiaodich']?>">Xem giao dich khach hang</a></td>
                        </tr>
                    </tbody>
                <?php 
                    }
                ?>
                </table>
                
            </div>
            <!--  -->
            <div class="col-md-12">
                <h4>Liệt kê lịch sữ đơn hàng</h4>
                <table class="table table-reponsive table-bordered table-triped">
                    <tr>
                        <th>Thứ Tự</th>
                        <th>Mã giao dịch</th>
                        <th>Tên sản phẩm</th>
                        <th>Ngày đặt hàng</th>
                    </tr>
                <?php 
                    if(isset($_GET['khachhang'])) {
                        $magiaodich = $_GET['khachhang'];
                    }else {
                        $magiaodich = '';
                    }
                    $sql_select_order = mysqli_query($con, "SELECT * FROM tbl_product, tbl_customer, tbl_giaodich
                    WHERE tbl_giaodich.pro_id = tbl_product.pro_id and tbl_giaodich.cus_id = tbl_customer.cus_id
                    and tbl_giaodich.magiaodich = '$magiaodich'
                    ORDER BY tbl_giaodich.giaodich_id DESC");
                    $i = 0;
                    while($row_select_order = mysqli_fetch_array($sql_select_order)) {
                        $i++;
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $row_select_order['magiaodich']?></td>
                            <td><?php echo $row_select_order['pro_name']?></td>
                            <td><?php echo $row_select_order['ngaythang']?></td>
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