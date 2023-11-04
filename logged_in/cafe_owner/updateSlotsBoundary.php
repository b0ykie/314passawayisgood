<?php
require_once 'updateSlotsController.php';
session_start();

$username = $_SESSION['username'];

if (isset($_GET['id'])) {
    $userID = $_GET['id'];
    $userController = new UpdateSlotController();
    $user = $userController->onInit($userID);

    if ($user !== null) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>User Admin</title>
            <link rel="stylesheet" href="admin.css">
        </head>
        <body>
            <form method="POST" action="UpdateSlotsController.php">
                <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">

                <label for="profile">slotDate:</label>
                <input type="text" name="profile" value="<?php echo $user->getSlotDate(); ?>"><br>

                <input type="submit" value="Update">
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "User not found.";
    }
} else {
    echo "Invalid profile.";
}
?>
