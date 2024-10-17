<?php
require_once "controller/dbcon.php";

// Check if the id is set in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Prepare statement to delete the product
    $delete_query = $conn->prepare("DELETE FROM products WHERE id = :id");
    $delete_query->bindParam(':id', $product_id);

    if ($delete_query->execute()) {
        header("Location: index.php?message=Product deleted successfully!");
        exit();
    } else {
        echo "Error deleting product!";
    }
} else {
    echo "Invalid request!";
    exit();
}
?>
