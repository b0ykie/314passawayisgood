<?php
    require_once 'managerEntity.php';

    class managerViewSlotsController
    {
        public function onInit($username)
        {
            $user = new Slots();

            return $user->getWorkSlots($username);
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