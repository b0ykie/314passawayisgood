<?php
require_once 'userAccountEntity.php';

class UpdateUserController {
    public function onInit($userID) {
        $userEntity = new User();
        $user = $userEntity->getUserByID($userID);
        return $user;
    }
}

// Check if the user ID is provided in the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize the user ID from the form
    $userID = $_POST['id'];

    // Create an instance of UpdateUserController
    $updateUserController = new UpdateUserController();

    // Retrieve the existing user's information
    $user = $updateUserController->onInit($userID);

    if ($user !== null) {
        // Retrieve and sanitize the updated user information from the form
        $updatedUsername = $_POST['username'];
        $updatedPassword = $_POST['password'];
        $updatedEmail = $_POST['email'];
        $updatedProfile = $_POST['profile'];

        // Update the user information
        $userEntity = new User();
        if ($userEntity->updateUserInfo($updatedUsername, $updatedPassword, $updatedEmail, $updatedProfile, $userID)) {
            // Redirect the user back to the users page after the update
            header("Location: adminUsersBoundary.php");
            exit();
        }
    } else {
        echo "User not found.";
    }
}
?>
