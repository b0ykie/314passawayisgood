<?php
  session_start();
  $username = $_SESSION['username'];
  require_once 'createSlotsController.php';
  $adminController = new CreateSlotsController();
  $user = $adminController->onInit($username);

  // Check if the form was submitted
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve user input from the form
    $ownerID = $_SESSION['username'];
    $userName = 0; //Manager will determine the slots
    $userPassword = 0; //Manager will determine the slots
    $userEmail = 0; //Manager will determine the slots
    $userProfile = $_POST['userProfile'];

    // // Check if the username already exists
    // $checkResult = $adminController->checkDuplicateByUsername($userName);
    // $checkResultEmail = $adminController->checkDuplicateByEmail($userEmail);

    // if (mysqli_num_rows($checkResult) > 0 || mysqli_num_rows($checkResultEmail) > 0) {
    //   echo "<script>alert('Username / Email already exists. Please choose a different username / email.');</script>";
      
    // } else {
    //   // Prepare the SQL query to insert a new user

      $check = $adminController->addNewSlot($ownerID, $userName, $userPassword,$userEmail,$userProfile);
    
      if ($check == true) {
        echo "<script>alert('New user created successfully.');</script>";
      } else {
        echo "<script>alert('User Profile does not exist. Create failed.');</script>";
      }
    }
//   }
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
      <div class="loginContain">
        <form method="POST" action="createSlotsBoundary.php">
          <h1>Create Work Slot</h1>
          <!-- <label for="userName">Chef Slot:</label>
          <input type="text" name="userName" id="userName" required>

          <label for="userPassword">Cashier Slot:</label>
          <input type="text" name="userPassword" id="userPassword" required>

          <label for="userEmail">Waiter Slot:</label>
          <input type="text" name="userEmail" id="userEmail" required> -->

          <label for="userProfile">Slot Date:</label>
          <input type="text" name="userProfile" id="userProfile" required>

          <button type="submit" name="login">Create Work Slot</button>
        </form>
      </div>
    </main>

    <!-- FOOTER SECTION -->
    <footer>
      <p>&copy; CafeworkForce Solutions</p>
    </footer>
  </body>
</html>
