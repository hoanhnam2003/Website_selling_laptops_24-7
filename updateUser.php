<?php
    require_once "connection.php";
    $idUser = $_GET['id'];
    $sql = "SELECT * FROM user WHERE user_id = $idUser";
    $user = $conn->query($sql)->fetch();
    $errors = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $sex = $_POST['sex'];
        $date = $_POST['date'];
        $email = $_POST['email'];
        $role = $_POST['role'];
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
             $sql1 = "UPDATE user SET user_name='$username', email='$email', password='$password', phone='$phone', role='$role', date='$date', sex='$sex' WHERE user_id = $idUser";
             $conn->query($sql1)->fetch();

             header('location: admin.php');
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
        <form class="col-3" method="post">
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">UserName</label>
                <input type="text" class="form-control" name='username' value='<?= $user['user_name'] ?>' placeholder="Nhập vào user name ...">
                <span style="color: red;"><?= $errors['user'] ?? ""?></span>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value='<?= $user['email'] ?>' placeholder="Nhập vào Email">
                <span style="color: red;"><?= $errors['email'] ?? ""?></span>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" value='<?= $user['password'] ?>' placeholder="Nhập vào mật khẩu ...">
                <span style="color: red;"><?= $errors['pass'] ?? ""?></span>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value='<?= $user['phone'] ?>' placeholder="Nhập vào số điện thoại ...">
                <span style="color: red;"><?= $errors['phone'] ?? ""?></span>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label for="inputZip" class="form-label">Date</label>
                    <input type="date" class="form-control" name='date' value='<?= $user['date'] ?>' id="inputZip">
                    <span style="color: red;"><?= $errors['date'] ?? ""?></span>
                </div>
                <div class="col-md-6">
                    <label for="inputState" class="form-label">Sex</label>
                    <select id="inputState" name="sex" class="form-select">
                        <option value="" <?php echo $user['sex'] == '' ? 'selected' : ''; ?>>Chọn giới tính</option>
                        <option value="Nam" <?php echo $user['sex'] == 'Nam' ? 'selected' : ''; ?>>Nam</option>
                        <option value="Nữ" <?php echo $user['sex'] == 'Nữ' ? 'selected' : ''; ?>>Nữ</option>
                    </select>
                    <span style="color: red;"><?= $errors['sex'] ?? ""?></span>
                </div>
                <div class="col-md-12">
                    <label for="inputState" class="form-label">Role</label>
                    <select id="inputState" name="role" class="form-select">
                        <option value="User" <?php echo $user['role'] == 'User' ? 'selected' : ''; ?>>User</option>
                        <option value="Admin" <?php echo $user['role'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                    </select>
                    <span style="color: red;"><?= $errors['sex'] ?? ""?></span>
                </div>        
            </div>
            <button type="submit" class="btn btn-primary col-12">Update</button>
        </form>
    </div>
</body>
</html>

