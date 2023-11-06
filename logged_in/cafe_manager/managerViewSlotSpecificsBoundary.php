<?php
  session_start();
  $username = $_SESSION['username'];
  $slotID = $_GET['id'];

  require_once 'managerViewSlotSpecificsController.php';
  $managerViewSlotSpecificsController = new managerViewSlotSpecificsController();

// Call the searchUsers method with the search keyword
  $result = $managerViewSlotSpecificsController->onInit($slotID);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe Staff</title>
    <link rel="stylesheet" href="../../style.css">
  </head>
  <style>
    #whatever {
        display: inline;
        margin-right: 10px;
    }
  </style>

  <body>
    <!-- HEADER SECTION -->
    <header>
      <div class="logo">
        <img src="../../images\logoo.jpg" alt="Company logo">
      </div>

      <nav>
        <ul>
          <li><a href="managerhomeBoundary.php">Home</a></li>
          <li><a href="managerViewSlotsBoundary.php">View Work Slots</a></li>
          <li><a href="managerViewIcSlotsBoundary.php">View In-Charge Work Slots</a></li>
        </ul>
      </nav>

      <div class="welcome">
        <h2>Welcome Back <?php echo $username; ?> </h2>
      </div>

      <div class="user-actions">
        <a href="../../homeBoundary.php" class="logout-btn">Log Out</a>
      </div>
    </header>

        <!-- MAIN CONTENT SECTION -->
        <main>
      <?php
        $username = $_SESSION['username'];
        $slotID = $_GET['id'];
        $resultSearch = $managerViewSlotSpecificsController->onInit($slotID);

        if ($resultSearch != FALSE) {
          foreach ($resultSearch as $row) {
            echo '<h3 >Slot Date: ' . $row->getSlotDate() . '</h3>';
            echo '<h3 >Remaining Chef Slot: ' . $row->getChefSlot() . '</h3>';
            echo '<h3 >Remaining Cashier Slot: ' . $row->getCashierSlot() . '</h3>';
            echo '<h3 >Remaining Waiter Slot: ' . $row->getWaiterSlot() . '</h3>';
            // echo "";
          }
        } 
        else {
          echo "No data found.";
        }
      // else {
      //   if (mysqli_num_rows($result) > 0) {
      //     echo "<table>";
      //     echo "<tr><th>slotDate</th><th>chefSlot</th><th>cashierSlot</th><th>waiterSlot</th><th>Action</th><th>Action</th></tr>";

      //     // Output data of each user
      //     while ($row = mysqli_fetch_assoc($result)) {
      //       echo "<tr>";
      //       echo "<td>" . $row['slotDate'] . "</td>";
      //       echo "<td>" . $row['chefSlot'] . "</td>";
      //       echo "<td>" . $row['cashierSlot'] . "</td>";
      //       echo "<td>" . $row['waiterSlot'] . "</td>";
      //       echo "<td><a href='managerEditIcSlotBoundary.php?id=" . $row['slotID'] . "'>Edit</a></td>";
      //       echo "<td><a href='managerTakeSlotBoundary.php?id=" . $row['slotID'] . "'>View</a></td>";
      //       echo "</tr>";
      //     }
      //     echo "</table>";
      //   } else {
      //     echo "No users found.";
      //   }
      // }
      ?>
    </main>

    <!-- FOOTER SECTION -->
    <footer>
      <p>&copy; CafeworkForce Solutions</p>
    </footer>
  </body>
</html>