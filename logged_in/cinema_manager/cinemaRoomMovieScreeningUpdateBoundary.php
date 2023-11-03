<?php
    session_start();

     // Check if a message is passed in the URL
     if (isset($_GET['message'])) {
        $message = $_GET['message'];
        echo "<script>alert('" . $message . "');</script>";
        unset($_GET['message']); // Unset the message to prevent it from persisting after page refresh
    }

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Booking System - Update Cinema Room Movie Screening</title>
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
            <h1>Update Cinema Room Movie Screening</h1>
            <div class="search-container">
                <form method="POST" action="cinemaRoomMovieScreeningUpdateController.php">
                    <label for="cinema_rm_ID">Cinema Room ID:</label>
                    <input type="number" id="cinema_rm_ID" name="cinema_rm_ID" class="clear-input" required>
                    <p></p>
                    <label for="cinema_rm_number">Cinema Room Number:</label>
                    <input type="number" id="cinema_rm_number" name="cinema_rm_number" class="clear-input" required min="1" max="10">
                    <p></p>
                    <label for="cinema_seat_list">Cinema Room Seat Capacity: 100</label>
                    <p></p>
                    <label for="cinema_screening"> Movie to be Screened: </label>
                    <input type="text" id="cinema_screening" name="cinema_screening" class="clear-input" required>
                    <br>
                    <p></p>
                    <label for="cinema_date"> Movie Screening Date: </label>
                    <input type="text" id="cinema_date" name="cinema_date" class="clear-input" required pattern="\d{4}-\d{2}-\d{2}" value="YYYY-MM-DD" onfocus="if(this.value=='YYYY-MM-DD') this.value='';" onblur="if(this.value=='') this.value='YYYY-MM-DD';">
                    <br>
                    <p></p>
                    <label for="cinema_time_slot"> Movie Screening Time: </label>
                    <input type="text" id="cinema_time_slot" name="cinema_time_slot" class="clear-input" required pattern="\d{2}:\d{2}:\d{2}" value="HH:MM:SS" onfocus="if(this.value=='HH:MM:SS') this.value='';" onblur="if(this.value=='') this.value='HH:MM:SS';">
                    <br>
                    <p></p>
                    <button type="submit" name="submit">Update</button>
                </form>
            </div>
        </div>
    </section>
    
    <!-- Other content -->
</body>
</html>