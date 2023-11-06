<?php
require_once 'managerEntity.php';

class managerEditIcSlotController {
    public function onInit($userID) {
        $userEntity = new Slots();
        $user = $userEntity->getSlotByID($userID);
        return $user;
    }
}

// Check if the user ID is provided in the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize the user ID from the form
    $slotID = $_POST['id'];

    // Create an instance of UpdateUserController
    $managerEditIcSlotController = new managerEditIcSlotController();

    // Retrieve the existing user's information
    $user = $managerEditIcSlotController->onInit($slotID);

    if ($user !== null) {
        // Retrieve and sanitize the updated user information from the form
        $newChefSlot = $_POST['chefslot'];
        $newCashierSlot = $_POST['cashierslot'];
        $newWaiterSlot = $_POST['waiterslot'];

        // Update the user information
        $userEntity = new Slots();
        if ($userEntity->updateIcSlot($newChefSlot, $newCashierSlot, $newWaiterSlot, $slotID)) {
            // Redirect the user back to the users page after the update
            header("Location: managerViewIcSlotsBoundary.php");
            exit();
        }
    } else {
        echo "User not found.";
    }
}
?>
