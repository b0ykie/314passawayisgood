<?php
require_once 'slotEntity.php';

class UpdateSlotController {
    public function onInit($userID) {
        $userEntity = new Slots();
        $user = $userEntity->getUserByID($userID);
        return $user;
    }
}

// Check if the user ID is provided in the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize the user ID from the form
    $userID = $_POST['id'];

    // Create an instance of UpdateUserController
    $updateUserController = new UpdateSlotController();

    // Retrieve the existing user's information
    $user = $updateUserController->onInit($userID);

    if ($user !== null) {
        // Retrieve and sanitize the updated user information from the form
        $updatedProfile = $_POST['profile'];

        // Update the user information
        $userEntity = new Slots();
        if ($userEntity->updateSlot($updatedProfile, $userID)) {
            // Redirect the user back to the users page after the update
            header("Location: ownerSlotsBoundary.php");
            exit();
        }
    } else {
        echo "User not found.";
    }
}
?>
