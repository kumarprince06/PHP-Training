<?php
require_once "dbcon.php";

// Check if the form is submitted
if (isset($_POST['submit'])) {

    // Validate the form fields
    if (
        empty($_POST['name']) || empty($_POST['brand']) ||
        empty($_POST['oPrice']) || empty($_POST['sPrice']) ||
        empty($_POST['id']) // Ensure we are getting the product ID
    ) {
        $error = "Please fill all the required fields..!";
        header("location:../editproduct.php?id={$_POST['id']}&message=$error"); // Redirect back with error message
        exit(); // Always exit after header redirect
    } else {
        // Get the product ID and other details
        $product_id = $_POST['id'];
        $product_name = $_POST['name'];
        $brand = $_POST['brand'];
        $original_price = $_POST['oPrice'];
        $selling_price = $_POST['sPrice'];
        $product_name = $_POST['name'];
        $brand = $_POST['brand'];
        $original_price = $_POST['oPrice'];
        $selling_price = $_POST['sPrice'];
        try {
            // Prepare the SQL query to update the product
            $update_query = $conn->prepare("UPDATE products SET product_name = :product_name, brand = :brand,
            original_price = :original_price, selling_price = :selling_price WHERE id = :id");

            // Bind the form values to the placeholders in the query
            $update_query->bindParam(':product_name', $product_name);
            $update_query->bindParam(':brand', $brand);
            $update_query->bindParam(':original_price', $original_price);
            $update_query->bindParam(':selling_price', $selling_price);
            $update_query->bindParam(':id', $product_id); // Bind the ID

            // Execute the query
            $update_query->execute();
            header("location:../index.php?message=Product updated successfully!");
        } catch (PDOException $e) {
            // Throw exception
            echo "Something went wrong: " . $e->getMessage();
        }
    }
}

?>
