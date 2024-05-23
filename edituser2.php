<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/admin.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f4f9;
            color: #6a5d7b;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        section {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 0px;
        }

        .wedit {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .weditimg {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #profileImage {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .btn-upload-img {
            display: inline-block;
            padding: 10px;
            background-color: #ff6b9b;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
            margin-top: 10px;
        }

        .weform {
            width: 60%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .inweform {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center;
        }

        .weitem {
            display: flex;
            flex-direction: column;
        }

        .border {
            border-bottom: 2px solid #ff6b9b;
            padding-bottom: 5px;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="tel"] {
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            min-width: 280px;
        }

        #emailInput {
            text-transform: none;
        }

        .btn-save {
            margin-top: 20px;
        }

        .btnsave {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff6b9b;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }

        .btnsave input {
            display: none;
        }

        .btnsave:hover {
            background-color: #e45287;
        }
    </style>
</head>
<?php
include("connect.php");
include("query.php");

$UserID = $_GET['UserID'];
$queryUser = mysqli_query($con, "SELECT * FROM users WHERE UserID = $UserID");
$rowUser = mysqli_fetch_assoc($queryUser);
$location = $rowUser["profile"];
$FName = $rowUser["FName"];
$LName = $rowUser["LName"];
$address = $rowUser["address"];
$email = $rowUser["email"];
$phone = $rowUser["phone"];
include("aheader.php");
?>

<body>
    <section>
        <div class="wrapper" id="w1">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="UserID" value="<?php echo "$UserID"; ?>" ;>
                <div class="wedit">
                    <div class="weditimg">
                        <?php
                        echo "<img id='profileImage' src='$location' alt='Profile Picture'>";
                        ?>
                        <label class="btn-upload-img">
                            Upload Profile Picture <input type="file" id="img" name="img" accept="image/*"
                                style="display: none;">
                        </label>
                    </div>
                    <div class="weform">
                        <div class="inweform">
                            <div class="weitem">
                                <div class="border">
                                    <p>Full Name:</p>
                                </div>
                                <?php
                                echo "<input type='text' name='first_name' value='$FName'>";
                                ?>
                            </div>
                            <div class="weitem">
                                <div class="border">
                                    <p>Address:</p>
                                </div>
                                <?php
                                echo "<input type='text' name='address' value='$address'>";
                                ?>
                            </div>
                        </div>
                        <div class="inweform">
                            <div class="weitem">
                                <div class="border">
                                    <p>Email:</p>
                                </div>
                                <?php
                                echo "<input type='text' name='email' id='emailInput' value='$email' style='text-transform: none;' pattern='.*\.com' title='Please enter a valid email address'>";
                                ?>

                            </div>
                            <div class="weitem">
                                <div class="border">
                                    <p>Phone:</p>
                                </div>
                                <?php
                                echo "<input type='tel' name='phone' value='$phone' pattern='^(\d{11}|\d{12}|\d{13})?$' title='Enter 11 or 13 digits'>";
                                ?>

                            </div>
                            
                            <label class="btn-save">
                                <div class="btnsave">
                                    Save Changes <input formaction="aupdateuser2.php" type="submit" name="submit">
                                </div>
                            </label>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </section>
    <script>
        document.getElementById('img').addEventListener('change', function (event) {
            const fileInput = event.target;
            const profileImage = document.getElementById('profileImage');

            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    profileImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>