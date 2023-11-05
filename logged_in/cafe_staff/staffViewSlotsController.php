<?php
class staffViewSlotsController
{
    public function onInit($username)
    {
        require_once 'staffEntity.php';

        $user = new Slots();
        return $user->getWorkSlots($username);
    }

    public function searchSlots($userID, $searchKeyword)
    {
        $user = new Slots();
        $searchUser = $user->searchSlots($userID, $searchKeyword);

        if (!empty($searchUser)) {
            return $searchUser;
        }
        else {
            return FALSE;
        }
    }
}

?>