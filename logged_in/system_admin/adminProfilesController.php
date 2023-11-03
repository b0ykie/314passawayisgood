<?php

require_once 'userAccountEntity.php';

class AdminUsersController
{
    public function onInit()
    {
        $user = new User();

        return $user->getUserProfiles();
    }

    public function searchProfile($searchKeyword)
    {
        $user = new User();
        $searchProfile = $user->searchUserProfiles($searchKeyword);

        if (!empty($searchProfile)) {
            return $searchProfile;
        }
        else {
            return FALSE;
        }
    }
}
?>
  