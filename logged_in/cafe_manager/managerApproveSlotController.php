<?php
require_once 'managerEntity.php';

class managerApproveSlotController {
    public function getSlotRoleslots($bidID) {
        $userEntity = new Slots();
        $availableSlotRoleslots = $userEntity->getSlotRoleslots($bidID);
        return $availableSlotRoleslots;
    }
    public function onInit($userID) {
        $userEntity = new Bids();
        $bidDetails = $userEntity->getBidByID($userID);
        return $bidDetails;
    }
}

// Check if the user ID is provided in the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize the user ID from the form
    $bidID = $_POST['id'];

    // Create an instance of managerApproveSlotController
    $managerApproveSlotController = new managerApproveSlotController();

    // Retrieve the all available bid slots of Chef, Cashier and Waiter
    $bidDetails = $managerApproveSlotController->onInit($bidID);

    if ($bidDetails !== null) {
        // Retrieve and sanitize the updated user information from the form
        $updatedBidStatus = 'approved';

        // Update the user information
        $userEntity = new Slots();
        if ($userEntity->updateSlot($updatedBidStatus, $bidID)) {
            // Redirect the user back to the users page after the update
            header("Location: ownerSlotsBoundary.php");
            exit();
        }
    } else {
        echo "User not found.";
    }
}
?>
