<?php
  session_start(); // start session
  $username = $_SESSION['username']; // get username from session variable
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
    <header>
      <div class="logo">
        <img src="..\..\images\logo.jpg" alt="Cinema Ticket Booking System">
      </div>
      <nav>
        <ul>
          <li><a href="managerhomeBoundary.php">Home</a></li>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Contact Us</a></li>
        </ul>
      </nav>
      
      <div class="welcome">
            <h1>Welcome Back <?php echo $username; ?> !</h1>
      </div>

      <div class="user-actions">
            <a href="../../loginBoundary.php" class="logout-btn">Log Out</a>
      </div>

      
    </header>

    <section class="hero">
      <div class="hero-content">
        <h1>JKS Movie Booking System</h1>
        <p></p>
        <a href="cinemaRoomMovieScreeningCreateBoundary.php" class="browse-btn">Create Cinema Room Movie Screening</a>
        <a href="cinemaRoomMovieScreeningViewBoundary.php" class="browse-btn">View Cinema Room Movie Screening</a>
        <a href="cinemaRoomMovieScreeningSearchBoundary.php" class="browse-btn">Search Cinema Room Movie Screening</a>
        <a href="cinemaRoomMovieScreeningUpdateBoundary.php" class="browse-btn">Update Cinema Room Movie Screening</a>
        <a href="cinemaRoomMovieScreeningDeleteBoundary.php" class="browse-btn">Delete Cinema Room Movie Screening</a>
        <p></p>
        <a href="movieListingCreateBoundary.php" class="browse-btn">Create Movie Listing</a>
        <a href="movieListingViewBoundary.php" class="browse-btn">View Movie Listing</a>
        <a href="movieListingSearchBoundary.php" class="browse-btn">Search Movie Listing</a>
        <a href="movieListingUpdateBoundary.php" class="browse-btn">Update Movie Listing</a>
        <a href="movieListingSuspendBoundary.php" class="browse-btn">Suspend Movie Listing</a>
        <p></p>
        <a href="ticketTypeViewBoundary.php" class="browse-btn">View All Ticket Types</a>
        <a href="ticketTypeManageBoundary.php" class="browse-btn">Manage Ticket Types</a>
        <p></p>
        <a href="foodAndDrinksCreateBoundary.php" class="browse-btn">Create Food and Drinks</a>
        <a href="foodAndDrinksViewBoundary.php" class="browse-btn">View Food and Drinks</a>
        <a href="foodAndDrinksSearchBoundary.php" class="browse-btn">Search Food and Drinks</a>
        <a href="foodAndDrinksUpdateBoundary.php" class="browse-btn">Update Food and Drinks</a>
        <a href="foodAndDrinksSuspendBoundary.php" class="browse-btn">Suspend Food and Drinks</a>
      </div>
      
    </section>


  <!-- MAIN CONTENT SECTION -->
  <main>
    <section class="featured-movies">
    
    </section>
    
      
      <style>
      .movie-panel {
        display: flex;
        overflow-x: scroll;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        white-space: nowrap;
      }
      
      .movie-item {
        margin-right: 20px;
      }
      </style>
      
      <script>
      // Automatically scroll the movie panel every 5 seconds
      setInterval(function() {
        const moviePanel = document.querySelector('.movie-panel');
        const scrollAmount = 300;
        moviePanel.scrollLeft += scrollAmount;
      }, 5000);
      </script>
      
  </main>
    <!-- FOOTER SECTION -->
    <footer>
      <p>&copy; Cafeworkforce Solutions</p>
    </footer>


    
  </div>
  </body>
  </html>