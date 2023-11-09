<?php

require_once 'userAccountEntity.php';

class AdminUsersController
{
    public function getUserAccounts()
    {
        $user = new User();

        $result = $user->getUserAccounts();

        if ($result !== false) {
            return $result; //Returns array to boundary if true
        } else {
            return false;
        }
    }

    public function searchUsers($searchKeyword)
    {
        $user = new User();
        $searchUser = $user->searchUserAccounts($searchKeyword);

        if (!empty($searchUser)) {
            return $searchUser; //Returns array to boundary if true
        }
        else {
            return false;
        }
    }
}
?>
  