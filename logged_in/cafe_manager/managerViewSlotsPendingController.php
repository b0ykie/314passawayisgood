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
    }
?>