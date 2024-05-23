<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item Category</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/stylemain.css">
    <link rel="stylesheet" href="css/editbook.css">
</head>

<body>
    <header>
        <a href="javascript:history.go(-1);" class="ahead">
            
            <h4>Go Back</h4>
        </a>
    </header>

    <?php
    include 'connect.php';

    function addGenre($con, $Genre, $location)
    {
        $sql = "INSERT INTO category (ItemCategory, img) VALUES (?, ?);";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $Genre, $location); // Fixed the binding parameters

        try {
            $stmt->execute();
            echo "<script>alert('Category added successfully!');</script>";
            echo "<script>window.location.href = 'editgenre.php';</script>";
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                echo "<script>alert('Category already exists!');</script>";
            } else {
                echo "Error adding genre: " . $e->getMessage();
            }
        }

        $stmt->close();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $Genre = isset($_POST["genre"]) ? $_POST["genre"] : '';

        if (isset($_FILES['bookImage']) && $_FILES['bookImage']['size'] > 0) {
            $name = $_FILES['bookImage']['name'];
            $tmp_name = $_FILES['bookImage']['tmp_name'];
            $location = "upload/items/$name";
            if (move_uploaded_file($tmp_name, $location)) {
                $bookImage = $location; // Update $bookImage with the new file path
            } else {
                echo "Error uploading file.";
                exit;
            }
        } else {
            $bookImage = "default_image_path.jpg";
        }

        addGenre($con, $Genre, $location);
    }
    ?>
    <section>
        <div class="wrapper" id="w3">
            <h2 style="font-size: 30px;">Add Category</h2><br>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                <div class="weditimg" style="width: unset">
                    <img id='profileImage' style='width: unset' src=''>
                    <label class="btn-upload-img">
                        Upload Item Image <input type="file" id="img" name="bookImage" accept="image/*">
                    </label>
                </div>
                Genre: <input type="text" name="genre" value="" required><br>
                <input type="submit" value="Add">
            </form>
        </div>
    </section>
</body>
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

</html>
