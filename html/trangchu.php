<?php
    include_once('../db/connect.php');
?>

<?php
    session_start();
    if(!isset($_SESSION['name'])) {
        header('Location: index.php');
    }

    if(isset($_GET['login'])) {
        $dangxuat = $_GET['login'];
    }else {
        $dangxuat = '';
    }

    
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
        <title>Web Ban hang | TFeww</title>
    </head>
    <body>
    <?php 
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
        if($tam =='giohang') { 
            include('../include/cart.php');
        }elseif($tam == 'timkiem') {
            include('../include/search.php');
        }elseif($tam == 'chitietdonhang'){
            include('../include/chitietdonhang.php');
        }elseif($tam == 'hoadon'){
            include('../include/xemdonhang.php');
        }else {
           include('../include/slider.php');
        }
        include('../include/footer.php');
    ?>
        <script>
            // -----------------SLIDER-----------------
            let list = document.querySelector(".slider .list");
            let items = document.querySelectorAll(".slider .list .slider-item");
            let dots = document.querySelectorAll(".slider .dots li");
            let prev = document.getElementById("prev");
            let next = document.getElementById("next");

            let active = 0;
            let lenghtItems = items.length - 1;
            // next
            next.onclick = function () {
                if (active + 1 > lenghtItems) {
                    active = 0;
                } else {
                    active += 1;
                }
                reloadeSlider();
            };

            // prev
            prev.onclick = function () {
                if (active - 1 < 0) {
                    active = lenghtItems;
                } else {
                    active -= 1;
                }
                reloadeSlider();
            };

            let refreshSlider = setInterval(() => {
                next.click();
            }, 3000);
            function reloadeSlider() {
                let checkLeft = items[active].offsetLeft;
                list.style.left = -checkLeft + "px";

                let lastActiveDot = document.querySelector(
                    ".slider .dots li.active"
                );
                lastActiveDot.classList.remove("active");
                dots[active].classList.add("active");
                clearInterval(refreshSlider);
                refreshSlider = setInterval(() => {
                    next.click();
                }, 3000);
            }

            // key la vi tri tuong ung cua the li do
            dots.forEach((li, key) => {
                li.addEventListener("click", function () {
                    active = key;
                    reloadeSlider();
                });
            });
        </script>
    </body>
</html>
