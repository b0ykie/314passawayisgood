<?php
session_start();

class fnbSearchController{
    public function searchFnb($fnbName){
        require_once 'foodAndDrinksEntity.php';

        // Create an instance of the fnbType class
        $fnb = new fnbType();

        $fnbList = $fnb->displayFnb($fnbName);
        if (empty($fnbList)) {
            $message = "FnB cannot be found. Please choose a different name.";
            header("Location: foodAndDrinksSearchBoundary.php?message=" . urlencode($message));
            exit();
        } else {
            return $fnbList;
        }
    }
}

if(isset($_POST['submit'])){
    $fnbName = $_POST['fnbName'];

    // Create an instance of the FnbController class
    $fnbSearchControllerObject = new fnbSearchController();
    $fnbList = $fnbSearchControllerObject->searchFnb($fnbName);
    
    // Pass the fnbList to the boundary file
    $_SESSION['fnbList'] = $fnbList;
    header("Location: foodAndDrinksSearchBoundary.php");
    exit();
}
?>
