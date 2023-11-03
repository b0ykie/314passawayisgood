<?php

class FnbSuspendController {
    public function suspendFnb($fnbID, $fnbAvailability) {
        // Include the necessary files
        require_once 'foodAndDrinksEntity.php';

        // Create an instance of the fnbType class
        $fnb = new fnbType();

        // checks if fnbID exists first
        if (($fnb->isFnbIdExist($fnbID))===TRUE)
        {
            if (($fnb->isFnbAlreadySuspended($fnbID))===TRUE)
            {
                $message = "FNB has already been suspended previously. Please choose a different FNB to suspend";
                header("Location: foodAndDrinksSuspendBoundary.php?message=" . urlencode($message));
                exit();
            } 
            else {
                
                $fnb->suspendFnbToDatabase($fnbID, $fnbAvailability);
                $message = "FNB suspended successfully";
                header("Location: foodAndDrinksSuspendBoundary.php?message=" . urlencode($message));
                exit();
            }
        } 
        else {
            
            $message = "FNB does not exist. Please choose a different FNB ID";
            header("Location: foodAndDrinksSuspendBoundary.php?message=" . urlencode($message));
            exit();
        }
        


    }
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $fnbID = $_POST['fnbID'];
   
    $fnbAvailability = 0;
    // Create an instance of the FnbSuspendController class
    $fnbSuspendControllerObject = new FnbSuspendController();

    // Call the suspendFnb function
    $fnbSuspendControllerObject->suspendFnb($fnbID, $fnbAvailability);
}
?>
