<?php
    class bidController {
        public function approveBid($staffRoleVal, $chefSlotVal, $cashierSlotVal, $waiterSlotVal, $shiftDateVal, $bidIDVal) {
            require_once 'managerEntity.php';

            // Instantiate the Bid entity
            $bid = new Bids();

            //Retrieve the form data
            $staffRole = $staffRoleVal;
            $chefSlot = $chefSlotVal;
            $cashierSlot = $cashierSlotVal;
            $waiterSlot = $waiterSlotVal;
            $shiftDate = $shiftDateVal;
            $bidID = $bidIDVal;

            // Check role and available slots
            switch ($staffRole) {
                case 'chef':
                    if ($chefSlot < 1) {
                        $message = "Less than 1 chef slot available. Approval failed.";
                        header("Location: managerViewIcSlotsBoundary.php?message=" . urlencode($message));
                        exit();
                    }
                    else {
                        $bid->decrementChefSlot($shiftDate);
                        header('Location: logged_in/cafe_manager/managerViewIcSlotsBoundary.php');
                        exit();
                    }
                case 'cashier':
                    if ($cashierSlot < 1) {
                        $message = "Less than 1 cashier slot available. Approval failed.";
                        header("Location: managerViewSlotsPendingBoundary.php?message=" . urlencode($message));
                        exit();
                    }
                    else {
                        $bid->decrementCashierSlot($shiftDate);
                    }
                    break;
                case 'waiter':
                    if ($waiterSlot < 1) {
                        $message = "Less than 1 waiter slot available. Approval failed.";
                        header("Location: managerViewSlotsPendingBoundary.php?message=" . urlencode($message));
                        exit();
                    }
                    else {
                        $bid->decrementWaiterSlot($shiftDate);
                    }
                    break;
                default:
                    $message = "Unknown error!";
                    header("Location: managerViewIcSlotsBoundary.php?message=" . urlencode($message));
                    exit();
            }

            $bid->setBidApproved($bidID);
            $message = "Bid approved.";
            header("Location: managerViewIcSlotsBoundary.php?message=" . urlencode($message));
        }

        public function rejectBid($bidID) {
            require_once 'managerEntity.php';

            // Instantiate the Bid entity
            $bid = new Bids();

            $bid->setBidRejected($bidID);

            $message = "Bid rejected!";
            header("Location: managerViewIcSlotsBoundary.php?message=" . urlencode($message));
        }
    }
    // Obtain data from POST
    $shiftDate = $_POST['shiftDate'];
    $staffRole = $_POST['staffRole'];
    $chefSlot = $_POST['chefSlot'];
    $cashierSlot = $_POST['cashierSlot'];
    $waiterSlot = $_POST['waiterSlot'];
    $bidID = $_POST['id'];
    $action = $_POST['action'];

    // Initialize and call the controller
    $bidController = new bidController();

    if ($action == 'approve') {
        $bidController->approveBid($staffRole, $chefSlot, $cashierSlot, $waiterSlot, $shiftDate, $bidID);
    }
    else {
        $bidController->rejectBid($bidID);
    }
    
?>