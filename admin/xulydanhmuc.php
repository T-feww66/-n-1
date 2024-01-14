<?php
    include_once('../db/connect.php');
?>

<?php 
    if(isset($_POST['themdanhmuc'])) {
        $tendanhmuc = $_POST['danhmuc'];
        $sql_insert_category = mysqli_query($con, "INSERT INTO tbl_category(category_name) VALUES('$tendanhmuc')");
    }elseif(isset($_POST['capnhatdanhmuc'])) {
        $id_update_post = $_POST['id_danhmuc'];
        $cate_name = $_POST['danhmuc'];
        $sql_update = mysqli_query($con, "UPDATE tbl_category SET category_name = '$cate_name'
                        WHERE category_id = $id_update_post");
    }
    if(isset($_GET['xoa'])) {
        $id = $_GET['xoa'];
        $sql_delete_category = mysqli_query($con,"DELETE FROM tbl_category WHERE category_id = '$id'");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục</title>
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
                    $id_update = $_GET['id'];
                    $sql_update_category = mysqli_query($con,"SELECT * FROM tbl_category where category_id = '$id_update'");
                    $row_update_category = mysqli_fetch_array($sql_update_category);
            ?>
            <div class="col-md-4">
                 <h4>Cập nhật danh mục</h4>
                 <form action="" method="post">
                     <label for="">Tên danh mục</label>
                     <input type="text" class="form-control" value="<?php echo $row_update_category['category_name']?>" name="danhmuc"><br>
                     <input type="hidden" class="form-control" value="<?php echo $row_update_category['category_id']?>" name="id_danhmuc"><br>
                     <input type="submit" name="capnhatdanhmuc" value="Cập nhật danh mục" style="background-color: aquamarine;" class="btn">
                 </form>
             </div>
            <?php
                }else {
            ?>
            <div class="col-md-4">
                <h4>Thêm danh mục</h4>
                <form action="" method="post">
                    <label for="">Tên danh mục</label>
                    <input type="text" class="form-control" placeholder="Tên danh mục" name="danhmuc"><br>
                    <input type="submit" name="themdanhmuc" value="Thêm danh mục" style="background-color: aquamarine;" class="btn">
                </form>
            </div>
            <?php 
                }
            ?>
            
            <div class="col-md-8">
                <h4>Liệt kê danh mục</h4>
                
                <table class="table table-reponsive table-bordered table-triped">
                    <tr>
                        <th>Thứ Tự</th>
                        <th>Tên danh mục</th>
                        <th>Quản lý</th>
                    </tr>
                <?php 
                    $sql_select_category = mysqli_query($con, "SELECT * FROM tbl_category ORDER BY category_id DESC");
                    $i = 0;
                    while($row_select_category = mysqli_fetch_array($sql_select_category)) {
                        $i++;
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $row_select_category['category_name']?></td>
                            <td><a href="?xoa=<?php echo $row_select_category['category_id']?>">Xoá</a> || <a href="?quanly=capnhat&id=<?php echo $row_select_category['category_id']?>">Cập Nhật</a></td>
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