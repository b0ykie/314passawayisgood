<?php
  session_start();
  $username = $_SESSION['username'];
  require_once '../../userAccountEntity.php';

  // Connect to the database
  $db = new PDO('mysql:host=localhost;dbname=bse_booking', 'root', '');
  // Instantiate the UserAccountController
  $user = new User($db);

  $result = $user->userDetails($username);
  $userloyalpts = $result->getLoyaltyPts();

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
            <img src="../../images\logo.jpg" alt="JKS Cinema Ticket Booking System">
        </div>

        <nav>
            <ul>
            <li><a href="cushomeBoundary.php">Home</a></li>
            <li><a href="cusmovieListBoundary.php">Movies</a></li>
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

        <main>
            <div class="Contact_us">
                <h1>Contact Us</h1>
                <h2>Owner : Dave <br>Manager : Kumar, Dom, YiRen <br>Admin : Zheng Bang <br> Calefair : WeiChoon</h2>
            </div>
        </main>

            <!-- FOOTER SECTION -->
        <footer>
            <p>&copy; Cafeworkforce Solutions</p>
        </footer>
    </body>
</html>