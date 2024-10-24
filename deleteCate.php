<?php
    require_once "connection.php";
    if(isset($_GET['id']) && is_numeric($_GET['id'])) {
        $categoryId = $_GET['id'];
        // Xóa các bản ghi từ bảng cart liên quan đến bảng product tham chiếu đến category bạn đang xóa
        $sql_cart = "DELETE FROM cart WHERE product_id IN (SELECT product_id FROM product WHERE category_id = ?)";
        $stmt_cart = $conn->prepare($sql_cart);
        $stmt_cart->execute([$categoryId]);
        // Tiếp theo, sau khi đã xóa các bản ghi từ bảng cart, xóa các bản ghi từ bảng product tham chiếu đến category
        $sql_product = "DELETE FROM product WHERE category_id = ?";
        $stmt_product = $conn->prepare($sql_product);
        $stmt_product->execute([$categoryId]);
        // Cuối cùng, sau khi đã xóa các bản ghi từ bảng product, xóa bản ghi từ bảng category
        $sql_category = "DELETE FROM category WHERE category_id = ?";
        $stmt_category = $conn->prepare($sql_category);
        $stmt_category->execute([$categoryId]);
        // Kiểm tra xem có bản ghi nào bị xóa không
        if($stmt_category->rowCount() > 0) {
            header('Location: listCate.php');
            exit;
        } else {
            echo "Không thể xóa danh mục hoặc danh mục không tồn tại.";
            // Xử lý lỗi tại đây nếu cần thiết
        }
    } else {
        echo "ID danh mục không hợp lệ.";
        // Xử lý lỗi tại đây nếu cần thiết
    }
    $conn = null; // Đóng kết nối
?>
