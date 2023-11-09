<?php
class CreateUsersController
{
    public function onInit()
    {
        require_once 'userAccountEntity.php';

        $user = new User();

        $userAccounts = $user->getUserAccounts();

        if (empty($userAccounts)) {
            return false;
        }

        return $userAccounts;
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

        function generateRandomEmail() {
            // Characters for the random part of the email
            $characters = 'abcdefghijklmnopqrstuvwxyz';
        
            // Generate a random 4-letter part
            $randomPart = '';
            for ($j = 0; $j < 4; $j++) {
                $randomPart .= $characters[rand(0, strlen($characters) - 1)];
            }
        
            // Combine the random part, "@gmail.com"
            $email = $randomPart . '@gmail.com';
        
            return $email;
        }

        $randomPhoneNumber = mt_rand(80000000, 99999999);
        $randomEmail = generateRandomEmail();
        $onePassword = "1";
        $staffProfile = "staff";

        $user = new User();
        $check = $user->insertNewUser($userName, $onePassword, $randomEmail, $staffProfile, $randomPhoneNumber);

        return $check;
    }

    

}

?>