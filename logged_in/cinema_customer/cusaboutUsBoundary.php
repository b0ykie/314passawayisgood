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
            <img src="../../images\logo.jpg" >
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

        <main>
            <div class="About_us">
                <h1>About Us</h1>
                <h3>In this project, your team is asked to design and develop a cinema ticket booking system. 
                    <br>The system should support at least the following key aspects. 
                    <br>1. Support and manage different types of users and user profiles and preferences (i.e. system admin,
                    manager, staff, customer etc.).
                    <br>2. Support the management of cinema rooms, seats (e.g. seat capacity and seat map), and the allocation of 
                    movie sessions to cinema rooms. 
                    <br>3. Support the process of purchasing and issuing tickets for a movie session. This process should also 
                    include seat selection and allocation. Note that there are different kinds of tickets such as adult, child, 
                    student, senior, etc. Seat allocation can be automated based on user preferences. Customer can also prepurchase food and drinks. 
                    <br>4. Support the customers to submit their review and rating based on their experience at the cinema. 
                    <br>5. Support the management and process of gaining and redeeming loyalty points. 
                    <br>6. Generate different kind or relevant reports for cinema managers. 
                    <br>You must create test data that is sufficiently large enough to simulate the system (e.g. 100 records to each 
                    datatype). You could write a script to generate these data randomly. In the final product demonstration, you 
                    will need to run a live demo of your product with these test data.
                </h3>
            </div>
        </main>

            <!-- FOOTER SECTION -->
        <footer>
            <p>&copy; CafeworkForce Solutions</p>
        </footer>
    </body>
</html>