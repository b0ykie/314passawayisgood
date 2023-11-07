<?php
require_once 'managerApproveSlotController.php';
session_start();

$username = $_SESSION['username'];

if (isset($_GET['id'])) {
    $bidID = $_GET['id'];
    $updateSlotController = new managerApproveSlotController();
    $bidDetails = $updateSlotController->onInit($bidID);
    $availableSlotRoleslots = $updateSlotController->getSlotRoleslots($bidID);

    if ($bidDetails !== null) {
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
            <form method="POST" action="managerApproveSlotController.php">
                <input type="hidden" name="id" value="<?php echo $bidDetails->getBidID(); ?>">

                <label for="profile">slotDate:</label>
                <input type="text" name="profile" value="<?php echo $bidDetails->getSlotDate(); ?>" readonly><br>

                <label for="profile">staffName:</label>
                <input type="text" name="profile" value="<?php echo $bidDetails->getCafeStaffID(); ?>" readonly><br>

                <label for="profile">staffRole:</label>
                <input type="text" name="profile" value="<?php echo $bidDetails->getCafeStaffRole(); ?>" readonly><br>

                <input type="submit" value="Approve Bid">
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
