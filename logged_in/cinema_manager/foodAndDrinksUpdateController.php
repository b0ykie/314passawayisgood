<?php

require_once 'foodAndDrinksEntity.php';

class FnbUpdateController {
    
    public function updateFnb($fnbID, $fnbName, $fnbPrice, $fnbAvailability) {

        $fnb = new fnbType();
        //$fnb1 = new fnbType();


        // checks if fnbID that cinema manager inputs exists
        if (($fnb->isFnbIdExist($fnbID)) ===TRUE )
        {
            // checks if fnbName that cinema manager wants to update is the same as the fnbName of the fnbID input
            if ( ($fnb->isFnbNameCorrespondToCurrentFnbID($fnbID, $fnbName))===TRUE) 
            {
                // if so, update the FNB in the database
                $fnb->updateFnbToDatabase($fnbID, $fnbName, $fnbAvailability, $fnbPrice);
                $message = "FNB has been updated";
                header("Location: foodAndDrinksUpdateBoundary.php?message=" . urlencode($message));
                exit();
            }
            // if fnbName that cinema manager wants to update is different from the fnbName of the fnbID input
            else
            {
                // check if fnbName that cinema manager wants to update already exists elsewhere in the database 
                if (($fnb->isFnbNameAlreadyExistsElsewhere($fnbID, $fnbName))===TRUE) 
                {
                    // if so, return error message
                    $message = "FNB name already exists. Please key in a different name.";
                    header("Location: foodAndDrinksUpdateBoundary.php?message=" . urlencode($message));
                    exit();
                }
                // if fnbName that cinema manager wants to update to does not exist elsewhere in the database..
                else
                {
                    // proceed to update the FNB with a new fnbName
                    $fnb->updateFnbToDatabase($fnbID, $fnbName, $fnbAvailability, $fnbPrice);
                    $message = "FNB successfully updated.";
                    header("Location: foodAndDrinksUpdateBoundary.php?message=" . urlencode($message));
                    exit();

                }
            }
        }
        //  if fnbID that cinema manager inputs doesnt not exist
        else 
        {
            // return error message
            $message = "FnbID cannot be found. Please choose a different fnbID.";
            header("Location: foodAndDrinksUpdateBoundary.php?message=" . urlencode($message));
            exit();
        }
    }
}

if (isset($_POST['submit'])) {
    $fnbID = $_POST['fnbID'];
    $fnbName = $_POST['fnbName'];
    $fnbPrice = $_POST['fnbPrice'];
    //$fnbAvailability = isset($_POST['fnbAvailability']) ? 1 : 0;
    $fnbAvailability = 1;

    $fnbUpdateControllerObject = new FnbUpdateController();
    $fnbUpdateControllerObject->updateFnb($fnbID, $fnbName, $fnbPrice, $fnbAvailability);
}

?>
