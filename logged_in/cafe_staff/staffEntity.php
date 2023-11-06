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

        public function getWorkSlotManager($slotID)
        {
            try {
                $connection = $this->connect();
                $sql = "SELECT managerID FROM WORK_SLOT ws
                        where ws.slotID = '$slotID'";
                $result = mysqli_query($connection, $sql);
                mysqli_close($connection);
                
                if ($result) {
                    $row = mysqli_fetch_assoc($result); // Fetch the row as an associative array
                    if ($row) {
                        $slotDate = $row['managerID']; // Access the 'staffRole' value from the array
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
                $sql = "SELECT ws.*
                        FROM WORK_SLOT ws
                        LEFT JOIN bidding_table bt ON ws.slotDate = bt.slot_id AND bt.staff_id = '$userID'
                        WHERE bt.staff_id IS NULL
                        AND (ws.managerID IS NULL OR ws.managerID <> 'dummymanager')";
                $result = mysqli_query($connection, $sql);
                mysqli_close($connection);
                return $result;
            } catch (Exception $e) {
                die('Failed to connect to the database: ' . mysqli_connect_error());
            }
        }

        public function searchSlots($userID, $searchKeyword){
            $connection = $this->connect();
      
            $sql = "SELECT ws.*
                    FROM WORK_SLOT ws
                    LEFT JOIN bidding_table bt ON ws.slotDate = bt.slot_id AND bt.staff_id = '$userID'
                    WHERE bt.staff_id IS NULL
                    AND (ws.managerID IS NULL OR ws.managerID <> 'dummymanager')
                    AND ws.slotDate LIKE '%$searchKeyword%'";
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
    }

    class SlotBid
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

        public function createSlotBid($username, $userrole, $slotdate, $slotmanager)
        {
            try {
                $stmt = $this->db->prepare('INSERT INTO bidding_table (staff_id, role, slot_id, managed_by) VALUES (:username, :userrole, :slotdate, :managerID)');
                $stmt->execute(array(':username' => $username, ':userrole' => $userrole, ':slotdate' => $slotdate, ':managerID' => $slotmanager));
                return true;
            } catch (Exception $e) {
                die('Failed to connect to the database: ' . mysqli_connect_error());
            }
            
        }

        public function getUserPendingBids($userID, $userrole)
        {
            try {
                $connection = $this->connect();
                $sql = "SELECT * FROM bidding_table bt
                        WHERE bidding_status = 'pending'
                        AND staff_id = '$userID'
                        AND role = '$userrole'";
                $result = mysqli_query($connection, $sql);
                mysqli_close($connection);
                return $result;
            } catch (Exception $e) {
                die('Failed to connect to the database: ' . mysqli_connect_error());
            }
        }

        public function searchUserPendingBids($userID, $userrole, $searchKeyword){
            $connection = $this->connect();
      
            $sql = "SELECT * 
                    FROM bidding_table
                    WHERE bidding_status = 'pending'
                    AND staff_id = '$userID'
                    AND role = '$userrole'
                    AND slot_id LIKE '%$searchKeyword%'";
            $result = mysqli_query($connection, $sql);
      
            $searchUserPendingBids = [];
      
            foreach ($result as $row) {
              $searchUserPendingBids[] = new Bid(
                $row['id'],
                $row['staff_id'],
                $row['bidding_status'],
                $row['role'],
                $row['slot_id'],
                $row['managed_by']
              );
            }
        
            mysqli_close($connection);
            return $searchUserPendingBids;
        }

        public function getUserSuccessfulBids($userID, $userrole)
        {
            try {
                $connection = $this->connect();
                $sql = "SELECT * FROM bidding_table bt
                        WHERE bidding_status = 'approved'
                        AND staff_id = '$userID'
                        AND role = '$userrole'";
                $result = mysqli_query($connection, $sql);
                mysqli_close($connection);
                return $result;
            } catch (Exception $e) {
                die('Failed to connect to the database: ' . mysqli_connect_error());
            }
        }

        public function searchUserSuccessfulBids($userID, $userrole, $searchKeyword){
            $connection = $this->connect();
      
            $sql = "SELECT * 
                    FROM bidding_table
                    WHERE bidding_status = 'approved'
                    AND staff_id = '$userID'
                    AND role = '$userrole'
                    AND slot_id LIKE '%$searchKeyword%'";
            $result = mysqli_query($connection, $sql);
      
            $searchUserPendingBids = [];
      
            foreach ($result as $row) {
              $searchUserPendingBids[] = new Bid(
                $row['id'],
                $row['staff_id'],
                $row['bidding_status'],
                $row['role'],
                $row['slot_id'],
                $row['managed_by']
              );
            }
        
            mysqli_close($connection);
            return $searchUserPendingBids;
        }

        public function getUserRejectedBids($userID, $userrole)
        {
            try {
                $connection = $this->connect();
                $sql = "SELECT * FROM bidding_table bt
                        WHERE bidding_status = 'rejected'
                        AND staff_id = '$userID'
                        AND role = '$userrole'";
                $result = mysqli_query($connection, $sql);
                mysqli_close($connection);
                return $result;
            } catch (Exception $e) {
                die('Failed to connect to the database: ' . mysqli_connect_error());
            }
        }

        public function searchUserRejectedBids($userID, $userrole, $searchKeyword){
            $connection = $this->connect();
      
            $sql = "SELECT * 
                    FROM bidding_table
                    WHERE bidding_status = 'rejected'
                    AND staff_id = '$userID'
                    AND role = '$userrole'
                    AND slot_id LIKE '%$searchKeyword%'";
            $result = mysqli_query($connection, $sql);
      
            $searchUserPendingBids = [];
      
            foreach ($result as $row) {
              $searchUserPendingBids[] = new Bid(
                $row['id'],
                $row['staff_id'],
                $row['bidding_status'],
                $row['role'],
                $row['slot_id'],
                $row['managed_by']
              );
            }
        
            mysqli_close($connection);
            return $searchUserPendingBids;
        }
    }

    class Bid
    {
        private $bidID;
        private $staffID;
        private $biddingStatus;
        private $role;
        private $slotID;
        private $managerID;

        public function __construct($bidID, $staffID, $biddingStatus, $role, $slotID, $managerID)
        {
            $this->bidID = $bidID;
            $this->staffID = $staffID;
            $this->biddingStatus = $biddingStatus;
            $this->role = $role;
            $this->slotID = $slotID;
            $this->managerID = $managerID;
        }

        public function getBidID()
        {
            return $this->bidID;
        }

        public function getStaffID()
        {
            return $this->staffID;
        }

        public function getBiddingStatus()
        {
            return $this->biddingStatus;
        }

        public function getRole()
        {
            return $this->role;
        }

        public function getSlotID(){
            return $this->slotID;
        }

        public function getManagerID(){
            return $this->managerID;
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
?>