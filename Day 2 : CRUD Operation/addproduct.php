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
    <form action="controller/addProduct_controller.php" method="post">
        <div class="addproduct" style="margin-bottom: 5px;">
            <label for="name">Product Name:</label>
            <input type="text" name="name" id="name">
            <span style="color: red;">*</span>
        </div>
        <div class="addproduct" style="margin-bottom: 5px;">
            <label for="brand">Brand Name:</label>
            <input type="text" name="brand" id="brand">
            <span style="color: red;">*</span>
        </div>

        <div class="addproduct" style="margin-bottom: 5px;">
            <label for="oPrice">Original Price:</label>
            <input type="text" name="oPrice" id="oPrice">
            <span style="color: red;">*</span>
        </div>
        <div class="addproduct" style="margin-bottom: 5px;">
            <label for="sPrice">Selling Price:</label>
            <input type="text" name="sPrice" id="sPrice">
            <span style="color: red;">*</span>
        </div>
        <button type="submit" value="submit" name="submit">Submit</button>
        <button type="reset">Reset</button>
    </form>



    <?php
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        echo "<div style='color:red;'>$message</div>";
    }
    ?>

</body>

</html>
