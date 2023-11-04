<?php
  session_start();
  $username = $_SESSION['username'];
  require_once 'ownerSlotsController.php';
  $adminProfilesController = new ownerSlotsController();
// Check if a search keyword is provided
  $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';

// Call the searchUsers method with the search keyword
  $result = $adminProfilesController->onInit();
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User Account</title>
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
            <li><a href="ownerhomeBoundary.php">Home</a></li>
            <li><a href="ownerSlotsBoundary.php">View Work Slots</a></li>
            <li><a href="createSlotsBoundary.php">Create Work Slots</a></li>
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
        $resultSearch = $adminProfilesController->searchSlots($searchKeyword);

        if ($resultSearch != FALSE) {
          echo "<table>";
          echo "<tr><th>slotDate</th><th>chefSlot</th><th>cashierSlot</th><th>waiterSlot</th><th>Action</th><th>Action</th></tr>";

          // Output data of each user
          foreach ($resultSearch as $row) {
            echo "<tr>";
            echo "<td>" . $row->getSlotDate() . "</td>";
            echo "<td>" . $row->getChefSlot() . "</td>";
            echo "<td>" . $row->getCashierSlot() . "</td>";
            echo "<td>" . $row->getWaiterSlot() . "</td>";
            echo "<td><a href='updateSlotsBoundary.php?id=" . $row->getId() . "'>Edit</a></td>";
            echo "<td><a href='deleteSlotsBoundary.php?id=" . $row->getId() . "'>Delete</a></td>";
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
          echo "<tr><th>slotDate</th><th>chefSlot</th><th>cashierSlot</th><th>waiterSlot</th><th>Action</th><th>Action</th></tr>";

          // Output data of each user
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['slotDate'] . "</td>";
            echo "<td>" . $row['chefSlot'] . "</td>";
            echo "<td>" . $row['cashierSlot'] . "</td>";
            echo "<td>" . $row['waiterSlot'] . "</td>";
            echo "<td><a href='updateSlotsBoundary.php?id=" . $row['slotID'] . "'>Edit</a></td>";
            echo "<td><a href='deleteSlotsBoundary.php?id=" . $row['slotID'] . "'>Delete</a></td>";
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