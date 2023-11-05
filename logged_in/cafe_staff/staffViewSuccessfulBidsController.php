<?php
class staffViewSuccessfulBidsController
{
    public function onInit($userID, $userrole)
    {
        require_once 'staffEntity.php';

        $user = new SlotBid();
        return $user->getUserSuccessfulBids($userID, $userrole);
    }

    public function searchUserSuccessfulBids($userID, $userrole, $searchKeyword)
    {
        $user = new SlotBid();
        $searchUser = $user->searchUserSuccessfulBids($userID, $userrole, $searchKeyword);

        if (!empty($searchUser)) {
            return $searchUser;
        }
        else {
            return FALSE;
        }
    }
}

?>