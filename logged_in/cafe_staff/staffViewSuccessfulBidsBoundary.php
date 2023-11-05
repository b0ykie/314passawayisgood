<?php
  session_start();
  $username = $_SESSION['username'];
  $userRole = $_SESSION['staff_role'];

  require_once 'staffViewSuccessfulBidsController.php';
  $viewPendingBids = new staffViewSuccessfulBidsController();

  // Check if a search keyword is provided
  $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';

  // Call the searchUsers method with the search keyword
  $result = $viewPendingBids->onInit($username, $userRole);
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
          <li><a href="staffhomeBoundary.php">Home</a></li>
          <li><a href="staffViewSlotsBoundary.php">View Work Slots</a></li>
          <li><a href="staffViewPendingBidsBoundary.php">View Pending Bids</a></li>
          <li><a href="staffViewSuccessfulBidsBoundary.php">View Successful Bids</a></li>
          <li><a href="staffViewRejectedBidsBoundary.php">View Rejected Bids</a></li>
        </ul>
      </nav>

      <div class="welcome">
        <h2>Welcome Back <?php echo $username; ?> </h2>
        <!-- Welcome Back ROLE Username -->
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
          <label for="search">Search User : </label>
          <input type="text" name="search" id="search" placeholder="Search xx/yy/zz...">
          <button type="submit" name="submit">Search</button>
        </form>
      </div>
      <?php
      if (isset($_POST['submit'])) {
        $searchKeyword = $_POST['search'];
        $resultSearch = $viewPendingBids->searchUserSuccessfulBids($username, $userRole, $searchKeyword);

        if ($resultSearch != FALSE) {
          echo "<table>";
          echo "<tr><th>slotDate</th><th>role</th><th>bidding_status</th></tr>";

          // Output data of each user
          foreach ($resultSearch as $row) {
            echo "<tr>";
            echo "<td>" . $row->getSlotID() . "</td>";
            echo "<td>" . $row->getRole() . "</td>";
            echo "<td>" . $row->getBiddingStatus() . "</td>";
            // echo "<td><a href='updateUserBoundary.php?id=" . $row->getStaffID() . "'>Edit</a></td>";
            // echo "<td><a href='staffCreateBidBoundary.php?id=" . $row->getId() . "'>Bid</a></td>";
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
          echo "<tr><th>slotDate</th><th>role</th><th>bidding_status</th></tr>";

          // Output data of each user
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['slot_id'] . "</td>";
            echo "<td>" . $row['role'] . "</td>";
            echo "<td>" . $row['bidding_status'] . "</td>";
            // echo "<td><a href='updateUserBoundary.php?id=" . $row['staffID'] . "'>Edit</a></td>";
            // echo "<td><a href='staffCreateBidBoundary.php?id=" . $row['slotID'] . "'>Bid</a></td>";
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