<?php
require_once 'deleteRoleAssignmentController.php';
session_start();

$username = $_SESSION['username'];

if (isset($_GET['id'])) {
    $userID = $_GET['id'];
    $userController = new DeleteRoleAssignmentController();
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
            <form method="POST" action="deleteRoleAssignmentController.php">
                <input type="hidden" name="id" value="<?php echo $user->getStaffID(); ?>">

                <label for="profile">userID:</label>
                <input type="text" name="profile" value="<?php echo $user->getUserID(); ?>" readonly><br>

                <label for="profile">staffRole:</label>
                <input type="text" name="profile" value="<?php echo $user->getStaffRole(); ?>" readonly><br>

                <input type="submit" value="Delete">
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
