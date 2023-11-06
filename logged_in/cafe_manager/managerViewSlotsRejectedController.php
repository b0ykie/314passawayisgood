<?php
    require_once 'managerEntity.php';

    class managerViewSlotsRejectedController
    {
        public function onInit($slotDate)
        {
            $user = new Bids();

            return $user->getRejectedBids($slotDate);
        }

        public function getSlotDate($slotID)
        {
            $userEntity = new Slots();
            $slotDate = $userEntity->getWorkSlotDate($slotID);
            return $slotDate;
        }

        public function searchRejectedBids($slotDate, $searchKeyword)
        {
            $user = new Bids();

            return $user->searchRejectedBids($slotDate, $searchKeyword);
        }
    }
?>