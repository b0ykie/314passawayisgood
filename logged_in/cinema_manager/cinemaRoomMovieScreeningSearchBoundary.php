<?php
    session_start();

    // Check if a message is passed in the URL
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        echo "<script>alert('" . $message . "');</script>";
        unset($_GET['message']); // Unset the message to prevent it from persisting after page refresh
    }


    // Retrieve the cinemaRoomMovieScreeningList from the session, if available
    $cinemaRoomMovieScreeningList = $_SESSION['cinemaRoomMovieScreeningList'] ?? [];

    // Clear the session variable after retrieving the value
    unset($_SESSION['cinemaRoomMovieScreeningList']);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Booking System - Search Cinema Room Movie Screening</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<header>
    <div class="logo">
        <img src="../../images\logo.jpg" alt="JKS Cinema Ticket Booking System">
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
            <h1>Search Cinema Room Movie Screening</h1>
            <div class="search-container">
                <form method="POST" action="cinemaRoomMovieScreeningSearchController.php">
                    <label for="cinema_screening">Movie Title:</label>
                    <input type="text" id="cinema_screening" name="cinema_screening" class="clear-input" required>
                    <p></p>
                    <button type="submit" name="submit">Search for Cinema Room Movie Screening</button>
                </form>
            </div>
        </div>
    </section>

    <section class="cinemaRoomMovieScreening-list">
        <div class="container">
            <?php if (!empty($cinemaRoomMovieScreeningList)) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Cinema Room ID</th>
                            <th>Cinema Room Number</th>
                            <th>Cinema Seat Capacity</th>
                            <th>Movie Screening Title</th>
                            <th>Movie Screening Date</th>
                            <th>Movie Screening Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cinemaRoomMovieScreeningList as $cinemaRoomMovieScreening) : ?>
                            <tr>
                                <td><?php echo $cinemaRoomMovieScreening['cinema_rm_ID']; ?></td>
                                <td><?php echo $cinemaRoomMovieScreening['cinema_rm_number']; ?></td>
                                <td><?php echo $cinemaRoomMovieScreening['cinema_seat_list']; ?></td>
                                <td><?php echo $cinemaRoomMovieScreening['cinema_screening']; ?></td>
                                <td><?php echo $cinemaRoomMovieScreening['cinema_date']; ?></td>
                                <td><?php echo $cinemaRoomMovieScreening['cinema_time_slot']; ?></td>
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