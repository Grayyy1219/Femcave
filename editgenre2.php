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

    function getGenreDetails($con, $GenreID)
    {
        $sql = "SELECT * FROM category WHERE CategoryID = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $GenreID);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    function updateGenreDetails($con, $GenreID, $location, $title)
    {
        $sql = "UPDATE category SET ItemCategory = ?, img = ? WHERE CategoryID = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssi", $title, $location, $GenreID);
        $stmt->execute();

        if ($stmt->errno) {
            echo "Error updating record: " . $stmt->error;
        } else {
            echo "<script>alert('Category updated successfully!');</script>";
            echo "<script>window.location.href = 'editgenre.php';</script>";
        }

        $stmt->close();
    }

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $GenreID = isset($_POST["GenreID"]) ? $_POST["GenreID"] : '';
        $title = isset($_POST["title"]) ? $_POST["title"] : '';

        $location = ''; // Initialize $location
    
        if (isset($_FILES['bookImage']) && $_FILES['bookImage']['size'] > 0) {
            $name = $_FILES['bookImage']['name'];
            $tmp_name = $_FILES['bookImage']['tmp_name'];
            $location = "upload/items/$name";
            if (move_uploaded_file($tmp_name, $location)) {
                // File uploaded successfully
            } else {
                echo "Error uploading file.";
                exit;
            }
        } else {
            $location = "default_image_path.jpg";
        }

        // Additional validation can be added here for other form fields.
    
        updateGenreDetails($con, $GenreID, $location, $title);
    }

    $GenreID = isset($_GET["GenreID"]) ? $_GET["GenreID"] : '';
    $GenreDetails = getGenreDetails($con, $GenreID);

    if ($GenreDetails) {
        ?>
        <section>
            <div class="wrapper" id="w3">
                <h2 style="font-size: 30px;">Edit Item Category</h2><br>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
                    enctype="multipart/form-data">
                    <input type="hidden" name="GenreID"
                        value="<?php echo htmlspecialchars($GenreDetails['CategoryID']); ?>">
                    <div class="weditimg" style="width: unset">
                        <img id='profileImage' style='width: unset'
                            src='<?php echo htmlspecialchars($GenreDetails['img']); ?>'>
                        <label class="btn-upload-img">
                            Upload Item Image <input type="file" id="img" name="bookImage" accept="image/*">
                        </label>
                    </div>
                    Title: <input type="text" name="title"
                        value="<?php echo htmlspecialchars($GenreDetails['ItemCategory']); ?>"><br>
                    <input type="submit" value="Update">
                </form>
            </div>
        </section>
        <?php
    } else {
        echo "Genre not found";
    }
    ?>
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