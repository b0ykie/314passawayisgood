<?php
  session_start(); // start session

  
// Check if the "View All Movie" button is clicked, only displaying table when clicked

if (isset($_POST['viewAll'])) {
    $_SESSION['showTable'] = true;
    header("Location: movieListingViewBoundary.php");
    exit();
}

$showTable = $_SESSION['showTable'] ?? false;
$movieList = $_SESSION['movieList'] ?? [];

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Booking System - View Boundary</title>
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

    <!-- Refresh Button -->
    <section class="hero">
      <div class="hero-content">
        <h1>View Movie Listing</h1>
        <div class="search-container">
            <form method="POST"action="movieListingViewController.php">
                <button type="submit" name="viewAll">Refresh Movie Listing</button>
            </form>
        </div>
    </section>

    <section class = "movie-list">
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

    <!-- FOOTER SECTION -->  
    <footer>
        <p>&copy; Cafeworkforce Solutions</p>
    </footer>
    </body>
</html>