<?php
include 'connect.php';
include 'query.php';
$getCartItemsQuery = "SELECT cart.cart_id, items.ItemID  , items.ItemName, items.ItemImage, cart.quantity, items.price
                     FROM cart
                     INNER JOIN items ON cart.ItemID   = items.ItemID  
                     WHERE cart.customer_id = $UserID";
$result = mysqli_query($con, $getCartItemsQuery);


$totalCartValue = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Cart</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/footer.css">
</head>

<body>
    <?php
    include("header2.php");
    include("popups.php");
    ?>
    <section class="wrapper">
        <div class="body2">
            <h1>Your Cart</h1>
            <div class="cart-container">
                <form method="post" action="" id="cartForm" enctype="multipart/form-data">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $totalPrice = $row['quantity'] * $row['price'];
                        $totalCartValue += $totalPrice;
                        ?>
                        <div class="cart-item">
                            <input type="checkbox" name="selectedItems[]" value="<?= $row['cart_id']; ?>"
                                onchange="updateTotal(this)">
                            <img src="<?= $row['ItemImage']; ?>" alt="Product Image" class="cart-item-image">
                            <div class="cart-item-details">
                                <p>
                                    <?= $row['ItemName']; ?>
                                </p>
                                <p>Quantity:
                                    <?= $row['quantity']; ?>
                                </p>
                                <?php
                                echo "<p class='total-price'>Total Price: PHP $totalPrice</p>";
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="cart-total">
                        <button type="submit" name="deleteSelected" formaction="deleteCartItem.php"
                            onclick="return confirmAction()">Remove
                            Selected</button>
                        <button type="submit" name="buySelected" formaction="processCartAction.php">Buy Now</button>
                        <p style="color: #111; font-weight: bold;">Total Selected Item Price:</p>
                        <span id="totalCartValue" style="color: #ff4081; font-size: 18px; margin-bottom: 0;">PHP <?= $totalCartValue = 0; $totalCartValue; ?>.00
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php include("footer.php"); ?>
    <script>
        function confirmAction() {
            var checkboxes = document.getElementsByName('selectedItems[]');

            // Check if no checkbox is selected
            var checkedBoxes = Array.from(checkboxes).filter(checkbox => checkbox.checked);
            if (checkedBoxes.length === 0) {
                alert("Please select an item to proceed to checkout.");
                return false;
            } else {
                if (confirm("Would you like to confirm the deletion of selected items?")) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        function updateTotal(checkbox) {
            var checkboxes = document.getElementsByName('selectedItems[]');
            var total = 0;

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    var totalPriceElement = checkboxes[i].closest('.cart-item').querySelector('.total-price');
                    var totalPriceText = totalPriceElement.textContent.trim();

                    var totalPrice = parseFloat(totalPriceText.replace(/[^\d]/g, ''));
                    total += totalPrice;
                }
            }

            document.getElementById('totalCartValue').textContent = total.toFixed(2);
        }
    </script>

</body>

</html>