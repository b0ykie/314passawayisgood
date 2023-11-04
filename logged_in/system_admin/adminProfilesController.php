<?php

require_once 'userAccountEntity.php';

class AdminProfilesController
{
    public function onInit()
    {
        $user = new Profile();

        return $user->getUserProfiles();
    }

    public function searchProfile($searchKeyword)
    {
        $profile = new Profile();
        $searchProfile = $profile->searchUserProfiles($searchKeyword);
        
        if (!empty($searchProfile)) {
            return $searchProfile;
        }
        else {
            return FALSE;
        }
    }
}
?>
  