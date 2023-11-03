<?php
    class fnbType{
        private $db;

        //default constructor
        public function __construct() {
            // Connect to the database
            $this->db = new PDO('mysql:host=localhost;dbname=bse_booking', 'root', '');
        }
        
        // check if FnbName is taken
        public function isFnbNameTaken($fnbName) {
            $stmt = $this->db->prepare("SELECT * FROM fnb WHERE fnbName= :fnbName");
            $stmt->bindValue(':fnbName', $fnbName);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return true; // FnbName already exists
            } else {
                return false; // FnbName doesn't exist
            }
        }
        

        // Add new FnB to the database
        public function addFnbToDatabase($fnbName, $fnbAvailability, $fnbPrice) {
            // Prepare a statement to insert the fnb information into the database
            $stmt = $this->db->prepare('INSERT INTO fnb (fnbName, fnb_availability, fnb_price) VALUES (:fnbName, :fnbAvailability, :fnbPrice)');
            $stmt->execute(array(':fnbName' =>$fnbName ,':fnbAvailability'=>$fnbAvailability, ':fnbPrice' =>$fnbPrice));
        }
        
         // Retrieve valid FnB from the database and display
         public function displayFnb($fnbName) {
            $stmt = $this->db->prepare("SELECT * FROM fnb WHERE fnbName LIKE :fnbName");
            $stmt->bindValue(':fnbName', '%' . $fnbName . '%');
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        // Retrieve all FnB records from the database
        public function retrieveAllFnb() {
            $stmt = $this->db->prepare("SELECT * FROM fnb");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        // check if FnbID exists
        public function isFnbIdExist($fnbID) {
            $stmt = $this->db->prepare("SELECT * FROM fnb WHERE fnbID= :fnbID");
            $stmt->bindValue(':fnbID', $fnbID);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return true; // FnbID exists
            } else {
                return false; // FnbID doesn't exist
            }
        }

        // Update FnB to the database
        public function updateFnbToDatabase($fnbID, $fnbName, $fnbAvailability, $fnbPrice) {
            // Prepare a statement to update the fnb information in the database
            $stmt = $this->db->prepare('UPDATE fnb SET fnbName = :fnbName, fnb_availability = :fnbAvailability, fnb_price = :fnbPrice WHERE fnbID = :fnbID');
            $stmt->execute(array(
                ':fnbID' => $fnbID,
                ':fnbName' => $fnbName,
                ':fnbAvailability' => $fnbAvailability,
                ':fnbPrice' => $fnbPrice
            ));
        }

        // Check if FnbName corresponds to the current FnbID
        public function isFnbNameCorrespondToCurrentFnbID($fnbID, $fnbName) {
            $stmt = $this->db->prepare("SELECT * FROM fnb WHERE fnbID = :fnbID AND fnbName = :fnbName");
            $stmt->bindValue(':fnbID', $fnbID);
            $stmt->bindValue(':fnbName', $fnbName);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return true; // FnbName corresponds to the current FnbID
            } else {
                return false; // FnbName is different from the current FnbID
            }
        }

        // Checks if FnbName exists elsewhere in the database, other than the current one which is associated to the FnbID 
        public function isFnbNameAlreadyExistsElsewhere($fnbID, $fnbName) {
            $stmt = $this->db->prepare("SELECT * FROM fnb WHERE fnbID != :fnbID AND fnbName = :fnbName");
            $stmt->bindValue(':fnbID', $fnbID);
            $stmt->bindValue(':fnbName', $fnbName);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return true; // FnbName already exists elsewhere
            } else {
                return false; // FnbName does not exist elsewhere
            }
        }

        // checks if fnb is already suspended 
        public function isFnbAlreadySuspended($fnbID) {
            $stmt = $this->db->prepare("SELECT fnb_availability FROM fnb WHERE fnbID = :fnbID");
            $stmt->bindValue(':fnbID', $fnbID);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result && $result['fnb_availability'] == 0) {
                return true; // FNB is already suspended
            } else {
                return false; // FNB is not suspended
            }
        }

        public function suspendFnbToDatabase($fnbID, $fnbAvailability) {
            // Prepare a statement to suspend (update fnbAvailability to 0) in the database
            $stmt = $this->db->prepare('UPDATE fnb SET fnb_availability = :fnbAvailability WHERE fnbID = :fnbID');
            $stmt->execute(array(
                ':fnbID' => $fnbID,
                ':fnbAvailability' => $fnbAvailability
            ));
        }


        
        
    }

    class fnb {
        private int $fnbID;
        private string $fnbName;
        private bool $fnb_availability;
        private int $fnb_price;
        
        public function __construct($fnbID, $fnbName, $fnb_availability, $fnb_price) {
            $this->fnbID = $fnbID;
            $this->fnbName = $fnbName;
            $this->fnb_availability = $fnb_availability;
            $this->fnb_price = $fnb_price;
        }

        public function getFnbID() {
            return $this->fnbID;
        }

        public function getFnbName() {
            return $this->fnbName;
        }

        public function getFnb_availability() {
            return $this->fnb_availability;
        }

        public function getFnb_price() {
            return $this->fnb_price;
        }

        public function setFnbID($fnbID){
            $this->fnbID = $fnbID;
        }

        public function setFnbName($fnbName){
            $this->fnbName = $fnbName;
        }

        public function setFnb_availability($fnb_availability){
            $this->fnb_availability = $fnb_availability;
        }

        public function setFnb_price($fnb_price){
            $this->fnb_price = $fnb_price;
        }

    
    }

?>