<?php

class User
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=bse_booking', 'root', '');
    }

    public function authenticate($username, $password, $role)
    {
        $query = "SELECT * FROM user_account WHERE userName = :username AND userPassword = :password AND userProfile = :role";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':role', $role);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return new UserAccount($result['userID'], $result['userName'], $result['userPassword'], $result['userProfile']);
        } else {
            return false;
        }
    }


    private function connect()
    {
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'bse_booking';

        // Create a connection
        $connection = mysqli_connect($hostname, $username, $password, $database);

        return $connection;
    }


    public function getUserByID($userID) {
        $connection = $this->connect();
        $userID = mysqli_real_escape_string($connection, $userID);
        $sql = "SELECT * FROM USER_ACCOUNT WHERE userID = '$userID'";
        $result = mysqli_query($connection, $sql);
    
        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          return new UserAccount(
            $row['userID'],
            $row['userName'],
            $row['userPassword'],
            $row['userEmail'],
            $row['userProfile']
          );
        }
        else {
            return false;
        }
      }
    
      public function updateAdminUserInfo($userID, $updatedUsername, $updatedPassword, $updatedEmail, $updatedProfile) {
        $connection = $this->connect();
        $userID = mysqli_real_escape_string($connection, $userID);
        $updatedUsername = mysqli_real_escape_string($connection, $updatedUsername);
        $updatedPassword = mysqli_real_escape_string($connection, $updatedPassword);
        $updatedEmail = mysqli_real_escape_string($connection, $updatedEmail);
        $updatedProfile = mysqli_real_escape_string($connection, $updatedProfile);
    
        $checkSql = "SELECT * FROM USER_ACCOUNT WHERE userName = '$updatedUsername' AND userID != '$userID'";
        $checkResult = mysqli_query($connection, $checkSql);
    
        if (mysqli_num_rows($checkResult) > 0) {
          echo "Username already exists. Please choose a different username.";
          return false;
        } else {
          $updateSql = "UPDATE USER_ACCOUNT SET userName = '$updatedUsername', userPassword = '$updatedPassword', userEmail = '$updatedEmail', userProfile = '$updatedProfile' WHERE userID = '$userID'";
          mysqli_query($connection, $updateSql);
          return true;
        }
      }
    
    

    public function getUserAccounts()
    {
        try {
            $connection = $this->connect();
            // Retrieve user records from the database
            $sql = "SELECT * FROM USER_ACCOUNT";
            $result = mysqli_query($connection, $sql);
            mysqli_close($connection);
            
            if (empty($result)) {
                return false;
            }
            
            return $result;
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }

    }

    public function searchUserAccounts($searchKeyword){
        $connection = $this->connect();

        $sql = "SELECT * FROM USER_ACCOUNT WHERE userName LIKE '%$searchKeyword%'";
        $result = mysqli_query($connection, $sql);

        if (empty($result)) {
            mysqli_close($connection);
            return false;
        }

        $searchUser = []; // Array to store BookTicket objects

        foreach ($result as $row) {
          $searchUser[] = new UserAccount(
            $row['userID'],
            $row['userName'],
            $row['userPassword'],
            $row['userEmail'],
            $row['userProfile']
          );
        }
        mysqli_close($connection);
        return $searchUser;
    }

    public function getUserProfiles()
    {
        try {
            $connection = $this->connect();
            // Retrieve user records from the database
            $sql = "SELECT * FROM USER_PROFILE";
            $result = mysqli_query($connection, $sql);
            mysqli_close($connection);
            return $result;
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }

    }

    public function retrieveAdminUsername()
    {

        try {

            $connection = $this->connect();
            $updatedUsername = mysqli_real_escape_string($connection, $_POST['username']);
            mysqli_close($connection);
            return $updatedUsername;
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }

    }

    public function retrieveAdminUserPassword()
    {
        try {

            $connection = $this->connect();
            $updatedPassword = mysqli_real_escape_string($connection, $_POST['password']);
            mysqli_close($connection);
            return $updatedPassword;
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
    }

    public function retrieveAdminUserEmail()
    {
        try {

            $connection = $this->connect();
            $updatedEmail = mysqli_real_escape_string($connection, $_POST['email']);
            mysqli_close($connection);
            return $updatedEmail;
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
    }

    public function retrieveAdminUserProfile()
    {
        try {

            $connection = $this->connect();
            $updatedProfile = mysqli_real_escape_string($connection, $_POST['profile']);
            mysqli_close($connection);
            return $updatedProfile;
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
    }

    public function checkDuplicate($userID)
    {
        try {

            $connection = $this->connect();
            $updatedUsername = mysqli_real_escape_string($connection, $_POST['username']);

            // Check for duplicate username
            $checkSql = "SELECT * FROM USER_ACCOUNT WHERE userName = '$updatedUsername' AND userID != '$userID'";
            $checkResult = mysqli_query($connection, $checkSql);
            mysqli_close($connection);
            return $checkResult;
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
    }

    public function retrieveAdminByUsername($username)
    {
        try {

            $connection = $this->connect();

            // Check for duplicate username
            $checkQuery = "SELECT * FROM USER_ACCOUNT WHERE userName = '$username'";
            $checkResult = mysqli_query($connection, $checkQuery);
            return $checkResult;
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
    }

    public function retrieveAdminByEmail($userEmail)
    {
        try {

            $connection = $this->connect();

            // Check for duplicate userEmail
            $checkQuery = "SELECT * FROM USER_ACCOUNT WHERE userEmail = '$userEmail'";
            $checkResult = mysqli_query($connection, $checkQuery);
            return $checkResult;
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
    }

    public function retrieveProfile($userProfileType )
    {
        try {

            $connection = $this->connect();

            // Check for duplicate userEmail
            $checkQuery = "SELECT * FROM USER_PROFILE WHERE userProfileType  = '$userProfileType '";
            $checkResult = mysqli_query($connection, $checkQuery);
            return $checkResult;
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
    }

    public function insertNewUser($userName, $userPassword, $userEmail, $userProfile, $randomPhoneNumber)
    {
        try {
            $connection = $this->connect();

            $insertQuery = "INSERT INTO USER_ACCOUNT (userName, userPassword, userEmail, userProfile, userPhone) 
            VALUES ('$userName', '$userPassword', '$userEmail', '$userProfile', '$randomPhoneNumber')";

            mysqli_query($connection, $insertQuery);
            mysqli_close($connection);

            return true;

        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
    }

    public function updateUserInfo($updatedUsername, $updatedPassword, $updatedEmail, $updatedProfile, $userID)
    {
        try {
            $connection = $this->connect();

            $checkSql = "SELECT * FROM USER_ACCOUNT WHERE userName = '$updatedUsername' AND userID != '$userID'";
            $checkResult = mysqli_query($connection, $checkSql);

            // Check if a user with the same username exists
            if (mysqli_num_rows($checkResult) > 0) {
                // Display an error message or handle the duplicate username scenario as desired
                echo "Username already exists. Please choose a different username.";

            } else {
                $updateSql = "UPDATE USER_ACCOUNT SET userName = '$updatedUsername', userPassword = '$updatedPassword', userEmail = '$updatedEmail', userProfile = '$updatedProfile' WHERE userID = '$userID'";
                mysqli_query($connection, $updateSql);
                mysqli_close($connection);
                return true;
            }
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
    }

    public function deleteUserAccount($userID)
    {
        try {
            $connection = $this->connect();

            $checkSql = "SELECT * FROM USER_ACCOUNT WHERE userID = '$userID'";
            $checkResult = mysqli_query($connection, $checkSql);
            // Check if a user with the same username exists
            if (mysqli_num_rows($checkResult) <= 0) {
                // Display an error message or handle the duplicate username scenario as desired
                echo "Username already exists. Please choose a different username.";

            } else {
                $deleteSqlUserProfile = "DELETE FROM user_account WHERE userID = :oldProfile";

                $stmt = $this->db->prepare($deleteSqlUserProfile);
                $stmt->bindValue(':oldProfile', $userID);
                $stmt->execute();
                // $sqlSyntax = "SELECT * from user_profile up where up.userProfileType = "."$userId";
                // $updateSql = "UPDATE USER_PROFILE SET userProfileType = '$updatedProfile'";
                // mysqli_query($connection, $updateSql);
                // mysqli_close($connection);
                return true;
            }
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
    }

    public function updateUserProfile($updatedProfile)
    {
        try {
            $connection = $this->connect();
            $checkSql = "SELECT * FROM USER_PROFILE WHERE userProfileType = '$updatedProfile'";
            $checkResult = mysqli_query($connection, $checkSql);

            // Check if a user with the same username exists
            if (mysqli_num_rows($checkResult) > 0) {
                // Display an error message or handle the duplicate username scenario as desired
                echo "Username already exists. Please choose a different username.";

            } else {
                $updateSql = "UPDATE USER_PROFILE SET userProfileType = '$updatedProfile'";
                mysqli_query($connection, $updateSql);
                mysqli_close($connection);
                return true;
            }
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
    }

    public function userDetails($username)
    {
        $query = "SELECT * FROM user_account WHERE userName = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return new UserAccount($result['userID'], $result['userName'], $result['userPassword'], $result['userProfile']);
        } else {
            return false;
        }
    }

    public function retrieveProfileTypes(){
        try {
            $connection = $this->connect();
            $sql = "SELECT userProfileType FROM USER_PROFILE";
            $result = mysqli_query($connection, $sql);
            return $result;
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
    }

    public function insertUserProfile($userProfileType)
    {
        try {
            $connection = $this->connect();
            // Prepare the SQL query to insert a new profile
            $sql = "INSERT INTO USER_PROFILE (userProfileType) 
                    VALUES ('$userProfileType')";

            if(mysqli_query($connection, $sql)){
                return true;
            }
            else if($errorCode = mysqli_errno($connection)){
                if($errorCode == 1062){
                    return false;
                }
            }
            mysqli_close($connection);
            
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }

    }


}

class Profile
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=bse_booking', 'root', '');
    }

    public function authenticate($username, $password, $role)
    {
        $query = "SELECT * FROM user_account WHERE userName = :username AND userPassword = :password AND userProfile = :role";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':role', $role);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return new UserAccount($result['userID'], $result['userName'], $result['userPassword'], $result['userProfile']);
        } else {
            return false;
        }
    }


    private function connect()
    {
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'bse_booking';

        // Create a connection
        $connection = mysqli_connect($hostname, $username, $password, $database);

        return $connection;
    }


    public function getUserByID($userID) {
        $connection = $this->connect();
        $userID = mysqli_real_escape_string($connection, $userID);
        $sql = "SELECT * FROM USER_PROFILE WHERE userProfileType = '$userID'";
        $result = mysqli_query($connection, $sql);
    
        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          return new UserProfile(
            $row['userProfileType'],
          );
        }
      }


    public function getUserProfiles()
    {
        try {
            $connection = $this->connect();
            // Retrieve user records from the database
            $sql = "SELECT * FROM USER_PROFILE";
            $result = mysqli_query($connection, $sql);
            mysqli_close($connection);
            return $result;
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }

    }

    public function searchUserProfiles($searchKeyword){
        $connection = $this->connect();

        $sql = "SELECT * FROM USER_PROFILE WHERE userProfileType LIKE '%$searchKeyword%'";
        $result = mysqli_query($connection, $sql);

        $searchProfile = []; // Array to store BookTicket objects

        foreach ($result as $row) {
          $searchProfile[] = new UserProfile(
            $row['userProfileType'],
          );
        }
    
        mysqli_close($connection);
        return $searchProfile;
    }

    public function checkDuplicate($userID)
    {
        try {

            $connection = $this->connect();
            $updatedUsername = mysqli_real_escape_string($connection, $_POST['username']);

            // Check for duplicate username
            $checkSql = "SELECT * FROM USER_ACCOUNT WHERE userName = '$updatedUsername' AND userID != '$userID'";
            $checkResult = mysqli_query($connection, $checkSql);
            mysqli_close($connection);
            return $checkResult;
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
    }

    public function retrieveProfile($userProfileType )
    {
        try {

            $connection = $this->connect();

            // Check for duplicate userEmail
            $checkQuery = "SELECT * FROM USER_PROFILE WHERE userProfileType  = '$userProfileType '";
            $checkResult = mysqli_query($connection, $checkQuery);
            return $checkResult;
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
    }

    public function updateUserProfile($updatedProfile, $userID)
    {
        try {
            $connection = $this->connect();

            $checkSql = "SELECT * FROM USER_PROFILE WHERE userProfileType = '$userID'";
            $checkResult = mysqli_query($connection, $checkSql);
            // Check if a user with the same username exists
            if (mysqli_num_rows($checkResult) <= 0) {
                // Display an error message or handle the duplicate username scenario as desired
                echo "Username already exists. Please choose a different username.";

            } else {
                $updateSqlUserProfile =  "UPDATE user_profile up
                set up.userProfileType  = :newProfile 
                where up.userProfileType = :oldProfile";

                $stmt = $this->db->prepare($updateSqlUserProfile);
                $stmt->bindValue(':oldProfile', $userID);
                $stmt->bindValue(':newProfile', $updatedProfile);
                $stmt->execute();
                // $sqlSyntax = "SELECT * from user_profile up where up.userProfileType = "."$userId";
                // $updateSql = "UPDATE USER_PROFILE SET userProfileType = '$updatedProfile'";
                // mysqli_query($connection, $updateSql);
                // mysqli_close($connection);
                return true;
            }
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
    }

    public function DeleteUserProfile($updatedProfile, $userID)
    {
        try {
            $connection = $this->connect();

            $checkSql = "SELECT * FROM USER_PROFILE WHERE userProfileType = '$userID'";
            $checkResult = mysqli_query($connection, $checkSql);
            // Check if a user with the same username exists
            if (mysqli_num_rows($checkResult) <= 0) {
                // Display an error message or handle the duplicate username scenario as desired
                echo "Username already exists. Please choose a different username.";

            } else {
                $deleteSqlUserProfile = "DELETE FROM user_profile WHERE userProfileType = :oldProfile";

                $stmt = $this->db->prepare($deleteSqlUserProfile);
                $stmt->bindValue(':oldProfile', $userID);
                $stmt->execute();
                // $sqlSyntax = "SELECT * from user_profile up where up.userProfileType = "."$userId";
                // $updateSql = "UPDATE USER_PROFILE SET userProfileType = '$updatedProfile'";
                // mysqli_query($connection, $updateSql);
                // mysqli_close($connection);
                return true;
            }
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
    }


    public function retrieveProfileTypes(){
        try {
            $connection = $this->connect();
            $sql = "SELECT userProfileType FROM USER_PROFILE";
            $result = mysqli_query($connection, $sql);
            return $result;
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
    }

}

class Staff
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=bse_booking', 'root', '');
    }

    public function authenticate($username, $password, $role)
    {
        $query = "SELECT * FROM user_account WHERE userName = :username AND userPassword = :password AND userProfile = :role";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':role', $role);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return new UserAccount($result['userID'], $result['userName'], $result['userPassword'], $result['userProfile']);
        } else {
            return false;
        }
    }


    private function connect()
    {
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'bse_booking';

        // Create a connection
        $connection = mysqli_connect($hostname, $username, $password, $database);

        return $connection;
    }


    public function getUserByID($userID) {
        $connection = $this->connect();
        $userID = mysqli_real_escape_string($connection, $userID);
        $sql = "SELECT * FROM CAFE_STAFF WHERE staffID = '$userID'";
        $result = mysqli_query($connection, $sql);
    
        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          return new CafeStaff(
            $row['staffID'],
            $row['staffRole'],
            $row['userID'],
          );
        }
      }


    public function getUserProfiles()
    {
        try {
            $connection = $this->connect();
            // Retrieve user records from the database
            $sql = "SELECT * FROM CAFE_STAFF";
            $result = mysqli_query($connection, $sql);
            mysqli_close($connection);
            return $result;
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }

    }

    public function searchRoleAssignment($searchKeyword){
        $connection = $this->connect();

        $sql = "SELECT * FROM CAFE_STAFF WHERE userID LIKE '%$searchKeyword%'";
        $result = mysqli_query($connection, $sql);

        $searchProfile = []; // Array to store BookTicket objects

        foreach ($result as $row) {
          $searchProfile[] = new CafeStaff(
            $row['staffID'],
            $row['staffRole'],
            $row['userID'],
          );
        }
    
        mysqli_close($connection);
        return $searchProfile;
    }

    public function checkDuplicate($userID)
    {
        try {

            $connection = $this->connect();
            $updatedUsername = mysqli_real_escape_string($connection, $_POST['userName']);

            // Check for duplicate username
            $checkSql = "SELECT * FROM CAFE_STAFF WHERE userName = '$updatedUsername' AND userID != '$userID'";
            $checkResult = mysqli_query($connection, $checkSql);
            mysqli_close($connection);
            return $checkResult;
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
    }

    public function addUserToDatabase($username, $email) {
        try {
            $connection = $this->connect();
            $staffID = $username . '_' . $email;

            $insertQuery = "INSERT INTO CAFE_STAFF (staffID, userID, staffRole) 
            VALUES ('$staffID', '$username', '$email')";

            mysqli_query($connection, $insertQuery);
            mysqli_close($connection);

            return true;

        } catch (Exception $e) {

        }
    }

    public function retrieveProfile($userProfileType )
    {
        try {

            $connection = $this->connect();

            // Check for duplicate userEmail
            $checkQuery = "SELECT * FROM USER_PROFILE WHERE userProfileType  = '$userProfileType '";
            $checkResult = mysqli_query($connection, $checkQuery);
            return $checkResult;
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
    }

    public function updateUserProfile($updatedProfile, $userID)
    {
        try {
            $connection = $this->connect();

            $checkSql = "SELECT * FROM USER_PROFILE WHERE userProfileType = '$userID'";
            $checkResult = mysqli_query($connection, $checkSql);
            // Check if a user with the same username exists
            if (mysqli_num_rows($checkResult) <= 0) {
                // Display an error message or handle the duplicate username scenario as desired
                echo "Username already exists. Please choose a different username.";

            } else {
                $updateSqlUserProfile =  "UPDATE user_profile up
                set up.userProfileType  = :newProfile 
                where up.userProfileType = :oldProfile";

                $stmt = $this->db->prepare($updateSqlUserProfile);
                $stmt->bindValue(':oldProfile', $userID);
                $stmt->bindValue(':newProfile', $updatedProfile);
                $stmt->execute();
                // $sqlSyntax = "SELECT * from user_profile up where up.userProfileType = "."$userId";
                // $updateSql = "UPDATE USER_PROFILE SET userProfileType = '$updatedProfile'";
                // mysqli_query($connection, $updateSql);
                // mysqli_close($connection);
                return true;
            }
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
    }

    public function DeleteRoleAssignment($userID)
    {
        try {
            $connection = $this->connect();

            $checkSql = "SELECT * FROM CAFE_STAFF WHERE staffID = '$userID'";
            $checkResult = mysqli_query($connection, $checkSql);
            // Check if a user with the same username exists
            if (mysqli_num_rows($checkResult) <= 0) {
                // Display an error message or handle the duplicate username scenario as desired
                echo "Username already exists. Please choose a different username.";

            } else {
                $deleteSqlUserProfile = "DELETE FROM CAFE_STAFF WHERE staffID = :oldProfile";

                $stmt = $this->db->prepare($deleteSqlUserProfile);
                $stmt->bindValue(':oldProfile', $userID);
                $stmt->execute();
                // $sqlSyntax = "SELECT * from user_profile up where up.userProfileType = "."$userId";
                // $updateSql = "UPDATE USER_PROFILE SET userProfileType = '$updatedProfile'";
                // mysqli_query($connection, $updateSql);
                // mysqli_close($connection);
                return true;
            }
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
    }


    public function retrieveProfileTypes(){
        try {
            $connection = $this->connect();
            $sql = "SELECT userProfileType FROM USER_PROFILE";
            $result = mysqli_query($connection, $sql);
            return $result;
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
    }

}

class UserAccount
{
    private $userID;
    private $userName;
    private $userPassword;
    private $userEmail;
    private $userProfile;

    public function __construct($id, $username, $password, $userEmail, $role)
    {
        $this->userID = $id;
        $this->userName = $username;
        $this->userPassword = $password;
        $this->userEmail = $userEmail;
        $this->userProfile = $role;
    }

    public function getId()
    {
        return $this->userID;
    }

    public function getUsername()
    {
        return $this->userName;
    }

    public function getPassword()
    {
        return $this->userPassword;
    }

    public function getRole()
    {
        return $this->userProfile;
    }

    public function getEmail(){
        return $this->userEmail;
    }

}

class UserProfile
{

    private $userProfileType;

    public function __construct($userProfileType)
    {
        $this->userProfileType = $userProfileType;
    }


    public function getProfile()
    {
        return $this->userProfileType;
    }
}

class CafeStaff
{
    private $staffID;
    private $staffRole;
    private $userID;

    public function __construct($staffID, $staffRole, $userID)
    {
        $this->staffID = $staffID;
        $this->staffRole = $staffRole;
        $this->userID = $userID;
    }

    public function getStaffID()
    {
        return $this->staffID;
    }

    public function getStaffRole()
    {
        return $this->staffRole;
    }

    public function getUserID()
    {
        return $this->userID;
    }
}

?>