<?php
class staffViewPendingBidsController
{
    public function onInit($userID, $userrole)
    {
        require_once 'staffEntity.php';

        $user = new SlotBid();
        return $user->getUserPendingBids($userID, $userrole);
    }

    public function searchUserPendingBids($userID, $userrole, $searchKeyword)
    {
        $user = new SlotBid();
        $searchUser = $user->searchUserPendingBids($userID, $userrole, $searchKeyword);

        if (!empty($searchUser)) {
            return $searchUser;
        }
        else {
            return FALSE;
        }
    }
}

?>