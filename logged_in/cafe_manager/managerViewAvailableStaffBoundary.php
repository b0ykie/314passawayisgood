<?php
  session_start();
  $managerID = $_SESSION['username'];
  $slotID = $_GET['id'];
  $workSlotID = $_GET['id'];

  require_once 'managerViewAvailableStaffController.php';
  $managerViewSlotsApprovedController = new managerViewAvailableStaffBoundary();
  $date = $managerViewSlotsApprovedController->getSlotDate($slotID);

  // Check if a search keyword is provided
  $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';

// Call the searchUsers method with the search keyword
  $result = $managerViewSlotsApprovedController->getAvailableStaff($slotID);
  
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
        $resultSearch = $managerViewSlotsApprovedController->searchAvailableStaff($workSlotID, $searchKeyword);

        if ($resultSearch != FALSE) {
          echo "<table>";
          echo "<tr><th>staffName</th><th>Role</th><th>Number</th><th>Bid Status</th></tr>";

          // Output data of each user
          foreach ($resultSearch as $row) {
            echo "<tr>";
            echo "<td>" . $row['userName'] . "</td>";
            
            // Check if 'role' is empty
            if (isset($row['role']) && !empty($row['role'])) {
              echo "<td>" . $row['role'] . "</td>";
            } 
            else {
              echo "<td>Did not make a bid</td>";
            }

            echo "<td>" . $row['userPhone'] . "</td>";

            if (isset($row['role']) && !empty($row['role'])) {
              echo "<td>" . $row['bidding_status'] . "</td>";
            } 
            else {
              echo "<td>Did not make a bid</td>";
            }
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
          echo "<tr><th>staffName</th><th>Role</th><th>Number</th><th>Bid Status</th></tr>";

          // Output data of each user
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['userName'] . "</td>";
            
            // Check if 'role' is empty
            if (isset($row['role']) && !empty($row['role'])) {
              echo "<td>" . $row['role'] . "</td>";
            } 
            else {
              echo "<td>Did not make a bid</td>";
            }

            echo "<td>" . $row['userPhone'] . "</td>";

            if (isset($row['role']) && !empty($row['role'])) {
              echo "<td>" . $row['bidding_status'] . "</td>";
            } 
            else {
              echo "<td>Did not make a bid</td>";
            }

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