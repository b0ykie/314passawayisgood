<?php
  session_start();
  $username = $_SESSION['username'];
  require_once 'createProfileController.php';
  $adminController = new CreateProfileController();
  $user = $adminController->onInit();

  // Check if the form was submitted
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve user input from the form
    $userProfileType = $_POST['userProfileType'];

    $resultRetrieve = $adminController->retrieveUserProfile($userProfileType);
    
    // Execute the query
    if (mysqli_num_rows($resultRetrieve) > 0) {
      echo "<script>alert('Error: The profile type already exists.');</script>";
    } 
    else {
      $result = $adminController->addNewUserProfile($userProfileType);
      if ($result == true){
        echo "<script>alert('New profile created successfully.');</script>";
      }
    }
  }

  // Retrieve existing profile types from the database
    $profileTypes = $adminController->getProfileTypes();

  // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User Profile</title>
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
      <div class="loginContain">
        <form method="POST" action="createProfileBoundary.php">
          <h1>Create User Profile</h1>
          <label for="userProfileType">User Profile Type:</label>
          <input type="text" name="userProfileType" id="userProfileType" required>

          <button type="submit" name="login">Create User Profile</button>
        </form>
      </div>
    </main>

    <!-- FOOTER SECTION -->
    <footer>
      <p>&copy; CafeworkForce Solutions</p>
    </footer>
  </body>
</html>