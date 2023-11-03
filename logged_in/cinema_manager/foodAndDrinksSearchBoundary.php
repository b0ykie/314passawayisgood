<?php
    session_start();

    // Check if a message is passed in the URL
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        echo "<script>alert('" . $message . "');</script>";
        unset($_GET['message']); // Unset the message to prevent it from persisting after page refresh
    }


    // Retrieve the fnbList from the session, if available
    $fnbList = $_SESSION['fnbList'] ?? [];

    // Clear the session variable after retrieving the value
    unset($_SESSION['fnbList']);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Booking System - Search FNB</title>
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

    <section class="hero">
        <div class="hero-content">
            <h1>Search Food and Drinks</h1>
            <div class="search-container">
                <form method="POST" action="foodAndDrinksSearchController.php">
                    <label for="fnbName">Food and Drinks Name:</label>
                    <input type="text" id="fnbName" name="fnbName" class="clear-input" required>
                    <p></p>
                    <button type="submit" name="submit">Search FNB</button>
                </form>
            </div>
        </div>
    </section>

    <section class="fnb-list">
        <div class="container">
            <?php if (!empty($fnbList)) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>FnB ID</th>
                            <th>FnB Name</th>
                            <th>FnB Availability</th>
                            <th>FnB Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fnbList as $fnb) : ?>
                            <tr>
                                <td><?php echo $fnb['fnbID']; ?></td>
                                <td><?php echo $fnb['fnbName']; ?></td>
                                <td><?php echo $fnb['fnb_availability']; ?></td>
                                <td><?php echo $fnb['fnb_price']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </section>

    <!-- Other content -->
</body>
</html>