<?php

    class AdminController{
        public function onInit(){
            require_once 'userAccountEntity.php';

            $user = new User();
          
            $userDetails = $user->getUserAccounts();
           
            return $userDetails;

        }
    }

?>