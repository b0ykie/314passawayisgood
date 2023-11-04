<?php
  session_start();
  $username = $_SESSION['username'];
  require_once 'cusPurchaseHistController.php';
  $cusPurchaseHistController = new cusPurchaseHistController();

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
                <img src="../../images\logoo.jpg" >
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
            <h1>Tickets Purchase History</h1>
            <?php 
                $allTixHist = $cusPurchaseHistController->retrievePurHist($username);
                $totalSales = 0;
                if ($allTixHist != FALSE) {
                    echo "<table>
                    <tr><th>Book Ticket ID</th>
                    <th>No. of Tickets Booked</th>
                    <th>Movie Name Booked</th>
                    <th>Ticket Type</th>
                    <th>Ticket Price Paid</th>
                    <th>Movie ID</th>
                    <th>Movie Screening Date</th></tr>";
                    foreach ($allTixHist as $row) {
                        echo "<tr><td>" . $row->getBookTicketID() . "</td>
                        <td>" . $row->getNoOfTicketsBooked() . "</td>
                        <td>" . $row->getMovieNameBooked() . "</td>
                        <td>" . $row->getTicketTypeIndex() . "</td>
                        <td>" . $row->getTicketPricePaid() . "</td>
                        <td>" . $row->getMovieID() . "</td>
                        <td>" . $row->getMovieScreeningDate() . "</td></tr>";
                        $totalSales += $row->getTicketPricePaid();
                    }
                    echo "</table>";
                }
                else {
                    echo "No ticket sales found.";
                }  
            
            ?>

            <h1>F&B Purchase History</h1>
            <?php
                $allFnbHist = $cusPurchaseHistController->retrieveFnBPurHist($username);
                $totalSales = 0;
                if ($allFnbHist != FALSE) {
                    echo "<table>
                    <tr><th>F&B ID</th>
                    <th>F&B Name</th>
                    <th>F&B fbCost</th>
                    <th>F&B Loyalty Points</th>
                    <th>F&B Date For</th></tr>";

                    foreach ($allFnbHist as $row) {
                        echo "<tr><td>" . $row->getBookFnbID() . "</td>
                        <td>" . $row->getFnbName() . "</td>
                        <td>" . $row->getFnbCost() . "</td>
                        <td>" . $row->getFnbLoyaltyPts() . "</td>
                        <td>" . $row->getFnbMovieScreeningDate() . "</td>";
                        $totalSales += $row->getFnbCost();
                    }
                    echo "</table>";
                }
                else {
                    echo "No F&B sales found.";
                }
            ?>
        </main>
    
        <footer>
            <p>&copy; CafeworkForce Solutions</p>
        </footer>
    </body>
</html>