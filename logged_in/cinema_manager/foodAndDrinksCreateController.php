<?php

class FnbCreateController {
    public function createFnb($fnbName, $fnbPrice, $fnbAvailability) {
        // Include the necessary files
        require_once 'foodAndDrinksEntity.php';

        // Create an instance of the fnbType class
        $fnb = new fnbType();

        // Check if the fnbName is already taken
        if ($fnb->isFnbNameTaken($fnbName)) {
            $message = "FnB with the same name already created. Please choose a different name.";
            header("Location: foodAndDrinksCreateBoundary.php?message=" . urlencode($message));
            exit();
        } 
        else {
            // Add the FNB to the database
            $fnb->addFnbToDatabase($fnbName, $fnbAvailability, $fnbPrice);
            $message = "New FNB has been created";
            header("Location: foodAndDrinksCreateBoundary.php?message=" . urlencode($message));
            exit();
        }
    }
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $fnbName = $_POST['fnbName'];
    $fnbPrice = $_POST['fnbPrice'];
    // check box where if checked, returns 1, empty returns 0
    //$fnbAvailability = isset($_POST['fnbAvailability']) ? 1 : 0; 
    $fnbAvailability = 1;
    // Create an instance of the FnbCreateController class
    $fnbCreateControllerObject = new FnbCreateController();

    // Call the createFnb function
    $fnbCreateControllerObject->createFnb($fnbName, $fnbPrice, $fnbAvailability);
}
?>
