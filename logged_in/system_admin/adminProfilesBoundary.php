<?php
  session_start();
  $username = $_SESSION['username'];
  require_once 'adminProfilesController.php';
  $adminUsersController = new AdminUsersController();
// Check if a search keyword is provided
  $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';

// Call the searchUsers method with the search keyword
  $result = $adminUsersController->onInit();
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
          <label for="search">Search Profile : </label>
          <input type="text" name="search" id="search" placeholder="Search profile...">
          <button type="submit" name="submit">Search</button>
        </form>
      </div>
      <?php
      if (isset($_POST['submit'])) {
        $searchKeyword = $_POST['search'];
        $resultSearch = $adminUsersController->searchUsers($searchKeyword);

        if ($resultSearch != FALSE) {
          echo "<table>";
          echo "<tr><th>Username</th><th>Password</th><th>Email</th><th>Profile</th><th>Action</th></tr>";

          // Output data of each user
          foreach ($resultSearch as $row) {
            echo "<tr>";
            echo "<td>" . $row->getUsername() . "</td>";
            echo "<td><a href='updateprofileBoundary.php?id=" . $row->getId() . "'>Edit</a></td>";
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
          echo "<tr><th>userProfileType</tr>";

          // Output data of each user
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['userProfileType'] . "</td>";
            echo "<td><a href='updateProfileBoundary.php?id=" . $row['userProfileType'] . "'>Edit</a></td>";
            echo "</tr>";
          }
          echo "</table>";
        } else {
          echo "No profiles found.";
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