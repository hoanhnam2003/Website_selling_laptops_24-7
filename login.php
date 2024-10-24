<?php
    require_once "connection.php";
    $errors = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(empty($email)){
            $errors['email'] = "Bạn chưa nhập tên đăng nhập.";
        }

        if(empty($password)){
            $errors['pass'] = "Bạn chưa nhập mật khẩu."; 
        }

        if(empty($errors)){   
            $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
            $result = $conn->query($sql)->fetch();
            print_r($result);
            $role = $result ? $result['role'] : "";
            $userId = $result['user_id'];
            if(!empty($result)){
            setcookie("userId", "$userId", time() + 60 * 60);
            setcookie("email", "$email", time() + 60 * 60);
            setcookie("role", "$role", time() + 60 * 60); 
            header("location: home.php");
            }
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
            <h2 class="text-center">Login</h2>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Tên đăng nhập ...">
                <span style="color: red;"><?= $errors['email'] ?? ""?></span>
            </div>
            <div class="mb-4">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu ...">
                <span style="color: red;"><?= $errors['pass'] ?? ""?></span>
            </div>
            <button type="submit" class="btn btn-primary col-12">Submit</button>
            <p style="text-align: center;" ><a href = "register.php" style ="color: black;">Register</a></p>
        </form>
    </div>
</body>
</html>

