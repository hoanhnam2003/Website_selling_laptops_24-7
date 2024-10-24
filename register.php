<?php
    require_once "connection.php";
    $errors = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $sex = $_POST['sex'];
        $date = $_POST['date'];
        $email = $_POST['email'];
        $role = 'User';
        if(empty($username)){
            $errors['user'] = "Bạn chưa nhập tên đăng nhập.";
        }
        if(empty($password)){
            $errors['pass'] = "Bạn chưa nhập mật khẩu."; 
        }
        if(empty($phone)){
            $errors['phone'] = "Bạn chưa nhập số điện thoại."; 
        }
        if(empty($sex)){
            $errors['sex'] = "Bạn chưa nhập giới tính."; 
        }
        if(empty($date)){
            $errors['date'] = "Bạn chưa nhập ngày sinh."; 
        }
        if(empty($email)){
            $errors['email'] = "Bạn chưa nhập email."; 
        }
        if(empty($errors)){
            $sql = "INSERT INTO user VALUES (null, '$username', '$password','$email' , '$phone', '$role', '$date','$sex')";
            $conn->query($sql)->fetch();
            header('location: login.php');
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
        <form class="col-3 formLog" method="post">
            <h2 class="text-center">Register</h2>
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">UserName</label>
                <input type="text" class="form-control" name='username' placeholder="Nhập vào user name ...">
                <span style="color: red;"><?= $errors['user'] ?? ""?></span>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Nhập vào Email">
                <span style="color: red;"><?= $errors['email'] ?? ""?></span>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Nhập vào mật khẩu ...">
                <span style="color: red;"><?= $errors['pass'] ?? ""?></span>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" placeholder="Nhập vào số điện thoại ...">
                <span style="color: red;"><?= $errors['phone'] ?? ""?></span>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label for="inputZip" class="form-label">Date</label>
                    <input type="date" class="form-control" name='date' id="inputZip">
                    <span style="color: red;"><?= $errors['date'] ?? ""?></span>
                </div>
                <div class="col-md-6">
                    <label for="inputState" class="form-label">State</label>
                    <select id="inputState" name="sex" class="form-select">
                        <option selected value="">Chọn giới tính</option>
                        <option>Nam</option>
                        <option>Nữ</option>
                    </select>
                    <span style="color: red;"><?= $errors['sex'] ?? ""?></span>
                </div>             
            </div>
            <button type="submit" class="btn btn-primary col-12">Register</button>
            <p style="text-align: center;" ><a href = "login.php" style ="color: black;">Login</a></p>
        </form>
    </div>
</body>
</html>

