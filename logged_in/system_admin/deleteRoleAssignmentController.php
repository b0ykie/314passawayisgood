<?php
require_once 'userAccountEntity.php';

class DeleteRoleAssignmentController {
    public function onInit($userID) {
        $userEntity = new Staff();
        $user = $userEntity->getUserByID($userID);
        return $user;
    }
}

// Check if the user ID is provided in the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize the user ID from the form
    $userID = $_POST['id'];

    // Create an instance of UpdateUserController
    $updateUserController = new DeleteRoleAssignmentController();

    // Retrieve the existing user's information
    $user = $updateUserController->onInit($userID);

    if ($user !== null) {
        // Retrieve and sanitize the updated user information from the form
        $updatedProfile = $_POST['profile'];

        // Update the user information
        $userEntity = new Staff();
        if ($userEntity->DeleteRoleAssignment($userID)) {
            // Redirect the user back to the users page after the update
            header("Location: adminRoleBoundary.php");
            exit();
        }
    } else {
        echo "User not found.";
    }
}
?>
