<?php
require_once "dbcon.php";

// Check if the form is submitted
if (isset($_POST['submit'])) {

    // Validate the form fields
    if (
        empty($_POST['name']) || empty($_POST['brand']) ||
        empty($_POST['oPrice']) || empty($_POST['sPrice'])
    ) {
        $error = "Please fill all the required fields..!";
        header("location:../addproduct.html?message=$error");
        exit(); // Always exit after header redirect
    } else {
        

        // Display product info (For testing/debugging)
        // echo "$product_name, $brand, $original_price, $selling_price";

        try {

            // Prepare the SQL query with placeholders to avoid SQL injection
            $query = $conn->prepare("INSERT INTO products (product_name, brand, original_price, selling_price)
             VALUES (:product_name, :brand, :original_price, :selling_price)");


            // Bind the form values to the placeholders in the query
            $query->bindParam(':product_name', $_POST['name']);
            $query->bindParam(':brand', $_POST['brand']);
            $query->bindParam(':original_price', $_POST['oPrice']);
            $query->bindParam(':selling_price', $_POST['sPrice']);

            // Execute the query
            $query->execute();
            header("location:../index.php?message=Product added successfuly..!");
        } catch (PDOException $e) {
            //throw exception
            echo "Something went wrong..!" . $e->getMessage();
        }
    }
}

?>
