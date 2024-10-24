<?php
    require_once "connection.php";
    $sql = "SELECT * FROM product";
    $products = $conn->query($sql)->fetchAll();
    $checkAdmin = false;
    $userId = "";
    if(!empty($_COOKIE)){
        $userId = $_COOKIE['userId'];
        $_COOKIE['role'] == 'Admin' ? $checkAdmin = true : $checkAdmin = false;
    }
    //tìm kiếm sản phẩm
    if (isset($_GET['search_submit'])) { 
        $searchTerm = $_GET['timkiem']; 
        $sql = "SELECT * FROM product WHERE product_name LIKE :searchTerm";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $stmt->execute();
        $products = $stmt->fetchAll(); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style2.css">
    <title>Trang Chủ</title>
</head>
<body>
    <div class='container'>
        <header>
            <img src="image/logo.png" alt="" style="margin-left: 16px;">
            <form action="home.php" method="GET">
                <div class="timkiem">
                    <input type="text" placeholder="Nhập tìm kiếm sản phẩm" name="timkiem">
                    <button type="submit" name="search_submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
            <nav>
                <ul>
                    <li><a href="home.php">Trang Chủ</a></li>
                    <li><a href="product.php">Sản Phẩm</a></li>
                    <?= $checkAdmin ? "<li><a href='admin.php'>Admin</a></li>" : ($userId ? "<li><a href='cart.php'>Giỏ hàng</a></li>" : "") ?>
                    <li><?= !empty($_COOKIE) ? "<a href='logout.php'>Đăng xuất</a>" : "<a href='login.php'>Đăng nhập</a>" ?></li>
                </ul>
            </nav>
        </header>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="image/banner-bo-may-vi-tinh.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="image/sua-chua-01.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="image/dich-vu-cai-dat-may-tinh-tai-nha.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <section class="featured-products">  
            <h1 class="names">Sản phẩm</h1>
            <div class='row'>
                <?php foreach($products as $key => $value) : ?> 
                    <div class="col-lg-3">
                        <div class="item">
                            <img src="image/<?= $value['image']?>" alt="">
                            <h1><a href="chitietPro.php?id=<?= $value['product_id']?>"><?= $value['product_name']?></a></h1>
                            <div class="price">
                                <p>Giá: <?= number_format($value['price'], 0, ',', '.')?> VND</p>
                            </div>
                            <a href="chitietPro.php?id=<?= $value['product_id']?>"><button type="button" class="btn btn-primary col-12">Xem chi tiết</button></a>
                        </div>
                    </div>
                <?php endforeach ?>    
            </div> 
            <div class='d-flex justify-content-center'><a href="product.php"><button type="button" class="btn col-12 mb-3 btn-outline-primary">Xem thêm</button></a></div>
        </section>
        <footer>
           <div class = "boxfooter">
                <div class = "center1">
                    <p class = "text_a">THÔNG TIN</p>
                    <p>Giới thiệu về lpc_24/7</p>
                    <p>Tin tức</p>
                    <p>Tin Tuyển Dụng</p>
                    <p><a href = "lienhe.php" style = "color: white;">Liên hệ - góp ý</a></p>
                </div>
                <div class = "center1">
                    <p class = "text_a">HỖ TRỢ KHÁCH HÀNG</p>
                    <p>Hướng dẫn mua hàng trực tuyến</p>
                    <p>Hướng dẫn thanh toán</p>
                    <p>Hướng dẫn mua hàng trả góp</p>
                    <p>In hoá đơn điện tử</p>
                </div>
                <div class = "center1">
                    <p class = "text_a">CHÍNH SÁCH CHUNG</p>
                    <p>Chính sách vận chuyển</p>
                    <p>Chính sách bảo hành</p>
                    <p>Chính sách cho doanh nghiệp</p>
                    <p>Bảo mật thông tin khách hàng</p>
                </div>
                <div class = "center1">
                    <p class = "text_a">TỔNG ĐÀI HỖ TRỢ</p>
                    <p>Hotline: 0398898989</p>
                    <p>Email: hoanhnam2003@gmail.com</p>
                    <a href = "https://www.facebook.com/" style = "color: white;"><i class="fa-brands fa-facebook"></i></a>
                    <a href = "https://www.instagram.com/?hl=en" style = "color: white;"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
            <p style = "text-align: center; font-size: 20px; margin-bottom: 0;"><b>Bản quyền thuộc về Lpc_24/7</b></p>
        </footer>
    </div>
</body>
</html>
