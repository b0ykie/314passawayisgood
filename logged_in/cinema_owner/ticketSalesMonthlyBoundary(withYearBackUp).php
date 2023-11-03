<?php
    session_start();
    $username = $_SESSION['username'];
    $month = $_POST['viewMonth'];
    $year = $_POST['viewYear'];
    require_once('ticketSalesMonthlyController.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ticket Sales Report</title>
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
                    <li><a href="ownerhomeBoundary.php">Home</a></li>
                    <li><a href="ticketSalesBoundary.php">Ticket Sales</a></li>
                    <li><a href="fnbSales.php">F&B Sales</a></li>
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
            <h1>Monthly Ticket Sales Report</h1>

            <section class="movie_list">
                <!-- Retrieve and display the movie information from the database based on the search keyword -->
                <h1>Movie Listing</h1>
                <table>
                    <tr><th>Book Ticket ID</th>
                    <th>No. of Tickets Booked</th>
                    <th>Movie Name Booked</th>
                    <th>Ticket Type</th>
                    <th>Ticket Price Paid</th>
                    <th>Movie ID</th>
                    <th>Movie Screening Date</th></tr>
                    <?php
                        $ticketMonthlySales = new ticketSalesMonthlyController();
                        // Retrieve ticket sale information from the database
                        $monthTixSales = $ticketMonthlySales->printticketSalesMonthly($month, $year);
                        // Display the movie information in HTML
                        $totalSales = 0;
                        foreach ($monthTixSales as $row) {
                            echo "<tr><td>" . $row->getBookTicketID() . "</td>
                            <td>" . $row->getNoOfTicketsBooked() . "</td>
                            <td>" . $row->getMovieNameBooked() . "</td>
                            <td>" . $row->getTicketTypeIndex() . "</td>
                            <td>" . $row->getTicketPricePaid() . "</td>
                            <td>" . $row->getMovieID() . "</td>
                            <td>" . $row->getMovieScreeningDate() . "</td>
                            </tr>";
                            $totalSales += $row->getTicketPricePaid();
                        }
                        echo "<tr><td colspan='4'></td><td>Total Sales:</td><td colspan='2'>" . $totalSales . "</td></tr>";
                    ?>
                </table>
            </section>
        </main>

        <footer>
            <p>&copy; CafeworkForce Solutions</p>
        </footer>
    </body>
</html>