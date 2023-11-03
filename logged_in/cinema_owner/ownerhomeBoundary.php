<?php
  session_start();
  $username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Owner</title>
    <link rel="stylesheet" href="../../style.css">
  </head>

  <body>
    <!-- HEADER SECTION -->
    <header>
      <div class="logo">
        <img src="../../images\logo.jpg" alt="JKS Cinema Ticket Booking System">
      </div>

      <nav>
        <ul>
          <li><a href="ownerhomeBoundary.php">Home</a></li>
          <li><a href="ticketSalesBoundary.php">Ticket Sales</a></li>
          <li><a href="fnbSalesBoundary.php">F&B Sales</a></li>
        </ul>
      </nav>

      <div class="welcome">
        <h2>OWNER <?php echo $username; ?> !</h2>
      </div>


      <div class="user-actions">
        <a href="../../homeBoundary.php" class="logout-btn">Log Out</a>
      </div>
    </header>

    <!-- MAIN CONTENT SECTION -->
    <main>
        <section class="hero">
        <div class="hero-content">
          <a href="ticketSalesBoundary.php" class="browse-btn">View Ticket Sales</a>
          <a href="fnbSalesBoundary.php" class="browse-btn">View F&B Sales</a>
        </div>
        <div class="hero-image">
            <img src="../../images\movie 1.jpg" alt="Popular Movie Poster">
        </div>
        </section> 
    </main>

    <!-- FOOTER SECTION -->
    <footer>
      <p>&copy; Cafeworkforce Solutions</p>
    </footer>
  </body>
</html>