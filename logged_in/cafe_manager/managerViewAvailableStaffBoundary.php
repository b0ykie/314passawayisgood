<?php
  session_start();

  if (isset($_GET['message'])) {
    $message = $_GET['message'];
    echo "<script>alert('" . urldecode($message) . "');</script>";
  }

  $managerID = $_SESSION['username'];
  $slotID = $_GET['id'];
  $workSlotID = $_GET['id'];

  require_once 'managerViewAvailableStaffController.php';
  $managerViewSlotsApprovedController = new managerViewAvailableStaffBoundary();
  $date = $managerViewSlotsApprovedController->getSlotDate($slotID);
  $availableSlotRoleslots = $managerViewSlotsApprovedController->getSlotRoleslots($slotID);

  // Check if a search keyword is provided
  $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';

  // Call the searchUsers method with the search keyword
  $result = $managerViewSlotsApprovedController->getAvailableStaff($date);
  
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
        $resultSearch = $managerViewSlotsApprovedController->searchAvailableStaff($date, $searchKeyword);

        if ($resultSearch != FALSE) {
          echo "<table>";
          echo "<tr><th>staffName</th><th>Number</th><th>Bid Status</th><th>Bid Role</th><th>assignedStaffRole</th><th>Action</th></tr>";

          // Output data of each user
          foreach ($resultSearch as $row) {
            echo "<tr>";

            echo "<td>" . $row['userName'] . "</td>";

            echo "<td>" . $row['userPhone'] . "</td>";

            // echo "<td>" . $row['bidding_status'] . "</td>";

            // echo "<td>" . $row['biddingRole'] . "</td>";
            
            //Check if bid status is empty or pending
            if (isset($row['bidding_status']) && !empty($row['bidding_status'])) {
              if ($row['bidding_status'] === 'pending') {
                echo "<td>Please approve staff</td>";
                } 
              else {
                echo "<td>" . $row['bidding_status'] . "</td>";
                }
              } 
              else {
                echo "<td>No bid</td>";
              }
              
            

            if (isset($row['biddingRole']) && !empty($row['biddingRole'])) {
              echo "<td>" . $row['biddingRole'] . "</td>";
            } 
            else {
              echo "<td>No bid role</td>";
            }

            if (!empty($row['assignedStaffRole'])) {
              echo "<td>" . $row['assignedStaffRole'] . "</td>";
            } 
            else {
              echo "<td>Please assign role</td>";
            }
          
            //Assigned Role
            if (empty($row['biddingRole']) && empty($row['assignedStaffRole'])) {
              // Condition 1: If there is nothing for both biddingRole and assignedStaffRole
              echo "<td>-</td>";
              } elseif (empty($row['biddingRole']) && !empty($row['assignedStaffRole'])) {
                  // Condition 2: If there is nothing for biddingRole but it has assignedStaffRole
                  echo "<td>";
                  echo "<form action='managerAssignSlotController.php' method='post'>";
                  echo "<input type='hidden' name='shiftDate' value='" . $date . "'>";
                  echo "<input type='hidden' name='chefSlot' value='" . $chefSlot . "'>";
                  echo "<input type='hidden' name='cashierSlot' value='" . $cashierSlot . "'>";
                  echo "<input type='hidden' name='waiterSlot' value='" . $waiterSlot . "'>";
                  echo "<input type='hidden' name='staffRole' value='" . $row['assignedStaffRole'] . "'>";
                  echo "<input type='hidden' name='id' value='" . $row['userID'] . "'>";
                  echo "<input type='hidden' name='workSlotID' value='" . $workSlotID . "'>";
                  echo "<input type='hidden' name='managerID' value='" . $managerID . "'>";
                  echo "<input type='hidden' name='action' value='approve'>";
                  echo "<button type='submit'>Approve</button>";
                  echo "</form>";
                  echo "</td>";
              } elseif (!empty($row['biddingRole']) && !empty($row['assignedStaffRole'])) {
                  // Condition 3: If there are values for both biddingRole and assignedStaffRole
                  echo "<td>Please approve staff</td>";
              } else {
                  // Add an else condition if needed
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
          echo "<tr><th>staffName</th><th>Number</th><th>Bid Status</th><th>Bid Role</th><th>assignedStaffRole</th><th>Action</th></tr>";

          // Output data of each user
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";

            echo "<td>" . $row['userName'] . "</td>";

            echo "<td>" . $row['userPhone'] . "</td>";
            
            // Check if bid status is empty or pending
            if (isset($row['bidding_status']) && !empty($row['bidding_status'])) {
              if ($row['bidding_status'] === 'pending') {
                echo "<td>Please approve staff</td>";
                } 
              else {
                echo "<td>" . $row['bidding_status'] . "</td>";
                }
              } 
              else {
                echo "<td>No bid</td>";
              }
          

            if (isset($row['biddingRole']) && !empty($row['biddingRole'])) {
              echo "<td>" . $row['biddingRole'] . "</td>";
            } 
            else {
              echo "<td>No bid role</td>";
            }

            if (!empty($row['assignedStaffRole'])) {
              echo "<td>" . $row['assignedStaffRole'] . "</td>";
            } 
            else {
              echo "<td>Please assign role</td>";
            }
          
            //Assigned Role
            if (empty($row['biddingRole']) && empty($row['assignedStaffRole'])) {
              // Condition 1: If there is nothing for both biddingRole and assignedStaffRole
              echo "<td>-</td>";
              } elseif (empty($row['biddingRole']) && !empty($row['assignedStaffRole'])) {
                  // Condition 2: If there is nothing for biddingRole but it has assignedStaffRole
                  echo "<td>";
                  echo "<form action='managerAssignSlotController.php' method='post'>";
                  echo "<input type='hidden' name='shiftDate' value='" . $date . "'>";
                  echo "<input type='hidden' name='chefSlot' value='" . $chefSlot . "'>";
                  echo "<input type='hidden' name='cashierSlot' value='" . $cashierSlot . "'>";
                  echo "<input type='hidden' name='waiterSlot' value='" . $waiterSlot . "'>";
                  echo "<input type='hidden' name='staffRole' value='" . $row['assignedStaffRole'] . "'>";
                  echo "<input type='hidden' name='id' value='" . $row['userID'] . "'>";
                  echo "<input type='hidden' name='workSlotID' value='" . $workSlotID . "'>";
                  echo "<input type='hidden' name='managerID' value='" . $managerID . "'>";
                  echo "<input type='hidden' name='action' value='approve'>";
                  echo "<button type='submit'>Approve</button>";
                  echo "</form>";
                  echo "</td>";
              } elseif (!empty($row['biddingRole']) && !empty($row['assignedStaffRole'])) {
                  // Condition 3: If there are values for both biddingRole and assignedStaffRole
                  echo "<td>Please approve staff</td>";
              } else {
                  // Add an else condition if needed
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