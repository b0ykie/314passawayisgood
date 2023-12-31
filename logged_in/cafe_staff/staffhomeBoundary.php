<?php
  session_start();
  $username = $_SESSION['username'];

  require_once 'staffhomeController.php';
  $staffHome = new staffhomeController();
  $role = $staffHome->onInit($username);
  
  $_SESSION['staff_role'] = $role;
  $userRole = $_SESSION['staff_role']
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe Staff</title>
    <link rel="stylesheet" href="../../style.css">
  </head>

  <body>
    <!-- HEADER SECTION -->
    <header>
      <div class="logo">
        <img src="../../images\logoo.jpg" alt="Company logo">
      </div>

      <nav>
        <ul>
          
          <li><a href="staffhomeBoundary.php">Home</a></li>
          <li><a href="staffViewSlotsBoundary.php">View Work Slots</a></li>
          <li><a href="staffViewPendingBidsBoundary.php">View Pending Bids</a></li>
          <li><a href="staffViewSuccessfulBidsBoundary.php">View Successful Bids</a></li>
          <li><a href="staffViewRejectedBidsBoundary.php">View Rejected Bids</a></li>
        </ul>
      </nav>

      <div class="welcome">
        <h2>Welcome Back <?php echo $userRole . ' | ' . $username; ?> </h2>
      </div>

      <div class="user-actions">
        <a href="../../homeBoundary.php" class="logout-btn">Log Out</a>
      </div>
    </header>

    <!-- MAIN CONTENT SECTION -->
    <main>
        <section class="hero">
            <div class="hero-content">
              <h1>Welcome to slot bidding system!</h1>
              <p></p>
              <p></p>
              <p></p>
              <p></p>
            </div>
            
            <div class="hero-image">
                <img src="../../images\movie 12.jpg" alt="Company logo">
            </div>
        </section>  
    </main>

    <!-- FOOTER SECTION -->
    <footer>
      <p>&copy; CafeworkForce Solutions</p>
    </footer>
  </body>
</html>