<?php
    class User
    {
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

        public function getUserRole($username) {
            $connection = $this->connect();
            $userID = mysqli_real_escape_string($connection, $username);
            $sql = "SELECT cs.staffRole FROM cafe_staff cs
                    LEFT JOIN user_account ua 
                    ON cs.userID = ua.userName
                    WHERE ua.userName =  '$username'";
            $result = mysqli_query($connection, $sql);
        
            if (mysqli_num_rows($result) > 0) {
                $result = mysqli_fetch_assoc($result);
                $userRole = strval($result['staffRole']);
                return $userRole;
            }
        }
    }

    class Slots
    {
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

        public function getWorkSlotID($slotID)
        {
            try {
                $connection = $this->connect();
                $sql = "SELECT slotID FROM WORK_SLOT ws
                        where ws.slotID = '$slotID'";
                $result = mysqli_query($connection, $sql);
                mysqli_close($connection);
                return $result;
            } catch (Exception $e) {
                die('Failed to connect to the database: ' . mysqli_connect_error());
            }
        }

        public function getWorkSlotDate($slotID)
        {
            try {
                $connection = $this->connect();
                $sql = "SELECT slotDate FROM WORK_SLOT ws
                        where ws.slotID = '$slotID'";
                $result = mysqli_query($connection, $sql);
                mysqli_close($connection);

                if ($result) {
                    $row = mysqli_fetch_assoc($result); // Fetch the row as an associative array
                    if ($row) {
                        $slotDate = $row['slotDate']; // Access the 'staffRole' value from the array
                        return $slotDate;
                    }
                }
            } catch (Exception $e) {
                die('Failed to connect to the database: ' . mysqli_connect_error());
            }
        }

        public function getWorkSlots($userID)
        {
            try {
                $connection = $this->connect();
                $sql = "SELECT *
                        FROM WORK_SLOT
                        where managerID = 'dummymanager'";
                $result = mysqli_query($connection, $sql);
                mysqli_close($connection);
                return $result;
            } catch (Exception $e) {
                die('Failed to connect to the database: ' . mysqli_connect_error());
            }
        }

        public function searchSlots($searchKeyword){
            $connection = $this->connect();
      
            $sql = "SELECT *
                    FROM WORK_SLOT
                    WHERE slotDate LIKE '%$searchKeyword%'
                    and managerID = 'dummymanager'";
            $result = mysqli_query($connection, $sql);
      
            $searchUser = []; // Array to store BookTicket objects
      
            foreach ($result as $row) {
              $searchUser[] = new WorkSlot(
                $row['slotID'],
                $row['ownerID'],
                $row['chefSlot'],
                $row['cashierSlot'],
                $row['waiterSlot'],
                $row['slotDate'],
                $row['managerID']
              );
            }
        
            mysqli_close($connection);
            return $searchUser;
          }

          public function getSlotByID($userID) {
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
                $row['slotDate'],
                $row['managerID']
              );
            }
          }

          public function updateSlotManager($slotDate, $slotID, $username)
          {
              try {
                  $connection = $this->connect();
      
                  $checkSql = "SELECT * FROM WORK_SLOT WHERE slotID = '$slotID'";
                  $checkResult = mysqli_query($connection, $checkSql);
                  // Check if a user with the same username exists
                  if (mysqli_num_rows($checkResult) <= 0) {
                      // Display an error message or handle the duplicate username scenario as desired
                      echo "Username already exists. Please choose a different username.";
      
                  } else {
                      $updateSqlUserProfile =  "UPDATE work_slot
                      SET managerID = :managerID
                      WHERE slotID = :slotID
                      AND slotDate = :slotDate";
      
                      $stmt = $this->db->prepare($updateSqlUserProfile);
                      $stmt->bindValue(':managerID', $username);
                      $stmt->bindValue(':slotID', $slotID);
                      $stmt->bindValue(':slotDate', $slotDate);
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

        public function getIcSlots($username)
        {
            try {
                $connection = $this->connect();
                $sql = "SELECT *
                        FROM WORK_SLOT
                        where managerID = '$username'";
                $result = mysqli_query($connection, $sql);
                mysqli_close($connection);
                return $result;
            } catch (Exception $e) {
                die('Failed to connect to the database: ' . mysqli_connect_error());
            }
        }

        public function searchIcSlots($searchKeyword, $username){
        $connection = $this->connect();
    
        $sql = "SELECT *
                FROM WORK_SLOT
                WHERE slotDate LIKE '%$searchKeyword%'
                and managerID = '$username'";
        $result = mysqli_query($connection, $sql);
    
        $searchUser = []; // Array to store BookTicket objects
    
        foreach ($result as $row) {
            $searchUser[] = new WorkSlot(
            $row['slotID'],
            $row['ownerID'],
            $row['chefSlot'],
            $row['cashierSlot'],
            $row['waiterSlot'],
            $row['slotDate'],
            $row['managerID']
            );
        }
            mysqli_close($connection);
            return $searchUser;
        }

        public function updateIcSlot($newChefSlot, $newCashierSlot, $newWaiterSlot, $slotID)
        {
            try {
                $connection = $this->connect();

                $updateSqlUserProfile =  
                    "UPDATE WORK_SLOT
                    SET
                    chefSlot = :newChefSlot,
                    cashierSlot = :newCashierSlot,
                    waiterSlot = :newWaiterSlot
                    WHERE slotID = :slotID";
                $stmt = $this->db->prepare($updateSqlUserProfile);
                $stmt->bindValue(':newChefSlot', $newChefSlot);
                $stmt->bindValue(':newCashierSlot', $newCashierSlot);
                $stmt->bindValue(':newWaiterSlot', $newWaiterSlot);
                $stmt->bindValue(':slotID', $slotID);
                $stmt->execute();

                // Check if any rows were affected by the update
                if ($stmt->rowCount() > 0) {
                    return true; // Successfully updated the slot
                } else {
                    // No matching slot found, so return an error message
                    return "Slot not found or not updated.";
                }
            } catch (Exception $e) {
                die('Failed to connect to the database: ' . mysqli_connect_error());
            }
        }

        public function getSlotDate($slotID)
        {
            try {
                $connection = $this->connect();
                $sql = "SELECT slotDate FROM WORK_SLOT ws
                        where ws.slotID = '$slotID'";
                $result = mysqli_query($connection, $sql);
                mysqli_close($connection);
                return $result;
            } catch (Exception $e) {
                die('Failed to connect to the database: ' . mysqli_connect_error());
            }
        }

    }

    class Bids 
    {
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

        public function getPendingBids($slotID)
        {
            try {
                $status = 'pending';
                $connection = $this->connect();
                // SQL query to retrieve pending bids for the specified work slot
                $sql = "SELECT ua.userEmail, bt.*, ua.userName
                        FROM bidding_table bt
                        INNER JOIN user_account ua 
                        ON ua.userName = bt.staff_id 
                        WHERE bt.slot_id = '$slotID'
                        AND bt.bidding_status = '$status'";
                        
                $result = mysqli_query($connection, $sql);
                mysqli_close($connection);
                return $result;
            } catch (Exception $e) {
                die('Failed to connect to the database: ' . $e->getMessage());
            }
        }

        public function getApprovedBids($slotID)
        {
            try {
                $status = 'approved';
                $connection = $this->connect();
                // SQL query to retrieve pending bids for the specified work slot
                $sql = "SELECT ua.userEmail, bt.*, ua.userName
                        FROM bidding_table bt
                        INNER JOIN user_account ua 
                        ON ua.userName = bt.staff_id 
                        WHERE bt.slot_id = '$slotID'
                        AND bt.bidding_status = '$status'";
                        
                $result = mysqli_query($connection, $sql);
                mysqli_close($connection);
                return $result;
            } catch (Exception $e) {
                die('Failed to connect to the database: ' . $e->getMessage());
            }
        }

        public function getRejectedBids($slotID)
        {
            try {
                $status = 'rejected';
                $connection = $this->connect();
                // SQL query to retrieve pending bids for the specified work slot
                $sql = "SELECT ua.userEmail, bt.*, ua.userName
                        FROM bidding_table bt
                        INNER JOIN user_account ua 
                        ON ua.userName = bt.staff_id 
                        WHERE bt.slot_id = '$slotID'
                        AND bt.bidding_status = '$status'";
                        
                $result = mysqli_query($connection, $sql);
                mysqli_close($connection);
                return $result;
            } catch (Exception $e) {
                die('Failed to connect to the database: ' . $e->getMessage());
            }
        }

        public function searchApprovedBids($slotDate, $searchKeyword)
        {
            try {
                $connection = $this->connect();
                $status = 'approved';
                $sql = "SELECT bt.staff_id , bt.`role`, bt.id
                        FROM bidding_table bt
                        INNER JOIN user_account ua 
                        ON ua.userName = bt.staff_id 
                        WHERE bt.slot_id = '$slotDate'
                        AND bt.bidding_status = '$status'
                        and bt.staff_id LIKE '%$searchKeyword%'";
                $result = mysqli_query($connection, $sql);
                mysqli_close($connection);
                return $result;
            } catch (Exception $e) {
                die('Failed to connect to the database: ' . $e->getMessage());
            }    
        }

        public function searchPendingBids($slotDate, $searchKeyword)
        {
            try {
                $connection = $this->connect();
                $status = 'pending';
                $sql = "SELECT bt.staff_id , bt.`role`, bt.id
                        FROM bidding_table bt
                        INNER JOIN user_account ua 
                        ON ua.userName = bt.staff_id 
                        WHERE bt.slot_id = '$slotDate'
                        AND bt.bidding_status = '$status'
                        and bt.staff_id LIKE '%$searchKeyword%'";
                $result = mysqli_query($connection, $sql);
                mysqli_close($connection);
                return $result;
            } catch (Exception $e) {
                die('Failed to connect to the database: ' . $e->getMessage());
            }    
        }

        public function searchRejectedBids($slotDate, $searchKeyword)
        {
            try {
                $connection = $this->connect();
                $status = 'rejected';
                $sql = "SELECT bt.staff_id , bt.`role`, bt.id
                        FROM bidding_table bt
                        INNER JOIN user_account ua 
                        ON ua.userName = bt.staff_id 
                        WHERE bt.slot_id = '$slotDate'
                        AND bt.bidding_status = '$status'
                        and bt.staff_id LIKE '%$searchKeyword%'";
                $result = mysqli_query($connection, $sql);
                mysqli_close($connection);
                return $result;
            } catch (Exception $e) {
                die('Failed to connect to the database: ' . $e->getMessage());
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
        private $managerID;

        public function __construct($slotID, $ownerID, $chefSlot, $cashierSlot, $waiterSlot, $slotDate, $managerID)
        {
            $this->slotID = $slotID;
            $this->ownerID = $ownerID;
            $this->chefSlot = $chefSlot;
            $this->cashierSlot = $cashierSlot;
            $this->waiterSlot = $waiterSlot;
            $this->slotDate = $slotDate;
            $this->managerID = $managerID;
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

        public function getManagerID(){
            return $this->managerID;
        }
    }

    class Bid
    {
        private $bidID;
        private $cafeStaffID;
        private $bidStatus;
        private $cafeStaffRole;
        private $slotDate;
        private $managerID;

        public function __construct($bidID, $cafeStaffID, $bidStatus, $cafeStaffRole, $slotDate, $managerID)
        {
            $this->bidID = $bidID;
            $this->cafeStaffID = $cafeStaffID;
            $this->bidStatus = $bidStatus;
            $this->cafeStaffRole = $cafeStaffRole;
            $this->slotDate = $slotDate;
            $this->managerID = $managerID;
        }

        public function getBidID()
        {
            return $this->bidID;
        }

        public function getCafeStaffID()
        {
            return $this->cafeStaffID;
        }

        public function getBidStatus()
        {
            return $this->bidStatus;
        }

        public function getCafeStaffRole()
        {
            return $this->cafeStaffRole;
        }

        public function getSlotDate(){
        return $this->slotDate;
        }

        public function getManagerID(){
            return $this->managerID;
        }
    }
?>