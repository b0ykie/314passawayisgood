<?php

    class ticketType{
        private $db;

        //default constructor
        public function __construct() {
            $this->db = new PDO('mysql:host=localhost;dbname=bse_booking', 'root', '');
        }

        public function getTicketDetails($dbName){
            try{
                $conn = mysqli_connect("localhost","root","",$dbName);
                $query = "SELECT * FROM ticket";
                $result =mysqli_query($conn,$query);
                return $result;
                }
            catch(Exception $e){
                echo"getTicketDetails Failed";
            }
        }
        
        public function isTypeNameTaken($ticketType){
            $stmt = $this->db->prepare("SELECT * FROM ticket WHERE ticketType= :ticketType");
            $stmt->bindValue(':ticketType', $ticketType);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result){
                return true;
            } else {
                return false;
            }
        }

        public function addTicket($ticketType, $ticketPrice){
            $stmt = $this->db->prepare('INSERT INTO ticket (ticketType, ticket_price) VALUES (:ticketType, :ticketPrice)');
            $stmt->execute(array(':ticketType'=>$ticketType,':ticketPrice'=>$ticketPrice));
        }

        public function updateTicketPrice($ticketType, $ticketPrice) {
            $stmt = $this->db->prepare('UPDATE ticket SET ticket_price = :ticketPrice WHERE ticketType = :ticketType');
            $stmt->bindParam(':ticketType', $ticketType);
            $stmt->bindParam(':ticketPrice', $ticketPrice);
            $stmt->execute();
        }
        
        public function deleteTicketType($ticketType){
            $stmt = $this->db->prepare('DELETE FROM ticket WHERE ticketType = :ticketType');
            $stmt->bindParam(':ticketType', $ticketType);
            $stmt->execute();
        }
        
        public function displayTicketType($ticketType){
            $stmt = $this->db->prepare("SELECT * FROM ticket WHERE ticketType= :ticketType");
            $stmt->bindValue(':ticketType', $ticketType);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Process the result
            foreach ($result as $row) {
                // Build the JavaScript code for the alert
                $ticketType = $row['ticketType'];
                $ticketPrice = $row['ticket_price'];
                $alertScript = "alert('Ticket Type: " . $row['ticketType'] . " $" . number_format($row['ticket_price'], 2) . "');";
        
                // Build the JavaScript code for the redirect
                $redirectScript = "window.location.href = 'ticketTypeManageBoundary.php';";
        
                // Combine the alert and redirect scripts
                $script = $alertScript . $redirectScript;
        
                // Output the JavaScript code
                echo "<script>" . $script . "</script>";
        
                // Exit the function to prevent further execution
                return;
            }
        
        }

        public function viewTicketType(){
            $stmt = $this->db->prepare("SELECT * FROM ticket");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }

    }


    class ticket {
        private $ticketID;
        private $ticketType;
        private $loyalty_pts;
        private $ticket_price;

        public function __construct($ticketID, $ticketType, $loyalty_pts, $ticket_price){
            $this->ticketID = $ticketID;
            $this->ticketType = $ticketType;
            $this->loyalty_pts = $loyalty_pts;
            $this->ticket_price = $ticket_price;
        }

        public function getTicketID(){
            return $this->ticketID;
        }

        public function getTicketType(){
            return $this->ticketType;
        }

        public function getLoyaltyPts(){
            return $this->loyalty_pts;
        }

        public function getTicketPrice(){
            return $this->ticket_price;
        }

        public function setTicketType(){
            return $this->ticketType;
        }

        public function setTicketPrice(){
            return $this->ticket_price;
        }
    }

   
?>