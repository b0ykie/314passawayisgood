<?php
    require_once 'staffEntity.php';

    class staffhomeController {
        public function onInit($username) {
            $userEntity = new User();
            $userRole = $userEntity->getUserRole($username);
            return $userRole;
        }
    }
?>