<?php
  class Slots {
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=bse_booking', 'root', '');
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
      $sql = "SELECT * FROM WORK_SLOT WHERE slotID = '$userID'";
      $result = mysqli_query($connection, $sql);
  
      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return new WorkSlot(
          $row['slotID'],
          $row['ownerID'],
          $row['chefSlot'],
          $row['cashierSlot'],
          $row['waiterSlot'],
          $row['slotDate']
        );
      }
    }

    public function deleteSlots($userID)
    {
        try {
            $connection = $this->connect();

            $checkSql = "SELECT * FROM WORK_SLOT WHERE slotID = '$userID'";
            $checkResult = mysqli_query($connection, $checkSql);
            // Check if a user with the same username exists
            if (mysqli_num_rows($checkResult) <= 0) {
                // Display an error message or handle the duplicate username scenario as desired
                echo "Username already exists. Please choose a different username.";

            } else {
                $deleteSqlUserProfile = "DELETE FROM work_slot WHERE slotID = :oldProfile";

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

    public function updateSlot($updatedProfile, $userID)
    {
        try {
            $connection = $this->connect();

            $checkSql = "SELECT * FROM WORK_SLOT WHERE slotID = '$userID'";
            $checkResult = mysqli_query($connection, $checkSql);
            // Check if a user with the same username exists
            if (mysqli_num_rows($checkResult) <= 0) {
                // Display an error message or handle the duplicate username scenario as desired
                echo "Username already exists. Please choose a different username.";

            } else {
                $updateSqlUserProfile =  "UPDATE work_slot
                SET slotDate = :newSlotDate
                WHERE slotID = :userID";
                ;

                $stmt = $this->db->prepare($updateSqlUserProfile);
                $stmt->bindValue(':userID', $userID);
                $stmt->bindValue(':newSlotDate', $updatedProfile);
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

    public function getWorkSlots($username)
    {
        try {
            $connection = $this->connect();
            // Retrieve user records from the database
            $sql = "SELECT * FROM WORK_SLOT WHERE ownerID = '$username'";
            $result = mysqli_query($connection, $sql);
            mysqli_close($connection);
            return $result;
        } catch (Exception $e) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }

    }

    public function searchSlots($searchKeyword){
      $connection = $this->connect();

      $sql = "SELECT * FROM WORK_SLOT WHERE slotDate LIKE '%$searchKeyword%'";
      $result = mysqli_query($connection, $sql);

      $searchUser = []; // Array to store BookTicket objects

      foreach ($result as $row) {
        $searchUser[] = new WorkSlot(
          $row['slotID'],
          $row['ownerID'],
          $row['chefSlot'],
          $row['cashierSlot'],
          $row['waiterSlot'],
          $row['slotDate']
        );
      }
  
      mysqli_close($connection);
      return $searchUser;
    }

    public function insertNewSlot($ownerID, $userName, $userPassword, $userEmail, $userProfile)
    {
        try {
            $connection = $this->connect();

            $insertQuery = "INSERT INTO WORK_SLOT (ownerID , chefSlot, cashierSlot, waiterSlot, slotDate) 
            VALUES ('$ownerID', '$userName', '$userPassword', '$userEmail', '$userProfile')";

            mysqli_query($connection, $insertQuery);
            mysqli_close($connection);

            return true;

        } catch (Exception $e) {

        }
    }

  } 
    

  class WorkSlot
{
    private $slotID;
    private $ownerID;
    private $chefSlot;
    private $cashierSlot;
    private $waiterSlot;
    private $slotDate;

    public function __construct($slotID, $ownerID, $chefSlot, $cashierSlot, $waiterSlot, $slotDate)
    {
        $this->slotID = $slotID;
        $this->ownerID = $ownerID;
        $this->chefSlot = $chefSlot;
        $this->cashierSlot = $cashierSlot;
        $this->waiterSlot = $waiterSlot;
        $this->slotDate = $slotDate;
    }

    public function getId()
    {
        return $this->slotID;
    }

    public function getOwnerID()
    {
        return $this->ownerID;
    }

    public function getChefSlot()
    {
        return $this->chefSlot;
    }

    public function getCashierSlot()
    {
        return $this->cashierSlot;
    }

    public function getWaiterSlot(){
        return $this->waiterSlot;
    }

    public function getSlotDate(){
      return $this->slotDate;
  }

}
?>      