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

        public function getAvailableStaff($workSlotDate)
        {
            $user = new User();

            return $user->getAvailableStaff($workSlotDate);
        }

        public function searchAvailableStaff($workSlotDate, $searchKeyword)
        {
            $user = new User();
            return $user->searchAvailableStaff($workSlotDate, $searchKeyword);
        }

        public function getSlotRoleslots($slotID) {
            $userEntity = new Slots();
            $availableSlotRoleslots = $userEntity->getSlotRoleslots($slotID);
            return $availableSlotRoleslots;
        }
    }
?>