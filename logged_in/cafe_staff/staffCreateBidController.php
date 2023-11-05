<?php
    require_once 'staffEntity.php';

    class staffCreateBidController {
        public function onInit($slotID) {
            $userEntity = new Slots();
            $slotID = $userEntity->getWorkSlotID($slotID);
            return $slotID;
        }
        public function getDate($slotID) {
            $userEntity = new Slots();
            $slotDate = $userEntity->getWorkSlotDate($slotID);
            return $slotDate;
        }
    }

    // Check if the user ID is provided in the form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve and sanitize the user ID from the form
        $userID = $_POST['id'];
    
        // Create an instance of UpdateUserController
        $updateUserController = new staffCreateBidController();
    
        // Retrieve the existing user's information
        $user = $updateUserController->onInit($userID);
    
        if ($user !== null) {
            // Retrieve and sanitize the updated user information from the form
            $username = $_POST['username'];
            $userrole = $_POST['userrole'];
            $slotdate = $_POST['slotdate'];
    
            // Update the user information
            $userEntity = new SlotBid();
            if ($userEntity->createSlotBid($username, $userrole, $slotdate)) {
                // $message = "Bid submitted successfully!";
                // header("Location: staffViewSlotsBoundary.php?message=" . urlencode($message));
                // Redirect the user back to the users page after the update
                header("Location: staffViewSlotsBoundary.php");
                exit();
            }
        } else {
            echo "User not found.";
        }
    }
?>
