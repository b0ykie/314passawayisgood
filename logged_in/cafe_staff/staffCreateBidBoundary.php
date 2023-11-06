<?php
require_once 'staffCreateBidController.php';
session_start();

$username = $_SESSION['username'];
$userRole = $_SESSION['staff_role'];

if (isset($_GET['id'])) {
    $slotID = $_GET['id'];
    $userController = new staffCreateBidController();
    $user = $userController->onInit($slotID);
    $date = $userController->getDate($slotID);
    $manager = $userController->getManager($slotID);

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
            <form method="POST" action="staffCreateBidController.php">
                <input type="hidden" name="id" value="<?php echo $username ?>">

                <label for="username">userName:</label>
                <input type="text" name="username" value="<?php echo $username ?>" readonly><br>

                <label for="userrole">role:</label>
                <input type="text" name="userrole" value="<?php echo $userRole ?>" readonly><br>

                <label for="slotdate">slotDate:</label>
                <input type="text" name="slotdate" value="<?php echo $date ?>" readonly><br>

                <label for="slotdate">CafeManager:</label>
                <input type="text" name="managerid" value="<?php echo $manager ?>" readonly><br>

                <input type="submit" value="Bid">
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
