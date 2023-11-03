<?php
    //session_start();
    require_once 'bookingController.php';
    // Check if a message is passed in the URL
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        echo "<script>alert('" . $message . "');</script>";
    }

    $username = $_SESSION['username'];
    $movieselected = $_GET['movie'];
    $_SESSION['moviename'] = $movieselected;

    
    $booking = new bookingController();


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
                <img src="../../images\logo.jpg" >
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

        <!-- MAIN SECTION -->
        <main>
            <div class="bookingContain"> 
            <form method="post" action="bookingController.php"> <!-- booking tix and f&b details -->
            <h1>Booking ticket for : <label id="movieName"><?php echo $movieselected;?></label></h1>
            <img src="../../images/Themes/<?php echo $movieselected; ?>.jpg" alt='Movie Image' style='width: 300px; height: 300px;'>
            <h3>
                <?php 
                    $getDetails = $booking->retrieveMovieDetails($movieselected);
                    echo $getDetails->getMovieDesc();
                ?>
            </h3>
            <br>

            <!-- Choose tix type drop box -->
            <div class="ticket_type">
                <label for="ticket_type" style="margin-right: 10px;">Ticket Type :</label>
                <select id="ticket_type" name="ticket_type" required>
                    <option value="" disabled selected>Select a type</option>
                    <?php
                    $retrieveTix = $booking->retrieveTickets();
                    // Display available F&B items
                    foreach ($retrieveTix as $tix) {
                        $ticketType = $tix->getTicketType();
                        $ticketPrice = $tix->getTicketPrice();
                        echo '<option value="' . $ticketType . '|' . $ticketPrice . '">' . $ticketType . ' (Price: $' . $ticketPrice . ')</option>';
                    }
                    ?>
                </select>
            </div>


            <!-- number of tix -->
            <div> 
                <label for="ticket_qty" style="margin-right: 10px; text-align: right;">Ticket Qty : </label>
                <input type="number" id="ticket_qty" name="ticket_qty" step="1" min="1" style="width: 120px; margin-right: -5px;" required>
            </div>

            <!-- choose date drop / time box -->
            <div> 
                <label for="date">Date / Time : </label>
                <select name="date" id="date" required>
                    <option value="" disabled selected>Select a date</option>
                    <?php
                        $getDate = $booking->retrieveDateOfMovie($movieselected);
                        foreach ($getDate as $Date) {
                            echo "<option value=".$Date->getCinemaRmID().">".$Date->getCinemaDate()." / ".$Date->getCinemaTimeSlot()." ( Seat Left : ".$Date->getCinemaSeatList().") "."</option>";
                        }
                    ?>
                </select>
            </div>

            <!-- add check box if user want to add f&b, if check, the f&b choose box will then be available for user to choose -->
            <div>
                <label>
                    <input type="checkbox" id="fnbCheckbox" name="fnbCheckbox">Get food and drinks?
                </label>
                <select name="fnb" id="fnb" required disabled>
                    <option value="" disabled selected>Select food items</option>
                    <?php
                        $availableFnb = $booking->retrieveAvailfnb();
                        // Display available F&B items
                        foreach ($availableFnb as $fnb) {
                            $fnbPrice = $fnb->getFnbPrice();
                            $fnbName = $fnb->getFnbName();
                            echo '<option value="' . $fnbName . '|' . $fnbPrice . '">' . $fnbName . ' (Price: $' . $fnbPrice . ')</option>';
                        }
                    ?>
                </select>
            </div>


            
            <!-- show user total amount to pay, with a check box at the side if user wants to claim loyalty points -->

            <div id="tixCost">
                Ticket Cost : $0.00
                <input type="hidden" name="tixCost" id="tixCostInput" value="0.00">
            </div>
            
            <div id="fnbCost">
                F&B Cost : $0.00
                <input type="hidden" name="fnbCost" id="fnbCostInput" value="0.00">
            </div>
            
            <div id="totalCost">Total Cost : $0.00</div>

            <!-- add paytment details -->
            <div id="payment-method" >
                <label for="card-number">Card Number (16 digits)</label>
                <input type="text" id="card-number" name="card-number" pattern="[0-9]{16}" required>
            </div>
            <div>
                <label for="expiration-date">Expiration Date (MM/YY)</label>
                <input type="text" id="expiration-date" name="expiration-date" pattern="(0[1-9]|1[0-2])\/[0-9]{2}" required>
            </div>
            <div>
                <label for="cvv">CVV (3 digits)</label>
                <input type="text" id="cvv" name="cvv" pattern="[0-9]{3}" required>
            </div>

            <button type="submit" name="submit">Book Now</button> <!-- book now button -->
        </form>
            </div> 
        </main>

        <!-- FOOTER SECTION -->     
        <footer>
            <p>&copy; CafeworkForce Solutions</p>
        </footer>

        <script src="myscript.js"></script>
    </body>


</html>