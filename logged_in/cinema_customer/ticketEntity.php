<?php

    class ticket {

        private $db;

        public function __construct() {
            $this->db = new PDO('mysql:host=localhost;dbname=bse_booking', 'root', '');
        }

        public function getTicket(){
            try {
                $query = "SELECT * FROM ticket";
                $stmt = $this->db->prepare($query);
                $stmt->execute();
        
                $ticket = [];
        
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $ticket[] = new ticketE($row['ticketID'], $row['ticketType'], $row['loyalty_pts'], $row['ticket_price']);
                }
        
                return $ticket;

            } catch(Exception $e){
                echo "getAvailfnb failed";
            }
        }
        

        
        
    }


    class ticketE {
       
        private int $ticketID  ;
        private string $ticketType;
        private int $loyalty_pts;
        private int $ticket_price;

        public function __construct($ticketID, $ticketType, $loyalty_pts, $ticket_price) {
            $this->ticketID = $ticketID;
            $this->ticketType = $ticketType;
            $this->loyalty_pts = $loyalty_pts;
            $this->ticket_price = $ticket_price;
        }

        #getter and setters
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
    
    }

?>