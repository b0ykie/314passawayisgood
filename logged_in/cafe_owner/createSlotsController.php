<?php
class CreateSlotsController
{
    public function onInit()
    {
        require_once 'slotEntity.php';

        $user = new Slots();

        return $user->getWorkSlots();
    }

    public function addNewSlot($ownerID, $userName, $userPassword, $userEmail, $userProfile)
    {
        require_once 'slotEntity.php';

        $user = new Slots();
        $check = $user->insertNewSlot($ownerID, $userName, $userPassword,$userEmail,$userProfile);

        return $check;
    }

}

?>