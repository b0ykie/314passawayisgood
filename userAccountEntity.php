<?php

    class User {
        private $db;

        public function __construct() {
            $this->db = new PDO('mysql:host=localhost;dbname=bse_booking', 'root', '');
        }

        public function authenticate($username, $password, $role) {
            $query = "SELECT * FROM user_account WHERE userName = :username AND userPassword = :password AND userProfile = :role";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $password);
            $stmt->bindValue(':role', $role);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return new UserAccount($result['userID'], $result['userName'], $result['userPassword'], $result['userProfile']);
            } 
            else {
                return false;
            }
        }

        public function userDetails($username) {
            $query = "SELECT * FROM user_account WHERE userName = :username";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':username', $username);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return new UserAccount($result['userID'], $result['userName'], $result['userPassword'], $result['userProfile']);
            } 
            else {
                return false;
            }
        }

        // Check if the username is taken
        public function isUsernameTaken($username) {
            $stmt = $this->db->prepare("SELECT * FROM user_account WHERE userName= :username");
            $stmt->bindValue(':username', $username);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return true; // username already exists
            } else {
                return false; // username doesn't exist
            }
        }
        
        // Check if the email is taken
        public function isEmailTaken($email) {
            $stmt = $this->db->prepare("SELECT * FROM user_account WHERE userEmail= :email");
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return true; // username already exists
            } else {
                return false; // username doesn't exist
            }
        }

        // Add the user to the database
        public function addUserToDatabase($username, $password, $email, $role, $randomPhoneNumber) {
            // Prepare a statement to insert the user information into the database
            // $stmt = $this->db->prepare('INSERT INTO user_account (userName, userPassword, userEmail, userProfile) VALUES (:username, :password, :email, :role)');
            // $stmt->execute(array(':username' => $username, ':password' => $password, ':email' => $email, ':role' => $role));
            try {
                $stmt = $this->db->prepare('INSERT INTO user_account (userName, userPassword, userEmail, userProfile,  userPhone) VALUES (:username, :password, :email, :role, :phone)');
                $stmt->execute(array(':username' => $username, ':password' => $password, ':email' => $email, ':role' => $role, ':phone' => $randomPhoneNumber));
                return true; // User added successfully
            } catch (PDOException $e) {
                return false; // Failed to add user
            }
        }
    }


    class UserAccount {
        private $id;
        private $username;
        private $password;
        private $role;
        
        public function __construct($id, $username, $password, $role) {
            $this->id = $id;
            $this->username = $username;
            $this->password = $password;
            $this->role = $role;
        }

        public function getId() {
            return $this->id;
        }

        public function getUsername() {
            return $this->username;
        }

        public function getPassword() {
            return $this->password;
        }

        public function getRole() {
            return $this->role;
        }
    }

?>