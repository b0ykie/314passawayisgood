<?php

    class approveController{

        public function approveBid($chefSlotVal, $cashierSlotVal, $waiterSlotVal, $staffRoleVal, $staff_idVal){
            
            require_once 'managerEntity.php';

            // Instantiate the Bid entity
            $bid = new Bids();

            // Retrieve the form data
            $chefSlot = $chefSlotVal;
            $cashierSlot = $cashierSlotVal;
            $waiterSlot = $waiterSlotVal;
            $staffRole = $staffRoleVal;
            $role = $roleVal;

            //Check role > slots > execute update query
            switch ($staffRole) {
                case 'chef':
                    if ($chefSlot >= 1)
                    {
                        //Call controller and pass status to minus 1 via query
                    }
                    else
                    {
                        $message = "Less than 1 slots. Not able to approve";
                        header("Location: managerViewSlotsPendingBoundary.php?message=" . urlencode($message));
                        exit();
                    }
                case 'cashier':
                    if ($cashierSlot >= 1)
                    {
                        
                    }
                    else
                    {
                        $message = "Less than 1 slots. Not able to approve";
                        header("Location: managerViewSlotsPendingBoundary.php?message=" . urlencode($message));
                        exit();
                    }
                case 'waiter':
                    if ($waiterSlot >= 1)
                    {
                        
                    }
                    else
                    {
                        $message = "Less than 1 slots. Not able to approve";
                        header("Location: managerViewSlotsPendingBoundary.php?message=" . urlencode($message));
                        exit();
                    }
                default:
                    // Handle other cases (greater than 1, or any other values)

            // Attempt to authenticate the user
            $result = $bid->setBidApproved($chefSlot, $cashierSlot, $waiterSlot, $staffRole, $role);

            if ($result) 
            {

                
                switch ($result->getRole()) {
                    case 'staff':
                        header('Location: logged_in/cafe_staff/staffhomeBoundary.php');
                        exit();
                    case 'admin':
                        header('Location: logged_in/system_admin/adminhomeBoundary.php');
                        exit();
                    case 'owner':
                        header('Location: logged_in/cafe_owner/ownerhomeBoundary.php');
                        exit();
                    case 'manager':
                        header('Location: logged_in/cafe_manager/managerhomeBoundary.php');
                        exit();
                    default:
                        // Invalid role
                        $message = "Invalid role";
                        header("Location: loginBoundary.php?message=" . urlencode($message));
                        exit();
                }
            }

            else {
                // Failed approveBid
                $message = "Either your Username, Password or Role is incorrect.";
                header("Location: loginBoundary.php?message=" . urlencode($message));
            }
        }
    }

    $chefSlot = $_POST['chefSlot'];
    $cashierSlot = $_POST['cashierSlot'];
    $waiterSlot = $_POST['waiterSlot'];
    $staffRole = $_POST['staffRole'];
    $staff_id = $_POST['staff_id'];

    $approveController = new approveController();

    $approveController ->approveBid($chefSlot, $cashierSlot, $waiterSlot, $staffRole, $staff_id);



?>