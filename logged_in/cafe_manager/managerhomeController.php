<?php
    require_once 'managerEntity.php';

    class managerhomeController {
        public function onInit($username) {
            $userEntity = new User();
            $userRole = $userEntity->getUserRole($username);
            return $userRole;
        }
    }
?>