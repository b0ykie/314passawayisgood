<?php
require_once 'slotEntity.php';

class DeleteSlotController {
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
    $deleteUserController = new DeleteSlotController();

    // Retrieve the existing user's information
    $user = $deleteUserController->onInit($userID);

    if ($user !== null) {
        // Retrieve and sanitize the updated user information from the form

        // Update the user information
        $userEntity = new Slots();
        if ($userEntity->deleteSlots($userID)) {
            // Redirect the user back to the users page after the update
            header("Location: ownerSlotsBoundary.php");
            exit();
        }
    } else {
        echo "User not found.";
    }
}
?>
