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
    // gửi mail
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';
    if(isset($_POST['send'])){
        $name = htmlentities($_POST['name']);
        $email = htmlentities($_POST['email']);
        // $subject = htmlentities($_POST['subject']);
        $message = htmlentities($_POST['message']);
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hoanhnam2003@gmail.com';
        $mail->Password = 'jsnknhoolbqxdhtg';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->isHTML(true);
        $mail->setFrom($email, $name);
        $mail->addAddress('hoanhnam2003@gmail.com');
        $mail->Subject = ("$email");
        $mail->Body = $message;
        $mail->send();
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
        <div class = "lienhe" style = "margin-top: 10px; display: flex; justify-content: space-around;">
            <div class = "map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d930.9346120730228!2d105.80594676957931!3d21.043148850455253!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab1633e3a849%3A0x1d13efa44ff7a863!2zMjMgTmcuIDQ2MiDEkC4gQsaw4bufaSwgVsSpbmggUGjDuiwgQmEgxJDDrG5oLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1703871824303!5m2!1svi!2s"
                width="600" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="thongtin_lienhe">
                <h4>Thông tin liên hệ</h4>
                <p style="color: black">Tên công ty: Lpc_24/7</p>
                <p style="color: black">Hotline: 0398898989</p>
                <p style="color: black">Địa chỉ: 23/462 Đường Bưởi, Phường Vĩnh Phúc, Quận Ba Đình, Hà Nội</p>
                <form  method="post">
                    <div class="mb-3">
                        <label for="nameField" class="form-label">Name</label>
                        <input type="text" class="form-control" id="nameField" name="name" placeholder="Name" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="emailField" class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailField" name="email" placeholder="Email" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="messageField" class="form-label">Message</label>
                        <textarea class="form-control" id="messageField" rows="3" name="message" placeholder="Message..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name = "send"> Send <i class="fa-solid fa-paper-plane color-white margin-left-1-rem"></i></button>
                </form>
            </div>
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
