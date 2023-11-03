<?php

require_once 'userAccountEntity.php';

class AdminUsersController
{
    public function onInit()
    {
        $user = new User();

        return $user->getUserAccounts();
    }

    public function searchUsers($searchKeyword)
    {
        $user = new User();
        $searchUser = $user->searchUserAccounts($searchKeyword);

        if (!empty($searchUser)) {
            return $searchUser;
        }
        else {
            return FALSE;
        }
    }
}
?>
  