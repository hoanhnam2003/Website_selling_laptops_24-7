<?php
    include_once 'connection.php';
    if(empty($_COOKIE)){
        header('location: login.php');
    }else{
        $_COOKIE['role'] !== 'Admin' ?  header('location: home.php') : "";
    }
    $sql1 = "SELECT * FROM category";
    $listCategorys = $conn->query($sql1)->fetchAll();  
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
            <button type="button" class='btn bg-primary my-2'><a href="createCate.php">Create</a></button>
        <table class="table table-striped">
            <tr>
                <th scope="col">STT</th>
                <th scope="col">CATEGORY NAME</th>
                <th colspan='2'>ACTIONS</th>
            </tr>
            <?php 
                if(count($listCategorys) === 0){
                    echo '<tr><td colspan=8><p style="text-align: center;margin-bottom: 0">Không có danh mục nào.</td></tr></p>';
                }else{
                    foreach($listCategorys as $key => $value) : ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $value['category_name'] ?></td>
                        
                        <td><button type='button' class="btn btn-success"><a href="updateCate.php?id=<?= $value['category_id']?>">Update</a></button></td>
                        <td><button type='button' class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button></td>
                    </tr>
            <?php endforeach; } ?>
        </table>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc muốn xóa danh mục này không ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"><a href="deleteCate.php?id=<?= $value['category_id']?>">Delete</a></button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
