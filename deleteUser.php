<?php
    require_once "connection.php";
    if(isset($_GET['id']) && is_numeric($_GET['id'])) {
        $userId = $_GET['id'];
        // Xóa các bản ghi từ bảng bill liên quan đến user bạn đang xóa
        $sql_bill = "DELETE FROM bill WHERE user_id = ?";
        $stmt_bill = $conn->prepare($sql_bill);
        $stmt_bill->execute([$userId]);
        // Tiếp theo, sau khi đã xóa các bản ghi từ bảng bill, xóa các bản ghi từ bảng cart tham chiếu đến user
        $sql_cart = "DELETE FROM cart WHERE user_id = ?";
        $stmt_cart = $conn->prepare($sql_cart);
        $stmt_cart->execute([$userId]);
        // Cuối cùng, sau khi đã xóa các bản ghi từ bảng cart, xóa bản ghi từ bảng user
        $sql_user = "DELETE FROM user WHERE user_id = ?";
        $stmt_user = $conn->prepare($sql_user);
        $stmt_user->execute([$userId]);

        // Kiểm tra xem có bản ghi nào bị xóa không
        if($stmt_user->rowCount() > 0) {
            header('Location: admin.php');
            exit;
        } else {
            echo "Không thể xóa người dùng hoặc người dùng không tồn tại.";
            // Xử lý lỗi tại đây nếu cần thiết
        }
    } else {
        echo "ID người dùng không hợp lệ.";
        // Xử lý lỗi tại đây nếu cần thiết
    }
    $conn = null; // Đóng kết nối
?>
