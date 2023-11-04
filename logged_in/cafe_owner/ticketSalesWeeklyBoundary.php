<?php
    session_start();
    $username = $_SESSION['username'];
    $week = $_POST['viewWeekly'];
    $viewWeeklyOfMonth = $_POST['viewWeeklyOfMonth'];
    require_once('ticketSalesWeeklyController.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Weekly Ticket Sales Report</title>
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
                    <li><a href="ownerhomeBoundary.php">Home</a></li>
                    <li><a href="ticketSalesBoundary.php">Ticket Sales</a></li>
                    <li><a href="fnbSalesBoundary.php">F&B Sales</a></li>
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
            <h1>Weekly Ticket Sales Report</h1>

            <section class="movie_list">
                <!-- Retrieve and display the movie information from the database based on the search keyword -->
                <h1>Movie Listing</h1>
                    <?php
                        $ticketWeeklySales = new ticketSalesWeeklyController();
                        // Retrieve ticket sale information from the database
                        $weekTixSales = $ticketWeeklySales->printticketSalesWeekly($week, $viewWeeklyOfMonth);
                        // Display the movie information in HTML
                        $totalSales = 0;
                        if ($weekTixSales != FALSE) {
                            echo "<table>
                            <tr><th>Book Ticket ID</th>
                            <th>No. of Tickets Booked</th>
                            <th>Movie Name Booked</th>
                            <th>Ticket Type</th>
                            <th>Ticket Price Paid</th>
                            <th>Movie ID</th>
                            <th>Movie Screening Date</th></tr>";
                            foreach ($weekTixSales as $row) {
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
                        }
                        else {
                            echo "No ticket sales found.";
                        }
                    ?>
                </table>
            </section>
        </main>

        <footer>
            <p>&copy; CafeworkForce Solutions</p>
        </footer>
    </body>
</html>