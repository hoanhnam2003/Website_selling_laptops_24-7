<?php
    require_once "connection.php";
    $checkAdmin = false;
    $userId = $_COOKIE['userId'];
    if(!empty($_COOKIE)){
        $_COOKIE['role'] === 'Admin' ? $checkAdmin = true : $checkAdmin = false;
    }
    $sql = "SELECT product.product_id, product.image, product.product_name, product.price, cart.quantity, cart.cart_id 
    FROM product JOIN cart ON product.product_id = cart.product_id WHERE cart.user_id = $userId";    
    $listCart = $conn->query($sql)->fetchAll();
    // tổng bill
    $totalPrice = 0;
    foreach ($listCart as $key => $value) {
        $itemTotal = $value['quantity'] * $value['price'];
        $totalPrice += $itemTotal;
    }
    // thông tin đơn hàng
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $ngay_hien_tai = date("Y-m-d");
        $trangthai = 'Đang chuẩn bị hàng';
        $sqls = "INSERT INTO bill VALUES(null, '$ngay_hien_tai', '$trangthai', '$userId', '$totalPrice')";
        $conn->query($sqls);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
        <nav aria-label="breadcrumb" class='mt-2'>
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">cart</li>
            </ol>
        </nav>
        <div class='d-flex'>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Product_name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total Price</th>
                        <th scope="col" style ="text-align: center;">Clear</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listCart as $key => $value) : ?>
                    <tr>
                        <th scope="row" ><?= $key + 1 ?></th>
                        <td width='500px' >
                            <div class='d-flex gap-2'><img width='100' src="./image/<?= $value['image']?>" alt="">
                            <?= $value['product_name']?></td></div>
                        <td><span><?php echo number_format($value['price'], 0, ',', '.'); ?> VND</span></td>
                        <td><?= $value['quantity']?></td>
                        <td><span><?php echo number_format($value['quantity'] * $value['price'] , 0, ',', '.'); ?> VND</span></td>
                        <td style ="text-align: center;">
                            <a href="deleteCart.php?id=<?= $value['cart_id']?>">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
                <thead>
                    <tr>
                        <th colspan="4">Total payment</th>
                        <th colspan="2">
                           <?php
                            echo number_format($totalPrice, 0, ',', '.') . " VND";  
                           ?> 
                        </th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th  colspan="4"></th>
                        <th colspan="2">
                            <div class="donhang">
                            <form method="POST" ><button type="submit" class="btn btn-primary col-5" onclick="return alert('Thanh toán thành công')">Thanh Toán</button></form>
                            </div>
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
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