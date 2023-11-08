.php

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
    }
?>