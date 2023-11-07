<?php
    require_once 'managerEntity.php';

    class managerViewSlotsPendingController
    {
        public function onInit($slotDate)
        {
            $user = new Bids();

            return $user->getPendingBids($slotDate);
        }

        public function getSlotDate($slotID)
        {
            $userEntity = new Slots();
            $slotDate = $userEntity->getWorkSlotDate($slotID);
            return $slotDate;
        }

        public function searchPendingBids($slotDate, $searchKeyword)
        {
            $user = new Bids();

            return $user->searchPendingBids($slotDate, $searchKeyword);
        }

        public function getSlotRoleslots($bidID) {
            $userEntity = new Slots();
            $availableSlotRoleslots = $userEntity->getSlotRoleslots($bidID);
            return $availableSlotRoleslots;
        }

        public function getBidByID($userID) {
            $userEntity = new Bids();
            $bidDetails = $userEntity->getBidByID($userID);
            return $bidDetails;
        }

        public function getNoOfApprovedBids($slotDate)
        {
            $noOfApprovedBids = new Bids();

            return $noOfApprovedBids->getNoOfApprovedBids($slotDate);
        }

        public function updateNoOfSlots($slotDate)
        {
            switch ($staffRole) {
                case 'chef':
                    if ($chefSlot >= 1)
                    {
                      //Call controller and pass status to minus 1 via query
                    }
                    else
                    {
                      $message = "Either your Username, Password or Role is incorrect.";
                      header("Location: managerViewSlotsPendingBoundary.php?message=" . urlencode($message));
                    }
                    break;
                case 'cashier':
                    if ($cashierSlot >= 1)
                    {
                      
                    }
                    else
                    {
                      $message = "Either your Username, Password or Role is incorrect.";
                      header("Location: managerViewSlotsPendingBoundary.php?message=" . urlencode($message));
                    }
                    break;
                case 'waiter':
                    if ($waiterSlot >= 1)
                    {
                      
                    }
                    else
                    {
                      $message = "Either your Username, Password or Role is incorrect.";
                      header("Location: managerViewSlotsPendingBoundary.php?message=" . urlencode($message));
                    }
                  break;
                default:
                    // Handle other cases (greater than 1, or any other values)
            }
        } 
    }
?>