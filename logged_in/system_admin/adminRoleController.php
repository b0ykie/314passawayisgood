<?php

require_once 'userAccountEntity.php';

class AdminRoleController
{
    public function onInit()
    {
        $user = new Staff();

        return $user->getUserProfiles();
    }

    public function searchRole($searchKeyword)
    {
        $profile = new Staff();
        $searchProfile = $profile->searchRoleAssignment($searchKeyword);
        
        if (!empty($searchProfile)) {
            return $searchProfile;
        }
        else {
            return FALSE;
        }
    }
}
?>