<?php
    require_once 'managerEntity.php';

    class managerViewSlotsApprovedController
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

        public function searchApprovedBids($slotDate, $searchKeyword)
        {
            $user = new Bids();

            return $user->searchApprovedBids($slotDate, $searchKeyword);
        }
    }
?>