<?php
require_once 'updateUserController.php';
session_start();

$username = $_SESSION['username'];

if (isset($_GET['id'])) {
    $userID = $_GET['id'];
    $userController = new UpdateUserController();
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
            <form method="POST" action="deleteUserController.php">
                <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
                <label for="username">Username:</label>
                <input type="text" name="username" value="<?php echo $user->getUsername(); ?>"><br>

                <label for="password">Password:</label>
                <input type="password" name="password" value="<?php echo $user->getPassword(); ?>"><br>

                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $user->getEmail(); ?>"><br>

                <label for="profile">Profile:</label>
                <input type="text" name="profile" value="<?php echo $user->getRole(); ?>"><br>

                <input type="submit" value="Delete">
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "User not found.";
    }
} else {
    echo "Invalid user ID.";
}
?>
