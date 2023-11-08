<?php
  session_start();

  if (isset($_GET['message'])) {
    $message = $_GET['message'];
    echo "<script>alert('" . urldecode($message) . "');</script>";
  }

  $managerID = $_SESSION['username'];
  $slotID = $_GET['id'];
  $workSlotID = $_GET['id'];

  require_once 'managerViewSlotsPendingController.php';
  $managerViewIcPendingSlotsController = new managerViewSlotsPendingController();
  $date = $managerViewIcPendingSlotsController->getSlotDate($slotID);
  $availableSlotRoleslots = $managerViewIcPendingSlotsController->getSlotRoleslots($slotID);
  $noOfApprovedBids = $managerViewIcPendingSlotsController->getNoOfApprovedBids($date);

  // Check if a search keyword is provided
  $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';

  // Call the searchUsers method with the search keyword
  $result = $managerViewIcPendingSlotsController->onInit($date);

  //Store staff Role in variable used for comparison
  $resultt = $managerViewIcPendingSlotsController->onInit($date);
  while ($row = mysqli_fetch_assoc($resultt)) {
    $staffRole = $row['role'];
  }

  //Store availableSlotRoleslots in variable used for comparison
  $chefSlot = $availableSlotRoleslots['chefSlot'];
  $cashierSlot = $availableSlotRoleslots['cashierSlot'];
  $waiterSlot = $availableSlotRoleslots['waiterSlot'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe Staff</title>
    <link rel="stylesheet" href="../../style.css">
  </head>

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
        <h2>Welcome Back <?php echo $managerID; ?> </h2>
      </div>

      <div class="user-actions">
        <a href="../../homeBoundary.php" class="logout-btn">Log Out</a>
      </div>
    </header>

        <!-- MAIN CONTENT SECTION -->
        <main>
      <!-- Search form -->
      <div class="search-container">
        <form method="post">
          <label for="search">Search Slot : </label>
          <input type="text" name="search" id="search" placeholder="Search xx/yy/zz...">
          <button type="submit" name="submit">Search</button>
        </form>
      </div>
      <?php
      if (isset($_POST['submit'])) {
        $searchKeyword = $_POST['search'];
        $resultSearch = $managerViewIcPendingSlotsController->searchPendingBids($date, $searchKeyword);

        if ($resultSearch != FALSE) {
          echo "<table>";
          echo "<tr><th>staffName</th><th>Role</th><th>Action</th><th>Action</th></tr>";

          // Output data of each user
          foreach ($resultSearch as $row) {
            echo "<tr>";
            echo "<td>" . $row['staff_id'] . "</td>";
            echo "<td>" . $row['role'] . "</td>";

            echo "<td>";
            echo "<form action='approveController.php' method='post'>";
            echo "<input type='hidden' name='shiftDate' value='" . $date . "'>";
            echo "<input type='hidden' name='chefSlot' value='" . $chefSlot . "'>";
            echo "<input type='hidden' name='cashierSlot' value='" . $cashierSlot . "'>";
            echo "<input type='hidden' name='waiterSlot' value='" . $waiterSlot . "'>";
            // echo "<input type='hidden' name='staffRole' value='" . $staffRole . "'>";
            echo "<input type='hidden' name='staffRole' value='" . $row['role'] . "'>";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<input type='hidden' name='workSlotID' value='" . $workSlotID . "'>";
            echo "<input type='hidden' name='action' value='approve'>";
            echo "<button type='submit'>Approve</button>";
            echo "</form>";
            echo "</td>";

            echo "<td>";
            echo "<form action='approveController.php' method='post'>";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<input type='hidden' name='action' value='reject'>";
            echo "<button type='submit'>Reject</button>";
            echo "</form>";
            echo "</td>";

            echo "</tr>";
          }
          echo "</table>";
        } 
        else {
          echo "No users found.";
        }
      } else {
        if (mysqli_num_rows($result) > 0) {
          echo "<table>";
          echo "<tr><th>staffName</th><th>Role</th><th>Action</th><th>Action</th></tr>";

          // Output data of each user
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['staff_id'] . "</td>";
            echo "<td>" . $row['role'] . "</td>";

            echo "<td>";
            echo "<form action='approveController.php' method='post'>";
            echo "<input type='hidden' name='shiftDate' value='" . $date . "'>";
            echo "<input type='hidden' name='chefSlot' value='" . $chefSlot . "'>";
            echo "<input type='hidden' name='cashierSlot' value='" . $cashierSlot . "'>";
            echo "<input type='hidden' name='waiterSlot' value='" . $waiterSlot . "'>";
            // echo "<input type='hidden' name='staffRole' value='" . $staffRole . "'>";
            echo "<input type='hidden' name='staffRole' value='" . $row['role'] . "'>";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<input type='hidden' name='workSlotID' value='" . $workSlotID . "'>";
            echo "<input type='hidden' name='action' value='approve'>";
            echo "<button type='submit'>Approve</button>";
            echo "</form>";
            echo "</td>";
            
            echo "<td>";
            echo "<form action='approveController.php' method='post'>";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<input type='hidden' name='action' value='reject'>";
            echo "<button type='submit'>Reject</button>";
            echo "</form>";
            echo "</td>";

            echo "</tr>";
          }
          echo "</table>";
        } else {
          echo "No users found.";
        }
      }
      ?>
    </main>

    <!-- FOOTER SECTION -->
    <footer>
      <p>&copy; CafeworkForce Solutions</p>
    </footer>
  </body>
</html>