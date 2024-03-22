<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeHive - Products</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .card {
        width: 300px;
        padding: 20px;
        margin: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .image {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .image img {
        width: 100%;
        height: auto;
        transition: transform 0.3s ease;
    }

    .image:hover img {
        transform: scale(1.1);
    }

    .content h2 {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .price {
        color: #4CAF50;
        font-weight: bold;
    }

    .button {
        display: inline-block;
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .button:hover {
        background-color: #45a049;
    }
</style>

<body>
    <div class="container">
        <?php

        $servername = "localhost";
        $username = "root";
        $password = "ruchit19";
        $database = "homehive";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT p.*, pi.product_quantity FROM product AS p INNER JOIN productinventory AS pi ON p.product_id = pi.product_id WHERE p.category_id = 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productName = $row['product_name'];
                $productPrice = $row['product_price'];
                $productImage = $row['product_image_url'];
                $productQuantity = $row['product_quantity'];

                $stockStatus = ($productQuantity == 0) ? 'Out of Stock' : (($productQuantity > 0 && $productQuantity <= 5) ? 'Few pieces left' : '');

        ?>
                <div class="card">
                    <div class="image">
                        <img src="<?php echo $productImage; ?>" alt="Product Image">
                    </div>
                    <div class="content">
                        <h2><?php echo $productName; ?></h2>
                        <p class="price">$<?php echo $productPrice; ?></p>
                        <p><?php echo $stockStatus; ?></p>
                        <a href="product_details.php?id=<?php echo $row['product_id']; ?>" class="button">View Details</a>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "No products found.";
        }
        ?>
    </div>
</body>

</html>