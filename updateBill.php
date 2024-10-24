<?php
    include_once 'connection.php';
    $idBill = $_GET['id'];
    $sql = "SELECT * FROM bill WHERE bill_id = $idBill";
    $bill = $conn->query($sql)->fetch();
    $errors = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $status = $_POST['status'];     
        if(empty($status)){
            $errors['l1'] = "Không được bỏ trống trường này"; 
        }
        if(empty($errors)){        
            $sql1 = "UPDATE bill SET trangthai='$status' WHERE bill_id=$idBill";
            $conn->query($sql1);
            header("location: listBill.php");
            die;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class='boxCreate'>
        <form method="post" enctype='multipart/form-data'>
            <select class="form-select mb-3" name='status' >
                <option selected value=''>Open this select menu</option>
                <option value="Đang chuẩn bị hàng" <?= $bill['trangthai'] === 'Đang chuẩn bị hàng' ? 'selected' : '' ?>>Đang chuẩn bị hàng</option>
                <option value="Đang giao hàng" <?= $bill['trangthai'] === 'Đang giao hàng' ? 'selected' : '' ?>>Đang giao hàng</option>
                <option value="Giao hàng thành công" <?= $bill['trangthai'] === 'Giao hàng thành công' ? 'selected' : '' ?>>Giao hàng thành công</option>
            </select>
            <span style="color: red;"><?= $errors['l1'] ?? ''?></span>
            <button type="submit" class="btn btn-primary col-12">Update Bill</button>
        </form>
    </div>
</body>
</html>

