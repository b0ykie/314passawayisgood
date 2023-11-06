<?php
    require_once 'managerEntity.php';

    class managerViewSlotSpecificsController
    {
        public function onInit($slotID)
        {
            $user = new Slots();

            return $user->getSlotByID($slotID);
        }

        public function searchSlots($searchKeyword)
        {
            $user = new Slots();
            $searchUser = $user->searchSlots($searchKeyword);

            if (!empty($searchUser)) {
                return $searchUser;
            }
            else {
                return FALSE;
            }
        }
    }
?>