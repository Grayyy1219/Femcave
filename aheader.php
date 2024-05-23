<header>
    <a href="admin.php" class="a"><img src="<?php echo $logo ?>" width="50" alt="Logo">
        <div class="logoname"><strong>Admin Page</strong></div>
    </a>
    <div class="header">
        <a class="a" href="admin.php#page">Page</a>
        <a class="a" href="blockuser.php">Users</a>
        <a class="a" href="admin.php#inventory">Inventory</a>
        <a class="a" href="admin.php#dashboard">Fast & Slow</a>
        <a class="a" href="paymenthistory.php?search=&start_date=&end_date=&submit=">Payment</a>
        <a class="a" href="printreport.php">Reports</a>
        <a onclick='showSettingsPopup()' class="a" href="#settings">Settings</a>
    </div>
    <?php include 'apopups.php'; ?>
    <a class="a" id="logout" href="logout.php">Log out</a>
</header>