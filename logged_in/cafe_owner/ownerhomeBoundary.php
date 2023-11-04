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
        <img src="../../images\logoo.jpg" alt="Company logo">
      </div>

      <nav>
        <ul>
          <li><a href="ownerhomeBoundary.php">Home</a></li>
          <li><a href="ownerSlotsBoundary.php">View Work Slots</a></li>
          <li><a href="createSlotsBoundary.php">Create Work Slots</a></li>
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
            <h1>Welcome to work slot management!</h1>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
        </div>
        <div class="hero-image">
            <img src="../../images\1.jpg" alt="Company logo">
        </div>
        </section> 
    </main>

    <!-- FOOTER SECTION -->
    <footer>
      <p>&copy; CafeworkForce Solutions</p>
    </footer>
  </body>
</html>