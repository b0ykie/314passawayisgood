<?php
  session_start();
  $username = $_SESSION['username'];
  require_once 'adminRoleController.php';
  $adminProfilesController = new AdminRoleController();
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
        <li><a href="adminhomeBoundary.php">Home</a></li>
          <li><a href="adminUsersBoundary.php">View User Accounts</a></li>
          <li><a href="createUsersBoundary.php">Create User Account</a></li>
          <li><a href="adminProfilesBoundary.php">View User Profile</a></li>
          <li><a href="createProfileBoundary.php">Create User Profile </a></li>
          <li><a href="adminRoleBoundary.php">View Cafe Role Assignments</a></li>
          <li><a href="assignRoleBoundary.php">Assign Cafe Role To Profile</a></li>
        </ul>
      </nav>

      <div class="welcome">
        <h2>ADMIN <?php echo $username; ?> !</h2>
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
          <input type="text" name="search" id="search" placeholder="Search user...">
          <button type="submit" name="submit">Search</button>
        </form>
      </div>
      <?php
      if (isset($_POST['submit'])) {
        $searchKeyword = $_POST['search'];
        $resultSearch = $adminProfilesController->searchRole($searchKeyword);

        if ($resultSearch != FALSE) {
          echo "<table>";
          echo "<tr><th>userID</th><th>staffRole</th><th>Action</th></tr>";

          // Output data of each user
          foreach ($resultSearch as $row) {
            echo "<tr>";
            echo "<td>" . $row->getUserID() . "</td>";
            echo "<td>" . $row->getStaffRole() . "</td>";
            // echo "<td><a href='updateUserBoundary.php?id=" . $row->getStaffID() . "'>Edit</a></td>";
            echo "<td><a href='deleteRoleAssignmentBoundary.php?id=" . $row->getStaffID() . "'>Delete</a></td>";
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
          echo "<tr><th>userID</th><th>staffRole</th><th>Action</th></tr>";

          // Output data of each user
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['userID'] . "</td>";
            echo "<td>" . $row['staffRole'] . "</td>";
            // echo "<td><a href='updateUserBoundary.php?id=" . $row['staffID'] . "'>Edit</a></td>";
            echo "<td><a href='deleteRoleAssignmentBoundary.php?id=" . $row['staffID'] . "'>Delete</a></td>";
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