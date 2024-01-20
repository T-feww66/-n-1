<?php 
    session_start();
    if(!isset($_SESSION['dangnhap'])) {
        header('Location: index.php');
    }
    if(isset($_GET['login'])) {
        $dangxuat = $_GET['login'];
    }else {
        $dangxuat = '';
    }

    if($dangxuat == 'dangxuat') {
        header('Location: index.php');
    }

    // thong ke
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
        <!-- link bieu do -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title>Thành công</title>
</head>
<body>
    <a href="?login=dangxuat">Log out</a>
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

    <p>Thống kê đơn hàng theo: <span id="text-date"></span></p>
    <select class="select-date">
        <option value="7ngay">7 ngay qua</option>
        <option value="28ngay">28 ngay qua</option>
        <option value="90ngay">90 ngay qua</option>
        <option value="365ngay">365 ngay qua</option>
    </select>
    <div id="chart" style="height: 250px;"></div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script>
        $(document).ready(function(){
            thongke();
            var char = new Morris.Area({
            element: 'chart',
            xkey: 'date',
            ykeys: ['date', 'order', 'sales', 'quantity'],
            labels: ['Ngày đặt hàng', 'Đơn hàng', 'Doanh thu', 'Số lượng bán']
            });

            $('.select-date').change(function() {
                var thoigian = $(this).val();
                if(thoigian== '7ngay') {
                   var text = '7 ngày qua';
                }else if(thoigian == '28ngay') {
                   var text = '28 ngày qua';
                }else if(thoigian == '90ngay') {
                   var text = '90 ngày qua';
                }else {
                   var text = '365 ngày qua';
                }

                $.ajax({
                    url:'thongke.php',
                    method: "POST",
                    dataType: "JSON",
                    data: {thoigian:thoigian},
                    success:function(data){
                        char.setData(data);
                        $('#text-date').text(text);
                    }
                })
            })
            function thongke() {
                var text = '365 ngay qua';
                $('#text-date').text(text);
                $.ajax({
                    url:'thongke.php',
                    method: "POST",
                    dataType: "JSON",
                    success:function(data){
                        char.setData(data);
                        $('#text-date').text(text);
                    }
                })
            }
        })
    </script>
</body>
</html>