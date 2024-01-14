<?php
    session_start();
    include_once('../db/connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="57x57" href="../assets/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="../assets/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="../assets/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="../assets/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="../assets/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="../assets/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="../assets/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="../assets/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="../assets/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="../assets/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
        <link rel="manifest" href="../assets/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="../assets/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="../assets/styles.css" />
    <title>Đăng nhập Admin</title>
</head>
<body>
    <?php 
        // session_destroy();
        if(isset($_POST['dangnhap'])) {
            $user = $_POST['taikhoan'];
            $pass = md5($_POST['matkhau']);
            if($user==''|| $pass=='') {
                echo '<script>alert("Vui lòng nhập đầy đủ thông tin hoặc xem lại tài khoản, mật khẩu")</script>';
            }else {
                $sql_admin = mysqli_query($con, "SELECT * FROM tbl_admin 
                WHERE taikhoan = '$user' AND matkhau = '$pass' LIMIT 1");
                $count = mysqli_num_rows($sql_admin);
                $row_admin = mysqli_fetch_array($sql_admin);
                if($count > 0) {
                    $_SESSION['dangnhap'] = $row_admin['admin_name'];
                    $_SESSION['admin_id'] = $row_admin['admin_id'];
                    header('Location: dashboard.php');
                }else {
                    echo '<script>alert("Vui lòng nhập đầy đủ thông tin hoặc xem lại tài khoản, mật khẩu")</script>';
                }
            }
        }
    ?>
    <h1 style="text-align: center" class="mt-20">ĐĂNG NHẬP VÀO TÀI KHOẢN ADMIN</h1>
    <div class="mt-20">
        <form action="" method="post">
            <div class="content">
                <label for="">Tài Khoản</label>
                <br>
                <input type="text" name="taikhoan" placeholder="Tài khoản" class="input">
                <br>
                <label for="">Mật Khẩu</label>
                <br>
                <input type="password" name="matkhau" placeholder="Mật khẩu" class="input">
                <br>
                <input type="submit" class="button mt-20" name="dangnhap" value="Đăng Nhập"></input> 
            </div>             
        </form>
    </div>
</body>
</html>