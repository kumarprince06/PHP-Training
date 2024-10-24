<?php

require_once "controller/dbcon.php";

try {
    // Prepare statement to get all the products
    $query = $conn->prepare("SELECT * FROM products");
    $query->execute();

    // Fetch all products as an associative array
    $products = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    //throw Exception
    echo "Something went wrong..!" . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Product</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <h1>Product Listing</h1>
    <a href="addproduct.php"><button style="margin-bottom: 10px;">Add Product</button></a>

    <table style="width:100%; text-align:center;">
        <thead>
            <tr>
                <th>Id</th>
                <th>Product Name</th>
                <th>Brand Name</th>
                <th>Original Price</th>
                <th>Selling Price</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through the products array and display each product
            foreach ($products as $product) {
                echo "<tr>
                            <td>{$product['id']}</td>
                            <td>{$product['product_name']}</td>
                            <td>{$product['brand']}</td>
                            <td>Rs {$product['original_price']}</td>
                            <td>Rs {$product['selling_price']}</td>
                            <td>
                                <a href='editproduct.php?id={$product['id']}'><button>Edit</button></a>
                                <a href='deleteproduct.php?id={$product['id']}' onclick='return confirm(\"Are you sure you want to delete this product?\");'><button>Delete</button></a>
                            </td>
                        </tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    if (isset($_GET['message'])) {

        $message = $_GET['message'];
        echo "<div style='color:green; margin-top:10px; font-size:20px; font-weight: bold;'> $message </div>";
    }
    ?>

</body>

</html>