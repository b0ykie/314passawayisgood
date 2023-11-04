<?php
  session_start();
  $username = $_SESSION['username'];
  require_once 'createUsersController.php';
  $adminController = new CreateUsersController();
  $user = $adminController->onInit();

  // Check if the form was submitted
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve user input from the form
    $userName = $_POST['userName'];
    $userPassword = $_POST['userPassword'];
    $userEmail = $_POST['userEmail'];
    $userProfile = $_POST['userProfile'];

    // Check if the username already exists
    $checkResult = $adminController->checkDuplicateByUsername($userName);
    $checkResultEmail = $adminController->checkDuplicateByEmail($userEmail);

    if (mysqli_num_rows($checkResult) > 0 || mysqli_num_rows($checkResultEmail) > 0) {
      echo "<script>alert('Username / Email already exists. Please choose a different username / email.');</script>";
      
    } else {
      // Prepare the SQL query to insert a new user

      $check = $adminController->addNewUser($userName, $userPassword,$userEmail,$userProfile);
    
      if ($check == true) {
        echo "<script>alert('New user created successfully.');</script>";
      } else {
        echo "<script>alert('User Profile does not exist. Create failed.');</script>";
      }
    }
  }
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
        <form method="POST" action="createUsersBoundary.php">
          <h1>Create User Account</h1>
          <label for="userName">Username:</label>
          <input type="text" name="userName" id="userName" required>

          <label for="userPassword">Password:</label>
          <input type="password" name="userPassword" id="userPassword" required>

          <label for="userEmail">Email:</label>
          <input type="email" name="userEmail" id="userEmail" required>

          <label for="userProfile">Profile:</label>
          <input type="text" name="userProfile" id="userProfile" required>

          <button type="submit" name="login">Create User Account</button>
        </form>
      </div>
    </main>

    <!-- FOOTER SECTION -->
    <footer>
      <p>&copy; CafeworkForce Solutions</p>
    </footer>
  </body>
</html>
