<?php

require_once 'slotEntity.php';

class OwnerSlotsController
{
    public function onInit()
    {
        $user = new Slots();

        return $user->getWorkSlots();
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
  