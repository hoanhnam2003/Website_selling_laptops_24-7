<?php
    include_once 'connection.php';
    $sql1 = "SELECT * FROM category";
    $categorys = $conn->query($sql1)->fetchAll();
    $errors = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $productname = $_POST['productname'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $file = $_FILES['img'];
        $img = $file['name']; 
        if(empty($productname)){
            $errors['l1'] = "Không được bỏ trống trường này"; 
        }
        if(empty($price)){
            $errors['l2'] = "Không được bỏ trống trường này"; 
        }
        if(empty($quantity)){
            $errors['l3'] = "Không được bỏ trống trường này"; 
        }
        if(empty($category)){
            $errors['l4'] = "Không được bỏ trống trường này"; 
        }
        if(empty($description)){
            $errors['l5'] = "Không được bỏ trống trường này"; 
        }
        if(empty($img)){
            $errors['l6'] = "Không được bỏ trống trường này"; 
        }
        if(empty($errors)){
            move_uploaded_file($file['tmp_name'], 'image/' . $img);
            $sql = "INSERT INTO product VALUES (NULL, '$productname', '$description', '$price', '$quantity', '$img', '$category')";
            $conn->query($sql);
            header("location: listPro.php");
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
                <input type="text" class="form-control" name="productname" placeholder='Nhập vào tên sản phẩm'>
                <span style="color: red;"><?= $errors['l1'] ?? ''?></span>
            </div>
            <div class="mb-3">
                <input class="form-control" type="file" name='img' id="formFile" >
                <span style="color: red;"><?= $errors['l6'] ?? ''?></span>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <input type="number" class="form-control"  name="price" placeholder="Price" min=0>
                    <span style="color: red;"><?= $errors['l2'] ?? ''?></span>
                </div>
                <div class="col">
                    <input type="number" class="form-control" name="quantity" placeholder="Số lượng" min=0>
                    <span style="color: red;"><?= $errors['l3'] ?? ''?></span>
                </div>
            </div>
            <select class="form-select" name='category'>
                <option selected value="">Loại sản phẩm</option>
                    <?php foreach($categorys as $key => $value) : ?>
                    <option value="<?= $value['category_id']?>" ><?= $value['category_name']?></option>
                    <?php endforeach ?>
            </select>
            <span style="color: red;"><?= $errors['l4'] ?? ''?></span>
            <div class="form-floating mt-3">
                <textarea class="form-control" placeholder="Leave a comment here" name="description" id="floatingTextarea"></textarea>
                <label for="floatingTextarea">Nhập vào mô tả</label>
            </div>
            <span style="color: red;"><?= $errors['l5'] ?? ''?></span>
            <button type="submit" class="btn btn-primary col-12 my-3">Create product</button>
        </form>
    </div>
</body>
</html>

