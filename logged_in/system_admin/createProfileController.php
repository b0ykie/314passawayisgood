<?php
    class CreateProfileController{
        public function onInit(){
            require_once 'userAccountEntity.php';

            $user = new User();
          
            $userDetails = $user->getUserAccounts();
           
            return $userDetails;

        }

        public function addNewUserProfile($userProfileType){
            require_once 'userAccountEntity.php';

            $user = new User();
          
            $result = $user->insertUserProfile($userProfileType);

            return $result;
        }

        public function retrieveUserProfile($userProfileType){
            require_once 'userAccountEntity.php';

            $user = new User();
          
            $result = $user->retrieveProfile($userProfileType);

            return $result;
        }

        public function getProfileTypes(){
            require_once 'userAccountEntity.php';

            $profileTypes = array();

            $user = new User();
          
            $result = $user->retrieveProfileTypes();

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $profileTypes[] = $row['userProfileType'];
                }
        }
        return $profileTypes;
    }
    }
?>