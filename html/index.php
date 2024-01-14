<?php
    session_start();
    include_once('../db/connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Đăng nhập</title>
</head>
<body>
<h1 style="text-align: center" class="mt-20">ĐĂNG NHẬP</h1>
    <?php 
        // session_destroy();
        if(isset($_POST['login'])) {
            $user = $_POST['email_login'];
            $pass = md5($_POST['pass_login']);
            if($user==''|| $pass=='') {
                echo '<script>alert("Vui lòng nhập đầy đủ thông tin hoặc xem lại tài khoản, mật khẩu")</script>';
            }else {
                $sql_login = mysqli_query($con, "SELECT * FROM tbl_user 
                WHERE user_email = '$user' AND user_pass = '$pass'");
                $count = mysqli_num_rows($sql_login);
                $row_login = mysqli_fetch_array($sql_login);
                if($count > 0) {
                    $_SESSION['name'] = $row_login['user_name'];
                    $_SESSION['user_id'] = $row_login['user_id'];
                    header('Location: trangchu.php');
                }else {
                    echo '<script>alert("Vui lòng nhập đầy đủ thông tin hoặc xem lại tài khoản, mật khẩu")</script>';
                }
            }
        }
    ?>

    <form action="" method="post" class="form-control">
    <!-- Email input -->
        <div class="container mt-5 pt-5 col-4">
            <div class="row">
                <div class="form-outline mb-6 mt-3">
                    <label class="form-label" for="form2Example1">Email address</label>
                    <input name="email_login" type="email" id="form2Example1" class="form-control" required />
                </div>

                <!-- Password input -->
                <div class="form-outline mb-6 mt-3">
                    <label class="form-label" for="form2Example2">Password</label>
                    <input name="pass_login" type="password" id="form2Example2" class="form-control" required />
                </div>
                <!-- Submit button -->
                <input name="login" type="submit" class="btn btn-primary btn-block mb-6 mt-3" value="Đăng nhập"></input>
                <!-- Register buttons -->
                <div class="text-center mt-3">
                    <p>Bạn không có tài khoản <a href="signup.php">Đăng ký</a></p>
                </div>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>