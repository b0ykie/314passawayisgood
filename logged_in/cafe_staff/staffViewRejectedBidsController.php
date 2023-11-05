<?php
class staffViewRejectedBidsController
{
    public function onInit($userID, $userrole)
    {
        require_once 'staffEntity.php';

        $user = new SlotBid();
        return $user->getUserRejectedBids($userID, $userrole);
    }

    public function searchUserRejectedBids($userID, $userrole, $searchKeyword)
    {
        $user = new SlotBid();
        $searchUser = $user->searchUserRejectedBids($userID, $userrole, $searchKeyword);

        if (!empty($searchUser)) {
            return $searchUser;
        }
        else {
            return FALSE;
        }
    }
}

?>