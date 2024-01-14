<!---------------------------- header--------------------- -->
    <header>
            <div id="header">
                <div class="content">
                    <div class="nav">
                        <div class="logo">
                            <a href="./trangchu.php">TFeww</a>
                        </div>
                        <div class="sidebar">
                            <ul class="lists">
                                <li><a href="trangchu.php">Trang chủ</a></li>
                                <li><a href="sanpham.php">Sản phẩm</a></li>
                                <li><a href="?login=dangxuat">Log out</a></li>
                                <li><a href="?quanly=chitietdonhang&khachhang=<?php echo $_SESSION['user_id']?>">Xem đơn hàng</a></li>
                            </ul>
                        </div>

                        <div class="orther-if">
                            <form action="sanpham.php?quanly=timkiem" method="post" class="search">
                                <input
                                    type="search"
                                    name="search_text"
                                    value=""
                                    placeholder="Tìm sản phẩm tại đây"
                                    class="search-text"
                                />
                                <button type="submit" name="search" class="search-btn">
                                    <i class="bx bx-search-alt-2 icon"></i>
                                </button>
                            </form>
                            <!-- -----------cart---------------- -->
                            <div class="cart">
                                <a href="?quanly=giohang" class="cart-icon">
                                    <i class="bx bx-cart-alt icon"></i>
                                    Giỏ Hàng
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>