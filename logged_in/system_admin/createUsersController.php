<?php
class CreateUsersController
{
    public function onInit()
    {
        require_once 'userAccountEntity.php';

        $user = new User();

        return $user->getUserAccounts();
    }

    public function checkDuplicateByUsername($username)
    {
        require_once 'userAccountEntity.php';

        $user = new User();

        $checkResult = $user->retrieveAdminByUsername($username);

        return $checkResult;
    }

    public function checkDuplicateByEmail($userEmail)
    {
        require_once 'userAccountEntity.php';

        $user = new User();

        $checkResult = $user->retrieveAdminByEmail($userEmail);

        return $checkResult;
    }

    public function addNewUser($userName, $userPassword, $userEmail, $userProfile)
    {
        require_once 'userAccountEntity.php';

        $user = new User();
        $check = $user->insertNewUser($userName, $userPassword,$userEmail,$userProfile);

        return $check;
    }

}

?>