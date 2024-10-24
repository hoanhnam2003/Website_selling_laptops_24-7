<?php
    require_once "connection.php";
    if(isset($_GET['id']) && is_numeric($_GET['id'])) {
        $idSp = $_GET['id'];
        // Trước tiên, xóa các bản ghi từ bảng cart tham chiếu đến product bạn đang xóa
        $sql_cart = "DELETE FROM cart WHERE product_id = ?";
        $stmt_cart = $conn->prepare($sql_cart);
        $stmt_cart->execute([$idSp]);
        // Tiếp theo, sau khi đã xóa các bản ghi từ bảng cart, xóa các bản ghi từ bảng product
        $sql_product = "DELETE FROM product WHERE product_id = ?";
        $stmt_product = $conn->prepare($sql_product);
        $stmt_product->execute([$idSp]);
        // Kiểm tra xem có bản ghi nào bị xóa không
        if($stmt_product->rowCount() > 0) {
            header('Location: listPro.php');
            exit;
        } else {
            echo "Không thể xóa sản phẩm hoặc sản phẩm không tồn tại.";
            // Xử lý lỗi tại đây nếu cần thiết
        }
    } else {
        echo "ID sản phẩm không hợp lệ.";
        // Xử lý lỗi tại đây nếu cần thiết
    }
    $conn = null; // Đóng kết nối
?>
