<?php
    //session_start();
    require_once 'bookingSuccessController.php';
    
    $username = $_SESSION['username'];
    $SuccessBooking = $_SESSION['bookTixSuccess'];

    $selectedTixQty = $_SESSION['selectedTixQty'];
    $movieselected = $_SESSION['movieselected'];
    $ticketType = $_SESSION['ticketType'];
    $tixCost = $_SESSION['tixCost'];
    $roomID = $_SESSION['roomID'];
    $movieDateGet = $_SESSION['movieDateGet'];
    $movieTime = $_SESSION['movieTime'];
    $roomNumber = $_SESSION['roomNumber'];
    $assignSeat = $_SESSION['assignSeat'];

    $fnbName = isset($_SESSION['fnbName']) ? $_SESSION['fnbName'] : '';
    $fnbPrice = isset($_SESSION['fnbPrice']) ? $_SESSION['fnbPrice'] : 0;
    
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

        <!-- MAIN SECTION -->
        <main>

            <h1>Booking Successful!! </h1>
            <h2>Booked Movie : <?php echo $movieselected; ?></h2>
            <img src="../../images/Themes/<?php echo $movieselected; ?>.jpg" alt='Movie Image' style='width: 300px; height: 300px;'>
            <h2>Ticket Type : <?php echo $ticketType; ?></h2>
            <h2>Book Ticket ID : <?php echo $SuccessBooking; ?></h2>
            <h2>Ticket Quantity : <?php echo $selectedTixQty; ?></h2>
            <h2>Ticket Cost : $<?php echo $tixCost; ?></h2>
            <h2>Date Selected : <?php echo $movieDateGet; ?></h2>
            <h2>Time Selected : <?php echo $movieTime; ?></h2>
            <h2>Cinema Room Number : <?php echo $roomNumber; ?></h2>
            <h2>Seat Number : <?php echo $assignSeat; ?></h2>

            <h2>F&B Booked : 
                <?php 
                if ($fnbName != ''){
                    echo $fnbName;
                    echo "<h2>F&B Price : $".$fnbPrice."</h2>";
                }
                else{
                    echo "NIL";
                }
                ?>
            </h2>
                
            <h2>Total Cost : $<?php echo $tixCost + $fnbPrice; ?></h2>




        </main>

        <!-- FOOTER SECTION -->     
        <footer>
            <p>&copy; Cafeworkforce Solutions</p>
        </footer>

        <script src="myscript.js"></script>
    </body>


</html>