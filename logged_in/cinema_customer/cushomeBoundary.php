<?php
  session_start();
  $username = $_SESSION['username'];

  require_once 'cusHomeController.php';
  $cusHome = new cusMovieHomeController();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Ticket Booking System</title>
    <link rel="stylesheet" href="../../style.css">
  </head>

  <body>
    <!-- HEADER SECTION -->
    <header>
      <div class="logo">
        <img src="../../images\logoo.jpg" >
      </div>

      <nav>
        <ul>
          <li><a href="cushomeBoundary.php">Home</a></li>
          
          <li><a href="cusaboutUsBoundary.php">About Us</a></li>
          <li><a href="cuscontactUsBoundary.php">Contact Us</a></li>
        </ul>
      </nav>

      <div class="welcome">
        <h2>Welcome Back <?php echo $username; ?> !</h2>
      </div>

      <div class="user-actions">
        <a href="cusPurchaseHistBoundary.php" class="purchase_history-btn">Purchase History</a>
        <a href="../../homeBoundary.php" class="logout-btn">Log Out</a>
      </div>
    </header>

    <!-- MAIN CONTENT SECTION -->
    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>Get Ready for the Latest Blockbusters!</h1>
                <p>Book your tickets online today and enjoy a hassle-free cinema experience.</p>
                <a href="cusmovieListBoundary.php" class="browse-btn">Browse Movies</a>
            </div>
            
            <div class="hero-image">
                <img src="../../images\movie 1.jpg" alt="Popular Movie Poster">
            </div>
        </section>

        <section class="featured-movies">
            <h2>Featured Movies</h2>
            <div class="movie-panel">
                <?php
                $cusHomeFeaturedMovie = $cusHome->retrieveFeaturedMovie();
                // Display the movie information in HTML
                foreach ($cusHomeFeaturedMovie as $row) {
                    echo "<div class='movie-item'>";
                    echo "<img src='../../images/Themes/{$row->getMoviename()}.jpg' alt='Movie Poster' style='width: 300px; height: 300px;'>";
                    echo "<h3>{$row->getMoviename()}</h3>";
                    echo "<div class='book-now'>";
                    echo "<a href='bookingBoundary.php?movie={$row->getMoviename()}'>Book Now</a>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
        </section>  
    </main>

    <!-- FOOTER SECTION -->
    <footer>
      <p>&copy; CafeworkForce Solutions</p>
    </footer>
  </body>
</html>