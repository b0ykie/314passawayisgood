<?php
    session_start();

    // Check if a message is passed in the URL
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        echo "<script>alert('" . $message . "');</script>";
        unset($_GET['message']); // Unset the message to prevent it from persisting after page refresh
    }

    // Retrieve the fnbList from the session, if available
    $movieList = $_SESSION['movieList'] ?? [];

    // Clear the session variable after retrieving the value
    unset($_SESSION['movieList']);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Booking System - Search FNB</title>
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
            <h1>Search Movie</h1>
            <div class="search-container">
                <form method="POST" action="movieSearchController.php">
                    <label for="movieName">Movie Name:</label>
                    <input type="text" id="movieName" name="movieName" class="clear-input" required>
                    <p></p>
                    <button type="submit" name="submit">Search for Movie</button>
                </form>
            </div>
        </div>
    </section>

    <section class="movie-list">
        <div class="container">
            <?php if (!empty($movieList)) : ?>
                <table>
                    <thead>
                        <tr>
                        <th>Movie Picture</th>
                            <th>Movie ID</th>
                            <th>Movie Name</th>
                            <th>Movie Description</th>
                            <th>Movie Availability</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($movieList as $movie) : ?>
                            <tr>
                                <td><?php echo "<img src='../../images/Themes/{$movie['movieName']}.jpg' alt='Movie Image' style='width: 300px; height: 300px;'>";?></td>
                                <td><?php echo $movie['movieID']; ?></td>
                                <td><?php echo $movie['movieName']; ?></td>
                                <td><?php echo $movie['movieDescription']; ?></td>
                                <td><?php echo $movie['movieAvailability']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </section>
    <!-- Other content -->
</body>
</html>