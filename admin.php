<?php
    include_once 'connection.php';
    if(empty($_COOKIE)){
        header('location: login.php');
    }else{
        $_COOKIE['role'] !== 'Admin' ?  header('location: home.php') : "";
    }
    $sql = "SELECT * FROM user";
    $listUers = $conn->query($sql)->fetchAll();
    $sql2 = "SELECT COUNT(*) AS total FROM product";
    $totalResult = $conn->query($sql2);
    $totalRow = $totalResult->fetch(PDO::FETCH_ASSOC);
    $totalProduct = $totalRow['total'];
    $sql3 = "SELECT COUNT(*) AS total_category FROM category";
    $totalResult = $conn->query($sql3);
    $totalRow = $totalResult->fetch(PDO::FETCH_ASSOC);
    $totalCategory = $totalRow['total_category'];
    $sql4 = "SELECT COUNT(*) AS total_user FROM user";
    $totalResult = $conn->query($sql4);
    $totalRow = $totalResult->fetch(PDO::FETCH_ASSOC);
    $totalUser = $totalRow['total_user'];
    $sql5 = "SELECT COUNT(*) AS total_bill FROM bill";
    $totalResult = $conn->query($sql5);
    $totalRow = $totalResult->fetch(PDO::FETCH_ASSOC);
    $totalBill = $totalRow['total_bill'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Admin</title>
</head>
<body>
    <div class='container-fluid bg-primary p-2'>
        <div class='container bg-primar d-flex justify-content-between align-items-center'>
            <a href="home.php"><p class='logo'>ADMIN</p></a>
            <ul>
                <li><a href="admin.php">ListUser</a></li>
                <li><a href="listPro.php">Listpro</a></li>
                <li><a href="listCate.php">ListCate</a></li>
                <li><a href="listBill.php">ListBill</a></li>
                <li><a href="logout.php">Log out</a></li>
            </ul>
        </div>
    </div>
    <div class='container'>
        <div class="row my-2">
            <div class="col">
                <div class="boxO">
                    <p>Tổng số người dùng</p>
                    <p><?= $totalUser ?></p>
                </div>
            </div>
            <div class="col">
                <div class="boxO">
                    <p>Tổng số sản phẩm</p>
                    <p><?= $totalProduct ?></p>
                </div>
            </div>
            <div class="col">
                <div class="boxO">
                    <p>Tổng số danh mục</p>
                    <p><?= $totalCategory ?></p>
                </div>
            </div>
            <div class="col">
            <div class="boxO">
                <p>Tổng số đơn hàng</p>
                <p><?= $totalBill ?></p>
            </div>
        </div>
        </div>  
        <button type="button" class='btn bg-primary my-2'><a href="createUser.php">Create</a></button>
        <table class="table table-striped">
            <tr>
                <th scope="col">STT</th>
                <th scope="col">USER NAME</th>
                <th scope="col">EMAIL</th>
                <th scope="col">PASSWORD</th>
                <th scope="col">PHONE</th>
                <th scope="col">SEX</th>
                <th scope="col">DATE</th>
                <th scope="col">ROLE</th>
                <th colspan='2'>ACTIONS</th>
            </tr>
            <?php 
                if(count($listUers) === 0){
                    echo '<tr><td colspan=8><p style="text-align: center;margin-bottom: 0">Không có tài khoản nào.</td></tr></p>';
                }else{
                    foreach($listUers as $key => $value) : ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td style="text-align: justify;"><?= $value['user_name'] ?></td>
                    <td><?= $value['email'] ?></td>
                    <td style="text-align: justify;"><?= $value['password'] ?></td>
                    <td><?= $value['phone'] ?></td>
                    <td><?= $value['sex'] ?></td>
                    <td><?= $value['date'] ?></td>
                    <td><?= $value['role'] ?></td>
                    <td><button type='button' class="btn btn-success"><a href="updateUser.php?id=<?= $value['user_id']?>">Update</a></button></td>
                    <td><button type='button' class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button></td>
                </tr>
            <?php endforeach; } ?>
        </table>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            Bạn có chắc muốn xóa sản phẩm này không ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary"><a href="deleteUser.php?id=<?= $value['user_id']?>">Delete</a></button>
            </div>
            </div>
        </div>
    </div>
</body>
</html>
