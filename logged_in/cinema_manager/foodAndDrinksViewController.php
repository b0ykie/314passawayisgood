<?php
session_start();

class FnbViewController {
    public function viewFnb() {
        // Include the necessary files
        require_once 'foodAndDrinksEntity.php';

        // Create an instance of the fnbType class
        $fnb = new fnbType();
        $fnbList = $fnb->retrieveAllFnb();
        return $fnbList;
        
    }
}

// Check if the form is submitted
if (isset($_POST['viewAll'])) {
    // Include the necessary files
    require_once 'foodAndDrinksEntity.php';

    // Create an instance of the FnbViewController class
    $fnbViewControllerObject = new FnbViewController();

    // Call the viewFnb function
    $fnbList = $fnbViewControllerObject->viewFnb();

     // Pass the fnbList to the boundary file
     $_SESSION['fnbList'] = $fnbList;
     header("Location: foodAndDrinksViewBoundary.php");
     exit();
}
?>
