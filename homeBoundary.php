<?php
  require_once 'homeController.php';

  $home = new homeController();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Ticket Booking System</title>
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
    <header>
      <div class="logo">
        <img src="images\logo.jpg" alt="JKS Cinema Ticket Booking System">
      </div>

      <nav>
        <ul>
          <li><a href="homeBoundary.php">Home</a></li>
          <li><a href="movieListBoundary.php">Movies</a></li>
          <li><a href="aboutUsBoundary.php">About Us</a></li>
          <li><a href="contactUsBoundary.php">Contact Us</a></li>
        </ul>
      </nav>

      <div class="user-actions">
        <a href="loginBoundary.php" class="login-btn">Login</a>
        <a href="registerBoundary.php" class="register-btn">Register</a>
      </div>
    </header>

    <!-- MAIN CONTENT SECTION -->
    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>Get Ready for the Latest Blockbusters!</h1>
                <p>Book your tickets online today and enjoy a hassle-free cinema experience.</p>
                <a href="movieListBoundary.php" class="browse-btn">Browse Movies</a>
            </div>
            
            <div class="hero-image">
                <img src="images\movie 1.jpg" alt="Popular Movie Poster">
            </div>
        </section>

        <section class="featured-movies">
            <h2>Featured Movies</h2>
            <div class="movie-panel" name="movie-panel">
            <?php
                $homeFeaturedMovie = $home->retrieveFeaturedMovie();
                // Display the movie information in HTML
                foreach ($homeFeaturedMovie as $row) {
                    echo "<div class='movie-item'>";
                    echo "<img src='images/Themes/{$row->getMoviename()}.jpg' alt='Movie Poster' style='width: 300px; height: 300px;'>";
                    echo "<h3>{$row->getMoviename()}</h3>";
                    echo "<div class='book-now'>";
                    echo "<a href='loginBoundary.php'>Book Now</a>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
        </section>  
    </main>

    <!-- FOOTER SECTION -->
    <footer>
      <p>&copy; Cafeworkforce Solutions</p>
    </footer>
  </body>
</html>