<?php
  require_once 'adminController.php';

  session_start();
  $username = $_SESSION['username'];
  $adminController = new AdminController();
  $user = $adminController->onInit();

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Admin</title>
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
          <li><a href="createProfileBoundary.php">Create User Profile</a></li>
          <li><a href="adminProfilesBoundary.php">View Cafe Role Assignments</a></li>
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
        <section class="hero">
        <div class="hero-content">
            <h1>Welcome to user management!</h1>
            <p></p>
            <p></p>
            <p></p>
            <p></p>

        </div>
        <div class="hero-image">
            <img src="../../images\yes.jpg"  alt="Company Logo">
        </div>
        </section> 
    </main>

    <!-- FOOTER SECTION -->
    <footer>
      <p>&copy; CafeworkForce Solutions</p>
    </footer>
  </body>
</html>

