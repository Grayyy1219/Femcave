<style>
.settings {
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    font-family: 'Arial', cursive; 
}

.settings input {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    border-radius: 5px;
}

.settings input[type="password"] {
    background-color: #fce4ec; 
}


.settings input[type="submit"] {
    background-color: #d63485; /* Solid color for the button */
    color: #fff; /* White text color */
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .settings {
        max-width: 100%;
    }
}

</style>
<?php $email = $_GET['email']; ?>
<form action="updateresetpassword.php" class="settings" method="post" enctype="multipart/form-data">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    New Password: <input type="password" name="password">
    Confirm Password: <input type="password" name="cpassword">
    <input type="submit" value="Change">
</form>