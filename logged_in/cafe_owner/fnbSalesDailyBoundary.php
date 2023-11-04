<?php
    session_start();
    $username = $_SESSION['username'];
    $day = $_POST['viewDay'];
    require_once('fnbSalesDailyController.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daily F&B Sales Report</title>
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
            <h1>Daily F&B Sales Report</h1>

            <section class="movie_list">
                <!-- Retrieve and display the movie information from the database based on the search keyword -->
                <h1>F&B Listing</h1>
                    <?php
                        $fnbDailySales = new fnbSalesDailyController();
                        // Retrieve ticket sale information from the database
                        $dayFnbSales = $fnbDailySales->printFnbSalesDaily($day);
                        // Display the movie information in HTML
                        $totalSales = 0;
                        if ($dayFnbSales != FALSE) {
                            echo "<table>
                            <tr><th>F&B ID</th>
                            <th>F&B Name</th>
                            <th>F&B fbCost</th>
                            <th>F&B Loyalty Points</th>
                            <th>F&B Date For</th>
                            <th>F&B Book By</th></tr>";
                            foreach ($dayFnbSales as $row) {
                                echo "<tr><td>" . $row->getBookFnbID() . "</td>
                                <td>" . $row->getFnbName() . "</td>
                                <td>" . $row->getFnbCost() . "</td>
                                <td>" . $row->getFnbLoyaltyPts() . "</td>
                                <td>" . $row->getFnbMovieScreeningDate() . "</td>
                                <td>" . $row->getFnbBookBy() . "</td>";
                                $totalSales += $row->getFnbCost();
                            }
                            echo "<tr><td colspan='2'>Total Sales:</td><td>" . $totalSales . "</td></tr>";
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