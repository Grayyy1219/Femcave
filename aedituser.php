<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Femcave</title>
    <link rel="icon" href="Image/logo.ico">

    <?php
    include("connect.php");
    include("query.php");
    echo "<style>
        body {
            background-color: $backgroundcolor;
        }
        .fade-overlay {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0), $backgroundcolor);
    </style>";
    ?>
    <style>
        body {
            background-color: #fce8e8;
            
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        a {
            text-decoration: none;
            color: black;
        }

        header {
            background-color: #ff80bf;
            
            padding: 10px;
            text-align: center;
        }

        .wrapper {
            background-color: #fff;
            
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            
            margin: 20px auto;
            max-width: 600px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form {
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .weditimg {
            text-align: center;
            margin-bottom: 30px;
        }

        #profileImage {
            max-width: 100%;
            height: auto;
            border-radius: 50%;
            
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            
        }

        .btn-upload-img {
            background-color: #ff80bf;
            color: #fff;
            
            padding: 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            width: 100%;
            max-width: 300px;
            text-align: center;
        }

        .btn-upload-img:hover {
            background-color: #cc66a6;
            
        }

        .inweform {
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
        }

        .weitem {
            flex: 1;
        }
        input {
            padding: 15px;
            border: 1px solid #ff80bf;
            
            border-radius: 8px;
            margin-bottom: 20px;
            transition: border-color 0.3s ease;
            width: 100%;
        }

        input:focus {
            outline: none;
            border-color: #cc66a6;
            
        }

        .btn-save {
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        .btnsave {
            background-color: #ff80bf;
            
            color: #fff;
            
            padding: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            max-width: 300px;
            text-align: center;
        }

        .btnsave:hover {
            background-color: #cc66a6;
            
        }
    </style>

</head>


<body>
    <header>
        <a href="admin.php" class="ahead">

            <h4>Go Back</h4>
        </a>
    </header>
    <section></a>
        <div class="wrapper" id="w1">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="wedit">
                    <div class="weditimg">
                        <?php
                        echo "<img id='profileImage' src='$alocation' alt='Profile Picture'>";
                        ?>
                        <label class="btn-upload-img">
                            Upload Profile Picture <input type="file" style="display: none;" id="img" name="img" accept="image/*">
                        </label>
                    </div>
                    <div class="weform">
                        <div class="inweform">
                            <div class="weitem">
                                <div class="border">
                                    <p>Full Name:</p>
                                </div>
                                <?php
                                echo "<input type='text' name='first_name' value='$aFName'>";
                                ?>
                            </div>
                            <div class="weitem">
                                <div class="border">
                                    <p>Address:</p>
                                </div>
                                <?php
                                echo "<input type='text' name='address' value='$aaddress'>";
                                ?>
                            </div>
                        </div>
                        <div class="inweform">
                            <div class="weitem">
                                <div class="border">
                                    <p>Email:</p>
                                </div>
                                <?php
                                echo "<input type='text' name='email' id='emailInput' value='$aemail' style='text-transform: none;' pattern='.*\.com' title='Please enter a valid email address'>";
                                ?>

                            </div>
                            <div class="weitem">
                                <div class="border">
                                    <p>Phone:</p>
                                </div>
                                <?php
                                echo "<input type='tel' name='phone' value='$aphone' pattern='^(\d{11}|\d{12}|\d{13})?$' title='Enter 11 or 13 digits'>";
                                ?>

                            </div>
                            <label class="btn-save">
                                <div class="btnsave">
                                    Save Changes <input formaction="aupdateuser.php" type="submit" name="submit" style="all: unset;">
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script>
        function closeSettingsPopup() {
            document.getElementById('SettingsPopup').style.display = 'none';
            var overlay = document.querySelector('.popup-overlay');
            overlay.style.opacity = 0;
            setTimeout(function () {
                overlay.style.display = 'none';
            }, 300);
        }

        function showSettingsPopup() {
            document.getElementById("SettingsPopup").style.display = "block";
            setTimeout(function () {
                document.getElementById("spopup-overlay").style.display = "block";
            }, 10);
        }

        function closeSettingsPopup() {
            document.getElementById("spopup-overlay").style.display = "none";
            document.getElementById("SettingsPopup").style.display = "none";
        }
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