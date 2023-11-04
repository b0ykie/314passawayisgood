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
    <title>Movie Booking System - Suspend Movie</title>
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
            <h1>Suspend Movie</h1>
            <div class="search-container">
                <form method="POST" action="movieSuspendController.php">
                    <label for="fnbID">Movie ID:</label>
                    <input type="number" id="movieID" name="movieID" class="clear-input" required min="1">
                    <p></p>
                    <button type="submit" name="submit">Suspend</button>
                </form>
            </div>
        </div>
    </section>
    
    <!-- Other content -->
</body>
</html>