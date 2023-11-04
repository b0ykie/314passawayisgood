<?php
  session_start();
  $username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User Account</title>
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
      <div class="loginContain">
        <form method="POST" action="assignRoleController.php">
          <h1>Assign Role to Existing Staff</h1>
          <label for="userName">Existing Staff Username:</label>
          <input type="text" name="userName" id="userName" required>

          <!-- <label for="userPassword">Password:</label>
          <input type="password" name="userPassword" id="userPassword" required> -->

          <!-- <label for="userEmail">Email:</label>
          <input type="email" name="userEmail" id="userEmail" required> -->

          <!-- <label for="userProfile">Profile:</label>
          <input type="text" name="userProfile" id="userProfile" required> -->

          <label for="confirm-role">Role:</label>
            <select name="userEmail" id="userEmail" required>
                <option value="--- Choose a role ---">--- Choose a role ---</option>
                <option value="chef">chef</option>
                <option value="cashier">cashier</option>
                <option value="waiter">waiter</option>
            </select>

          <button type="submit" name="login">Assign Role</button>
        </form>
      </div>
    </main>

    <!-- FOOTER SECTION -->
    <footer>
      <p>&copy; CafeworkForce Solutions</p>
    </footer>
  </body>
</html>
