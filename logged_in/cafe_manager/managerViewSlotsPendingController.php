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
    }
?>