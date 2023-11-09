<?php
    require_once 'managerEntity.php';

    class managerViewAvailableStaffBoundary
    {
        public function onInit($slotDate)
        {
            $user = new Bids();

            return $user->getApprovedBids($slotDate);
        }

        public function getSlotDate($slotID)
        {
            $userEntity = new Slots();
            $slotDate = $userEntity->getWorkSlotDate($slotID);
            return $slotDate;
        }

        public function getAvailableStaff($workSlotID)
        {
            $user = new User();

            return $user->getAvailableStaff($workSlotID);
        }

        public function searchAvailableStaff($workSlotID, $searchKeyword)
        {
            $user = new User();

            return $user->searchAvailableStaff($workSlotID, $searchKeyword);
        }
    }
?>