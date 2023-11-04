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
    <title>Movie Booking System - Create FNB</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<header>
    
        <div class="logo">
            <img src="../../images\logoo.jpg" >
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
            <h1>Create Food and Drinks</h1>
            <div class="search-container">
                <form method="POST" action="foodAndDrinksCreateController.php">
                    <label for="fnbName">Food and Drinks Name:</label>
                    <input type="text" id="fnbName" name="fnbName" class="clear-input" required>
                    <p></p>
                    <label for="fnbPrice">Food and Drinks Price:</label>
                    <input type="number" id="fnbPrice" name="fnbPrice" class="clear-input" required min="1">
                    <p></p>
                    <!--<label for="fnbAvailability"> Make Available: </label>
                    <input type="checkbox" name="fnbAvailability" class="clear-input" value="1">
                    <br> -->
                    <button type="submit" name="submit">Create New FNB</button>
                </form>
            </div>
        </div>
    </section>
    
    <!-- Other content -->
</body>
</html>