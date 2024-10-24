<?php
    include_once 'connection.php';
    $idCate = $_GET['id'];
    $sql = "SELECT * FROM category WHERE category_id = $idCate";
    $category = $conn->query($sql)->fetch();
    $errors = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $categoryname = $_POST['categoryname'];   
        if(empty($categoryname)){
            $errors['l1'] = "Không được bỏ trống trường này"; 
        }
        if(empty($errors)){
            move_uploaded_file($file['tmp_name'], 'image/' . $img);
            $sql = "UPDATE category SET category_name='$categoryname' WHERE category_id=$idCate";
            $conn->query($sql);
            header("location: listCate.php");
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
            <div class="mb-3">
                <input type="text" class="form-control" name="categoryname" value="<?= $category['category_name']?>" placeholder='Nhập vào tên danh muc'>
                <span style="color: red;"><?= $errors['l1'] ?? ''?></span>
            </div>
            <button type="submit" class="btn btn-primary col-12">Update category</button>
        </form>
    </div>
</body>
</html>

