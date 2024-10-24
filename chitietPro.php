<?php
    require_once "connection.php";
    $idPro = $_GET['id'];
    $checkAdmin = false;
    $userId =  "";
    if(!empty($_COOKIE)){
        $userId = $_COOKIE['userId'];
        $_COOKIE['role'] === 'Admin' ? $checkAdmin = true : $checkAdmin = false;
    } 
    // thêm giỏ hầng và kiểm tra giỏ hàng
    $sql = "SELECT product.*, category_name FROM product JOIN category ON product.category_id = category.category_id WHERE product_id = $idPro";
    $product = $conn->query($sql)->fetch();
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $userId) {
        $quantity = $_POST['quantity'];
        $id = $_POST['id'];
        $checkQuery = "SELECT * FROM cart WHERE product_id = $id AND user_id = $userId";
        $checkResult = $conn->query($checkQuery);
        if ($checkResult->rowCount() > 0) {
            $updateQuery = "UPDATE cart SET quantity = quantity + $quantity WHERE product_id = $id AND user_id = $userId";
            $conn->query($updateQuery);
        } else {
            $insertQuery = "INSERT INTO cart (product_id, quantity, user_id) VALUES ($id, $quantity, $userId)";
            $conn->query($insertQuery);
        }
    } 
    // Tính tổng số lượng sản phẩm trong giỏ hàng của người dùng hiện tại
    $totalItemsQuery = "SELECT SUM(quantity) as totalItems FROM cart WHERE user_id = $userId";
    $totalItemsResult = $conn->query($totalItemsQuery);
    $totalItems = $totalItemsResult->fetch()['totalItems'];
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
    <link rel="stylesheet" type="text/css" href="style2.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style2.css">
    <title>Product</title>
</head>
<body>
    <div class='container'>
        <header>
            <img src="image/logo.png" alt="">
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
        <section class='box_conten'>
            <div class='box_img'>
                <img src="image/<?= $product['image']; ?>" alt="<?= $product['image']; ?>">
            </div>          
            <div class='box_text'>
                <h1><?= $product['product_name']; ?></h1>
                <p class='dd'>Giá: <span><?php echo number_format($product['price'], 0, ',', '.'); ?> VND</span></p>
                <form action="" method="post">
                <input type="hidden" name="id" value="<?= $product['product_id'] ?>">
                <div class='svm'>
                    <p class="number">Số lượng: </p>
                    <div class="number-control">
                        <div class="number-left"></div>
                        <input type="number" name="quantity" min=1  value=1 class="number-quantity">
                        <div class="number-right"></div>
                    </div>
                    <p>Sản phẩm có sẵn: <?= $product['quantity'] ?></p>
                </div>
                <button type="submit" class="btn btn-primary col-4 my-3">Mua ngay</button>
                </form>            
                <p>Mô tả:</p>
                <p class='mt'><?= nl2br($product['description']); ?></p>
                <p>Phân loại: <?= $product['category_name']; ?></p>     
            </div>
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
