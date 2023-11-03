<?php
  session_start(); // start session
  require_once('ticketType.php');
  //require_once('ticketTypeAddController.php');
  $username = $_SESSION['username']; // get username from session variable
  $dbName = "bse_booking";
  $db = new PDO('mysql:host=localhost;dbname=bse_booking', 'root', '');
  $ticketType = new ticketType($db);
  
  //Check if a message is passed in the URL
  if (isset($_GET['message'])) {
    $message = $_GET['message'];
    echo "<script>alert('" . $message . "');</script>";
  }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Booking System - Create FNB</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<header>
    
        <div class="logo">
            <img src="../../images\logo.jpg" >
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
        <h1>Manage Ticket Types</h1>
      </div>
      
    </section>
    
    <main>
      <!-- Add the search bar above the ticket type -->
      <div class="search-container">
                    <form method="post" action="ticketTypeSearchController.php">
                        <label for="search">Search Ticket Type: </label>
                        <input type="text" name="ticketType" id="search" placeholder="Enter Ticket Type">
                        <button type="submit" name="submit">Search</button>
                    </form>
                </div>
        <br>
        <!-- ADD TICKET -->
        <div class="search-container">
          <form action="ticketTypeAddController.php" method="post">
          <label for="addTicket">Add Ticket Type Name:</label>
          <input type = addTicket id="ticketType" name="ticketType">
          <label for="addTicket">Ticket Price:</label>
          <input type = number id="ticket_price" name="ticket_price" step="0" min="1" required>
          <button type="submit" name="update">Add</button>
          </form>
        </div>
        <br>
        <!-- CHANGE PRICE -->
        <!-- Ticket drop down list -->
        <div class="search-container">
        <form action="ticketTypeUpdateController.php" method="post">
        <?php
            $result2 = $ticketType -> getTicketDetails($dbName);
            echo "<label for='ticketType123' style='margin-right: 10px;'>Update Ticket Type:</label>";
            echo "<select id='ticketType' name ='ticketType' required>";
            while($row = mysqli_fetch_assoc($result2)){
                echo "<option value=\"" . $row['ticketType'] . "\" >" . $row['ticketType'] . "</option>";
            }
            echo "</select>";
        ?>

        <!-- Change price -->
        <label for="priceChange">Change price to:</label>
        <input type= number id="ticket_price" name="ticket_price" step="0" min="1" required>
        <button type="submit" name="update">Update</button>
        </form>
        </div>
        <br>
        <!-- DELETE TICKET TYPE -->
        <!-- Ticket drop down list -->
        <div class="search-container">
        <form action="ticketTypeDeleteController.php" method="post">
        <?php
            $result2 = $ticketType -> getTicketDetails($dbName);
            echo "<label for='ticketType123' style='margin-right: 10px;'>Remove Ticket Type :</label>";
            echo "<select id='ticketType' name ='ticketType' required>";
            while($row = mysqli_fetch_assoc($result2)){
                echo "<option value=\"" . $row['ticketType'] . "\" >" . $row['ticketType'] . "</option>";
            }
            echo "</select>";
        ?>
        <!-- Delete -->
        <button type="submit"name="delete"> Remove </button>
        </form>
        </div>
        <br>
        <br>
        <hr>
    </main>

    <!-- FOOTER SECTION -->  
    <footer>
        <p>&copy; CafeworkForce Solutions</p>
    </footer>
    </body>
</html>
