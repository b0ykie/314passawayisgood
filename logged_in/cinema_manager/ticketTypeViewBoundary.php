<?php
  session_start(); // start session

  
// Check if the "View All Movie" button is clicked, only displaying table when clicked

if (isset($_POST['viewAll'])) {
    $_SESSION['showTable'] = true;
    header("Location: ticketTypeViewBoundary.php");
    exit();
}

$showTable = $_SESSION['showTable'] ?? false;
$ticketType = $_SESSION['ticketType'] ?? [];

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
            <img src="../../images\logo.jpg" >
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
        <h1>View Ticket Type</h1>
        <div class="search-container">
            <form method="POST"action="ticketTypeViewController.php">
                <button type="submit" name="viewAll">Refresh Ticket Type Table</button>
            </form>
        </div>
    </section>

    <section class = "movie-list">
    <div class="container">
            <?php if (!empty($ticketType)) : ?>
                <table>
                    <thead>
                    <tr>
                        <th style="color: white; font-size: 20px;">Ticket Type</th>
                        <th style="color: white; font-size: 20px;">Ticket Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($ticketType as $tt) : ?>
                        <tr>
                            <td style="font-size: 20px; color: white;"><?php echo $tt['ticketType']; ?></td>
                            <td style="font-size: 20px; color: white;"><?php echo '$' . number_format($tt['ticket_price'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>
            <?php endif; ?>
        </div>

    </section>

    <!-- FOOTER SECTION -->  

    </body>
</html>