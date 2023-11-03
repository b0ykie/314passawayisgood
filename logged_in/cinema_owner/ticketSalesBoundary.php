<?php
    session_start();
    $username = $_SESSION['username'];

    // Include the controller and entity files
    require_once('ticketSalesController.php');
    $ticketSales = new ticketSalesController();

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
                <img src="../../images\logo.jpg" alt="JKS Cinema Ticket Booking System">
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
            <h1>Generate Ticket Sales Report</h1>

            <!-- view monthly selection -->
            <form method="post" action="ticketSalesMonthlyBoundary.php">
                <label for="viewMonth">View Monthly : </label>
                <select id="viewMonth" name="viewMonth" required>
                    <option value="" disabled selected>Select a Month</option>
                    <?php
                        $availableMonths = $ticketSales->getAvailableMonths();
                        foreach ($availableMonths as $month) {
                        echo "<option value=" . $month .">" . $month . "</option>";
                        }
                    ?>
                </select>

                <button type="submit" name="submit">Generate</button>
            </form>

            <!-- view weekly selection -->
            <form method="post" action="ticketSalesWeeklyBoundary.php">

                <!-- week selection -->
                <label for="viewWeekly">View Weekly : </label>
                <select id="viewWeekly" name="viewWeekly" required>
                    <option value="" disabled selected>Select a Week</option>
                    <option value="1">Week 1 (1st to 7th)</option>
                    <option value="2">Week 2 (8th to 14th)</option>
                    <option value="3">Week 3 (15th to 21th)</option>
                    <option value="4">Week 4 (22nd to 31st)</option>
                </select>

                <!-- week of month selection -->
                <label for="viewWeeklyOfMonth">Of Month : </label>
                <select id="viewWeeklyOfMonth" name="viewWeeklyOfMonth" required>
                    <option value="" disabled selected>Of Month</option>
                    <?php
                        $availableMonths = $ticketSales->getAvailableMonths();
                        foreach ($availableMonths as $month) {
                        echo "<option value=" . $month .">" . $month . "</option>";
                        }
                    ?>
                </select>

                <button type="submit" name="submit">Generate</button>
            </form>

            <!-- view daily selection -->
            <form method="post" action="ticketSalesDailyBoundary.php">
                <label for="viewDay">View Daily : </label>
                <select id="viewDay" name="viewDay" required>
                    <option value="" disabled selected>Select a Day</option>
                    <?php
                        $availableDays = $ticketSales->getAvailableDays();
                        foreach ($availableDays as $days) {
                            echo "<option value=" . $days . ">" . $days . "</option>";
                        }
                    ?>
                </select>

                <button type="submit" name="submit">Generate</button>
            </form>


            <!-- Retrieve and display all the book ticket from the database-->
            <section class="movie_list">
                <h1>Movie Listing</h1>
                    <?php
                        $allTixSales = $ticketSales->printAllTixSales();
                        $totalSales = 0;
                        if ($allTixSales != FALSE) {
                            echo "<table>
                            <tr><th>Book Ticket ID</th>
                            <th>No. of Tickets Booked</th>
                            <th>Movie Name Booked</th>
                            <th>Ticket Type</th>
                            <th>Ticket Price Paid</th>
                            <th>Movie ID</th>
                            <th>Movie Screening Date</th></tr>";
                            foreach ($allTixSales as $row) {
                                echo "<tr><td>" . $row->getBookTicketID() . "</td>
                                <td>" . $row->getNoOfTicketsBooked() . "</td>
                                <td>" . $row->getMovieNameBooked() . "</td>
                                <td>" . $row->getTicketTypeIndex() . "</td>
                                <td>" . $row->getTicketPricePaid() . "</td>
                                <td>" . $row->getMovieID() . "</td>
                                <td>" . $row->getMovieScreeningDate() . "</td></tr>";
                                $totalSales += $row->getTicketPricePaid();
                            }
                            echo "<tr><td colspan='4'>Total Sales:</td><td>" . $totalSales . "</td></tr>";
                        }
                        else {
                            echo "No ticket sales found.";
                        }
                    ?>
                </table>
            </section>
        </main>

        <footer>
            <p>&copy; Cafeworkforce Solutions</p>
        </footer>
    </body>
</html>
