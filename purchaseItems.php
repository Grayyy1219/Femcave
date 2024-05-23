<?php
include 'connect.php';
include 'query.php';
session_start();

if (!isset($_SESSION['selectedItems'])) {
    echo "No items selected for purchase.";
    exit();
}

$selectedItems = $_SESSION['selectedItems'];

$getSelectedItemsQuery = "SELECT items.ItemID, items.ItemName, items.ItemImage, cart.Quantity, items.Price
                         FROM cart
                         INNER JOIN items ON cart.ItemID = items.ItemID
                         WHERE cart.customer_id = ?
                         AND cart.cart_id IN ($selectedItems)";
$stmt = mysqli_prepare($con, $getSelectedItemsQuery);
mysqli_stmt_bind_param($stmt, "i", $UserID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    echo "Error retrieving selected items: " . mysqli_error($con);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/stylemain.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <style>
        body {
            font-family: 'Lobster', cursive;
            background: linear-gradient(to bottom, #fce4ec, #fff);
            color: #555;
            margin: 0;
        }

        header {
            background: linear-gradient(to right, #ff4081, #ff8c68);
            color: #fff;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            border-bottom: 2px solid #fff;
        }

        .wrapper {
            max-width: 1200px;
            margin: 100px auto;
            padding: 150px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .checkout-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .item-summary {
            border-bottom: 1px solid #eee;
            padding: 15px;
            display: flex;
            align-items: center;
            transition: background-color 0.3s ease;
        }

        .item-summary:hover {
            background-color: #f9ebf2;
        }

        .item-image {
            max-width: 80px;
            margin-right: 15px;
            border-radius: 5px;
        }

        .checkout-button {
            margin-top: 20px;
            text-align: center;
        }

        .checkout-button button {
            background: #ff4081;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }


        p {
            margin: 0;
        }
    </style>
</head>

<body>
    <?php
    include("header2.php");
    ?>
    <section>

        <div class="wrapper" id="w3">
            <h1>Confirm checkout</h1><br><br><br>
            <div class="checkout-container">
                <?php
                $totalPurchaseValue = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $totalPrice = $row['Quantity'] * $row['Price'];
                    $totalPurchaseValue += $totalPrice;
                    ?>
                    <div class="item-summary">
                        <img src="<?= $row['ItemImage']; ?>" alt="Product Image" class="item-image">
                        <p><strong><?= $row['ItemName']; ?> </strong><br>Quantity: <?= $row['Quantity']; ?><br>Total Price: <strong style="color: #ff4081;">PHP <?= $totalPrice; ?>.00</strong></p>
                    </div>
                    <?php
                }
                ?>
                <div class="checkout-button">
                    <button onclick="checkout()">Checkout</button>
                    <p style="color: #111; font-weight: bold;">Total Purchase Value:</p>
                    <p style="color: #ff4081; font-size: 18px; margin-bottom: 0;"> PHP
                        <?= $totalPurchaseValue; ?>.00
                    </p>
                </div>
            </div>
        </div>
    </section>
    <?php include("footer.php"); ?>

    <script>
        function checkout() {
            window.location.href = "payment.php";
        }
    </script>

</body>

</html>