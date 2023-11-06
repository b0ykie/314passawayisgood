<?php
require_once 'managerEntity.php';

class managerTakeSlotController {
    public function onInit($slotID) {
        $userEntity = new Slots();
        $slotDate = $userEntity->getSlotByID($slotID);
        return $slotDate;
    }
}

// Check if the user ID is provided in the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize the user ID from the form
    $slotID = $_POST['id'];
    $username = $_POST['username'];

    // Create an instance of UpdateUserController
    $updateUserController = new managerTakeSlotController();

    // Retrieve the existing user's information
    $user = $updateUserController->onInit($slotID);

    if ($user !== null) {
        // Retrieve and sanitize the updated user information from the form
        $updatedProfile = $_POST['profile'];

        // Update the user information
        $userEntity = new Slots();
        if ($userEntity->updateSlotManager($updatedProfile, $slotID, $username)) {
            // Redirect the user back to the users page after the update
            header("Location: managerViewSlotsBoundary.php");
            exit();
        }
    } else {
        echo "User not found.";
    }
}
?>
