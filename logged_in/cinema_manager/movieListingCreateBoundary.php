<?php
    session_start();

    // Check if a message is passed in the URL
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        echo "<script>alert('" . $message . "');</script>";
        unset($_GET['message']); // Unset the message to prevent it from persisting after page refresh
    }

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Booking System - Create Movie Listing</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<header>
    
        <div class="logo">
            <img src="../../images\logo.jpg" alt="JKS Cinema Ticket Booking System">
        </div>

        <nav>
            <ul>
            <li><a href="managerhomeBoundary.php">Home</a></li>
            <li><a href="../contactUsBoundary.php">About Us</a></li>
            <li><a href="aboutUsBoundary.php">Contact Us</a></li>
            </ul>
        </nav>

        <div class="welcome">
            <h1>Welcome Back <?php echo $_SESSION['username']; ?> !</h1>
        </div>

        <div class="user-actions">
            <a href="../../loginBoundary.php" class="logout-btn">Log Out</a>
        </div>
</header>

<section class="hero">
    <div class="hero-content">    
        <h1>Create Movie Listing</h1>
            <div class="search-container">
            <form method="POST" enctype="multipart/form-data">
                <label for="uploadImage">Upload an Image with the same Movie Name:</label>
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="UploadImage" name="uploadImage">
            </form>
            <br>
            <?php
                $target_dir = "../../images/Themes/";
                $uploadOk = 1;

                if(isset($_POST["uploadImage"]) && isset($_FILES["fileToUpload"])) {
                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if($check !== false) {
                        echo '<span style="color: white;">File is an image - ' . $check["mime"] . '.</span>';
                        $uploadOk = 1;

                        // Check if file already exists
                        if (file_exists($target_file)) {
                            echo '<span style="color: white;">Sorry, file already exists.</span>';
                            $uploadOk = 0;
                        }

                        // Check file size
                        if ($_FILES["fileToUpload"]["size"] > 500000) {
                            echo '<span style="color: white;">Sorry, your file is too large.</span>';
                            $uploadOk = 0;
                        }

                        // Allow certain file formats
                        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
                        if (!in_array($imageFileType, $allowedExtensions)) {
                            echo '<span style="color: white;">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</span>';
                            $uploadOk = 0;
                        }

                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                            echo '<span style="color: white;">Sorry, your file was not uploaded.</span>';
                        } else {
                            // if everything is ok, try to upload file
                            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                echo '<span style="color: white;">The file ' . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . ' has been uploaded.</span>';
                            } else {
                                echo '<span style="color: white;">Sorry, there was an error uploading your file.</span>';
                            }
                        }
                    } else {
                        echo '<span style="color: white;">File is not an image.</span>';
                        $uploadOk = 0;
                    }
                }
            ?>

                <br>
                <br>
                <form method="POST" action="movieListingCreateController.php">
                    <label for="movieName">Movie Name:</label>
                    <input type="text" id="movieName" name="movieName" class="clear-input" required>
                    <p></p>
                    <label for="movieDescription">Movie Description:</label>
                    <br>
                    <textarea id="movieDescription" name="movieDescription" class="clear-input" required rows="4" cols="50"></textarea>
                    <p></p>
                    <!--<label for="movieAvailability"> Make Available: </label>
                    <input type="checkbox" name="movieAvailability" class="clear-input" value="1">-->
                    <br>
                    <button type="submit" name="submit">Create New Movie Listing</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Other content -->
</body>
</html>