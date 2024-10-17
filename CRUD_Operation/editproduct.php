<?php

require_once "controller/dbcon.php";

// Check if the id is set in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Prepare statement to fetch product details
    $query = $conn->prepare("SELECT * FROM products WHERE id = :id");
    $query->bindParam(':id', $product_id);
    $query->execute();

    // Fetch the product
    $product = $query->fetch(PDO::FETCH_ASSOC);
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>

<body>
    <h1 style="text-align: center;">Add Product</h1>
    <p style="color: red;">* required fields </p>
    <form action="controller/updateProduct_controller.php" method="post">
        <input type="number" hidden value="<?php echo $product['id']; ?>" name="id" id="id">
        <div class="addproduct" style="margin-bottom: 5px;">
            <label for="name">Product Name:</label>
            <input type="text" name="name" id="name" value="<?php echo $product['product_name']; ?>">
            <span style="color: red;">*</span>
        </div>
        <div class="addproduct" style="margin-bottom: 5px;">
            <label for="brand">Brand Name:</label>
            <input type="text" name="brand" id="brand" value="<?php echo $product['brand']; ?>">
            <span style="color: red;">*</span>
        </div>

        <div class="addproduct" style="margin-bottom: 5px;">
            <label for="oPrice">Original Price:</label>
            <input type="text" name="oPrice" id="oPrice" value="<?php echo $product['original_price']; ?>">
            <span style="color: red;">*</span>
        </div>
        <div class="addproduct" style="margin-bottom: 5px;">
            <label for="sPrice">Selling Price:</label>
            <input type="text" name="sPrice" id="sPrice" value="<?php echo $product['selling_price']; ?>">
            <span style="color: red;">*</span>
        </div>
        <button type="submit" value="Update" name="submit">Update</button>
        <button type="reset">Reset</button>
    </form>

</body>

</html>

