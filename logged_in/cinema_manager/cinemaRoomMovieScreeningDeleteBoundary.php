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
    <title>Movie Booking System - Delete Room Movie Screening</title>
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
            <h1>Delete Cinema Room Movie Screening</h1>
            <div class="search-container">
                <form method="POST" action="cinemaRoomMovieScreeningDeleteController.php">
                    <label for="cinema_rm_ID">Cinema Room ID:</label>
                    <input type="number" id="cinema_rm_ID" name="cinema_rm_ID" class="clear-input" required min="1">
                    <p></p>
                    <button type="submit" name="submit">Delete</button>
                </form>
            </div>
        </div>
    </section>
    
    <!-- Other content -->
</body>
</html>