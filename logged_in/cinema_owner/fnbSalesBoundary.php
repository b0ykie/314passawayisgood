<?php
    session_start();
    $username = $_SESSION['username'];

    // Include the controller and entity files
    require_once('fnbSalesController.php');
    $fnbSales = new fnbSalesController();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>F&B Sales Report</title>
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
            <h1>Generate F&B Sales Report</h1>

            <!-- view monthly selection -->
            <form method="post" action="fnbSalesMonthlyBoundary.php">
                <label for="viewMonth">View Monthly : </label>
                <select id="viewMonth" name="viewMonth" required>
                    <option value="" disabled selected>Select a Month</option>
                    <?php
                        $availableFnbMonths = $fnbSales->getAvailableFnbMonths();
                        foreach ($availableFnbMonths as $month) {
                        echo "<option value=" . $month .">" . $month . "</option>";
                        }
                    ?>
                </select>

                <button type="submit" name="submit">Generate</button>
            </form>

            <!-- view weekly selection -->
            <form method="post" action="fnbSalesWeeklyBoundary.php">

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
                        $availableFnbMonths = $fnbSales->getAvailableFnbMonths();
                        foreach ($availableFnbMonths as $month) {
                        echo "<option value=" . $month .">" . $month . "</option>";
                        }
                    ?>
                </select>

                <button type="submit" name="submit">Generate</button>
            </form>

            <!-- view daily selection -->
            <form method="post" action="fnbSalesDailyBoundary.php">
                <label for="viewDay">View Daily : </label>
                <select id="viewDay" name="viewDay" required>
                    <option value="" disabled selected>Select a Day</option>
                    <?php
                        $availableFnbDays = $fnbSales->getAvailableFnbDays();
                        foreach ($availableFnbDays as $days) {
                            echo "<option value=" . $days . ">" . $days . "</option>";
                        }
                    ?>
                </select>

                <button type="submit" name="submit">Generate</button>
            </form>


            <!-- Retrieve and display all the book ticket from the database-->
            <section class="movie_list">
                <h1>F&B Listing</h1>
                
                    <?php
                        $allFnbSales = $fnbSales->printAllFnbSales();
                        $totalSales = 0;
                        if ($allFnbSales != FALSE) {
                            echo "<table>
                            <tr><th>F&B ID</th>
                            <th>F&B Name</th>
                            <th>F&B fbCost</th>
                            <th>F&B Loyalty Points</th>
                            <th>F&B Date For</th>
                            <th>F&B Book By</th></tr>";

                            foreach ($allFnbSales as $row) {
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
