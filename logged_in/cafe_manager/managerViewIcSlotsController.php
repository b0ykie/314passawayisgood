<?php
    require_once 'managerEntity.php';

    class managerViewIcSlotsController
    {
        public function onInit($username)
        {
            $user = new Slots();

            return $user->getIcSlots($username);
        }

        public function searchIcSlots($searchKeyword, $username)
        {
            $user = new Slots();
            $searchUser = $user->searchIcSlots($searchKeyword, $username);

            if (!empty($searchUser)) {
                return $searchUser;
            }
            else {
                return FALSE;
            }
        }
    }
?>