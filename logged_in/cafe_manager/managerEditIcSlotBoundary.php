<?php
require_once 'managerEditIcSlotController.php';
session_start();

$username = $_SESSION['username'];

if (isset($_GET['id'])) {
    $userID = $_GET['id'];
    $userController = new managerEditIcSlotController();
    $user = $userController->onInit($userID);

    if ($user !== null) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Cafe Manager</title>
            <link rel="stylesheet" href="admin.css">
        </head>
        <body>
            <form method="POST" action="managerEditIcSlotController.php">
                <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
                <input type="hidden" name="username" value="<?php echo $username ?>">

                <label for="profile">ChefSlot:</label>
                <input type="text" name="chefslot" value="<?php echo $user->getManagerID(); ?>" readonly><br>

                <label for="profile">ChefSlot:</label>
                <input type="text" name="chefslot" value="<?php echo $user->getChefSlot(); ?>"><br>

                <label for="profile">CashierSlot:</label>
                <input type="text" name="cashierslot" value="<?php echo $user->getCashierSlot(); ?>"><br>

                <label for="profile">WaiterSlot:</label>
                <input type="text" name="waiterslot" value="<?php echo $user->getWaiterSlot(); ?>"><br>

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
