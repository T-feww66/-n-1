<?php
    session_start();
    include_once('../db/connect.php');
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- favicon -->
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
        <link
            href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
            rel="stylesheet"
        />
        <title>headerigation | TFeww</title>
    </head>
    <body>
        <?php
            if(!isset($_SESSION['name'])) {
                header('Location: index.php');
            }

            if(isset($_GET['login'])) {
                $dangxuat = $_GET['login'];
            }else {
                $dangxuat = '';
            }

            if($dangxuat == 'dangxuat') {
                $sql_delete = mysqli_query($con, "DELETE FROM tbl_cart");
                header('Location: index.php');
            }
        ?>
        <?php
            if(isset($_GET['quanly'])) {
                $tam = $_GET['quanly'];
            }else {
                $tam = '';
            }
            include('../include/header.php');
            if($tam =='chitietsp') { 
               include('../include/chitietproduct.php');
            }elseif($tam == 'chitietdonhang'){
                include('../include/chitietdonhang.php');
            }elseif($tam =='giohang') {
               include('../include/cart.php');
                
            }else if($tam == 'hoadon'){
                include('../include/xemdonhang.php');
            }elseif($tam == 'timkiem') {
                include('../include/search.php');
            }else {
                include('../include/product.php');
            }
            include('../include/footer.php');
        ?>
    </body>
</html>
