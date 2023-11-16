<?php
    class assignController {

        public function getUsername($userId) {
            require_once 'managerEntity.php';
            $bid = new Bids();
            $username = $bid->getUsername($userId);
            return $username;
        }

        public function approveBid($staffRoleVal, $chefSlotVal, $cashierSlotVal, $waiterSlotVal, $shiftDateVal, $userNameVal, $managerIdVal) {
            require_once 'managerEntity.php';

            // Instantiate the Bid entity
            $bid = new Bids();

            //Retrieve the form data
            $staffRole = $staffRoleVal;
            $chefSlot = $chefSlotVal;
            $cashierSlot = $cashierSlotVal;
            $waiterSlot = $waiterSlotVal;
            $shiftDate = $shiftDateVal;
            $userName = $userNameVal;
            $managerId = $managerIdVal;

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
                    }
                    break;
                case 'cashier':
                    if ($cashierSlot < 1) {
                        $message = "Less than 1 cashier slot available. Approval failed.";
                        header("Location: managerViewIcSlotsBoundary.php?message=" . urlencode($message));
                        exit();
                    }
                    else {
                        $bid->decrementCashierSlot($shiftDate);
                    }
                    break;
                case 'waiter':
                    if ($waiterSlot < 1) {
                        $message = "Less than 1 waiter slot available. Approval failed.";
                        header("Location: managerViewIcSlotsBoundary.php?message=" . urlencode($message));
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

            $bid->createSlotBid($userName, $staffRole, $shiftDate, $managerId);
            $message = "Bid approved.";
            header("Location: managerViewIcSlotsBoundary.php?message=" . urlencode($message));
        }

    }
    // Obtain data from POST
    $shiftDate = $_POST['shiftDate'];
    $staffRole = $_POST['staffRole'];
    $chefSlot = $_POST['chefSlot'];
    $cashierSlot = $_POST['cashierSlot'];
    $waiterSlot = $_POST['waiterSlot'];
    $userId = $_POST['id'];
    $action = $_POST['action'];
    $workSlotID = $_POST['workSlotID'];
    $managerID = $_POST['managerID'];

    // Initialize and call the controller
    $assignController = new assignController();

    $userName = $assignController->getUsername($userId);

    if ($action == 'approve') {
        $assignController->approveBid($staffRole, $chefSlot, $cashierSlot, $waiterSlot, $shiftDate, $userName, $managerID);
    }
?>